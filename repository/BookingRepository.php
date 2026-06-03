<?php
// Repository/Booking.php

// Load the Booking business model, as the Repository must instantiate and return Booking objects.
require_once __DIR__ . '/../model/Booking.php';

// Load the MemberRepository so we can join the foreign keys
require_once __DIR__ . '/../repository/MemberRepository.php';
// Load the SessionRepository so we can join the foreign keys
require_once __DIR__ . '/../repository/SessionRepository.php';

// Load the DatabaseSingleton, as the Repository needs its generic query execution methods.
require_once __DIR__ . '/../database/DatabaseSingleton.php';

class BookingRepository {

    // Dependency Injection: The Repository requires the Database access object.
    private DatabaseSingleton $db;
    private Auditer $auditer;
    private MemberRepository $memberRepository;
    private SessionRepository $sessionRepository;
    public function __construct(DatabaseSingleton $db, Auditer $auditer) {
        $this->db = $db;
        $this->auditer = $auditer;
        $this->memberRepository = new MemberRepository($db, $auditer);
        $this->sessionRepository = new SessionRepository($db, $auditer);
    }

    /**
     * Converts a raw database array row into a Booking Model object.
     * This is the bridge between the Data Access Layer (Repository) and the
     * Business Logic Layer (Model).
     */
    private function createModelFromRow(array $row): Booking {
        return new Booking(
            (int)$row["bookingId"],
            $this->sessionRepository->findById($row["sessionId"]),
            $this->memberRepository->findById($row["memberId"]),
            DateTimeImmutable::createFromFormat("Y-m-d", $row["date"]),
            (int)$row["seats"],
            (float)$row["pricePerSeat"]
        );
    }

    // ----------------------------------------------------------------------
    //                           FETCH METHODS
    // ----------------------------------------------------------------------

    /**
     * Finds a single Booking by its primary key ID.
     */
    public function findById(int $id): ?Booking {
        $sql = "SELECT * FROM `bookings` WHERE `bookingId` = :id";

        $results = $this->db->query($sql, ['id' => $id]);

        if (empty($results)) {
            return null;
        }

        // Convert the raw data to a single Booking object
        return $this->createModelFromRow($results[0]);
    }

    /**
     * Gets the latest (largest) bookingId in the database
     */
    public function findLatestId(): ?int {
        $sql = "SELECT bookingId FROM bookings ORDER BY bookingId DESC";
        
        $results = $this->db->query($sql);
        
        if (empty($results)) {
            return null;
        }

        return $results[0]['bookingId'];
    }

    /**
     * Finds all Bookings in the database.
     * @return Booking[] An array of Booking objects
     */
    public function findAll(): array {
        $sql = "SELECT * FROM `bookings` ORDER BY `bookingId` ASC";
        $results = $this->db->query($sql);

        // Convert all raw results into an array of Booking objects
        return array_map($this->createModelFromRow(...), $results);
    }

    /**
     * Finds all Bookings in the database that have been made by a given member
     * @param Member $member
     * @return array[Booking]
     */
    public function findByMember(Member $member): array {
        $sql = "SELECT * FROM `bookings` WHERE memberId = :id";
        $results = $this->db->query($sql, ["id" => $member->memberId]);

        // Convert all raw results into an array of Booking objects
        return array_map($this->createModelFromRow(...), $results);
    }

    // ----------------------------------------------------------------------
    //                           PERSISTENCE METHOD
    // ----------------------------------------------------------------------

    /**
     * Saves a Booking Model to the database, handling either INSERT or UPDATE.
     * @return bool Success Did the INSERT/UPDATE succeed or fail?
     */
    public function save(Booking $booking): bool {
        if ($booking->bookingId === null) {
            // INSERT (New Booking)
            if (!$this->auditer->create($booking)) {return false;};
            $sql = "INSERT INTO bookings VAlUES (NULL, :sessionId, :memberId, :seats, :pricePerSeat, :date)";
            $rowsAffected = $this->db->execute($sql, ["sessionId" => $booking->session->sessionId, "memberId" => $booking->member->memberId, "seats" => $booking->seats, "pricePerSeat" => $booking->pricePerSeat, "date" => $booking->date->format("Y-m-d")]);
            return $rowsAffected > 0;
        }
        else {
            // UPDATE (Existing Booking)
            if (!$this->auditer->update($booking)) {return false;}
            $sql = "UPDATE bookings SET sessionId = :sessionId, memberId = :memberId, seats = :seats, pricePerSeat = :pricePerSeat, date = :date WHERE bookingId = :id";
            $rowsAffected = $this->db->execute($sql, ["id" => $booking->bookingId, "sessionId" => $booking->session->sessionId, "memberId" => $booking->member->memberId, "seats" => $booking->seats, "pricePerSeat" => $booking->pricePerSeat, "date" => $booking->date->format("Y-m-d")]);
            return $rowsAffected == 1;
        }
    }

    /**
     * Deletes a Booking Model from the database
     * @param Booking $booking
     * @return bool Success. Did the DELETE succeed or fail
     */
    public function delete(Booking $booking): bool {
        if (!$this->auditer->delete($booking)) {return false;}
        $sql = "DELETE FROM bookings WHERE bookingId = :id";
        $rowsAffected = $this->db->execute($sql, ["id" => $booking->bookingId]);
        return $rowsAffected == 1;
    }
}
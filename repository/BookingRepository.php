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
        $sql = "SELECT * FROM `Bookings` WHERE `bookingId` = :id";

        $results = $this->db->query($sql, ['id' => $id]);

        if (empty($results)) {
            return null;
        }

        // Convert the raw data to a single Booking object
        return $this->createModelFromRow($results[0]);
    }

    /**
     * Finds all Bookings in the database.
     * @return Booking[] An array of Booking objects
     */
    public function findAll(): array {
        $sql = "SELECT * FROM `Bookings` ORDER BY `bookingId` ASC";
        $results = $this->db->query($sql);

        // Convert all raw results into an array of Booking objects
        return array_map($this->createModelFromRow(...), $results);
    }

    public function findByName(string $name): ?Booking {
        $sql = "SELECT * FROM `Bookings` WHERE `bookingName` = :name";

        $results = $this->db->query($sql, ['name' => $name]);

        if (empty($results)) {
            return null;
        }

        // Convert the raw data to a single Booking object
        return $this->createModelFromRow($results[0]);
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
            $sql = "INSERT INTO bookings VAlUES (NULL, :sessionId, :memberId, :seats, :pricePerSeat)";
            $rowsAffected = $this->db->execute($sql, ["sessionId" => $booking->session->sessionId, "memberId" => $booking->member->memberId, "seats" => $booking->seats, "pricePerSeat" => $booking->pricePerSeat]);
            return $rowsAffected > 0;
        }
        else {
            // UPDATE (Existing Booking)
            if (!$this->auditer->update($booking)) {return false;}
            $sql = "UPDATE bookings SET sessionId = :sessionId, memberId = :memberId, seats = :seats, pricePerSeat = :pricePerSeat WHERE bookingId = :id";
            $rowsAffected = $this->db->execute($sql, ["id" => $booking->bookingId, "sessionId" => $booking->session->sessionId, "memberId" => $booking->member->memberId, "seats" => $booking->seats, "pricePerSeat" => $booking->pricePerSeat]);
            return $rowsAffected == 1;
        }
    }
}
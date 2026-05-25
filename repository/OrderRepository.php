<?php
// Repository/Order.php

// Load the Order business model, as the Repository must instantiate and return Order objects.
require_once __DIR__ . '/../model/Order.php';

// Load the MemberRepository so we can join the foreign keys
require_once __DIR__ . '/../repository/MemberRepository.php';

// Load the DatabaseSingleton, as the Repository needs its generic query execution methods.
require_once __DIR__ . '/../database/DatabaseSingleton.php';

class OrderRepository {

    // Dependency Injection: The Repository requires the Database access object.
    private DatabaseSingleton $db;
    private Auditer $auditer;
    private MemberRepository $memberRepository;

    public function __construct(DatabaseSingleton $db, Auditer $auditer) {
        $this->db = $db;
        $this->auditer = $auditer;

        $this->memberRepository = new MemberRepository($db, $auditer);
    }

    /**
     * Converts a raw database array row into a Order Model object.
     * This is the bridge between the Data Access Layer (Repository) and the
     * Business Logic Layer (Model).
     */
    private function createModelFromRow(array $row): Order {
        return new Order(
            (int)$row['orderId'],
            $this->memberRepository->findById($row['memberId']),
            new DateTime($row['orderDate']),
            OrderStatus::from($row["orderStatus"])
        );
    }

    // ----------------------------------------------------------------------
    //                           FETCH METHODS
    // ----------------------------------------------------------------------

    /**
     * Finds a single Order by its primary key ID.
     */
    public function findById(int $id): ?Order {
        $sql = "SELECT * FROM `orders` WHERE `orderId` = :id";

        $results = $this->db->query($sql, ['id' => $id]);

        if (empty($results)) {
            return null;
        }

        // Convert the raw data to a single Movie object
        return $this->createModelFromRow($results[0]);
    }

    /**
     * Gets the latest (largest) orderId in the database
     */
    public function findLatestId(): ?int {
        $sql = "SELECT orderId FROM orders ORDER BY orderId DESC";
        
        $results = $this->db->query($sql);
        
        if (empty($results)) {
            return null;
        }

        return $results[0]['orderId'];
    }

    /**
     * Finds all orders in the database.
     * @return Order[] An array of Order objects
     */
    public function findAll(): array {
        $sql = "SELECT * FROM `orders` ORDER BY `orderId` ASC";
        $results = $this->db->query($sql);

        // Convert all raw results into an array of Movie objects
        return array_map($this->createModelFromRow(...), $results);
    }

    /**
     * Finds all orders in the database that were made by a specified member.
     * @param Member $member The member
     * @return Order[] An array of Order objects
     */
    public function findByMember(Member $member): array {
        $sql = "SELECT * FROM `orders` WHERE memberId = :id";
        $results = $this->db->query($sql, ["id" => $member->memberId]);

        // Convert all raw results into an array of Movie objects
        return array_map($this->createModelFromRow(...), $results);
    }

    // ----------------------------------------------------------------------
    //                           PERSISTENCE METHOD
    // ----------------------------------------------------------------------

    /**
     * Saves a Order Model to the database, handling either INSERT or UPDATE.
     * @return bool Success Did the INSERT/UPDATE succeed or fail?
     */
    public function save(Order $order): bool {
        if ($order->orderId === null) {
            // INSERT (New Order)
            if (!$this->auditer->create($order)) {return false;};
            $sql = "INSERT INTO orders VAlUES (:id, :memberId, :time, :status)";
            $rowsAffected = $this->db->execute($sql, ["id" => $order->orderId, "memberId" => $order->member->memberId, "time" => $order->orderDate->format("Y-m-d H:i:s"), "status" => $order->orderStatus->value]);
            return $rowsAffected > 0;
        }
        else {
            // UPDATE (Existing Order). Note: No one is changing the member an order is assigned to. Therefore such a change will simply not be written to the database.
            if (!$this->auditer->update($order)) {return false;}
            $sql = "UPDATE orders SET orderDate = :time, orderStatus = :status, WHERE orderId = :id";
            $rowsAffected = $this->db->execute($sql, ["id" => $order->orderId, "time" => $order->orderDate->format("Y-m-d H:i:s"), "status" => $order->orderStatus->value]);
            return $rowsAffected == 1;
        }
    }
}
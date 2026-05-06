<?php
// Repository/OrderItem.php

// Load the OrderItem business model, as the Repository must instantiate and return OrderItem objects.
require_once __DIR__ . '/../model/OrderItem.php';

// Load the SessionRepository so we can join the foreign keys
require_once __DIR__ . '/../repository/SessionRepository.php';
// Load the OrderRepository so we can join the foreign keys
require_once __DIR__ . '/../repository/OrderRepository.php';

// Load the DatabaseSingleton, as the Repository needs its generic query execution methods.
require_once __DIR__ . '/../database/DatabaseSingleton.php';

class OrderItemRepository {

    // Dependency Injection: The Repository requires the Database access object.
    private DatabaseSingleton $db;
    private Auditer $auditer;
    private OrderRepository $orderRepository;
    private SessionRepository $sessionRepository;
    public function __construct(DatabaseSingleton $db, Auditer $auditer) {
        $this->db = $db;
        $this->auditer = $auditer;
        $this->orderRepository = new OrderRepository($db, $auditer);
        $this->sessionRepository = new SessionRepository($db, $auditer);
    }

    /**
     * Converts a raw database array row into a OrderItem Model object.
     * This is the bridge between the Data Access Layer (Repository) and the
     * Business Logic Layer (Model).
     */
    private function createModelFromRow(array $row): OrderItem {
        return new OrderItem(
            (int)$row["orderItemId"],
            $this->orderRepository->findById($row["orderItemId"]),
            $this->sessionRepository->findById($row["sessionId"]),
            (int)$row["seats"],
            (float)$row["pricePerSeat"]
        );
    }

    // ----------------------------------------------------------------------
    //                           FETCH METHODS
    // ----------------------------------------------------------------------

    /**
     * Finds a single OrderItem by its primary key ID.
     */
    public function findById(int $id): ?OrderItem {
        $sql = "SELECT * FROM `orderItems` WHERE `orderItemId` = :id";

        $results = $this->db->query($sql, ['id' => $id]);

        if (empty($results)) {
            return null;
        }

        // Convert the raw data to a single OrderItem object
        return $this->createModelFromRow($results[0]);
    }

    /**
     * Finds all OrderItems in the database.
     * @return OrderItem[] An array of OrderItem objects
     */
    public function findAll(): array {
        $sql = "SELECT * FROM `orderItems` ORDER BY `orderItemId` ASC";
        $results = $this->db->query($sql);

        // Convert all raw results into an array of OrderItem objects
        return array_map($this->createModelFromRow(...), $results);
    }

    /**
     * Finds all OrderItems in the database that belong to a specific Order
     * @param Order $order
     * @return array[OrderItem]
     */
    public function findByMember(Order $order): array {
        $sql = "SELECT * FROM `orderItems` WHERE orderId = :id";
        $results = $this->db->query($sql, ["id" => $order->orderId]);

        // Convert all raw results into an array of OrderItem objects
        return array_map($this->createModelFromRow(...), $results);
    }

    // ----------------------------------------------------------------------
    //                           PERSISTENCE METHOD
    // ----------------------------------------------------------------------

    /**
     * Saves a OrderItem Model to the database, handling either INSERT or UPDATE.
     * @return bool Success Did the INSERT/UPDATE succeed or fail?
     */
    public function save(OrderItem $orderItem): bool {
        if ($orderItem->orderItemId === null) {
            // INSERT (New OrderItem)
            if (!$this->auditer->create($orderItem)) {return false;};
            $sql = "INSERT INTO orderItems VAlUES (NULL, :orderId, :sessionId, :seats, :pricePerSeat)";
            $rowsAffected = $this->db->execute($sql, ["orderId" => $orderItem->order->orderId, "sessionId" => $orderItem->session->sessionId, "seats" => $orderItem->seats, "pricePerSeat" => $orderItem->pricePerSeat]);
            return $rowsAffected > 0;
        }
        else {
            // UPDATE (Existing OrderItem)
            if (!$this->auditer->update($orderItem)) {return false;}
            $sql = "UPDATE orderItems SET orderId = :orderId, sessionId = :sessionId, seats = :seats, pricePerSeat = :pricePerSeat WHERE orderItemId = :id";
            $rowsAffected = $this->db->execute($sql, ["id" => $orderItem->orderItemId, "orderId" => $orderItem->order->orderId, "sessionId" => $orderItem->session->sessionId, "seats" => $orderItem->seats, "pricePerSeat" => $orderItem->pricePerSeat]);
            return $rowsAffected == 1;
        }
    }
}
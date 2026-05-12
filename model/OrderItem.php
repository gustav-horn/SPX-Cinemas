<?php
// Model/OrderItem.php

require_once __DIR__ . "/../utilities/Auditer.php";

class OrderItem implements Auditable {
    // Properties match the database columns for data storage
    // Note:
    //  ? at type indicates the property can be null

    public ?int $orderItemId;
    public Order $order;
    public Session $session;
    public int $seats;
    public float $pricePerSeat;

    public function __construct(
        ?int $id,
        Order $order,
        Session $session,
        int $seats,
        float $pricePerSeat,
    ) {
        $this->orderItemId = $id;
        $this->order = $order;
        $this->session = $session;
        $this->seats = $seats;
        $this->pricePerSeat = $pricePerSeat;
    }
    
    public function getCost(): float {
        return $this->seats * $this->pricePerSeat;
    }

    public function repr(): string {
        $order = $this->order->repr();
        $session = $this->session->repr();
        return "OrderItem(id = $this->orderItemId, order = $order, session = $session, seats = $this->seats, pricePerSeat = $this->pricePerSeat)";
    }

    public function name(): string {
        return "OrderItem";
    }
}
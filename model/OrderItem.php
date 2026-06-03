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
    public DateTimeImmutable $date;
    public int $seats;
    public float $pricePerSeat;

    public function __construct(
        ?int $id,
        Order $order,
        Session $session,
        DateTimeImmutable $date,
        int $seats,
        float $pricePerSeat,
    ) {
        $this->orderItemId = $id;
        $this->order = $order;
        $this->session = $session;
        $this->date = $date;
        $this->seats = $seats;
        $this->pricePerSeat = $pricePerSeat;
    }
    
    public function getCost(): float {
        return $this->seats * $this->pricePerSeat;
    }

    public function repr(): string {
        $order = $this->order->repr();
        $session = $this->session->repr();
        $date = $this->date->format("Y-m-d");
        return "OrderItem(id = $this->orderItemId, order = $order, session = $session, date = $date, seats = $this->seats, pricePerSeat = $this->pricePerSeat)";
    }

    public function name(): string {
        return "OrderItem";
    }
}
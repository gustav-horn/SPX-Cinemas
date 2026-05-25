<?php
// Model/Order.php

require_once __DIR__ . "/../utilities/Auditer.php";

enum OrderStatus: string {
    case Booked = "Booked";
}

class Order implements Auditable {
    // Properties match the database columns for data storage
    // Note:
    //  ? at type indicates the property can be null

    public ?int $orderId;
    public Member $member;
    public DateTime $orderDate;

    public OrderStatus $orderStatus;

    public function __construct(
        ?int $id,
        Member $member,
        DateTime $dateTime,
        OrderStatus $orderStatus,
    ) {
        $this->orderId = $id;
        $this->member = $member;
        $this->orderDate = $dateTime;
        $this->orderStatus = $orderStatus;
    }

    public function repr(): string {
        $member = $this->member->repr();
        $time = $this->orderDate->format("Y-m-d H:i:s");
        $status = $this->orderStatus->value;
        return "Order(id = $this->orderId, member = $member, time = $time, status = $status)";
    }

    public function name(): string {
        return "Order";
    }
}
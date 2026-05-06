<?php
// Model/Order.php

require_once __DIR__ . "/../utilities/Auditer.php";

class Order implements Auditable {
    // Properties match the database columns for data storage
    // Note:
    //  ? at type indicates the property can be null

    public ?int $orderId;
    public Member $member;
    public DateTime $orderTime;

    public function __construct(
        ?int $id,
        Member $member,
        DateTime $time,
    ) {
        $this->orderId = $id;
        $this->member = $member;
        $this->orderTime = $time;
    }

    public function repr(): string {
        $member = $this->member->repr();
        $time = $this->orderTime->format("Y-m-d H:i:s");
        return "Order(id = $this->orderId, member = $member, time = $time)";
    }

    public function name(): string {
        return "Order";
    }
}
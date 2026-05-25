<?php
// Model/Booking.php

require_once __DIR__ . "/../utilities/Auditer.php";

// Load Session model and repository
require_once __DIR__ . "/../model/Session.php";
require_once __DIR__ . "/../repository/SessionRepository.php";

// Load Member model and repository
require_once __DIR__ . "/../model/Member.php";
require_once __DIR__ . "/../repository/MemberRepository.php";

class Booking implements Auditable {
    // Properties match the database columns for data storage
    // Note:
    //  ? at type indicates the property can be null

    public ?int $bookingId;
    public Session $session;
    public Member $member;
    public DateTime $date;

    public int $seats;
    public float $pricePerSeat;

    public function __construct(
        ?int $id,
        Session $session,
        Member $member,
        DateTime $date,
        int $seats,
        float $pricePerSeat
        
    ) {
        $this->bookingId = $id;
        $this->session = $session;
        $this->member = $member;
        $this->date = $date;
        $this->seats = $seats;
        $this->pricePerSeat = $pricePerSeat;
    }

    public function getCost(): float {
        return $this->seats * $this->pricePerSeat;
    }

    public function repr(): string {
        $member = $this->member->repr();
        $session = $this->session->repr();
        $date = $this->date->format("Y-m-d");
        return "Booking(id = $this->bookingId, member = $member, session = $session, date = $date, seats = $this->seats, pricePerSeat = $this->pricePerSeat)";
    }
    public function name(): string {
        return "Booking";
    }
}
<?php
// Model/Session.php

class Session {
    // Properties match the database columns for data storage
    // Note:
    //  ? at type indicates the property can be null

    public ?int $sessionId;
    public string $sessionName;
    public ?Movie $movie;
    public ?Cinema $cinema;
    public ?DateTime $sessionTime;
    public ?float $sessionCost;

    public function __construct(
        ?int $id,
        string $name,
        ?Movie $movie = null,
        ?Cinema $cinema = null,
        ?DateTime $time = null,
        ?float $sessionCost = null,
    ) {
        $this->sessionId = $id;
        $this->sessionName = $name;
        $this->movie = $movie;
        $this->cinema = $cinema;
        $this->sessionTime = $time;
        $this->sessionCost = $sessionCost;
    }

    public function getCost(): float {
        return $this->sessionCost;
    }
}
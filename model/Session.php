<?php
// Model/Session.php

require_once __DIR__ . "/../utilities/Auditer.php";

class Session implements Auditable {
    // Properties match the database columns for data storage
    // Note:
    //  ? at type indicates the property can be null

    public ?int $sessionId;
    public Movie $movie;
    public Cinema $cinema;
    public ?DateTime $sessionTime;
    public ?float $sessionCost;

    public function __construct(
        ?int $id,
        ?Movie $movie = null,
        ?Cinema $cinema = null,
        ?DateTime $time = null,
        ?float $sessionCost = null,
    ) {
        $this->sessionId = $id;
        $this->movie = $movie;
        $this->cinema = $cinema;
        $this->sessionTime = $time;
        $this->sessionCost = $sessionCost;
    }

    public function getCost(): float {
        return $this->sessionCost;
    }

    public function repr(): string {
        $movie = $this->movie->movieName;
        $cinema = $this->cinema->repr();
        $time = $this->sessionTime->format("H:i:v");
        return "Session(id = $this->sessionId, movie = $movie, cinema = $cinema, time = $time, cost = $this->sessionCost)";
    }

    public function name(): string {
        return "Session";
    }
}
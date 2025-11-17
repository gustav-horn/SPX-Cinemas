<?php
// Model/Location.php

// Load Movie model & repository
require_once __DIR__ . '/../model/Movie.php';
require_once __DIR__ . "/../repository/MovieRepository.php";

class Location {
    // Properties match the database columns for data storage
    // Note:
    //  ? at type indicates the property can be null

    public ?int $locationId;
    public string $locationName;

    public function __construct(
        ?int $id,
        string $name,
    ) {
        $this->locationId = $id;
        $this->locationName = $name;
    }
}
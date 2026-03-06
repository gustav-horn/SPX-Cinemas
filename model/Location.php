<?php
// Model/Location.php

require_once __DIR__ . "/../utilities/Auditer.php";

// Load Movie model & repository
require_once __DIR__ . '/../model/Movie.php';
require_once __DIR__ . "/../repository/MovieRepository.php";

class Location implements Auditable {
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

    public function repr(): string {
        return "Location(id = $this->locationId, name = $this->locationName)";
    }

    public function name(): string {
        return "Location";
    }
}
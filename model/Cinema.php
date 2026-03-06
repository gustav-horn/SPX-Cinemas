<?php
// Model/Cinema.php

require_once __DIR__ . "/../utilities/Auditer.php";

class Cinema implements Auditable {
    // Properties match the database columns for data storage
    // Note:
    //  ? at type indicates the property can be null

    public ?int $cinemaId;
    public string $cinemaName;
    public Location $location;

    public function __construct(
        ?int $id,
        string $name,
        ?Location $location
    ) {
        $this->cinemaId = $id;
        $this->cinemaName = $name;
        $this->location = $location;
    }

    public function repr(): string {
        $location = $this->location->locationName;
        return "Cinema(id = $this->cinemaId, name = $this->cinemaName, location = $location)";
    }

    public function name(): string {
        return "Cinema";
    }
}
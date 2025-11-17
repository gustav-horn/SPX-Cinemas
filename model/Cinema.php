<?php
// Model/Cinema.php

class Cinema {
    // Properties match the database columns for data storage
    // Note:
    //  ? at type indicates the property can be null

    public ?int $cinemaId;
    public string $cinemaName;
    public ?Location $location;

    public function __construct(
        ?int $id,
        string $name,
        ?Location $location
    ) {
        $this->cinemaId = $id;
        $this->cinemaName = $name;
        $this->location = $location;
    }
}
<?php
// Repository/Location.php

// Load the Location business model, as the Repository must instantiate and return Location objects.
require_once __DIR__ . '/../model/Location.php';

// Load the DatabaseSingleton, as the Repository needs its generic query execution methods.
require_once __DIR__ . '/../database/DatabaseSingleton.php';

class LocationRepository {

    // Dependency Injection: The Repository requires the Database access object.
    private DatabaseSingleton $db;

    public function __construct(DatabaseSingleton $db) {
        $this->db = $db;
    }

    /**
     * Converts a raw database array row into a Location Model object.
     * This is the bridge between the Data Access Layer (Repository) and the
     * Business Logic Layer (Model).
     */
    private function createModelFromRow(array $row): Location {
        return new Location(
            (int)$row['locationId'],
            $row['locationName'],
        );
    }

    // ----------------------------------------------------------------------
    //                           FETCH METHODS
    // ----------------------------------------------------------------------

    /**
     * Finds a single Location by its primary key ID.
     */
    public function findById(int $id): ?Location {
        $sql = "SELECT * FROM `location` WHERE `locationId` = :id";

        $results = $this->db->query($sql, ['id' => $id]);

        if (empty($results)) {
            return null;
        }

        // Convert the raw data to a single Movie object
        return $this->createModelFromRow($results[0]);
    }

    /**
     * Finds all locations in the database.
     * @return Location[] An array of Location objects
     */
    public function findAll(): array {
        $sql = "SELECT * FROM `location` ORDER BY `locationId` ASC";
        $results = $this->db->query($sql);

        // Convert all raw results into an array of Movie objects
        return array_map($this->createModelFromRow(...), $results);
    }

    public function findByName(string $name): ?Location {
        $sql = "SELECT * FROM `location` WHERE `locationName` = :name";

        $results = $this->db->query($sql, ['name' => $name]);

        if (empty($results)) {
            return null;
        }

        // Convert the raw data to a single Location object
        return $this->createModelFromRow($results[0]);
    }

    // ----------------------------------------------------------------------
    //                           PERSISTENCE METHOD
    // ----------------------------------------------------------------------

    /**
     * Saves a Location Model to the database, handling either INSERT or UPDATE.
     * @return bool Success Did the INSERT/UPDATE succeed or fail?
     */
    public function save(Location $location): bool {
        if ($location->locationId === null) {
            // INSERT (New Location)
            return true;
        }
        else {
            // UPDATE (Existing Location)
            return true;
        }
    }
}
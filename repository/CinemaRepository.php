<?php
// Repository/Location.php

// Load the Cinema business model, as the Repository must instantiate and return Cinema objects.
require_once __DIR__ . '/../model/Cinema.php';

// Load the LocationRepository so we can join the foreign keys
require_once __DIR__ . '/../repository/LocationRepository.php';

// Load the DatabaseSingleton, as the Repository needs its generic query execution methods.
require_once __DIR__ . '/../database/DatabaseSingleton.php';

class CinemaRepository {

    // Dependency Injection: The Repository requires the Database access object.
    private DatabaseSingleton $db;
    private LocationRepository $locations;

    public function __construct(DatabaseSingleton $db) {
        $this->db = $db;
        $this->locations = new LocationRepository($db);
    }

    /**
     * Converts a raw database array row into a Cinema Model object.
     * This is the bridge between the Data Access Layer (Repository) and the
     * Business Logic Layer (Model).
     */
    private function createModelFromRow(array $row): Cinema {
        return new Cinema(
            (int)$row['cinemaId'],
            $row['cinemaName'],
            $this->locations->findById($row['locationId']),
        );
    }

    // ----------------------------------------------------------------------
    //                           FETCH METHODS
    // ----------------------------------------------------------------------

    /**
     * Finds a single Cinema by its primary key ID.
     */
    public function findById(int $id): ?Cinema {
        $sql = "SELECT * FROM `cinemas` WHERE `cinemaId` = :id";

        $results = $this->db->query($sql, ['id' => $id]);

        if (empty($results)) {
            return null;
        }

        // Convert the raw data to a single Movie object
        return $this->createModelFromRow($results[0]);
    }

    /**
     * Finds all cinemas in the database.
     * @return Cinema[] An array of Cinema objects
     */
    public function findAll(): array {
        $sql = "SELECT * FROM `cinemas` ORDER BY `cinemaId` ASC";
        $results = $this->db->query($sql);

        // Convert all raw results into an array of Movie objects
        return array_map($this->createModelFromRow(...), $results);
    }

    /**
     * Finds all cinemas associated with a given locationId
     * @param int An id associated with the given location
     * @return Cinema[] An array of Cinema objects
     */
    public function findByLocation(int $locationId): array {
        $sql = "SELECT * FROM `cinemas` WHERE locationId = :id ORDER BY `cinemaId` ASC";
        $results = $this->db->query($sql, ["id" => $locationId]);

        return array_map($this->createModelFromRow(...), $results);
    }

    // ----------------------------------------------------------------------
    //                           PERSISTENCE METHOD
    // ----------------------------------------------------------------------

    /**
     * Saves a Cinema Model to the database, handling either INSERT or UPDATE.
     * @return bool Success Did the INSERT/UPDATE succeed or fail?
     */
    public function save(Cinema $cinema): bool {
        if ($cinema->cinemaId === null) {
            // INSERT (New Cinema)
            $sql = "INSERT INTO cinemas VAlUES (:id, :name, :location)";
            $rowsAffected = $this->db->execute($sql, ["id" => $cinema->cinemaId, "name" => $cinema->cinemaName, "location" => $cinema->location->locationId]);
            return $rowsAffected > 0;
        }
        else {
            // UPDATE (Existing Cinema)
            $sql = "UPDATE cinemas SET cinemaName = :name, locationId = :location WHERE cinemaId = :id";
            $rowsAffected = $this->db->execute($sql, ["id" => $cinema->cinemaId, "name" => $cinema->cinemaName, "location" => $cinema->location->locationId]);
            return $rowsAffected == 1;
        }
    }
}
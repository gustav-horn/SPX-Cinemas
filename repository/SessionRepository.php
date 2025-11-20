<?php
// Repository/Session.php

// Load the Session business model, as the Repository must instantiate and return Session objects.
require_once __DIR__ . '/../model/Session.php';

// Load the MovieRepository so we can join the foreign keys
require_once __DIR__ . '/../repository/MovieRepository.php';
// Load the CinemaRepository so we can join the foreign keys
require_once __DIR__ . '/../repository/CinemaRepository.php';

// Load the DatabaseSingleton, as the Repository needs its generic query execution methods.
require_once __DIR__ . '/../database/DatabaseSingleton.php';

class SessionRepository {

    // Dependency Injection: The Repository requires the Database access object.
    private DatabaseSingleton $db;
    private MovieRepository $movies;
    private CinemaRepository $cinemas;

    public function __construct(DatabaseSingleton $db) {
        $this->db = $db;
        $this->movies = new MovieRepository($db);
        $this->cinemas = new CinemaRepository($db);
    }

    /**
     * Converts a raw database array row into a Session Model object.
     * This is the bridge between the Data Access Layer (Repository) and the
     * Business Logic Layer (Model).
     */
    private function createModelFromRow(array $row): Session {
        return new Session(
            (int)$row['sessionId'],
            $this->movies->findById($row['movieId']) ?? null, // Use null coalesce for optional fields
            $this->cinemas->findById($row['cinemaId']) ?? null,
            new DateTime($row['sessionTime']),
            $row['sessionCost']
        );
    }

    // ----------------------------------------------------------------------
    //                           FETCH METHODS
    // ----------------------------------------------------------------------

    /**
     * Finds a single Session by its primary key ID.
     */
    public function findById(int $id): ?Session {
        $sql = "SELECT * FROM `sessions` WHERE `sessionId` = :id";

        $results = $this->db->query($sql, ['id' => $id]);

        if (empty($results)) {
            return null;
        }

        // Convert the raw data to a single Movie object
        return $this->createModelFromRow($results[0]);
    }

    /**
     * Finds all sessions in the database.
     * @return Session[] An array of Session objects
     */
    public function findAll(): array {
        $sql = "SELECT * FROM `sessions` ORDER BY `sessionId` ASC";
        $results = $this->db->query($sql);

        // Convert all raw results into an array of Session objects
        return array_map($this->createModelFromRow(...), $results);
    }

    /**
     * Finds all sessions showing in a given cinema
     * @param int The cinemaId
     * @return Session[] An array of Session objects
     */
    public function findByCinema(int $cinemaId): array {
        $sql = "SELECT * FROM `sessions`WHERE `cinemaId` = :id ORDER BY `sessionId` ASC";
        $results = $this->db->query($sql, ["id" => $cinemaId]);

        // Convert all raw results into an array of Session objects
        return array_map($this->createModelFromRow(...), $results);
    }

    /**
     * Finds all sessions showing a given movie
     * @param int The movieId
     * @return Session[] An array of Session objects
     */
    public function findByMovie(int $movieId): array {
        $sql = "SELECT * FROM `sessions` WHERE `movieId` = :id ORDER BY `sessionId` ASC";
        $results = $this->db->query($sql, ["id" => $movieId]);

        return array_map($this->createModelFromRow(...), $results);
    }

    // ----------------------------------------------------------------------
    //                           PERSISTENCE METHOD
    // ----------------------------------------------------------------------

    /**
     * Saves a Session Model to the database, handling either INSERT or UPDATE.
     * @return bool Success Did the INSERT/UPDATE succeed or fail?
     */
    public function save(Session $session): bool {
        if ($session->sessionId === null) {
            // INSERT (New Session)
            return true;
        }
        else {
            // UPDATE (Existing Session)
            return true;
        }
    }
}
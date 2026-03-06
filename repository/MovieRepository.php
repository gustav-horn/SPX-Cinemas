<?php
// Repository/MovieRepository.php

// Load the Movie business model, as the Repository must instantiate and return Movie objects.
require_once __DIR__ . '/../model/Movie.php';

// Load the DatabaseSingleton, as the Repository needs its generic query execution methods.
require_once __DIR__ . '/../database/DatabaseSingleton.php';

class MovieRepository {

    // Dependency Injection: The Repository requires the Database access object.
    private DatabaseSingleton $db;
    private Auditer $auditer;

    public function __construct(DatabaseSingleton $db, Auditer $auditer) {
        $this->db = $db;
        $this->auditer = $auditer;
    }

    /**
     * Converts a raw database array row into a Movie Model object.
     * This is the bridge between the Data Access Layer (Repository) and the
     * Business Logic Layer (Model).
     */
    private function createModelFromRow(array $row): Movie {
        return new Movie(
            (int)$row['movieId'],
            $row['movieName'],
            $row['movieDescription'] ?? null, // Use null coalesce for optional fields
            $row['trailerFileName'] ?? null,
            $row['posterFileName'] ?? null
        );
    }

    // ----------------------------------------------------------------------
    //                           FETCH METHODS
    // ----------------------------------------------------------------------

    /**
     * Finds a single Movie by its primary key ID.
     */
    public function findById(int $id): ?Movie {
        $sql = "SELECT * FROM `movies` WHERE `movieId` = :id";

        $results = $this->db->query($sql, ['id' => $id]);

        if (empty($results)) {
            return null;
        }

        // Convert the raw data to a single Movie object
        return $this->createModelFromRow($results[0]);
    }

    /**
     * Finds all movies in the database.
     * @return Movie[] An array of Movie objects
     */
    public function findAll(): array {
        $sql = "SELECT * FROM `movies` ORDER BY `movieName` ASC";
        $results = $this->db->query($sql);

        // Convert all raw results into an array of Movie objects
        return array_map($this->createModelFromRow(...), $results);
    }

    /**
     * Returns a random set of Movie Model objects, limited by the quantity passed in.
     * @param int $limit The maximum number of random movies to return
     * @return Movie[] An array of Movie objects
     */
    public function findRandom(int $limit): array {
        // Uses SQL ORVER BY RAND() function
        $sql = "SELECT * FROM `movies` ORDER BY RAND() LIMIT :limit";

        $results = $this->db->query($sql, ["limit" => $limit]);

        return array_map($this->createModelFromRow(...), $results);
    }

    // ----------------------------------------------------------------------
    //                           PERSISTENCE METHOD
    // ----------------------------------------------------------------------

    /**
     * Saves a Movie Model to the database, handling either INSERT or UPDATE.
     * @return bool Success Did the INSERT/UPDATE succeed or fail?
     */
    public function save(Movie $movie): bool {
        if ($movie->movieId === null) {
            // INSERT (New Movie)
            if (!$this->auditer->create($movie)) {return false;};
            $sql = "INSERT INTO `movies` (`movieName`, `movieDescription`, `trailerFileName`, `postFileName`)
                    VALUES (:name, :desc, :trailer, :poster)";
            
            $rowsAffected = $this->db->execute(sql: $sql, 
                params: [
                    "name" => $movie->movieName,
                    "desc" => $movie->movieDescription,
                    "trailer" => $movie->trailerFileName,
                    "poster" => $movie->posterFileName,
                ]
                );

            return $rowsAffected > 0;
        }
        else {
            // UPDATE (Existing Movie)
            if (!$this->auditer->update($movie)) {return false;}
            $sql = "UPDATE `movies` SET
                    `movieName` = :name,
                    `movieDescription = :desc,
                    `trailerFileName` = :trailer,
                    `posterFileName` = :poster,
                    WHERE `movieId = :id";
            
            $rowsAffected = $this->db->execute(sql: $sql,
                params: [
                    "name" => $movie->movieName,
                    "desc" => $movie->movieDescription,
                    "trailer" => $movie->trailerFileName,
                    "poster" => $movie->posterFileName
                ]);
            
            return $rowsAffected == 0;
        }
    }
}
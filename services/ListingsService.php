<?php
// service/ListingsService.php
/**
 * Movie Listings Service
 * Handles the filtering by location
 */

// Load relevant models and repositories
require_once __DIR__ . "/../database/DatabaseSingleton.php";

require_once __DIR__ . "/../model/Movie.php";
require_once __DIR__ . "/../model/Session.php";
require_once __DIR__ . "/../model/Cinema.php";
require_once __DIR__ . "/../model/Location.php";

require_once __DIR__ . "/../repository/MovieRepository.php";
require_once __DIR__ . "/../repository/SessionRepository.php";
require_once __DIR__ . "/../repository/CinemaRepository.php";
require_once __DIR__ . "/../repository/LocationRepository.php";

class ListingsService {

    private DatabaseSingleton $db;
    private MovieRepository $movies;
    private SessionRepository $sessions;
    private CinemaRepository $cinemas;
    private LocationRepository $locations;

    public function __construct(DatabaseSingleton $db, Auditer $auditer) {
        $this->db = $db;
        $this->movies = new MovieRepository($db, $auditer);
        $this->sessions = new SessionRepository($db, $auditer);
        $this->cinemas = new CinemaRepository($db, $auditer);
        $this->locations = new LocationRepository($db, $auditer);
    }

    
    /**
     * Gets the movies that are associated with the provided location name
     * @param string Name of the relevant location
     * @return array{"movie":Movie, "session":Session[]} An array of Movie objects and their sessions
     */
    public function findByLocation(string $locationName): ?array {
        $generateFromMovies = fn($movies) => array_map(
                fn($movie) => ["movie" => $movie, "sessions" => $this->sessions->findByMovie($movie->movieId)], 
                $movies);
        // If we don't need to filter, just return them all
        if ($locationName === "all") {
            return $generateFromMovies($this->movies->findAll());
        }
        else {
            $location = $this->locations->findByName($locationName);
            // Fallback guard condition
            if ($location === null) {
                return $generateFromMovies($this->movies->findAll());
            }
            // Grab all the Ids we need, sort out the relationships between them, and then fill the list of these Ids with the actual models
            else {
                $sql = "SELECT movies.movieId, sessions.sessionId FROM movies 
                        INNER JOIN sessions ON movies.movieId = sessions.movieId 
                        INNER JOIN cinemas ON sessions.cinemaId = cinemas.cinemaId 
                        WHERE cinemas.locationId = :location";
                $results = accumulate(
                    $this->db->query($sql, ["location" => $location->locationId]), 
                    "movieId", 
                    "sessionId"
                    );
                $results = array_map(
                    fn($row) => [
                            "movie" => $this->movies->findById($row["movieId"]), 
                            "sessions" => array_map($this->sessions->findById(...), $row["sessionId"])
                        ],
                    $results
                    );
                return $results;
            }
        }
    }
}

/**
 * Helper function that accumulates repeated keys into key - array{value} pairs
 * @param array{key:mixed, value:mixed} $array
 * @param string $key
 * @param string $value
 * @return array{key:mixed, value:mixed[]}
 */
function accumulate(array $array, string $key, string $value): array {
    $stack = [];
    foreach ($array as $item) {
        if (($needle = array_find_key($stack, fn($row) => $row[$key] == $item[$key])) !== null) {
            $row = $stack[$needle];
            array_push($row[$value], $item[$value]);
            $stack[$needle] = $row;
        }
        else {
            array_push($stack, [$key => $item[$key], $value => [$item[$value]]]);
        }
    }
    return $stack;
}
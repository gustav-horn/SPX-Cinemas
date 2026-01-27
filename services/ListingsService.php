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

    public function __construct(DatabaseSingleton $db) {
        $this->db = $db;
        $this->movies = new MovieRepository($db);
        $this->sessions = new SessionRepository($db);
        $this->cinemas = new CinemaRepository($db);
        $this->locations = new LocationRepository($db);
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
        if ($locationName === "all") {
            return $generateFromMovies($this->movies->findAll());
        }
        else {
            $location = $this->locations->findByName($locationName);
            if ($location === null) {
                return $generateFromMovies($this->movies->findAll());
            }
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
        if ($row = array_find($stack, fn($row) => $row[$key] == $item[$key])) {
            array_push($row, $item[$value]);
        }
        else {
            array_push($stack, [$key => $item[$key], $value => [$item[$value]]]);
        }
    }
    return $stack;
}
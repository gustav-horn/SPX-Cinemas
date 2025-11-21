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
                // Collates list of all sessions to associative array of movies and sessions
                return array_slice(array_reduce( //Slice to remove redundant first term
                    array_slice( //Dispose of redundant first term
                        array_reduce( // Merge list of all sessions at a given location
                            array_map(fn($cinema) => $this->sessions->findByCinema($cinema->cinemaId), $this->cinemas->findByLocation($location->locationId)),
                            fn($carry, $item) => array_merge($carry, $item),
                            []
                        ),
                    1),
                    function(array $prev, Session $session) {
                        $movie = $session->movie;
                        if ($index = array_find_key($prev, fn($item)=> $item["movie"]->movieId === $movie->movieId)) {
                            array_push($prev[$index]["sessions"], $session);
                            return $prev;
                        }
                        else {
                            array_push($prev, ["movie" => $movie, "sessions" => [$session]]);
                            return $prev;
                        }
                    },
                    []
                ), 1);
            }
        }
    }
}

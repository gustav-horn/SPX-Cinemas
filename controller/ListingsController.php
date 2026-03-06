<?php
// controller/HomeController.php
/* Controller for the movieListings page
    - Filters movies by location
    - sends the relevant movies to be displayed
*/

//Include any models if needed
require_once __DIR__ . '/../model/Movie.php';
require_once __DIR__ . '/../model/Location.php';
require_once __DIR__ . '/../repository/LocationRepository.php';

//Include the required utilities
require_once __DIR__ . '/../database/DatabaseSingleton.php';
require_once __DIR__ . "/../utilities/Auditer.php";

//Include the Listings Service
require_once __DIR__ . '/../services/ListingsService.php';

class ListingsController {
    public function displayListings()
    {
        //retrieve any data if needed
        $db = DatabaseSingleton::getInstance();
        $auditer = new Auditer($db);

        $listingsService = new ListingsService($db, $auditer);
        $movies = $listingsService->findByLocation($_POST["location"] ?? "all");

        $locationRepository = new LocationRepository($db, $auditer);
        $locations = $locationRepository->findAll();

        $activeMovie = $_GET['movie'] ?? "None";

        // Views are included from the project root path (index.php runs from root)
        include __DIR__ . '/../view/listings.php';
    }
}
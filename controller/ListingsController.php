<?php
// controller/HomeController.php
/* Controller for the home page
    - Fetches 4 random movies from the database
    - Passes them to the home view for rendering
*/

//Include any models if needed
require_once __DIR__ . '/../database/DatabaseSingleton.php';
require_once __DIR__ . '/../model/Movie.php';
require_once __DIR__ . '/../repository/MovieRepository.php';

class ListingsController
{
    public function displayListings()
    {
        //retrieve any data if needed
        $db = DatabaseSingleton::getInstance();
        $movieRepository = new MovieRepository($db);
        $movies = $movieRepository->findByLocation($_POST["location"] ?? "all");

        // Views are included from the project root path (index.php runs from root)
        include __DIR__ . '/../view/listings.php';
    }
}
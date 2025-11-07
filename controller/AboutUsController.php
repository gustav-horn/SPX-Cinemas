<?php
// controller/AboutUsController.php
/* Controller for the AboutUs page
    - Fetches 4 random movies from the database
    - Passes them to the AboutUs view for rendering
*/

//Include any models if needed
//require_once __DIR__ . '/../model/Movie.php';

class AboutUsController
{
    public function displayAboutUs()
    {

        // Views are included from the project root path (index.php runs from root)
        include __DIR__ . '/../view/AboutUs.php';
    }
}
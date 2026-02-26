<?php
// controller/LoginController.php
/* Controller for the Login page
    - sends the Login form
    - manages the supplied data
*/

//Include any models if needed
require_once __DIR__ . '/../model/Movie.php';
require_once __DIR__ . '/../model/Location.php';
require_once __DIR__ . '/../repository/LocationRepository.php';

//Include the Listings Service
require_once __DIR__ . '/../services/ListingsService.php';

class LoginController {
    private SessionManager $sessionManager;

    public function __construct(SessionManager $sessionManager) {
        $this->sessionManager = $sessionManager;
    }

    /// Manages what we do depending on the situation
    public function manageRequest(){
        // Step 1. Check if we are logged in. If so, we are looking to logout
        if ($this->sessionManager->checkLoggedIn()) {
            $this->logout();
        }
        // Step 2. Look for a $_POST request.
        else if (count($_POST) != 0) {
            $this->login();
        }
        // Step 3. The user must be looking to log in, show them the page
        else {
            $status = "Provide Username and Password";
            require_once __DIR__ . "/../view/login.php";
        };
    }

    private function login() {
        $username = $_POST["username"];
        $password = $_POST["password"];

        // We grab our dependencies now. The laziness helps us avoid unnecessary work
        require_once __DIR__ . "/../database/DatabaseSingleton.php";
        require_once __DIR__ . "/../repository/MemberRepository.php";
        $repository = new MemberRepository(DatabaseSingleton::getInstance());
        
        if ($member = $repository->findByUsername($username)) {
            if (password_verify($member->password)) {
                $lastPage = $this->sessionManager->getLastPage();
                $this->sessionManager->loggedIn($member);
                header("Location: " . $lastPage);
            }
            else {
                $status = "Incorrect Password";
                require_once __DIR__ . "/../view/login.php";
            }
        }
        else {
            $status = "Incorrect Username";
            require_once __DIR__ . "/../view/login.php";
        }
    }

    private function logout() {
        $this->sessionManager->loggedOut("login");
        header("Location: index.php?page=login");
    }
}
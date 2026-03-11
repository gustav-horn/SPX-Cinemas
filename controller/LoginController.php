<?php
// controller/LoginController.php
/* Controller for the Login page
    - sends the Login form
    - manages the supplied data
*/

//Include any models if needed
require_once __DIR__ . "/../repository/MemberRepository.php";

//Include the required utilities
require_once __DIR__ . '/../database/DatabaseSingleton.php';
require_once __DIR__ . "/../utilities/Auditer.php";

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
        // Step 2. Look for a $_POST request. If there is one, verify the login request
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
        $username = htmlspecialchars($_POST["username"]);
        $password = htmlspecialchars($_POST["password"]);

        // We grab our dependencies now. The laziness helps us avoid unnecessary work
        require_once __DIR__ . "/../database/DatabaseSingleton.php";
        require_once __DIR__ . "/../repository/MemberRepository.php";
        require_once __DIR__ . "/../utilities/Auditer.php";
        $db = DatabaseSingleton::getInstance();
        $repository = new MemberRepository($db, new Auditer($db));
        
        // 1. Find the requested Member object
        if ($member = $repository->findByUsername($username)) {
            // 2. Verify the password
            if ($member->password->verify($password)) {
                $lastPage = $this->sessionManager->getLastPage();
                $this->sessionManager->loggedIn($member);
                header("Location: index.php?page=" . $lastPage);
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
        $this->sessionManager->loggedOut("home");
        header("Location: index.php?page=login");
    }
}
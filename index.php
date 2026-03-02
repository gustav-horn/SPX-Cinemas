<?php

//index.php - front controller

require_once __DIR__ . "/utilities/SessionManager.php";

// simple router base of ?page = ...
(string) $page = $_GET['page'] ?? 'home';

$sessionManager = new SessionManager($page);

switch ($page) {
    case "home":
        require_once __DIR__ . "/controller/HomeController.php";
        $sessionManager->updateCurrPage($page);
        $controller = new HomeController();
        $controller->displayHome();
        break;
    case "listings":
        require_once __DIR__ . "/controller/ListingsController.php";
        $sessionManager->updateCurrPage($page);
        $controller = new ListingsController();
        $controller->displayListings();
        break;
    case "login":
        require_once __DIR__ . "/controller/LoginController.php";
        $controller = new LoginController($sessionManager);
        $controller->manageRequest();
        break;
    case "account":
        require_once __DIR__ . "/controller/AccountController.php";
        $controller = new AccountController($sessionManager);
        $controller->manageRequest();
        break;
    case "about":
        require_once __DIR__ . "/controller/AboutUsController.php";
        $sessionManager->updateCurrPage($page);
        $controller = new AboutUsController();
        $controller->displayAboutUs();
        break;
    default:
        http_response_code(404);
        echo "Page not found";
}


?>
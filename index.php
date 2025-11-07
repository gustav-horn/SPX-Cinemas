<?php

//index.php - front controller

// simple router base of ?page = ...
(string) $page = $_GET['page'] ?? 'home';

switch ($page) {
    case "home":
        require_once __DIR__ . "./controller/HomeController.php";
        $controller = new HomeController();
        $controller->displayHome();
        break;
    case "about":
        require_once __DIR__ . "./controller/AboutUsController.php";
        $controller = new AboutUsController();
        $controller->displayAboutUs();
        break;
    default:
        http_response_code(404);
        echo "Page not found";
}



?>
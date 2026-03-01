<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/img/favicon.png">
    <title>SPX Cinemas</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <!-- Banner -->
    <div class="banner">
        <h1 class="banner-title">SPX Cinemas</h1>
    </div>

    <!-- Site Header -->
    <header class="site-header row width-100">
        <img class="header-logo" src="assets/img/SPXCinemas_Logo.png">
        <div class="col width-100">
            <h2>Welcome to SPX Cinemas</h2>
            <p class="subtitle">Your place for movie listings and trailers</p>
            <div class="navbar width-100">
                <!-- Navigation Bar -->
                <nav class="row width-100">
                    <ul class="nav-list">
                        <li><a href="index.php?page=home" class="nav-link active">Home</a></li>
                        <li><a href="index.php?page=listings" class="nav-link active">Movies</a></li>
                        <li><a href="index.php?page=about" class="nav-link active">About Us</a></li>
                    </ul>
                    <ul class="login-status nav-list row">
                        <?php
                        // This is such a hack, but because of the structure of index.php we know that the sessionManager will always be defined
                        global $sessionManager;
                        if (($sessionManager)->checkLoggedIn()):
                        ?>
                            <li><a href="index.php?page=login" class="nav-link active">Log Out</a></li>
                            <li><a href="index.php?page=memberDetails" class="nav-link active">Account Details</a></li>
                        <?php else: ?>
                            <li><a href="index.php?page=login" class="nav-link active">Log In</a></li>
                        <?php endif ?>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
<main class="container">
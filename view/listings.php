<?php
// Renders HTML
// expects $movies to be provided by the controller
// expects $locations to be provided by the controller

    include __DIR__ . "/../view/header.php"; //Include header and navigation bar
?>

<!-- Filter Form -->
<form class = "location-form" action="#" method="post" id="location-form">
    <label class="location-label" for="location">Select your location: </label>
    <select class="location-select" name="location" id="location" onchange="document.getElementById('location-form').submit()">
            <option class="location-option" value="all" <?= (key_exists("location", $_POST) and ($_POST["location"] === "All" or $_POST["location"] === null)) ? "selected" : ""?>>All</option>
        <?php foreach ($locations as $location): ?>
            <option class="location-option" value="<?= htmlspecialchars($location->locationName) ?>" <?=(key_exists("location", $_POST) and $_POST["location"] === $location->locationName) ? "selected" : ""?>><?=htmlspecialchars($location->locationName)?></option>
        <?php endforeach ?>
    </select>
</form>
<section class = "movie-grid">
    <?php if (empty($movies)): ?>
    <?php else: ?>
        <?php foreach ($movies as $movie): ?>
            <article class="movie-card" id="<?= $movie["movie"]->movieId; ?>">
                <img 
                    src = "/assets/img/<?= htmlspecialchars($movie["movie"]->getPoster()); ?>"
                    alt = "<?= htmlspecialchars($movie["movie"]->movieName); ?>"
                    class = "movie-poster"
                >
                <div class = "movie-body">
                    <h2 class = "movie-title"><?= htmlspecialchars($movie["movie"]->movieName); ?></h2>
                    <p class = "movie-desc"><?= htmlspecialchars($movie["movie"]->movieDescription); ?></p>
                    <div class="movie-meta">
                        <span class="movie-id">ID: <?= $movie["movie"]->movieId; ?></span>
                    </div>
                </div>
            </article>
        <?php endforeach ?>
    <?php endif ?>
</section>

<?php 
    include __DIR__."/../view/footer.php";
?>

<!-- Details Pages -->
<?php if (empty($movies)): ?>
<?php else: ?>
    <?php foreach ($movies as $movie): ?>
        <div id="movieDetails<?= $movie["movie"]->movieId; ?>" class="details-modal">
            <div class="details-content">
                <div class="row">
                    <span class="details-close">&times;</span>
                    <div class="details-poster-container">
                        <img src = "/assets/img/<?= htmlspecialchars($movie["movie"]->getPoster()); ?>"
                            alt = "The poster of <?= htmlspecialchars($movie["movie"]->movieName); ?>"
                            class = "movie-poster" >
                    </div>
                    <span style="padding: 1%;"></span>
                    <div class = "col details-movie-info">
                        <h1 class = "movie-title"><?= htmlspecialchars($movie["movie"]->movieName) ?></h1>
                        <p class = "movie-body"><?= htmlspecialchars($movie["movie"]->movieDescription) ?></p>
                        <a href="#" class="trailer-link" data-trailer="<?= htmlspecialchars($movie["movie"]->trailerFileName); ?>">
                            Watch Trailer
                        </a>
                    </div>
                </div>
                <?php if (empty($movie["sessions"])): ?>
                    <p>No sessions available</p>
                <?php else: ?>
                    <table class="session-table">
                        <thead>
                            <tr>
                                <th>Cinema</th>
                                <!-- <th>Date</th> -->
                                <th>Time</th>
                                <th>Cost</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody><?php foreach ($movie["sessions"] as $session): ?>
                            <tr class = "session">
                                <td class = "session-cinema"><?= htmlspecialchars($session->cinema->cinemaName) ?></td>
                                <!-- <td class = "session-date"><?= htmlspecialchars($session->sessionTime->format("d-M")) ?></td> -->
                                <td class = "session-time"><?= htmlspecialchars($session->sessionTime->format("h:i A")) ?></td>
                                <td class = "session-cost">$<?= htmlspecialchars($session->sessionCost) ?></td>
                                <td><button class = "session-book">Book Now!</button></td>
                            </tr>
                        <?php endforeach ?></tbody>
                    </table>
                    <span style = "padding: 2%"></span>
                <?php endif ?>
            </div>
        </div>
    <?php endforeach ?>
<?php endif ?>
<script src="assets/js/compiled/details.js"></script>

<!-- Trailer Modal -->
<div id="trailerModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <iframe id="trailerFrame"
                width="100%"
                height="400"
                src=""
                frameborder="0"
                allowfullscreen>
        </iframe>
    </div>
</div>
<script src="assets/js/compiled/modal.js"></script>
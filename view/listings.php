<?php
// Renders HTML
// expects $movies to be provided by the controller
// expects $locations to be provided by the controller

    include __DIR__ . "/../view/header.php"; //Include header and navigation bar
?>

<!-- Filter Form -->
<?php $findKey = fn($key) => key_exists("location", $_POST) and ($_POST["location"] === $key) ?>
<div class = "location-form" id="location-form">
    <button class="location-select" id="location">&nbsp; Select your location: &nbsp; &nbsp;</button>
    <div class="location-options" id="location-options" hidden="true">
            <div class="location-option <?= ($findKey("All") or $findKey(null) or !key_exists("location", $_POST)) ? "active" : null ?>"
                value = "All"
            >
                All
            </div>
        <?php foreach ($locations as $location): ?>
            <div 
                class="location-option <?= $findKey($location->locationName) ? "active" : null; ?>"
                value = "<?= $location->locationName; ?>"
            >
                <?=$location->locationName?>
            </div>
        <?php endforeach ?>
    </div>
</div>
<script type="module" src="assets/js/compiled/moviesFilter.js"></script>
<section class = "movie-grid">
    <?php if (empty($movies)): ?>
    <?php else: ?>
        <?php foreach ($movies as $movie): ?>
            <article class="movie-card" id="<?= $movie["movie"]->movieId; ?>">
                <img 
                    src = "assets/img/<?= $movie["movie"]->getPoster(); ?>"
                    alt = "<?= $movie["movie"]->movieName; ?>"
                    class = "movie-poster"
                >
                <div class = "movie-body">
                    <h2 class = "movie-title"><?= $movie["movie"]->movieName; ?></h2>
                    <p class = "movie-desc"><?= $movie["movie"]->movieDescription; ?></p>
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
<div id="movieInit" key="<?= $activeMovie ?>" display="none"></div>
<?php if (empty($movies)): ?>
<?php else: ?>
    <?php foreach ($movies as $movie): ?>
        <div id="movieDetails<?= $movie["movie"]->movieId; ?>" class="details-modal">
            <div class="details-content">
                <div class="row">
                    <span class="details-close">&times;</span>
                    <div class="details-poster-container">
                        <img src = "assets/img/<?= $movie["movie"]->getPoster(); ?>"
                            alt = "The poster of <?= $movie["movie"]->movieName; ?>"
                            class = "movie-poster big-poster" >
                    </div>
                    <span class="padding-1"></span>
                    <div class = "col details-movie-info">
                        <h1 class = "movie-title"><?= $movie["movie"]->movieName ?></h1>
                        <p class = "movie-body"><?= $movie["movie"]->movieDescription ?></p>
                        <a href="#" class="trailer-link" data-trailer="<?= $movie["movie"]->trailerFileName; ?>">
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
                                <td class = "session-cinema"><?= $session->cinema->cinemaName ?></td>
                                <!-- <td class = "session-date"><?= $session->sessionTime->format("d-M") ?></td> -->
                                <td class = "session-time"><?= $session->sessionTime->format("h:i A") ?></td>
                                <td class = "session-cost">$<?= $session->sessionCost ?></td>
                                <td><button class = "session-book" sessionId = "<?= $session->sessionId ?>">Book Now!</button></td>
                            </tr>
                        <?php endforeach ?></tbody>
                    </table>
                    <span class="padding-2"></span>
                <?php endif ?>
            </div>
        </div>
    <?php endforeach ?>
<?php endif ?>
<script type="module" src="assets/js/compiled/details.js"></script>

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
<script type="module" src="assets/js/compiled/modal.js"></script>
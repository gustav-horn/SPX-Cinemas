<?php
// Renders HTML
// expects $movies to be provided by the controller
// expects $locations to be provided by the controller

    include __DIR__ . "/../view/header.php"; //Include header and navigation bar
?>

<!-- Needs filter form -->
<form class = "location-form" action="#" method="post" id="location-form">
    <label class="location-label" for="location">Select your location</label>
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
            <article class="movie-card">
                <img 
                    src = "/assets/img/<?= htmlspecialchars($movie["movie"]->getPoster()); ?>"
                    alt = "<?= htmlspecialchars($movie["movie"]->movieName); ?>"
                    class = "movie-poster"
                >
                <div class = "movie-body" onclick="Something">
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
<script src="assets/js/modal.js"></script>
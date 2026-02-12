<?php
// Renders HTML
// expects $movies to be provided by the controller
// expects $locations to be provided by the controller

    include __DIR__ . "/../view/header.php"; //Include header and navigation bar
?>

<!-- Filter Form -->
 <script>
    async function submitLocation(location) {
        let form = new FormData();
        form.append("location", location)
        let response = await fetch("index.php?page=listings", 
            {
                method: "POST",
                mode: "same-origin",
                credentials: "same-origin",
                body: form
            }
        );
        console.log(response)
        if (response.redirected === false) {
            var html = await response.text();
            console.log(html);
            document.open("index.php?page=listings", 'replace');
            document.write(html);
            document.close();
        }
        else {
            window.location = response.url;
        }
    }
</script>
 <?php $findKey = fn($key) => key_exists("location", $_POST) and ($_POST["location"] === $key) ?>
<div class = "location-form" id="location-form" onmouseleave="document.getElementById('location-options').hidden = true">
    <button class="location-select" id="location" onmouseover="document.getElementById('location-options').hidden = false">&nbsp; Select your location: &nbsp; &nbsp;</button>
    <div class="location-options" id="location-options" hidden="true">
            <div class="location-option <?= ($findKey("All") or $findKey(null) or !key_exists("location", $_POST)) ? "active" : null ?>"
                onclick = 'submitLocation("All")'
            >
                All
            </div>
        <?php foreach ($locations as $location): ?>
            <div 
                class="location-option <?= $findKey($location->locationName) ? "active" : null; ?>"
                onclick='submitLocation("<?= htmlspecialchars($location->locationName); ?>")'
            >
                <?=htmlspecialchars($location->locationName)?>
            </div>
        <?php endforeach ?>
    </div>
</div>
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
<script src="assets/js/details.js"></script>

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
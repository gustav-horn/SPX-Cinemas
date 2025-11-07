<?php
// Renders HTML
// expects $movies to be provided by the controller

    include __DIR__ . "/../view/header.php"; //Include header and navigation bar
?>

<h1>Featured Movies</h1>
<h3>Check out some of our latest movies!</h3>
<section class = "movie-grid">
    <?php if (empty($movies)): ?>
    <?php else: ?>
        <?php foreach ($movies as $movie): ?>
            <article class="movie-card">
                <img 
                    src = "/assets/img/<?= htmlspecialchars($movie->getPoster()); ?>"
                    alt = "<?= htmlspecialchars($movie->movieName); ?>"
                    class = "movie-poster"
                >
                <div class = "movie-body">
                    <h2 class = "movie-title"><?= htmlspecialchars($movie->movieName); ?></h2>
                    <p class = "movie-desc"><?= htmlspecialchars($movie->movieDescription); ?></p>
                    <div class="movie-meta">
                        <span class="movie-id">ID: <?= $movie->movieId; ?></span>
                        <!-- Use YouTube link from database -->
                        <a href="#" class="trailer-link" data-trailer="<?= htmlspecialchars($movie->trailerFileName); ?>">
                            Watch Trailer
                        </a>

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

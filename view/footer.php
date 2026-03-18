</main>
<footer class="site-footer">
    <div class="container">
        <p>&copy; <?php echo date('Y'); ?> SPX Cinemas</p>
        <?php if ($sessionManager->checkLoggedIn()): ?>
            <div>Current User: <?= $sessionManager->getActiveUser()->firstName->decrypt() ?> <?= $sessionManager->getActiveUser()->lastName->decrypt() ?></div>
        <?php endif ?>
    </div>
</footer>
</body>
</html>
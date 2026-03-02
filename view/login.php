<?php
/*
    Controller for the Login page
    // controller/LoginController.php
    Expects $status text from the controller

*/
    include __DIR__ . '/../view/header.php';
?>
<h1>Log In</h1>

<p><?= $status ?></p>
<form action="" method="POST" class="col login-form">
    <label for="username">Username: </label>
    <input type="text" name="username" id="username" autocomplete="username" required>
    <label for="password">Password: </label>
    <input type="password" name="password" id="password" autocomplete="password" required>
    <a href="index.php?page=account">Or register instead</a> <!-- Make sure to route it to the register page -->
    <button type="submit" class="form-submit-btn">Login</button>
</form>

<?php
    include __DIR__ . '/../view/footer.php';
?>
 
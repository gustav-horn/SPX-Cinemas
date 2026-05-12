<?php
/*
    Controller for the Account page
    // controller/AccountController.php
    Expects $status text and $sessionManager from the controller
    Also expects Member $username, $firstName, $lastName, $street, $town, $postcode, $phone, $email
*/
    include __DIR__ . '/../view/header.php';
?>
<h1>Account</h1>

<p><?= $status ?></p>
<form action="" method="POST">
    <div class="account-form">
        <fieldset class="form-group">
            <legend>Login Information</legend>
            <label for="username">Username: </label>
            <input type="text" name="username" id="username" autocomplete="username" value="<?= $username ?>" required>
            <label for="password1">Password: </label>
            <input type="password" name="password1" id="password1" autocomplete="password" <?= $sessionManager->checkLoggedIn() ? "" : "required" ?>>
            <label for="password2">Confirm Password: </label>
            <input type="password" name="password2" id="password2" autocomplete="password" <?= $sessionManager->checkLoggedIn() ? "" : "required" ?>>
        </fieldset>
        <fieldset class="form-group">
            <legend>Personal Information</legend>
            <label for="firstName">First Name: </label>
            <input type="text" name="firstName" id="firstName" value="<?= $firstName ?>" required>
            <label for="lastName">Last Name: </label>
            <input type="text" name="lastName" id="lastName" value="<?= $lastName ?>" required>
            <label for="email">Email Address: </label>
            <input type="text" name="email" id="email" pattern="[\w]+[@][\w]+[.][\w]+.*" value="<?= $email ?>" autocomplete="email">
            <lable for="phone">Phone Number: </lable>
            <input type="text" name="phone" id="phone" value="<?= $phone ?>" autocomplete="phone">
        </fieldset>
        <fieldset class="form-group">
            <legend>Address Information</legend>
            <label for="street">Street: </label>
            <input type="text" name="street" id="street" value="<?= $street ?>">
            <label for="town">Town: </label>
            <input type="text" name="town" id="town" value="<?= $town ?>">
            <lable for="postcode">Postcode: </lable>
            <input type="text" name="postcode" id="postcode" pattern="[0-9]+" value="<?= $postcode ?>">
        </fieldset>
    </div>
    <?php if ($sessionManager->checkLoggedIn()): ?>
        <button type="submit" name="action" value="delete" id="delete" class="form-submit-btn">Delete</button>
        <button type="submit" name="action" value="update" id="update" class="form-submit-btn">Update User Details</button>
        <button type="submit" name="action" value="history" id="history" class="form-submit-btn">View Order History</button>
    <?php else: ?>
        <button type="submit" name="action" value="create" id="create" class="form-submit-btn">Create User</button>
    <?php endif ?>
</form>

<?php
    include __DIR__ . '/../view/footer.php';
?>
 
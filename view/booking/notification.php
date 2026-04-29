<?php
/*
    Controller for the notification page
    // view/booking/notification.php
    Expects $message from the controller

*/
    include __DIR__ . '/../../view/header.php';
?>

<div class="row justify-centre">
    <div class="big-message-display"><?= $message ?></div>
</div>

<?php
    include __DIR__ . '/../../view/footer.php';
?>
 
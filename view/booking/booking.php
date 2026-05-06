<?php
/*
    Controller for the booking page
    // view/booking/booking.php
    Expects a $session, a $startNo and a $status from the controller

*/
    include __DIR__ . '/../../view/header.php';
?>

<h1>Booking</h1>
<p><?= $status ?></p>
<div class="padding-2">

<h2>Select Your Seats</h2>
<div class="padding-2"></div>
<div class="row justify-centre align-centre">
    <button id="plus" class="operator"><img src="assets/img/plus.png"></button>
    <div id="seats-display"><?= $startNo ?></div>
    <button id="minus" class="operator"><img src="assets/img/minus.png"></button>
<script type="module" src="assets/js/compiled/booking.js"></script>
</div>
<div class="padding-2"></div>

<h2>Booking Details</h2>
<table class="booking-session-table">
    <thead>
        <tr class="table-header">
            <th class="header-cell">Movie</th>
            <th class="header-cell">Cinema</th>
            <th class="header-cell">Session Time</th>
            <th class="header-cell">Cost</th>
        </tr>
    </thead>
    <tbody>
        <tr class="session-row">
            <td class="movie-cell"><?= $session->movie->movieName ?></td>
            <td class="cinema-cell">SPX Cinemas - <?= $session->cinema->cinemaName ?></td>
            <td class="time-cell"><?= $session->sessionTime->format("h:i A") ?></td>
            <td id="cost-cell" cost="<?= $session->sessionCost ?>" class="cost-cell">$<?= $session->sessionCost ?></td>
        </tr>
    </tbody>
</table>

<div class="padding-2"></div>
<div class="row">
    <h3>Total Cost: </h3>
    <div class="padding-1"></div>
    <strong id="total-cost-display" class="price-display col justify-centre">$0</strong>
</div>
<div class="row justify-centre"><button id="booking-submit" class="session-book">Confirm Booking</button></div>
<div class="padding-2"></div>

<a href="https://www.flaticon.com/free-icons/plus-sign" title="plus sign icons">Icons created by Freepik - Flaticon</a>
<?php
    include __DIR__ . '/../../view/footer.php';
?>
 

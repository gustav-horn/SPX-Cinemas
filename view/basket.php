<?php
/*
    Controller for the basket page
    // view/basket.php
    Expects $bookings and $status from the controller

*/
    include __DIR__ . '/../view/header.php';
?>

<h1>Your basket</h1>
<p><?= $status ?></p>
<?php if (count($bookings) > 0): ?>
    <table class="booking-session-table" class="col">
        <thead>
            <tr class="table-header">
                <th class="header-cell">Booking Number</th>
                <th class="header-cell">Movie</th>
                <th class="header-cell">Cinema</th>
                <th class="header-cell">Date</th>
                <th class="header-cell">Time</th>
                <th class="header-cell">Quantity</th>
                <th class="header-cell">Cost</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bookings as $booking): ?>
                <tr class="session-row">
                    <td class="bookingNo-cell">#<?= $booking->bookingId ?>
                    <td class="movie-cell"><?= $booking->session->movie->movieName ?></td>
                    <td class="cinema-cell">SPX Cinemas - <?= $booking->session->cinema->cinemaName ?></td>
                    <td class="date-cell"><?= $booking->date->format("D d \of M Y") ?></td>
                    <td class="time-cell"><?= $booking->session->sessionTime->format("h:i A") ?></td>
                    <td class="quantity-cell"><?= $booking->seats ?></td>
                    <td name="booking-cost" cost="<?= $booking->getCost() ?>" class="cost-cell">$<?= $booking->getCost() ?></td>
                    <td><button class="session-book" name="edit-booking" booking-id="<?= $booking->bookingId ?>">Edit Booking</button></td>
                    <td><button class="bin-btn" name="delete-booking" booking-id="<?= $booking->bookingId ?>"><img src="assets/img/bin.png"></button></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
<?php else: ?>
    <h3>No bookings have been made. </h3>
<?php endif ?>

<div class="padding-2"></div>
<div class="row">
    <h3>Total Cost: </h3>
    <div class="padding-1"></div>
    <strong id="total-cost-display" class="price-display col justify-centre">$<?= array_reduce($bookings, fn($carry, $booking) => $carry + $booking->getCost(), 0) ?></strong>
</div>
<div class="padding-2"></div>
<buttton id="basket-confirm" class="session-book">Confirm Order</buttton>
<script type="module" src="assets/js/compiled/basket.js"></script>
<div class="padding-2"></div>
<a href="https://www.flaticon.com/free-icons/recycle-bin" title="recycle bin icons">Recycle bin icons created by lakonicon - Flaticon</a>

<?php
    include __DIR__ . '/../view/footer.php';
?>
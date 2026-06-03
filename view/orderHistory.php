<?php
// Renders HTML
// expects $orders to be provided by the controller

    include __DIR__ . "/../view/header.php"; //Include header and navigation bar
?>

<?php $totalCost = fn($order) => array_reduce($order["items"], fn($carry, $item) => $carry + $item->getCost(), 0) ?>

<?php foreach ($orders as $order): ?>
    <div name="accordian" class="card">
        <div class="card-header" order-id="<?= $order["order"]->orderId ?>">
            <div class="padding-2">Order Number: #<?= $order["order"]->orderId ?></div>
            <div class="padding-2">Order Date: <?= $order["order"]->orderDate->format("Y-m-d") ?></div>
            <div class="padding-2">Order Total: $<?= $totalCost($order) ?></div>
        </div>
        <div class="collapse hidden" order-id="<?= $order["order"]->orderId ?>">
            <div class="card-body">
                <div class="padding-2">
                    <h4>Order Items</h4>
                </div>
                <div class="row">
                <?php foreach ($order["items"] as $item): ?>
                    <div class="order-item-content">
                        <div class="column">
                            <h4>Order Item: #<?= $item->orderItemId?></h4>
                            <div class="">
                                <div class="col">Movie: <?= $item->session->movie->movieName ?></div>
                                <div class="col">Cinema: <?= $item->session->cinema->cinemaName ?></div>
                            </div>
                            <div class="">
                                <div class="col">Session Time: <?= $item->session->sessionTime->format("h:i A") ?></div>
                                <div class="col">Booking Date: <?= $item->date->format("d/m/Y") ?> </div>
                                <div class="col">Seats: <?= $item->seats ?></div>
                            </div>
                        </div>
                    </div>                        
                <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>
<script type="module" src="assets/js/compiled/orderHistory.js"></script>

<?php 
    include __DIR__."/../view/footer.php";
?>
<?php
// service/BasketService.php
/**
 * Customer Basket Service
 * Handles the conversion of a basket into an order
 */

// Load relevant models and repositories
require_once __DIR__ . "/../database/DatabaseSingleton.php";

require_once __DIR__ . "/../model/Member.php";
require_once __DIR__ . "/../model/Order.php";
require_once __DIR__ . "/../model/OrderItem.php";
require_once __DIR__ . "/../model/Booking.php";

require_once __DIR__ . "/../repository/OrderRepository.php";
require_once __DIR__ . "/../repository/OrderItemRepository.php";
require_once __DIR__ . "/../repository/BookingRepository.php";

class BasketService {

    private DatabaseSingleton $db;
    private OrderRepository $orders;
    private OrderItemRepository $orderItems;
    private BookingRepository $basketItems;
    private Auditer $auditer;

    public function __construct(DatabaseSingleton $db, Auditer $auditer) {
        $this->db = $db;
        $this->orders = new OrderRepository($db, $auditer);
        $this->orderItems = new OrderItemRepository($db, $auditer);
        $this->basketItems = new BookingRepository($db, $auditer);
        $this->auditer = $auditer;
    }

    public function hasItems(Member $member): bool {
        return count($this->basketItems->findByMember($member)) > 0;
    }

    public function confirmBasket(Member $member): bool {
        $items = $this->basketItems->findByMember($member);

        $order = new Order(null, $member, new DateTime(), OrderStatus::Booked);
        if (!$this->orders->save($order)) { // Save the new order
            return false;
        };

        $order->orderId = $this->orders->findLatestId(); //Note: we are *very* confident this is true bc. we just (successfully) put something into the database.

        $orderItemSuccesses = array_map(
                fn($item) => $this->orderItems->save(
                    new OrderItem(null, $order, $item->session, $item->date, $item->seats, $item->pricePerSeat)
                    ),
                $items
        );
        if (array_any($orderItemSuccesses, fn($succ) => $succ === false)) { // I.e. if any of our orderItem insertions have failed
            return false;
        };

        $basketDeletionSuccesses = array_map(
            $this->basketItems->delete(...),
            $items
        );
        if (array_any($basketDeletionSuccesses, fn($succ) => $succ === false)) { // I.e. if any of our basketDeletions have failed
            return false;
        }

        if (!$this->auditer->orderPlaced($member, $items)) { // Make the auditLog
            return false;
        }

        return true;
    }

    public function deleteItem(int $bookingId): bool {
        $item = $this->basketItems->findById($bookingId);
        if (is_null($item)) {return false;}
        return $this->basketItems->delete($item);
    }
    
}
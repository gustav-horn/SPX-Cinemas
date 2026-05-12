<?php
// controller/OrderHistoryController.php
/* Controller for the Order History page
    - sends the page
*/

// Include the required models and repositories
require_once __DIR__ . "/../model\Order.php";
require_once __DIR__ . "/../repository/OrderRepository.php";
require_once __DIR__ . "/../model/OrderItem.php";
require_once __DIR__ . "/../repository/OrderItemRepository.php";

// Include the required utility modules
require_once __DIR__ . "/../database/DatabaseSingleton.php";
require_once __DIR__ . "/../utilities/Auditer.php";

class OrderHistoryController
{
    public function displayOrderHistory(SessionManager $sessionManager)  {
        //retrieve any data if needed
        $db = DatabaseSingleton::getInstance();
        $auditer = new Auditer($db);

        $orderRepository = new OrderRepository($db, $auditer);
        $orderItemRepository = new OrderItemRepository($db, $auditer);

        $orders = $orderRepository->findByMember($sessionManager->getActiveUser());

        $orders = array_map(
            fn($order) => ["order" => $order, "items" => $orderItemRepository->findByOrder($order)], 
            $orders
        );

        // Views are included from the project root path (index.php runs from root)
        include __DIR__ . '/../view/orderHistory.php';
    }
}
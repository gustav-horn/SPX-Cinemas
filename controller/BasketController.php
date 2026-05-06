<?php
// controller/Basket.php
/* Controller for the Basket page
    - Grabs all current bookings made by the given customer
*/

//Include any models if needed
require_once __DIR__ . '/../model/Member.php';
require_once __DIR__ . '/../model/Booking.php';
require_once __DIR__ . '/../repository/BookingRepository.php';

//Include the required utilities
require_once __DIR__ . '/../database/DatabaseSingleton.php';
require_once __DIR__ . "/../utilities/Auditer.php";

//Include the BasketService
require_once __DIR__ . "/../services/BasketService.php";

class BasketController {
    private BookingRepository $bookingRepository;
    private SessionManager $sessionManager;
    private BasketService $basketService;

    public function __construct(SessionManager $sessionManager) {
        $this->sessionManager = $sessionManager;
        $db = DatabaseSingleton::getInstance();
        $auditer = new Auditer($db);

        $this->bookingRepository = new BookingRepository($db, $auditer);
        $this->basketService = new BasketService($db, $auditer);
    }

    public function manageRequest() {
        //Step 1. Check to see if we need to do anything
        if ((count($_POST) > 0) && (isset($_POST["action"]))) {
            switch($_POST["action"]) {
                case "confirm": $this->confirmBasket(); break;
                case "delete": $this->deleteItem($_POST["item"]); break;
                default: $this->displayBasket("Continue managing your basket normally.");
            };
            return;
        }
        //Step 2. If no, then just seve the page
        else {
            $this->displayBasket("View, edit and confirm your basket");
            return;
        }
    }

    public function displayBasket(string $status) {
        //Let's make sure that someone is logged in before doing this
        if ($this->sessionManager->checkLoggedIn()) {
            $bookings = $this->bookingRepository->findByMember($this->sessionManager->getActiveUser());
        }
        else {
            $bookings = null;
        }

        // Views are included from the project root path (index.php runs from root)
        include __DIR__ . '/../view/basket.php';
    }

    public function confirmBasket() {
        //Check to make sure that somewone is logged in
        if ($this->sessionManager->checkLoggedIn()) {
            if ($this->basketService->confirmBasket($this->sessionManager->getActiveUser())) { // Convert the basket into an order item.
                $this->displayBasket("Basket Confirmed.");
            }
            else {
                $this->displayBasket("Something went wrong, please try again");
            };
        }
    }

    public function deleteItem(int $itemId) {
        //Check to make sure that somewone is logged in
        if ($this->sessionManager->checkLoggedIn()) {
            if ($this->basketService->deleteItem($itemId)) { // Actually delete the basket item
                $this->displayBasket("View, edit and confirm your basket");
            }
            else {
                $this->displayBasket("Something went wrong, please try again");
            };
        }
    }
}
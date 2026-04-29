<?php
// controller/BookingController.php
/* Controller for the booking management page
    - sends the page
    - creates OR updates the booking
*/

// Include any models and repositories if needed
require_once __DIR__ . "/../model/Session.php";
require_once __DIR__ . "/../repository/SessionRepository.php";

require_once __DIR__ . "/../model/Booking.php";
require_once __DIR__ . "/../repository/BookingRepository.php";

// Include the required utility modules
require_once __DIR__ . "/../database/DatabaseSingleton.php";
require_once __DIR__ . "/../utilities/Encryption.php";
require_once __DIR__ . "/../utilities/Auditer.php";

class BookingController {
    private BookingRepository $bookingRepository;
    private SessionRepository $sessionRepository;
    private SessionManager $sessionManager;

    public function __construct(SessionManager $sessionManager) {
        $this->sessionManager = $sessionManager;
        $db = DatabaseSingleton::getInstance();
        $auditer = new Auditer($db);

        $this->bookingRepository = new BookingRepository($db, $auditer);
        $this->sessionRepository = new SessionRepository($db, $auditer);
    }

    public function manageRequest() {
        // Step 1. Check to see if we are pointed at a valid session
        if ((!isset($_GET["session"]) || ($session = $this->sessionRepository->findById($_GET["session"])) === null)
            && (true)) { // Will be: !isset($_GET["booking"]) || ($session = $this->bookingService->findSessionByBookingId($_GET["booking"]) === null)
            $this->serveNotification("404. The session you are looking for is either no longer available or does not exist.");
            return;
        }
        // Step 2. Check to see if we have some changes to make
        if ((count($_POST) > 0) && isset($_POST["noOfSeats"])) {
            // Add the booking
            $this->createBooking($session);
            return;
        }
        // Step 3. Serve the page
        $this->servePage($session, "Please select the number of seats you want and confirm your booking");
        return;
    }

    private function createBooking(Session $session): void {
        $seats = (int)$_POST["noOfSeats"];
        if ($seats <= 0) {
            $this->servePage($session, "Please select one or more seats");
            return;
        }
        $booking = new Booking(null, $session, $this->sessionManager->getActiveUser(), $seats, $session->getCost());
        if ($this->bookingRepository->save($booking)) {
            $this->serveNotification("Booking Creation Succesful.");
            return;
        }
        else {
            $this->servePage($session, "Booking Creation Failed. Please Try Again.");
            return;
        }
    }

    private function servePage(Session $session, string $status) {
        require_once __DIR__ . "/../view/booking/booking.php";
    }

    private function serveNotification(string $message) {
        require_once __DIR__ . "/../view/booking/notification.php";
    }
}
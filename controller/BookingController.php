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
        if ((isset($_GET["session"]) && ($session = $this->sessionRepository->findById($_GET["session"])) !== null)) {
            // Check to see if we have some changes to make
            if ((count($_POST) > 0) && isset($_POST["noOfSeats"]) && isset($_POST["date"])) {
                $this->createBooking($session);
            }
            // Serve the page
            else {
                $this->servePage($session, 0, new DateTimeImmutable(), "Please select the number of seats you want and confirm your booking");
            }
        }
        // Step 2. Check to see if we are pointed at a valid pre-existing booking
        else if (isset($_GET["booking"]) && ($booking = $this->bookingRepository->findById($_GET["booking"])) !== null) {
            if ((count($_POST) > 0) && isset($_POST["noOfSeats"]) && isset($_POST["date"])) {
                $this->editBooking($booking);
            }
            // Serve the page
            else {
                $this->servePage($booking->session, $booking->seats, $booking->date, "Edit your booking");
            }
        }
        // Step 3. Fallback to 404
        else {
            $this->serveNotification("404. The session you are looking for is either no longer available or does not exist.");
        };
    }

    private function createBooking(Session $session): void {
        $seats = (int)$_POST["noOfSeats"];
        $date = DateTimeImmutable::createFromFormat("Y-m-d", $_POST["date"]);
        if ($seats <= 0) {
            $this->servePage($session, $seats, $date, "Please select one or more seats");
            return;
        }
        if ($date->add(new DateInterval("P1D")) < new DateTime("now")) {
            $this->servePage($session, $seats, $date, "Please have a date that is not from the past.");
            return;
        }
        $booking = new Booking(null, $session, $this->sessionManager->getActiveUser(), $date, $seats, $session->getCost());
        if ($this->bookingRepository->save($booking)) {
            $this->serveNotification("Booking Creation Successful. <br> Your booking number is #" . $this->bookingRepository->findLatestId());
            return;
        }
        else {
            $this->servePage($session, $seats, $date, "Booking Creation Failed. Please Try Again.");
            return;
        }
    }

    private function editBooking(Booking $booking): void {
        $seats = (int)$_POST["noOfSeats"];
        $date = DateTimeImmutable::createFromFormat("Y-m-d", $_POST["date"]);
        if ($seats <= 0) {
            $this->servePage($booking->session, $seats, $date, "Please select either one or more seats. <br> If you wish to cancel, simply delete the booking from the previous page");
            return;
        }
        if ($date->add(new DateInterval("P1D")) < new DateTime("now")) {
            $this->servePage($booking->session, $seats, $date, "Please have a date that is not from the past.");
            return;
        }
        $newBooking = new Booking($booking->bookingId, $booking->session, $this->sessionManager->getActiveUser(), $date, $seats, $booking->session->getCost());
        if ($booking == $newBooking || $this->bookingRepository->save($newBooking)) { // Makes no change to the booking a successful no-op
            $this->serveNotification("Booking Modification Succesful.");
            return;
        }
        else {
            $this->servePage($booking->session, $seats, $date, "Booking Modification Failed. Please Try Again.");
            return;
        }
    }

    private function servePage(Session $session, int $startNo, DateTimeImmutable $date, string $status) {
        require_once __DIR__ . "/../view/booking/booking.php";
    }

    private function serveNotification(string $message) {
        require_once __DIR__ . "/../view/booking/notification.php";
    }
}
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../model/BookingModel.php';

class BookingController {
    private $bookingModel;

    public function __construct() {
        $this->bookingModel = new BookingModel();
    }

    public function getWishlist() {
        if (!isset($_SESSION['user_data'])) {
            die("You need to log in.");
        }

        $customerID = $_SESSION['user_data']['CustomerID'];
        return $this->bookingModel->fetchWishlistVenues($customerID);
    }

    public function confirmBooking() {
        if (!isset($_SESSION['user_data'])) {
            die("You need to log in.");
        }

        $customerID = $_SESSION['user_data']['CustomerID'];
        $venueID = $_POST['venueID'] ?? 0;

        if ($venueID == 0) {
            die("Invalid venue ID.");
        }

        if ($this->bookingModel->bookVenue($customerID, $venueID)) {
            echo "Booking confirmed successfully.";
        } else {
            echo "Failed to confirm booking.";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['action'])) {
    $controller = new BookingController();

    switch ($_POST['action']) {
        case 'confirm_booking':
            $controller->confirmBooking();
            break;
        default:
            die("Invalid action.");
    }
}
?>

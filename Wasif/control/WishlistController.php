<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../model/WishlistModel.php';

class WishlistController {
    private $wishlistModel;

    public function __construct() {
        $this->wishlistModel = new WishlistModel();
    }

    public function getWishlist() {
        if (!isset($_SESSION['user_data'])) {
            die("You need to log in.");
        }

        $customerID = $_SESSION['user_data']['CustomerID'];
        return $this->wishlistModel->fetchWishlistVenues($customerID);
    }

    public function removeFromWishlist() {
        if (!isset($_SESSION['user_data'])) {
            die("You need to log in.");
        }

        $customerID = $_SESSION['user_data']['CustomerID'];
        $venueID = $_POST['venueID'] ?? 0;

        if ($venueID == 0) {
            die("Invalid venue ID.");
        }

        if ($this->wishlistModel->deleteVenueFromWishlist($customerID, $venueID)) {
            echo "Venue removed from wishlist.";
        } else {
            echo "Failed to remove venue.";
        }
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

        if ($this->wishlistModel->bookVenue($customerID, $venueID)) {
            echo "Booking confirmed successfully.";
        } else {
            echo "Failed to confirm booking.";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['action'])) {
    $controller = new WishlistController();

    switch ($_POST['action']) {
        case 'remove_from_wishlist':
            $controller->removeFromWishlist();
            break;
        case 'confirm_booking':
            $controller->confirmBooking();
            break;
        default:
            die("Invalid action.");
    }
}
?>

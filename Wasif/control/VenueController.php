<?php
require_once '../model/VenueModel.php';
require_once '../model/CustomerModel.php';
session_start();

class VenueController {
    private $venueModel;
    private $customerModel;

    public function __construct() {
        $this->venueModel = new VenueModel();
        $this->customerModel = new CustomerModel();
    }

    public function getAvailableVenues() {
        return $this->venueModel->fetchAvailableVenues();
    }

    public function addToWishlist() {
        if (!isset($_SESSION['user_data'])) {
            die("You need to log in to add to wishlist.");
        }

        $customerID = $_SESSION['user_data']['CustomerID'];
        $venueName = $_POST['venueName'] ?? '';

        if (empty($venueName)) {
            die("Venue name cannot be empty.");
        }

        $venueID = $this->venueModel->getVenueIdByName($venueName);
        if (!$venueID) {
            die("Invalid venue name.");
        }

        if ($this->customerModel->addVenueToWishlist($customerID, $venueID)) {
            echo "Venue added to wishlist.";
        } else {
            echo "Failed to add venue.";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['action'])) {
    $controller = new VenueController();

    switch ($_POST['action']) {
        case 'add_to_wishlist':
            $controller->addToWishlist();
            break;
        default:
            die("Invalid action.");
    }
}
?>

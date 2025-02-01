<?php
require_once '../model/UserModel.php';
session_start();

class LoginController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function login() {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            echo "Email and password are required.";
            return;
        }

        // Check if the user is an admin
        $admin = $this->userModel->getAdminByEmail($email);
        if ($admin && password_verify($password, $admin['Password'])) {
            $_SESSION['user_type'] = 'Admin';
            $_SESSION['user_data'] = $admin;
            header("Location: ../view/admin_profile.php");
            exit;
        }

        // Check if the user is a customer
        $customer = $this->userModel->getCustomerByEmail($email);
        if ($customer && password_verify($password, $customer['Password'])) {
            $_SESSION['user_type'] = 'Customer';
            $_SESSION['user_data'] = $customer;
            header("Location: ../view/customer_home.php");
            exit;
        }

        // Check if the user is a venue owner
        $venueOwner = $this->userModel->getVenueOwnerByEmail($email);
        if ($venueOwner && password_verify($password, $venueOwner['Password'])) {
            $_SESSION['user_type'] = 'VenueOwner';
            $_SESSION['user_data'] = $venueOwner;
            header("Location: ../view/venue_owner_profile.php");
            exit;
        }

        // Check if the user is an event organizer
        $eventOrganizer = $this->userModel->getEventOrganizerByEmail($email);
        if ($eventOrganizer && password_verify($password, $eventOrganizer['Password'])) {
            $_SESSION['user_type'] = 'EventOrganizer';
            $_SESSION['user_data'] = $eventOrganizer;
            header("Location: ../view/event_organizer_profile.php");
            exit;
        }

        // If no match found
        echo "Invalid email or password.";
    }
}

// Handle login request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $controller = new LoginController();
    $controller->login();
}
?>

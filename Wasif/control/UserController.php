<?php
require_once '../model/UserModel.php';

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function registerCustomer() {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $address = $_POST['address'] ?? '';

        if (empty($name) || empty($email) || empty($password) || empty($phone) || empty($address)) {
            echo "All fields are required.";
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format.";
            return;
        }

        if ($this->userModel->registerCustomer($name, $email, $password, $phone, $address)) {
            echo "Customer registration successful.";
            header("Location: ../view/login.php");
            exit();
        } else {
            echo "Customer registration failed. Email might already exist.";
        }
    }


    public function registerVenueOwner() {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $businessName = $_POST['business_name'] ?? '';

        if (empty($name) || empty($email) || empty($password) || empty($businessName)) {
            echo "All fields are required.";
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format.";
            return;
        }

        if ($this->userModel->registerVenueOwner($name, $email, $password, $phone, $businessName)) {
            echo "Venue owner registration successful.";
            header("Location: ../view/login.php");
            exit();
        } else {
            echo "Venue owner registration failed. Email might already exist.";
        }
    }

    public function registerEventOrganizer() {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $specialization = $_POST['specialization'] ?? '';

        if (empty($name) || empty($email) || empty($password) || empty($specialization)) {
            echo "All fields are required.";
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format.";
            return;
        }

        if ($this->userModel->registerEventOrganizer($name, $email, $password, $phone, $specialization)) {
            echo "Event organizer registration successful.";
            header("Location: ../view/login.php");
            exit();
        } else {
            echo "Event organizer registration failed. Email might already exist.";
        }
    }
}

// Handle actions
if (isset($_POST['action'])) {
    $controller = new UserController();
    switch ($_POST['action']) {
        case 'register_customer':
            $controller->registerCustomer();
            break;
        case 'register_venue_owner':
            $controller->registerVenueOwner();
            break;
        case 'register_event_organizer':
            $controller->registerEventOrganizer();
            break;
        default:
            echo "Invalid action.";
    }
}
?>

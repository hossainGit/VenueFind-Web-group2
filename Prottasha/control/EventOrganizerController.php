<?php
require_once '../model/UserModel.php';

class EventOrganizerController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    // 1. View Profile
    public function viewProfile($organizerID) {
        // Fetch the profile from the model
        return $this->userModel->getEventOrganizerByID($organizerID);
    }
    

    // 2. Edit Profile
    public function editProfile($organizerID) {
        $name = $_POST['name'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $specialization = $_POST['specialization'] ?? '';

        // Server-side validation
        if (empty($name)) {
            echo "Name is required.";
            return;
        }

        if (empty($phone) || !preg_match('/^01[3-9][0-9]{8}$/', $phone)) {
            echo "Invalid phone number. Enter a valid Bangladeshi phone number.";
            return;
        }
        
        if (empty($specialization)) {
            echo "Specialization is required.";
            return;
        }

        // Call the model to update the database
        $result = $this->userModel->updateEventOrganizer($organizerID, $name, $phone, $specialization);
        if ($result) {
            echo "Profile updated successfully.";
            header ("Location: ../view/viewProfile.php");
        } else {
            echo "Profile update failed.";
        }
    }

    // 3. View Services
    public function viewServices($organizerID) {
        // Fetch services using the model
        return $this->userModel->getServicesByOrganizerID($organizerID);
    }
    
    public function getServiceByID($serviceID) {
        return $this->userModel->getServiceByID($serviceID);
    }
    
    public function updateService($serviceID, $name, $type, $price, $description) {
        return $this->userModel->updateService($serviceID, $name, $type, $price, $description);
    }
        
    

    // 4. Add New Service
    public function addService($organizerID) {
        $name = $_POST['name'] ?? '';
        $type = $_POST['type'] ?? '';
        $price = $_POST['price'] ?? '';
        $description = $_POST['description'] ?? '';

        // Server-side validation
        if (empty($name)) {
            echo "Service name is required.";
            return;
        }

        if (empty($type)) {
            echo "Service type is required.";
            return;
        }

        if (empty($price) || !is_numeric($price) || floatval($price) <= 0) {
            echo "Invalid price. Price must be a positive number.";
            return;
        }

        if (empty($description)) {
            echo "Service description is required.";
            return;
        }

        $result = $this->userModel->addService($organizerID, $name, $type, $price, $description);
        if ($result) {
            echo "Service added successfully.";
            header("Location: ../view/viewServices.php"); // Redirect after adding service
            exit;
        } else {
            echo "Failed to add service.";
        }
    }


    // 8. Logout
    public function logout() {
        session_start();
        session_destroy();
        header("Location: ../view/login.php");
    }
}

// Handle actions
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    session_start();
    $controller = new EventOrganizerController();

    if (!isset($_SESSION['organizerID'])) {
        echo "Unauthorized access.";
        exit;
    }

    $organizerID = $_SESSION['organizerID'];

    switch ($_POST['action']) {
        case 'view_profile':
            $controller->viewProfile($organizerID);
            break;
        case 'edit_profile':
            $controller->editProfile($organizerID);
            break;
        case 'view_services':
            $controller->viewServices($organizerID);
            break;
        case 'add_service':
            $controller->addService($organizerID);
            break;
        case 'logout':
            $controller->logout();
            break;
        default:
            echo "Invalid action.";
    }
}
?>

<?php
require_once '../model/CustomerModel.php';
session_start();

class CustomerController {
    private $customerModel;

    public function __construct() {
        $this->customerModel = new CustomerModel();
    }

    // Fetch customer details
    public function getCustomerDetails() {
        if (!isset($_SESSION['user_data'])) {
            die("You need to log in.");
        }

        $customerID = $_SESSION['user_data']['CustomerID'];
        return $this->customerModel->fetchCustomerDetails($customerID);
    }

    // Update phone or address
    public function updateCustomerInfo() {
        if (!isset($_SESSION['user_data'])) {
            die("You need to log in to update your profile.");
        }

        $customerID = $_SESSION['user_data']['CustomerID'];
        $phone = $_POST['phone'] ?? '';
        $address = $_POST['address'] ?? '';

        if (!empty($phone)) {
            if (!preg_match('/^(?:\+8801|01)[3-9]\d{8}$/', $phone)) {
                die("Invalid Bangladeshi phone number.");
            }
            $this->customerModel->updateCustomerInfo($customerID, 'PhoneNumber', $phone);
            $_SESSION['user_data']['PhoneNumber'] = $phone;
        }

        if (!empty($address)) {
            $this->customerModel->updateCustomerInfo($customerID, 'Address', $address);
            $_SESSION['user_data']['Address'] = $address;
        }

        header("Location: ../view/view_profile.php");
    }

    // Change customer password
    public function updatePassword() {
        if (!isset($_SESSION['user_data'])) {
            die("You need to log in to change your password.");
        }

        $customerID = $_SESSION['user_data']['CustomerID'];
        $currentPassword = $_POST['currentPassword'] ?? '';
        $newPassword = $_POST['newPassword'] ?? '';

        if (empty($currentPassword) || empty($newPassword)) {
            die("Both fields are required.");
        }

        if ($this->customerModel->updatePassword($customerID, $currentPassword, $newPassword)) {
            header("Location: ../view/view_profile.php?success=Password updated successfully");
        } else {
            die("Incorrect current password.");
        }
    }
}

// Handle requests
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['action'])) {
    $controller = new CustomerController();

    switch ($_POST['action']) {
        case 'update_customer_info':
            $controller->updateCustomerInfo();
            break;
        case 'update_password':
            $controller->updatePassword();
            break;
        case 'get_customer_details':
            $controller->getCustomerDetails();
            break;
        default:
            die("Invalid action.");
    }
}
?>

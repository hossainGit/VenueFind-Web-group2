<?php
require_once '../model/UserModel.php';

class AdminController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function initializeAdmin() {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        // Validation
        if (empty($name) || empty($email) || empty($password)) {
            echo "All fields are required.";
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format.";
            return;
        }

        // Check if email already exists in Admins table
        if ($this->userModel->emailExistsInAdmins($email)) {
            echo "Admin with this email already exists.";
            return;
        }

        // Register admin
        if ($this->userModel->registerAdmin($name, $email, $password)) {
            echo "Admin initialized successfully.";
        } else {
            echo "Failed to initialize admin.";
        }
    }
}

// Handle requests
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'initialize_admin') {
    $controller = new AdminController();
    $controller->initializeAdmin();
}
?>

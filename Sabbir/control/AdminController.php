<?php
require_once '../model/AdminModel.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class AdminController {
    private $adminModel;

    public function __construct() {
        $this->adminModel = new AdminModel();
    }

    public function loginAdmin($email, $password) {
        if (!$this->validateEmail($email) || empty($password)) {
            $_SESSION['error'] = "Invalid email or password.";
            header("Location: ../view/adminLogin.php");
            exit;
        }

        $admin = $this->adminModel->getAdminByEmail($email);
        if ($admin && password_verify($password, $admin['Password'])) {
            $_SESSION['adminID'] = $admin['AdminID'];
            $_SESSION['adminName'] = $admin['Name'];
            header("Location: ../view/adminProfile.php");
            exit;
        } else {
            $_SESSION['error'] = "Invalid credentials.";
            header("Location: ../view/adminLogin.php");
        }
    }

    public function viewProfile($adminID) {
        return $this->adminModel->getAdminByID($adminID);
    }

    public function logoutAdmin() {
        session_destroy();
        header("Location: ../view/adminLogin.php");
        exit;
    }

    private function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function editAdminProfile($adminID) {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
    
        // Validation
        if (empty($name)) {
            $_SESSION['error'] = "Name is required.";
            header("Location: ../view/editAdminProfile.php");
            exit;
        }
    
        if (!$this->validateEmail($email)) {
            $_SESSION['error'] = "Invalid email format.";
            header("Location: ../view/editAdminProfile.php");
            exit;
        }
    
        // Update admin profile
        $result = $this->adminModel->updateAdminProfile($adminID, $name, $email);
        if ($result) {
            $_SESSION['success'] = "Profile updated successfully.";
        } else {
            $_SESSION['error'] = "Failed to update profile.";
        }
    
        header("Location: ../view/editAdminProfile.php");
        exit;
    }

    public function addNewAdmin() {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
    
        // Validation
        if (empty($name)) {
            $_SESSION['error'] = "Name is required.";
            header("Location: ../view/addAdmin.php");
            exit;
        }
    
        if (!$this->validateEmail($email)) {
            $_SESSION['error'] = "Invalid email format.";
            header("Location: ../view/addAdmin.php");
            exit;
        }
    
        if (strlen($password) < 6) {
            $_SESSION['error'] = "Password must be at least 6 characters.";
            header("Location: ../view/addAdmin.php");
            exit;
        }
    
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $result = $this->adminModel->addAdmin($name, $email, $hashedPassword);
    
        if ($result) {
            $_SESSION['success'] = "New admin added successfully.";
        } else {
            $_SESSION['error'] = "Failed to add admin.";
        }
    
        header("Location: ../view/addAdmin.php");
        exit;
    }

    public function getAllCustomers() {
        return $this->adminModel->fetchAllCustomers();
    }  
    
    public function getAllOrganizers() {
        return $this->adminModel->fetchAllOrganizers();
    }
    
    
}

// Handle actions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $controller = new AdminController();

    switch ($_POST['action']) {
        case 'admin_login':
            $controller->loginAdmin($_POST['email'], $_POST['password']);
            break;
        case 'edit_admin_profile':
            $controller->editAdminProfile($_POST['adminID']);
            break;
        case 'add_admin':
            $controller->addNewAdmin();
            break;
                 
            
        default:
            echo "Invalid action.";
    }
}

if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    $controller = new AdminController();
    $controller->logoutAdmin();
}

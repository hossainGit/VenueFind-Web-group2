<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../model/AppointmentModel.php';

class AppointmentController {
    private $appointmentModel;

    public function __construct() {
        $this->appointmentModel = new AppointmentModel();
    }

    public function getAppointments() {
        if (!isset($_SESSION['user_data'])) {
            die("You need to log in.");
        }

        $customerID = $_SESSION['user_data']['CustomerID'];
        return $this->appointmentModel->fetchAppointments($customerID);
    }

    public function cancelAppointment() {
        if (!isset($_SESSION['user_data'])) {
            die("You need to log in.");
        }

        $appointmentID = $_POST['appointmentID'] ?? 0;

        if ($appointmentID == 0) {
            die("Invalid appointment ID.");
        }

        if ($this->appointmentModel->deleteAppointment($appointmentID)) {
            echo "Appointment canceled successfully.";
        } else {
            echo "Failed to cancel appointment.";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['action'])) {
    $controller = new AppointmentController();

    switch ($_POST['action']) {
        case 'cancel_appointment':
            $controller->cancelAppointment();
            break;
        default:
            die("Invalid action.");
    }
}
?>

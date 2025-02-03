<?php
session_start();
require_once '../model/owner_model.php';

if (isset($_GET['appointmentID'])) {
    $appointmentID = $_GET['appointmentID'];

    if (declineBooking($appointmentID)) {
        header("Location: ../view/booking_requests.php");
        exit();
    } else {
        header("Location: ../view/booking_requests.php?error=Failed to decline booking.");
        exit();
    }
}
?>
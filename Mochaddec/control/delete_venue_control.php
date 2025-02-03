<?php
session_start();
require_once '../model/owner_model.php';

if (isset($_GET['venueID'])) {
    $venueID = $_GET['venueID'];

    if (deleteVenue($venueID)) {
        header("Location: ../view/dashboard.php");
        exit();
    } else {
        header("Location: ../view/dashboard.php?error=Failed to delete venue.");
        exit();
    }
}
?>
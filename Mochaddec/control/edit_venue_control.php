<?php
session_start();
require_once '../model/owner_model.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $venueID = $_POST['venueID'];
    $name = trim($_POST['name']);
    $location = trim($_POST['location']);
    $capacity = trim($_POST['capacity']);
    $price = trim($_POST['price']);
    $description = trim($_POST['description']);
    $availability = trim($_POST['availability']);

    // Validation
    $errors = [];

    if (empty($name)) {
        $errors[] = "Venue name is required.";
    }

    if (empty($location)) {
        $errors[] = "Location is required.";
    }

    if (empty($capacity)) {
        $errors[] = "Capacity is required.";
    } elseif (!is_numeric($capacity) || $capacity <= 0) {
        $errors[] = "Capacity must be a positive number.";
    }

    if (empty($price)) {
        $errors[] = "Price is required.";
    } elseif (!is_numeric($price) || $price <= 0) {
        $errors[] = "Price must be a positive number.";
    }

    if (empty($description)) {
        $errors[] = "Description is required.";
    }

    if (empty($availability)) {
        $errors[] = "Availability status is required.";
    } elseif (!in_array($availability, ['Available', 'Unavailable'])) {
        $errors[] = "Invalid availability status.";
    }

    if (empty($errors)) {
        if (updateVenue($venueID, $name, $location, $capacity, $price, $description, $availability)) {
            $_SESSION['success'] = "Venue updated successfully!";
            header("Location: ../view/dashboard.php");
            exit();
        }
    } else {
        echo "Invalid Input: ";
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }


    // header("Location: ../view/edit_venue.php?venueID=$venueID");
    // exit();
}
?>
<?php
session_start();
require_once '../model/owner_model.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ownerID = $_SESSION['OwnerID'];
    $name = trim($_POST['name']);
    $location = trim($_POST['location']);
    $capacity = trim($_POST['capacity']);
    $price = trim($_POST['price']);
    $description = trim($_POST['description']);

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

    if (empty($errors)) {
        if (addVenue($ownerID, $name, $location, $capacity, $price, $description)) {
            $_SESSION['success'] = "Venue added successfully!";
            header("Location: ../view/dashboard.php");
            exit();
        } else {
            $_SESSION['error'] = "Failed to add venue.";
        }
    } else {
        echo "Invalid Input: ";
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }

    // header("Location: ../view/add_venue.php");
    // exit();
}
?>
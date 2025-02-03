<?php
session_start();
require_once '../model/owner_model.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ownerID = $_SESSION['OwnerID'];
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phoneNumber = trim($_POST['phoneNumber']);

    // Validation OF UPDATE PRFL
    $errors = [];

    if (empty($name)) {
        $errors[] = "Name is required.";
    }

    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (empty($phoneNumber)) {
        $errors[] = "Phone number is required.";
    } elseif (!preg_match("/^[0-9]{11}$/", $phoneNumber)) {
        $errors[] = "Phone number must be 11 digits.";
    }

    if (empty($errors)) {
        if (updateOwnerProfile($ownerID, $name, $email, $phoneNumber)) {
            header("Location: ../view/profile.php");
            exit();
        } else {
            echo "Invalid Input: ";
        }
    } else {
        echo "Invalid Input: ";
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
        $_SESSION['error'] = implode("<br>", $errors);
    }

}
?>
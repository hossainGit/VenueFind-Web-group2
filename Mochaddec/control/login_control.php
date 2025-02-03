<?php
session_start();
require_once '../model/owner_model.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $owner = loginOwner($email, $password);

    if ($owner) {
        $_SESSION['OwnerID'] = $owner['OwnerID'];
        $_SESSION['Name'] = $owner['Name'];
        header("Location: ../view/dashboard.php");
        exit();
    } else {
        header("Location: ../view/login.php?error=Invalid email or password.");
        exit();
    }
}
?>
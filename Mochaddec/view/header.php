<?php

if(session_status()==PHP_SESSION_NONE) {
session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div id="label">
    <h1>VenueFind</h1>
            <h2>
                Venue Owner Dashboard
            </h2>
    </div>

<div id="banner">
 
        </div>
    <header>
        <nav>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="add_venue.php">Add Venue</a></li>
                <li><a href="booking_requests.php">Booking Requests</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="../control/logout.php" onclick="return confirm('Are you sure you want to Log out?');">Logout</a></li>
            </ul>
        </nav>
    </header>
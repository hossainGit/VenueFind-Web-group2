<?php
session_start();
if (!isset($_SESSION['user_data'])) {
    header("Location: login.php"); // Redirect if not logged in
    exit();
}

$customerName = $_SESSION['user_data']['Name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Home</title>
    <link rel="stylesheet" type="text/css" href="../css/customer.css">
    <script src="../js/customer.js"></script>
</head>
<body>
    <header>
        <h1>Welcome, <?php echo htmlspecialchars($customerName); ?>!</h1>
    </header>
    
    <main>
        <button onclick="location.href='view_profile.php'">View Profile</button>
        <button onclick="location.href='view_venues.php'">View Available Venues</button>
        <button onclick="location.href='wishlist.php'">Manage Wishlist</button>
        <button onclick="location.href='book_venue.php'">Book a Venue</button>
        <button onclick="location.href='appointments.php'">View Appointments</button>
        <br><br> <!-- Adds space between buttons -->
        <button class="logout-btn" onclick="location.href='../control/logout.php'">Logout</button>
    </main>
</body>
</html>

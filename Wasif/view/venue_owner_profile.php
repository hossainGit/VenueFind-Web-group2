<?php
session_start();
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'VenueOwner') {
    header("Location: ../login.php");
    exit;
}
$venueOwner = $_SESSION['user_data'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venue Owner Profile</title>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($venueOwner['Name']); ?>!</h1>
    <p>Email: <?php echo htmlspecialchars($venueOwner['Email']); ?></p>
    <p>Phone: <?php echo htmlspecialchars($venueOwner['PhoneNumber']); ?></p>
    <p>Business Name: <?php echo htmlspecialchars($venueOwner['BusinessName']); ?></p>
    <a href="../control/logout.php">Logout</a>
</body>
</html>

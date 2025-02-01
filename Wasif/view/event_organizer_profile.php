<?php
session_start();
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'EventOrganizer') {
    header("Location: ../login.php");
    exit;
}
$eventOrganizer = $_SESSION['user_data'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Organizer Profile</title>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($eventOrganizer['Name']); ?>!</h1>
    <p>Email: <?php echo htmlspecialchars($eventOrganizer['Email']); ?></p>
    <p>Phone: <?php echo htmlspecialchars($eventOrganizer['PhoneNumber']); ?></p>
    <p>Specialization: <?php echo htmlspecialchars($eventOrganizer['Specialization']); ?></p>
    <a href="../control/logout.php">Logout</a>
</body>
</html>

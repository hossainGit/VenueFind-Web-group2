<?php
session_start();

if (!isset($_SESSION['organizerID'])) {
    header("Location: login.php");
    exit;
}

$organizerName = $_SESSION['organizerName'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo htmlspecialchars($organizerName); ?>!</h1>
        <div class="button-group">
            <a href="viewProfile.php" class="btn">View Profile</a>
            <a href="editProfile.php" class="btn">Edit Profile</a>
            <a href="viewServices.php" class="btn">View Services</a>
            <a href="addService.php" class="btn">Add Service</a>
            <a href="logout.php" class="btn">Logout</a>
        </div>
    </div>
</body>
</html>

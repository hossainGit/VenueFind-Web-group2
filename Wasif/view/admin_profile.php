<?php
session_start();
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'Admin') {
    header("Location: ../login.php");
    exit;
}
$admin = $_SESSION['user_data'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($admin['Name']); ?>!</h1>
    <p>Email: <?php echo htmlspecialchars($admin['Email']); ?></p>
    <a href="../control/logout.php">Logout</a>
</body>
</html>

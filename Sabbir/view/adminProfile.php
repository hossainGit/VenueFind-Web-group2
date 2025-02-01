<?php
session_start();
if (!isset($_SESSION['adminID'])) {
    header("Location: adminLogin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['adminName']); ?>!</h1>
        <div class="button-box">
            <a href="viewAdminProfile.php" class="btn">View Profile</a>
            <a href="editAdminProfile.php" class="btn">Edit Profile</a>
            <a href="addAdmin.php" class="btn">Add New Admin</a>
            <a href="manageCustomers.php" class="btn">Manage Customers</a>
            <a href="manageOrganizers.php" class="btn">Manage Event Organizers</a>
            <a href="../control/AdminController.php?action=logout" class="btn">Logout</a>
        </div>
    </div>
</body>
</html>

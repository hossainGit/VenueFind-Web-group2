<?php
session_start();
require_once '../control/AdminController.php';

if (!isset($_SESSION['adminID'])) {
    header("Location: adminLogin.php");
    exit;
}

$controller = new AdminController();
$admin = $controller->viewProfile($_SESSION['adminID']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Admin Profile</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <a href="adminProfile.php" class="btn back-btn">Back to Profile</a>
        <h1>Admin Profile</h1>
        <?php if ($admin) { ?>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($admin['Name']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($admin['Email']); ?></p>
            <p><strong>Created At:</strong> <?php echo htmlspecialchars($admin['CreatedAt']); ?></p>
        <?php } else { ?>
            <p>Profile not found.</p>
        <?php } ?>
    </div>
</body>
</html>

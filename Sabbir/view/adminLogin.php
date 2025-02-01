<?php
session_start();
if (isset($_SESSION['adminID'])) {
    header("Location: adminProfile.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/validation.js" defer></script>
</head>
<body>
    <div class="container">
        <h1>Admin Login</h1>
        <?php if (isset($_SESSION['error'])) { echo "<p class='error'>" . $_SESSION['error'] . "</p>"; unset($_SESSION['error']); } ?>
        <form action="../control/AdminController.php" method="POST" id="adminLoginForm" onsubmit="return validateAdminLogin()">
            <input type="hidden" name="action" value="admin_login">
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email">
            <span id="emailError"></span>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            <span id="passwordError"></span>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>

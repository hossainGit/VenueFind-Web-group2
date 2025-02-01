<?php
session_start();
if (!isset($_SESSION['adminID'])) {
    header("Location: adminLogin.php");
    exit;
}
$adminID = $_SESSION['adminID'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Admin Profile</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/validation.js" defer></script>
</head>
<body>
    <div class="container">
        <a href="adminProfile.php" class="btn back-btn">Back to Profile</a>
        <h1>Edit Profile</h1>
        <?php if (isset($_SESSION['error'])) { echo "<p class='error'>" . $_SESSION['error'] . "</p>"; unset($_SESSION['error']); } ?>
        <?php if (isset($_SESSION['success'])) { echo "<p class='success'>" . $_SESSION['success'] . "</p>"; unset($_SESSION['success']); } ?>
        <form action="../control/AdminController.php" method="POST" id="editAdminProfileForm" onsubmit="return validateEditProfile()">
            <input type="hidden" name="action" value="edit_admin_profile">
            <input type="hidden" name="adminID" value="<?php echo $adminID; ?>">

            <label for="name">Name:</label>
            <input type="text" id="name" name="name">
            <span id="nameError"></span>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email">
            <span id="emailError"></span>

            <button type="submit">Update Profile</button>
        </form>
    </div>
</body>
</html>

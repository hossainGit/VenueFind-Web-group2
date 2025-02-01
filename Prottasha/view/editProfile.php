<?php
session_start();
if (!isset($_SESSION['organizerID'])) {
    header("Location: login.php");
    exit;
}
$organizerID = $_SESSION['organizerID'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/validation.js" defer></script>
</head>
<body>
    <div class="container">
        <a href="profile.php" class="btn back-btn">Back to Profile</a>
        <h1>Edit Profile</h1>
        <?php if (isset($_SESSION['error'])) { echo "<p class='error'>" . $_SESSION['error'] . "</p>"; unset($_SESSION['error']); } ?>
        <?php if (isset($_SESSION['success'])) { echo "<p class='success'>" . $_SESSION['success'] . "</p>"; unset($_SESSION['success']); } ?>
        <form action="../control/EventOrganizerController.php" method="POST" id="editProfileForm" onsubmit="return validation('editProfileForm')">
            <input type="hidden" name="action" value="edit_profile">
            <input type="hidden" name="organizerID" value="<?php echo $organizerID; ?>">

            <label for="name">Name:</label>
            <input type="text" id="name" name="name">
            <span id="nameError" class="error"></span>

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone">
            <span id="phoneError" class="error"></span>

            <label for="specialization">Specialization:</label>
            <input type="text" id="specialization" name="specialization">
            <span id="specializationError" class="error"></span>

            <button type="submit" class="btn">Update Profile</button>
        </form>
    </div>
</body>
</html>

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
    <title>Add Service</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/validation.js" defer></script>
</head>
<body>
    <div class="container">
        <a href="profile.php" class="btn back-btn">Back to Profile</a>
        <h1>Add New Service</h1>
        <?php if (isset($_SESSION['error'])) { echo "<p class='error'>" . $_SESSION['error'] . "</p>"; unset($_SESSION['error']); } ?>
        <?php if (isset($_SESSION['success'])) { echo "<p class='success'>" . $_SESSION['success'] . "</p>"; unset($_SESSION['success']); } ?>
        <form action="../control/EventOrganizerController.php" method="POST" id="addServiceForm" onsubmit="return validation('addServiceForm')">
            <input type="hidden" name="action" value="add_service">
            <input type="hidden" name="organizerID" value="<?php echo $organizerID; ?>">

            <label for="name">Service Name:</label>
            <input type="text" id="name" name="name">
            <span id="serviceNameError"></span>

            <label for="type">Type:</label>
            <input type="text" id="type" name="type">
            <span id="serviceTypeError"></span>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price">
            <span id="servicePriceError"></span>

            <label for="description">Description:</label>
            <textarea id="description" name="description"></textarea>
            <span id="serviceDescriptionError"></span>

            <button type="submit">Add Service</button>
        </form>
    </div>
</body>
</html>

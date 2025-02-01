<?php
session_start();

if (!isset($_SESSION['organizerID'])) {
    header("Location: login.php");
    exit;
}

require_once '../control/EventOrganizerController.php';


$controller = new EventOrganizerController();


$organizerID = $_SESSION['organizerID'];
$profile = $controller->viewProfile($organizerID);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Profile</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <a href="profile.php" class="btn back-btn">Back to Profile</a>
        <h1>Profile Details</h1>
        <?php if (!empty($profile)) { ?>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($profile['Name']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($profile['Email']); ?></p>
            <p><strong>Phone:</strong> <?php echo htmlspecialchars($profile['PhoneNumber']); ?></p>
            <p><strong>Specialization:</strong> <?php echo htmlspecialchars($profile['Specialization']); ?></p>
            <a href="editProfile.php" class="btn">Edit Profile</a>
        <?php } else { ?>
            <p>Profile not found.</p>
        <?php } ?>
    </div>
</body>
</html>

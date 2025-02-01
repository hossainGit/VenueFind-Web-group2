<?php
session_start();

// Redirect to login if not authenticated
if (!isset($_SESSION['organizerID'])) {
    header("Location: login.php");
    exit;
}

// Include the controller
require_once '../control/EventOrganizerController.php';

// Create a controller instance
$controller = new EventOrganizerController();

// Fetch services for the logged-in organizer
$organizerID = $_SESSION['organizerID'];
$services = $controller->viewServices($organizerID);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Services</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <a href="profile.php" class="btn back-btn">Back to Profile</a>
        <h1>Your Services</h1>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Price</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($services)) { ?>
                    <?php foreach ($services as $service) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($service['Name']); ?></td>
                            <td><?php echo htmlspecialchars($service['Type']); ?></td>
                            <td><?php echo htmlspecialchars($service['Price']); ?></td>
                            <td><?php echo htmlspecialchars($service['Description']); ?></td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="5">No services found.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>

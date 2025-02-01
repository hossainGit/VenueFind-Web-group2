<?php
session_start();
require_once '../control/AdminController.php';

if (!isset($_SESSION['adminID'])) {
    header("Location: adminLogin.php");
    exit;
}

$controller = new AdminController();
$organizers = $controller->getAllOrganizers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Event Organizers</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <a href="adminProfile.php" class="btn back-btn">Back to Profile</a>
        <h1>Event Organizers</h1>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Specialization</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($organizers)) { ?>
                    <?php foreach ($organizers as $organizer) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($organizer['Name']); ?></td>
                            <td><?php echo htmlspecialchars($organizer['Email']); ?></td>
                            <td><?php echo htmlspecialchars($organizer['PhoneNumber']); ?></td>
                            <td><?php echo htmlspecialchars($organizer['Specialization']); ?></td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="4">No event organizers found.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
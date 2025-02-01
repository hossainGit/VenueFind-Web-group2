<?php
session_start();
require_once '../control/AdminController.php';

if (!isset($_SESSION['adminID'])) {
    header("Location: adminLogin.php");
    exit;
}

$controller = new AdminController();
$customers = $controller->getAllCustomers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Customers</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <a href="adminProfile.php" class="btn back-btn">Back to Profile</a>
        <h1>Customer List</h1>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customers as $customer) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($customer['Name']); ?></td>
                    <td><?php echo htmlspecialchars($customer['Email']); ?></td>
                    <td><?php echo htmlspecialchars($customer['PhoneNumber']); ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>

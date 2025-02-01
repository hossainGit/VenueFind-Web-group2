<?php
session_start();
if (!isset($_SESSION['user_data'])) {
    header("Location: login.php");
    exit();
}

$customerName = $_SESSION['user_data']['Name'];
$email = $_SESSION['user_data']['Email'];
$phone = $_SESSION['user_data']['PhoneNumber'];
$address = $_SESSION['user_data']['Address'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Profile</title>
    <link rel="stylesheet" type="text/css" href="../css/viewProfile.css">
    <script src="../js/customer.js"></script>
</head>
<body>
    <header>
        <h1>Customer Profile</h1>
    </header>

    <main>
        <div class="profile-container">
            <p><strong>Name:</strong> <?php echo htmlspecialchars($customerName); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>

            <!-- Update Phone -->
            <form method="POST" action="../control/CustomerController.php" onsubmit="return validateProfile()">
                <input type="hidden" name="action" value="update_customer_info">

                <label for="phone">Phone Number:</label>
                <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
                <span id="phoneError"></span>
                <button type="submit">Update Phone</button>
            </form>

            <!-- Update Address -->
            <form method="POST" action="../control/CustomerController.php" onsubmit="return validateProfile()">
                <input type="hidden" name="action" value="update_customer_info">

                <label for="address">Address:</label>
                <textarea id="address" name="address"><?php echo htmlspecialchars($address); ?></textarea>
                <span id="addressError"></span>
                <button type="submit">Update Address</button>
            </form>

            <!-- Change Password -->
            <h2>Change Password</h2>
            <form method="POST" action="../control/CustomerController.php" onsubmit="return validatePasswordChange()">
                <input type="hidden" name="action" value="update_password">

                <label for="currentPassword">Current Password:</label>
                <input type="password" id="currentPassword" name="currentPassword">
                <span id="currentPasswordError"></span>

                <label for="newPassword">New Password:</label>
                <input type="password" id="newPassword" name="newPassword">
                <span id="newPasswordError"></span>

                <button type="submit">Change Password</button>
            </form>
        </div>
    </main>

    <footer>
        <button onclick="history.back()">Go Back</button>
        <button onclick="location.href='customer_home.php'">Profile Home</button>
    </footer>
</body>
</html>

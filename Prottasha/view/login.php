<?php
session_start();
require_once '../model/UserModel.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $error = "Email and password are required.";
    } else {
        $userModel = new UserModel();
        $organizer = $userModel->getEventOrganizerByEmail($email);

        if ($organizer && password_verify($password, $organizer['Password'])) {
            $_SESSION['organizerID'] = $organizer['OrganizerID'];
            $_SESSION['organizerName'] = $organizer['Name'];
            header("Location: profile.php");
            exit;
        } else {
            $error = "Invalid email or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
        <form action="login.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email">
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>

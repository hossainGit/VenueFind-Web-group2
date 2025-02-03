<?php
session_start();

if (isset($_SESSION['OwnerID'])) {
    header("Location: dashboard.php");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../model/owner_model.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    $owner = loginOwner($email, $password);

    if ($owner) {
        $_SESSION['OwnerID'] = $owner['OwnerID'];
        $_SESSION['Name'] = $owner['Name'];
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venue Owner Login</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Venue Owner Login</h1>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

      
        <form action="login.php" method="POST"> <!-- ..................................................................................................................... -->
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" >
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" >
            </div>
            <button type="submit" class="btn">Login</button><!-- ..................................................................................................................... -->
        </form>
    </div>
</body>
</html>
<?php
session_start();

if (!isset($_SESSION['OwnerID'])) {
    header("Location: login.php");
    exit();
}


require_once '../model/owner_model.php';


$ownerID = $_SESSION['OwnerID'];
$owner = getOwnerByID($ownerID);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];


}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Management</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script defer src="../js/validation.js" ></script>
</head>
<body>
    
    <?php include 'header.php'; ?>

    <div class="container">
        <h1>Profile Management</h1>
        

<!-- ..................................................................................................................... -->
        
        <form action="../control/update_profile_control.php" method="POST">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($owner['Name']); ?>" >
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($owner['Email']); ?>" >
            </div>
            <div class="form-group">
                <label for="phoneNumber">Phone Number:</label>
                <input type="text" id="phoneNumber" name="phoneNumber" value="<?php echo htmlspecialchars($owner['PhoneNumber']); ?>" >
            </div>
            <button type="submit" class="btn">Update Profile</button>
        </form>
    </div>
<!-- ..................................................................................................................... -->
    <?php include 'footer.php'; ?>
</body>
</html>
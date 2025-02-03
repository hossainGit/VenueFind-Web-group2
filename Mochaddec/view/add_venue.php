<?php
session_start();

if (!isset($_SESSION['OwnerID'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Venue</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script defer src="../js/validation.js" ></script>

</head>
<body>
 
    <?php include 'header.php'; ?>
<!-- ..................................................................................................................... -->
    <div class="container">
        <h1>Add New Venue</h1>
        
        <form action="../control/add_venue_control.php" method="POST">
            <div class="form-group">
                <label for="name">Venue Name:</label>
                <input type="text" id="name" name="name" >
            </div>
            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" id="location" name="location" >
            </div>
            <div class="form-group">
                <label for="capacity">Capacity:</label>
                <input type="number" id="capacity" name="capacity" >
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" step="0.01" >
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="4" ></textarea>
            </div>
            <button type="submit" class="btn btnG">Add Venue</button>
        </form>
    </div>


    <?php include 'footer.php'; ?>

</body>
</html>
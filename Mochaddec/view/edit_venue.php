<?php
session_start();

if (!isset($_SESSION['OwnerID'])) {
    header("Location: login.php");
    exit();
}


require_once '../model/owner_model.php';


if (isset($_GET['venueID'])) {
    $venueID = $_GET['venueID'];
    $venue = getVenueByID($venueID);

   
    if ($venue['OwnerID'] != $_SESSION['OwnerID']) {
        header("Location: dashboard.php");
        exit();
    }
} else {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Venue</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script defer src="../js/validation.js" ></script>
</head>
<body>

    <?php include 'header.php'; ?>

    <div class="container">     <!-- ..................................................................................................................... -->
        <h1>Edit Venue</h1>
       
        <form action="../control/edit_venue_control.php" method="POST">

         <input type="hidden" name="venueID" value="<?php echo $venue['VenueID']; ?>">
        <div class="form-group">
                <label for="name">Venue Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($venue['Name']); ?>" >
            </div>
        <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" id="location" name="location" value="<?php echo htmlspecialchars($venue['Location']); ?>" >
            </div>
         <div class="form-group">
                <label for="capacity">Capacity:</label>
                <input type="number" id="capacity" name="capacity" value="<?php echo htmlspecialchars($venue['Capacity']); ?>" >
         </div>
         <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" step="0.01" value="<?php echo htmlspecialchars($venue['Price']); ?>" >
            </div>
    <div class="form-group">
           <label for="description">Description:</label>
                <textarea id="description" name="description" rows="4" ><?php echo htmlspecialchars($venue['Description']); ?></textarea>
            </div>
<!-- avilabity button  -->
            <div class="form-group">
    <label for="availability">Availability Status:</label>
    <select id="availability" name="availability" >
        <option value="Available" <?php echo ($venue['AvailabilityStatus'] == 'Available') ? 'selected' : ''; ?>>Available</option>
        <option value="Unavailable" <?php echo ($venue['AvailabilityStatus'] == 'Unavailable') ? 'selected' : ''; ?>>Unavailable</option>
    </select>
</div>


            <button type="submit" class="btn btnG">Update Venue</button> <!-- ..................................................................................................................... -->
        </form>
    </div>

    
    <?php include 'footer.php'; ?>

</body>
</html>
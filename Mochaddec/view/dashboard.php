<?php
session_start();

if (!isset($_SESSION['OwnerID'])) {
    header("Location: login.php");
    exit();
}

require_once '../model/owner_model.php';



$ownerID = $_SESSION['OwnerID'];
$venues = getVenuesByOwner($ownerID);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venue Owner Dashboard</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body> 
    <?php include 'header.php'; ?>
<!-- ..................................................................................................................... -->
    <div class="container">

        <h1>Your Venues</h1>
        
   
        <div class="venue-list">
            <?php if (empty($venues)): ?>
                <p>No venues found. Add a new venue to get started!</p>
            <?php else: ?>
                <?php foreach ($venues as $venue): ?>
                    <div class="venue-card">
                        <h2><?php echo htmlspecialchars($venue['Name']); ?></h2>
                        <p><strong>Location:</strong> <?php echo htmlspecialchars($venue['Location']); ?></p>
                        <p><strong>Capacity:</strong> <?php echo htmlspecialchars($venue['Capacity']); ?></p>
                        <p><strong>Price:</strong> $<?php echo htmlspecialchars($venue['Price']); ?></p>
                        <p><strong>Status:</strong> <?php echo htmlspecialchars($venue['AvailabilityStatus']); ?></p>
                      
                        <a href="edit_venue.php?venueID=<?php echo $venue['VenueID']; ?>" class="btn">Edit</a>
                        <a href="../control/delete_venue_control.php?venueID=<?php echo $venue['VenueID']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this venue?');">Delete</a>
                     
                        <a href="booking_history.php?venueID=<?php echo $venue['VenueID']; ?>" class="btn btnO">View Bookings</a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <div class="venue-card addmore"><a href="add_venue.php" class="btn btn-add">Add New Venue</a></div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

</body>
</html>
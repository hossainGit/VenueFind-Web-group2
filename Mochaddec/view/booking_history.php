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


    $bookings = getBookingsByVenueID($venueID);
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
    <title>Booking History - <?php echo htmlspecialchars($venue['Name']); ?></title>
    <link rel="stylesheet" href="../css/styles.css">

</head>
<body>

    <?php include 'header.php'; ?>

    <div class="container">
        <h1>Booking History for <?php echo htmlspecialchars($venue['Name']); ?></h1>
  
        <a href="dashboard.php" class="btn">Back to Dashboard</a>

       
        <div class="booking-list">
            <?php if (empty($bookings)): ?>
                <p>No bookings found for this venue.</p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Customer</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($bookings as $booking): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($booking['Date']); ?></td>
                                <td><?php echo htmlspecialchars($booking['Time']); ?></td>
                                <td><?php echo htmlspecialchars($booking['CustomerName']); ?></td>
                                <td><?php echo htmlspecialchars($booking['Status']); ?></td>
                                <td>
                                <?php if ($booking['Status'] === 'Pending'): ?>
                                    
                                    <a href="../control/approve_booking_control.php?appointmentID=<?php echo $booking['AppointmentID']; ?>" class="btn btnG">Approve</a>
                                    <a href="../control/decline_booking_control.php?appointmentID=<?php echo $booking['AppointmentID']; ?>" class="btn btn-danger">Decline</a>
                                    
                                    <?php endif; ?>
                                    </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>


    <?php include 'footer.php'; ?>

</body>
</html>
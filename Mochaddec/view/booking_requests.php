<?php
session_start();
// Redirect to login if not logged in
if (!isset($_SESSION['OwnerID'])) {
    header("Location: login.php");
    exit();
}

// Include the database connection and model
require_once '../model/owner_model.php';

// Fetch all bookings for the logged-in venue owner
$ownerID = $_SESSION['OwnerID'];
$bookings = getAllBookingsForOwner($ownerID);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Requests</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../ajax/search_booking_requests.js" defer></script>
    <script src="../ajax/filter_booking_requests.js" defer></script>
</head>
<body>

    <?php include 'header.php'; ?>

    <div class="container">
        <h1>Booking Requests</h1>

       
        <div class="search-filter">
            <input type="text" id="searchBooking" placeholder="Search by venue name...">
            <input type="date" id="filterDate">
        </div>

        
        <table id="bookingTable">
            <thead>
                <tr>
                    <th>Venue Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Customer Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($bookings)): ?>
                    <tr>
                        <td colspan="6">No booking requests found.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($bookings as $booking): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($booking['VenueName']); ?></td>
                            <td><?php echo htmlspecialchars($booking['Date']); ?></td>
                            <td><?php echo htmlspecialchars($booking['Time']); ?></td>
                            <td><?php echo htmlspecialchars($booking['CustomerName']); ?></td>
                            <td><?php echo htmlspecialchars($booking['Status']); ?></td>
                            <td>
                                <?php if ($booking['Status'] === 'Pending'): ?>
                                    <a href="../control/approve_booking_control.php?appointmentID=<?php echo $booking['AppointmentID']; ?>" class="btn btnG" onclick="return confirm('Are you sure you want to approve this booking?');">Approve</a>
                                    <a href="../control/decline_booking_control.php?appointmentID=<?php echo $booking['AppointmentID']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to reject this booking?');">Decline</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php include 'footer.php'; ?>

</body>
</html>
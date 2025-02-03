<?php
session_start();
require_once '../model/owner_model.php';

$filterDate = $_GET['date'] ?? '';
$ownerID = $_SESSION['OwnerID'];

if (!empty($filterDate)) {
    $bookings = filterBookingsByDateForOwner($ownerID, $filterDate);
} else {
    $bookings = getAllBookingsForOwner($ownerID);
}

if (!empty($bookings)) {
    foreach ($bookings as $booking) {
        echo "<tr>
                <td>{$booking['VenueName']}</td>
                <td>{$booking['Date']}</td>
                <td>{$booking['Time']}</td>
                <td>{$booking['CustomerName']}</td>
                <td>{$booking['Status']}</td>
                <td>";
        if ($booking['Status'] === 'Pending') {
            echo "<a href='../control/approve_booking_control.php?appointmentID={$booking['AppointmentID']}' class='btn'>Approve</a>
                  <a href='../control/decline_booking_control.php?appointmentID={$booking['AppointmentID']}' class='btn btn-danger'>Decline</a>";
        }
        echo "</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='6'>No bookings found.</td></tr>";
}
?>
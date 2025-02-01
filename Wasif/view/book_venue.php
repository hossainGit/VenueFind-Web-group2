<?php
session_start();
if (!isset($_SESSION['user_data'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Venue</title>
    <link rel="stylesheet" type="text/css" href="../css/booking.css">
    <script src="../js/booking_actions.js"></script>
</head>
<body>
    <header>
        <h1>Book a Venue</h1>
    </header>

    <main>
        <h2>Venues in Wishlist</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>Venue Name</th>
                    <th>Location</th>
                    <th>Capacity</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="wishlistTable">
                <?php
                require_once "../control/BookingController.php";
                $bookingController = new BookingController();
                $venues = $bookingController->getWishlist();

                if (!empty($venues)) {
                    foreach ($venues as $venue) {
                        echo "<tr id='venueRow_{$venue['VenueID']}'>";
                        echo "<td>" . htmlspecialchars($venue['Name']) . "</td>";
                        echo "<td>" . htmlspecialchars($venue['Location']) . "</td>";
                        echo "<td>" . htmlspecialchars($venue['Capacity']) . "</td>";
                        echo "<td>$" . htmlspecialchars($venue['Price']) . "</td>";
                        echo "<td><button onclick='confirmBooking({$venue['VenueID']})'>Confirm Book</button></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No venues available in wishlist for booking.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <h3>Click <a href="appointments.php">here</a> to view your appointments.</h3>
    </main>

    <footer>
        <button onclick="history.back()">Go Back</button>
        <button onclick="location.href='customer_home.php'">Profile Home</button>
    </footer>
</body>
</html>

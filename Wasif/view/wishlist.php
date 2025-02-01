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
    <title>My Wishlist</title>
    <link rel="stylesheet" type="text/css" href="../css/wishlist.css">
    <script src="../js/wishlist_actions.js"></script>
</head>
<body>
    <header>
        <h1>My Wishlist</h1>
    </header>

    <main>
        <h2>Wishlist Venues</h2>
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
                require_once "../control/WishlistController.php";
                $wishlistController = new WishlistController();
                $venues = $wishlistController->getWishlist();

                if (!empty($venues)) {
                    foreach ($venues as $venue) {
                        echo "<tr id='venueRow_{$venue['VenueID']}'>";
                        echo "<td>" . htmlspecialchars($venue['Name']) . "</td>";
                        echo "<td>" . htmlspecialchars($venue['Location']) . "</td>";
                        echo "<td>" . htmlspecialchars($venue['Capacity']) . "</td>";
                        echo "<td>$" . htmlspecialchars($venue['Price']) . "</td>";
                        echo "<td><button onclick='removeFromWishlist({$venue['VenueID']})'>Delete</button></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No venues are added to your wishlist.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <h3>Are you ready to book?</h3>
        <p>Click <a href="book_venue.php">here</a> to proceed with venue booking.</p>
    </main>

    <footer>
        <button onclick="history.back()">Go Back</button>
        <button onclick="location.href='customer_home.php'">Profile Home</button>
    </footer>
</body>
</html>

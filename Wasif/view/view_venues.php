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
    <title>Available Venues</title>
    <link rel="stylesheet" type="text/css" href="../css/view_venues.css">
    <script src="../ajax/search_venues.js"></script>
    <script src="../js/wishlist.js"></script>
</head>
<body>

    <header>
        <h1>Search Available Venues</h1>
    </header>

    <main>
        <!-- Search Bar -->
        <input type="text" id="search" placeholder="Search venues..." onkeyup="searchData()">
        <div id="results"></div>

        <!-- Wishlist Input -->
        <h2>Add to Wishlist</h2>
        <input type="text" id="selectedVenue" placeholder="Selected venue..." readonly>
        <span id="wishlistError"></span>
        <button onclick="addToWishlist()">Add to Wishlist</button>
    </main>

    <footer>
        <button onclick="history.back()">Go Back</button>
        <button onclick="location.href='customer_home.php'">Profile Home</button>
    </footer>

</body>
</html>

<?php
class WishlistModel {
    private $conn;

    public function __construct() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "VenueFind";

        try {
            $this->conn = new mysqli($servername, $username, $password, $dbname);
            if ($this->conn->connect_error) {
                throw new Exception("Database connection failed: " . $this->conn->connect_error);
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function fetchWishlistVenues($customerID) {
        $stmt = $this->conn->prepare("SELECT Venues.VenueID, Venues.Name, Venues.Location, Venues.Capacity, Venues.Price 
                                      FROM Venues 
                                      JOIN Customers ON FIND_IN_SET(Venues.VenueID, Customers.Wishlist) 
                                      WHERE Customers.CustomerID = ?");
        $stmt->bind_param("i", $customerID);
        $stmt->execute();
        $result = $stmt->get_result();
        $venues = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $venues;
    }

    public function deleteVenueFromWishlist($customerID, $venueID) {
        // Fetch current wishlist
        $stmt = $this->conn->prepare("SELECT Wishlist FROM Customers WHERE CustomerID = ?");
        $stmt->bind_param("i", $customerID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        if (!$row) {
            return false;
        }

        $wishlist = explode(',', $row['Wishlist']);
        $wishlist = array_filter($wishlist, function ($id) use ($venueID) {
            return $id != $venueID;
        });

        $wishlistString = implode(',', $wishlist);

        $stmt = $this->conn->prepare("UPDATE Customers SET Wishlist = ? WHERE CustomerID = ?");
        $stmt->bind_param("si", $wishlistString, $customerID);
        return $stmt->execute();
    }

    public function __destruct() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
?>

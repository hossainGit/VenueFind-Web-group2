<?php
class CustomerModel {
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

    public function fetchCustomerDetails($customerID) {
        $stmt = $this->conn->prepare("SELECT Name, Email, PhoneNumber, Address FROM Customers WHERE CustomerID = ?");
        $stmt->bind_param("i", $customerID);
        $stmt->execute();
        $result = $stmt->get_result();
        $customerData = $result->fetch_assoc();
        $stmt->close();
        return $customerData;
    }

    public function updateCustomerInfo($customerID, $field, $value) {
        $stmt = $this->conn->prepare("UPDATE Customers SET $field = ? WHERE CustomerID = ?");
        $stmt->bind_param("si", $value, $customerID);
        return $stmt->execute();
    }
    
    public function updatePassword($customerID, $currentPassword, $newPassword) {
        $stmt = $this->conn->prepare("SELECT Password FROM Customers WHERE CustomerID = ?");
        $stmt->bind_param("i", $customerID);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($hashedPassword);
        $stmt->fetch();
    
        if (!password_verify($currentPassword, $hashedPassword)) {
            return false;
        }
    
        $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("UPDATE Customers SET Password = ? WHERE CustomerID = ?");
        $stmt->bind_param("si", $newHashedPassword, $customerID);
        return $stmt->execute();
    }

    public function addVenueToWishlist($customerID, $venueID) {
        // Fetch current wishlist
        $stmt = $this->conn->prepare("SELECT Wishlist FROM Customers WHERE CustomerID = ?");
        $stmt->bind_param("i", $customerID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
    
        $wishlist = $row ? explode(',', $row['Wishlist']) : [];
    
        // Check if venue already exists in the wishlist
        if (in_array($venueID, $wishlist)) {
            return false; // Venue already added
        }
    
        // Add new venue to wishlist
        $wishlist[] = $venueID;
        $wishlistString = implode(',', $wishlist);
    
        // Update wishlist in database
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

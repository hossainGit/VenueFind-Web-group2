<?php
class VenueModel {
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

    public function fetchAvailableVenues() {
        $stmt = $this->conn->prepare("SELECT VenueID, Name, Location FROM Venues WHERE AvailabilityStatus = 'Available'");
        $stmt->execute();
        $result = $stmt->get_result();
        $venues = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $venues;
    }

    public function getVenueIdByName($venueName) {
        $stmt = $this->conn->prepare("SELECT VenueID FROM Venues WHERE Name = ?");
        $stmt->bind_param("s", $venueName);
        $stmt->execute();
        $result = $stmt->get_result();
        $venue = $result->fetch_assoc();
        $stmt->close();
        return $venue ? $venue['VenueID'] : null;
    }

    public function searchVenuesByName($query) {
        $stmt = $this->conn->prepare("SELECT Name, Location FROM Venues WHERE Name LIKE CONCAT('%', ?, '%') AND AvailabilityStatus = 'Available'");
        $stmt->bind_param("s", $query);
        $stmt->execute();
        $result = $stmt->get_result();
        $venues = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $venues;
    }
    
    
    public function __destruct() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
?>

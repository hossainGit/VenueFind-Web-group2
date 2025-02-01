<?php
class AdminModel {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli("localhost", "root", "", "VenueFind");
        if ($this->conn->connect_error) {
            die("Database connection failed: " . $this->conn->connect_error);
        }
    }

    public function getAdminByEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM Admins WHERE Email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getAdminByID($adminID) {
        $stmt = $this->conn->prepare("SELECT * FROM Admins WHERE AdminID = ?");
        $stmt->bind_param("i", $adminID);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function updateAdminProfile($adminID, $name, $email) {
        $stmt = $this->conn->prepare("UPDATE Admins SET Name = ?, Email = ? WHERE AdminID = ?");
        $stmt->bind_param("ssi", $name, $email, $adminID);
        return $stmt->execute();
    }
    
    public function addAdmin($name, $email, $password) {
        $stmt = $this->conn->prepare("INSERT INTO Admins (Name, Email, Password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $password);
        return $stmt->execute();
    }

    public function fetchAllCustomers() {
        $result = $this->conn->query("SELECT CustomerID, Name, Email, PhoneNumber FROM Customers");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function fetchAllOrganizers() {
        $stmt = $this->conn->prepare("SELECT OrganizerID, Name, Email, PhoneNumber, Specialization FROM EventOrganizers");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    
    
}
?>

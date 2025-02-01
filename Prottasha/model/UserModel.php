<?php
class UserModel {
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

    // Get Event Organizer by Email
    public function getEventOrganizerByEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM EventOrganizers WHERE Email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $stmt->close();
        return $data;
    }

    // Get Event Organizer by ID
    public function getEventOrganizerByID($organizerID) {
        $stmt = $this->conn->prepare("SELECT * FROM EventOrganizers WHERE OrganizerID = ?");
        $stmt->bind_param("i", $organizerID);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $stmt->close();
        return $data;
    }

    // Update Event Organizer Profile
    public function updateEventOrganizer($organizerID, $name, $phone, $specialization) {
        $stmt = $this->conn->prepare("UPDATE EventOrganizers SET Name = ?, PhoneNumber = ?, Specialization = ? WHERE OrganizerID = ?");
        $stmt->bind_param("sssi", $name, $phone, $specialization, $organizerID);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Get Services by Organizer ID
    public function getServicesByOrganizerID($organizerID) {
        $stmt = $this->conn->prepare("SELECT * FROM Services WHERE OrganizerID = ?");
        $stmt->bind_param("i", $organizerID);
        $stmt->execute();
        $result = $stmt->get_result();
        $services = [];
        while ($row = $result->fetch_assoc()) {
            $services[] = $row;
        }
        $stmt->close();
        return $services;
    }    
    
    // Add a New Service
    public function addService($organizerID, $name, $type, $price, $description) {
        $stmt = $this->conn->prepare("INSERT INTO Services (OrganizerID, Name, Type, Price, Description) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issds", $organizerID, $name, $type, $price, $description);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Fetch service details by ID
    public function getServiceByID($serviceID) {
       global $db;
       $query = "SELECT * FROM services WHERE ServiceID = ?";
       $stmt = $db->prepare($query);
       $stmt->bind_param("i", $serviceID);
       $stmt->execute();
       $result = $stmt->get_result();
       $service = $result->fetch_assoc();
       $stmt->close();
       return $service;
    }

// Update service details
    public function updateService($serviceID, $name, $type, $price, $description) {
       global $db;
       $query = "UPDATE services SET Name = ?, Type = ?, Price = ?, Description = ? WHERE ServiceID = ?";
       $stmt = $db->prepare($query);
       $stmt->bind_param("ssdsi", $name, $type, $price, $description, $serviceID);
       $result = $stmt->execute();
       $stmt->close();
       return $result;
    }


    // Delete a Service
    public function deleteService($serviceID) {
        $stmt = $this->conn->prepare("DELETE FROM Services WHERE ServiceID = ?");
        $stmt->bind_param("i", $serviceID);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Mark Notification as Read
    public function markNotificationAsRead($notificationID) {
        $stmt = $this->conn->prepare("UPDATE Notifications SET IsRead = TRUE WHERE NotificationID = ?");
        $stmt->bind_param("i", $notificationID);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Destructor to Close Database Connection
    public function __destruct() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
?>

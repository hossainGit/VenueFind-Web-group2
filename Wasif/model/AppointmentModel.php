<?php
class AppointmentModel {
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

    public function fetchAppointments($customerID) {
        $stmt = $this->conn->prepare("SELECT Appointments.AppointmentID, Venues.Name, Appointments.Date, Appointments.Time, Appointments.Status 
                                      FROM Appointments 
                                      JOIN Venues ON Appointments.VenueID = Venues.VenueID 
                                      WHERE Appointments.CustomerID = ?");
        $stmt->bind_param("i", $customerID);
        $stmt->execute();
        $result = $stmt->get_result();
        $appointments = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $appointments;
    }

    public function deleteAppointment($appointmentID) {
        $stmt = $this->conn->prepare("DELETE FROM Appointments WHERE AppointmentID = ?");
        $stmt->bind_param("i", $appointmentID);
        return $stmt->execute();
    }

    public function __destruct() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
?>

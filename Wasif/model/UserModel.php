<?php
class UserModel {
    private $conn;

    public function __construct() {
        // Database connection
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

    /*
      Registers a customer in the Customers table.
     */
    public function registerCustomer($name, $email, $password, $phone, $address) {
        $stmt = $this->conn->prepare("INSERT INTO Customers (Name, Email, Password, PhoneNumber, Address) VALUES (?, ?, ?, ?, ?)");
        if (!$stmt) {
            return false;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("sssss", $name, $email, $hashedPassword, $phone, $address);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    /*
      Registers a venue owner in the VenueOwners table.
     */
    public function registerVenueOwner($name, $email, $password, $phone, $businessName) {
        $stmt = $this->conn->prepare("INSERT INTO VenueOwners (Name, Email, Password, PhoneNumber, BusinessName) VALUES (?, ?, ?, ?, ?)");
        if (!$stmt) {
            return false;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("sssss", $name, $email, $hashedPassword, $phone, $businessName);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    /*
      Registers an event organizer in the EventOrganizers table.
     */
    public function registerEventOrganizer($name, $email, $password, $phone, $specialization) {
        $stmt = $this->conn->prepare("INSERT INTO EventOrganizers (Name, Email, Password, PhoneNumber, Specialization) VALUES (?, ?, ?, ?, ?)");
        if (!$stmt) {
            return false;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("sssss", $name, $email, $hashedPassword, $phone, $specialization);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    /*
      Validates if an email already exists in any table (Customers, VenueOwners, or EventOrganizers).
     */
    public function emailExists($email) {
        $tables = ['Customers', 'VenueOwners', 'EventOrganizers'];
        foreach ($tables as $table) {
            $stmt = $this->conn->prepare("SELECT Email FROM $table WHERE Email = ?");
            if (!$stmt) {
                continue;
            }
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $stmt->close();
                return true;
            }
            $stmt->close();
        }
        return false;
    }

    /*
      Logs the registration event for admins to track in SecurityLogs.
     */
    public function logSecurityAction($adminID, $action) {
        $stmt = $this->conn->prepare("INSERT INTO SecurityLogs (AdminID, Action) VALUES (?, ?)");
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param("is", $adminID, $action);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
/*
  Registers an admin in the Admins table.
 */
public function registerAdmin($name, $email, $password) {
    $stmt = $this->conn->prepare("INSERT INTO Admins (Name, Email, Password) VALUES (?, ?, ?)");
    if (!$stmt) {
        return false;
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt->bind_param("sss", $name, $email, $hashedPassword);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

/*
  Checks if an email exists in the Admins table.
 */
public function emailExistsInAdmins($email) {
    $stmt = $this->conn->prepare("SELECT Email FROM Admins WHERE Email = ?");
    if (!$stmt) {
        return false;
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $exists = $stmt->num_rows > 0;
    $stmt->close();
    return $exists;
}
/*
  Get admin details by email.
 */
public function getAdminByEmail($email) {
    $stmt = $this->conn->prepare("SELECT * FROM Admins WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $stmt->close();
    return $data;
}

/*
  Get customer details by email.
 */
public function getCustomerByEmail($email) {
    $stmt = $this->conn->prepare("SELECT * FROM Customers WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $stmt->close();
    return $data;
}

/*
  Get venue owner details by email.
 */
public function getVenueOwnerByEmail($email) {
    $stmt = $this->conn->prepare("SELECT * FROM VenueOwners WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $stmt->close();
    return $data;
}

/*
  Get event organizer details by email.
 */
public function getEventOrganizerByEmail($email) {
    $stmt = $this->conn->prepare("SELECT * FROM EventOrganizers WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $stmt->close();
    return $data;
}

public function updateCustomer($customerID, $phone, $address) {
    $stmt = $this->conn->prepare("UPDATE Customers SET PhoneNumber = ?, Address = ? WHERE CustomerID = ?");
    if (!$stmt) {
        return false;
    }

    $stmt->bind_param("ssi", $phone, $address, $customerID);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}


    /*
     Closes the database connection when the object is destroyed.
     */
    public function __destruct() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
?>

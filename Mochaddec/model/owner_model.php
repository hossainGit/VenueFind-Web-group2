<?php
$conn = new mysqli("localhost", "root", "", "venuefind");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// ..................................................................................................................... venue

function getVenuesByOwner($ownerID) {
    global $conn;
    $sql = "SELECT * FROM venues WHERE OwnerID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ownerID);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}


function getVenueByID($venueID) {
    global $conn;
    $sql = "SELECT * FROM venues WHERE VenueID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $venueID);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}


function addVenue($ownerID, $name, $location, $capacity, $price, $description) {
    global $conn;
    $sql = "INSERT INTO venues (OwnerID, Name, Location, Capacity, Price, Description, AvailabilityStatus) VALUES (?, ?, ?, ?, ?, ?, 'Available')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issids", $ownerID, $name, $location, $capacity, $price, $description);
    return $stmt->execute();
}


function updateVenue($venueID, $name, $location, $capacity, $price, $description, $availability) {
    global $conn;
    $sql = "UPDATE venues SET Name = ?, Location = ?, Capacity = ?, Price = ?, Description = ?, AvailabilityStatus = ? WHERE VenueID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssidssi", $name, $location, $capacity, $price, $description, $availability, $venueID);
    return $stmt->execute();
}

// TESTINGG incorrect one
// function updateVenue($venueID, $name, $location, $capacity, $price, $description, $availability) {
//     global $conn;
//     $sql = "UPDATE venue SET Name = ?, Location = ?, Capacity = ?, Price = ?, Description = ?, `Availability Status` = ? WHERE VenueID = ?";
//     $stmt = $conn->prepare($sql);
//     $stmt->bind_param("ssidsis", $name, $location, $capacity, $price, $description, $availability, $venueID);
//     return $stmt->execute();
// }


function deleteVenue($venueID) {
    global $conn;
    $sql = "DELETE FROM venues WHERE VenueID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $venueID);
    return $stmt->execute();
}

// ..................................................................................................................... booking crud



function getBookingsByVenueID($venueID) {
    global $conn;
    $sql = "SELECT a.AppointmentID, a.Date, a.Time, c.Name AS CustomerName, a.Status 
            FROM appointments a 
            JOIN customers c ON a.CustomerID = c.CustomerID 
            WHERE a.VenueID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $venueID);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}


function approveBooking($appointmentID) {
    global $conn;
    $sql = "UPDATE appointments SET Status = 'Accepted' WHERE AppointmentID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $appointmentID);
    return $stmt->execute();
}


function declineBooking($appointmentID) {
    global $conn;
    $sql = "UPDATE appointments SET Status = 'Declined' WHERE AppointmentID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $appointmentID);
    return $stmt->execute();
}

// ..................................................................................................................... owner


function getOwnerByID($ownerID) {
    global $conn;
    $sql = "SELECT * FROM venueowners WHERE OwnerID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ownerID);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}


function updateOwnerProfile($ownerID, $name, $email, $phoneNumber) {
    global $conn;
    $sql = "UPDATE venueowners SET Name = ?, Email = ?, PhoneNumber = ? WHERE OwnerID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $email, $phoneNumber, $ownerID);
    return $stmt->execute();
}


function loginOwner($email, $password) {
    global $conn;
    $sql = "SELECT * FROM venueowners WHERE Email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $owner = $result->fetch_assoc();

    if ($owner && password_verify($password, $owner['Password'])) {
        return $owner;
    } else {
        return false;
    }
}



// ..................................................................................................................... ajax

function getAllBookings() {
    global $conn;
    $sql = "SELECT a.AppointmentID, a.Date, a.Time, c.Name AS CustomerName, a.Status 
            FROM appointments a 
            JOIN customers c ON a.CustomerID = c.CustomerID";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}



function getAllBookingsForOwner($ownerID) {
    global $conn;
    $sql = "SELECT a.AppointmentID, v.Name AS VenueName, a.Date, a.Time, c.Name AS CustomerName, a.Status 
            FROM appointments a 
            JOIN customers c ON a.CustomerID = c.CustomerID 
            JOIN venues v ON a.VenueID = v.VenueID 
            WHERE v.OwnerID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ownerID);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

// for search
function searchBookingsByVenueNameForOwner($ownerID, $searchTerm) {
    global $conn;
    $sql = "SELECT a.AppointmentID, v.Name AS VenueName, a.Date, a.Time, c.Name AS CustomerName, a.Status 
            FROM appointments a 
            JOIN customers c ON a.CustomerID = c.CustomerID 
            JOIN venues v ON a.VenueID = v.VenueID 
            WHERE v.OwnerID = ? AND v.Name LIKE ?";
    $stmt = $conn->prepare($sql);
    $searchTerm = "%$searchTerm%";
    $stmt->bind_param("is", $ownerID, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

// for Filter 
function filterBookingsByDateForOwner($ownerID, $date) {
    global $conn;
    $sql = "SELECT a.AppointmentID, v.Name AS VenueName, a.Date, a.Time, c.Name AS CustomerName, a.Status 
            FROM appointments a 
            JOIN customers c ON a.CustomerID = c.CustomerID 
            JOIN venues v ON a.VenueID = v.VenueID 
            WHERE v.OwnerID = ? AND a.Date = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $ownerID, $date);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}
?>
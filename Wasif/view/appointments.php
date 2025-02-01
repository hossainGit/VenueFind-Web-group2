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
    <title>My Appointments</title>
    <link rel="stylesheet" type="text/css" href="../css/appointments.css">
    <script src="../js/appointment_actions.js"></script>
</head>
<body>
    <header>
        <h1>My Appointments</h1>
    </header>

    <main>
        <h2>Confirmed Appointments</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>Venue Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="appointmentTable">
                <?php
                require_once "../control/AppointmentController.php";
                $appointmentController = new AppointmentController();
                $appointments = $appointmentController->getAppointments();

                if (!empty($appointments)) {
                    foreach ($appointments as $appointment) {
                        echo "<tr id='appointmentRow_{$appointment['AppointmentID']}'>";
                        echo "<td>" . htmlspecialchars($appointment['Name']) . "</td>";
                        echo "<td>" . htmlspecialchars($appointment['Date']) . "</td>";
                        echo "<td>" . htmlspecialchars($appointment['Time']) . "</td>";
                        echo "<td>" . htmlspecialchars($appointment['Status']) . "</td>";
                        echo "<td><button onclick='cancelAppointment({$appointment['AppointmentID']})'>Cancel</button></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No confirmed appointments.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </main>

    <footer>
        <button onclick="history.back()">Go Back</button>
        <button onclick="location.href='customer_home.php'">Profile Home</button>
    </footer>
</body>
</html>

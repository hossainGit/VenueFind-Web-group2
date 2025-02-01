function cancelAppointment(appointmentID) {
    if (!confirm("Are you sure you want to cancel this appointment?")) {
        return;
    }

    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../control/AppointmentController.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            alert(this.responseText);
            var row = document.getElementById("appointmentRow_" + appointmentID);
            if (row) row.remove(); // Remove row from table
        }
    };

    xhttp.send("action=cancel_appointment&appointmentID=" + appointmentID);
}

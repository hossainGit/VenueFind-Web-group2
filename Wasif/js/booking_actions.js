function confirmBooking(venueID) {
    if (!confirm("Are you sure you want to book this venue?")) {
        return;
    }

    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../control/BookingController.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            alert(this.responseText);
            var row = document.getElementById("venueRow_" + venueID);
            if (row) row.remove(); // Remove row from table
        }
    };

    xhttp.send("action=confirm_booking&venueID=" + venueID);
}

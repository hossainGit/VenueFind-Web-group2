function addToWishlist() {
    var venueName = document.getElementById("selectedVenue").value;
    
    if (!venueName) {
        document.getElementById("wishlistError").innerText = "Please select a venue before adding.";
        return;
    }
    document.getElementById("wishlistError").innerText = ""; // Clear error message

    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../control/VenueController.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText);
        }
    };

    xhttp.send("action=add_to_wishlist&venueName=" + encodeURIComponent(venueName));
}

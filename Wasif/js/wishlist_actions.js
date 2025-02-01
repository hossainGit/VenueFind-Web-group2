function removeFromWishlist(venueID) {
    if (!confirm("Are you sure you want to remove this venue from your wishlist?")) {
        return;
    }

    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../control/WishlistController.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            alert(this.responseText);
            var row = document.getElementById("venueRow_" + venueID);
            if (row) row.remove(); // Remove row from table
        }
    };

    xhttp.send("action=remove_from_wishlist&venueID=" + venueID);
}

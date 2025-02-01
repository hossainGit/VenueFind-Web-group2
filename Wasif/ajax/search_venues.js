function searchData() {
    var input = document.getElementById("search").value;
    if (input == "") {
        document.getElementById("results").innerHTML = "";
        return;
    }

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("results").innerHTML = this.responseText;
        }
    };

    xhttp.open("GET", "../control/search.php?q=" + input, true);
    xhttp.send();
}

function selectVenue(venueName) {
    document.getElementById("selectedVenue").value = venueName;
}

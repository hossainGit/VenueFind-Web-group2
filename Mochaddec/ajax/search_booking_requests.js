document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchBooking');
    const bookingTable = document.getElementById('bookingTable');

    if (searchInput && bookingTable) {
        searchInput.addEventListener('input', function () {
            const searchTerm = this.value.trim();

            if (searchTerm.length > 0) {
                fetch(`../control/search_control.php?search=${encodeURIComponent(searchTerm)}`)

                .then(response => response.text())
                .then(data => {


                        bookingTable.querySelector('tbody').innerHTML = data;
                    })
                    .catch(error => console.error('Error:', error));
              } else {

                  fetch(`../control/search_control.php`)
                    .then(response => response.text())
                    .then(data => {
                        bookingTable.querySelector('tbody').innerHTML = data;
                    })
                    .catch(error => console.error('Error:', error));
                    
            }
        });
    }
});
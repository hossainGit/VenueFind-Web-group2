document.addEventListener('DOMContentLoaded', function () {
    const filterDateInput = document.getElementById('filterDate');
    const bookingTable = document.getElementById('bookingTable');

    if (filterDateInput && bookingTable) {
        filterDateInput.addEventListener('change', function () {


const filterDate = this.value;

            if (filterDate) {

             fetch(`../control/filter_control.php?date=${encodeURIComponent(filterDate)}`)
                    .then(response => response.text())
                    .then(data => {
                        bookingTable.querySelector('tbody').innerHTML = data;
                    })
                    .catch(error => console.error('Error:', error));
            } else {

                    fetch(`../control/filter_control.php`)
                    .then(response => response.text())
                    .then(data => {
                        bookingTable.querySelector('tbody').innerHTML = data;
                    })
                    .catch(error => console.error('Error:', error));
            }
        });
    }
});
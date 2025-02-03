document.addEventListener('DOMContentLoaded', () => {
    const addVenueForm = document.querySelector('form[action="../control/add_venue_control.php"]');
    const editVenueForm = document.querySelector('form[action="../control/edit_venue_control.php"]');
    const profileForm = document.querySelector('form[action="../control/update_profile_control.php"]');

    if (addVenueForm) attachValidation(addVenueForm, validateVenueForm);
    if (editVenueForm) attachValidation(editVenueForm, validateVenueForm);
    if (profileForm) attachValidation(profileForm, validateProfileForm);
});

function attachValidation(form, validationFunction) {
    form.addEventListener('submit', (e) => {
        if (!validationFunction()) {
            e.preventDefault(); // Stop submitting
        }
    });
}

function validateVenueForm() {
    const name = document.getElementById('name').value.trim();
    const location = document.getElementById('location').value.trim();
    const capacity = document.getElementById('capacity').value.trim();
    const price = document.getElementById('price').value.trim();
    const description = document.getElementById('description').value.trim();

    if (!name) {
        alert('Name is required.');
        return false;
    }

    if (!location) {
        alert('Location is required.');
        return false;
    }

    if (!capacity || isNaN(capacity) || capacity <= 0) {
        alert('Capacity must be a positive number.');
        return false;
    }

    if (!price || isNaN(price) || price <= 0) {
        alert('Price must be a positive number.');
        return false;
    }

    if (!description) {
        alert('Description is required.');
        return false;
    }
    alert('Venue info added!');
    return true; 
    
}

function validateProfileForm() {
    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const phoneNumber = document.getElementById('phoneNumber').value.trim();

    if (!name) {
        alert('Name is required.');
        return false;
    }

    if (!email) {
        alert('Email is required.');
        return false;
    }

    if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
        alert('Invalid email address.');
        return false;
    }

    if (!phoneNumber) {
        alert('Phone number is required.');
        return false;
    }

    if (!/^\d{11}$/.test(phoneNumber)) {
        alert('Phone number must be 11 digits.');
        return false;
    }
    alert('Profile update succesful!');
    return true; 
}

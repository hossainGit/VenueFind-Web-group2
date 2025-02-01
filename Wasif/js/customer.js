// Validate Phone
function validatePhone() {
    const phone = document.getElementById("phone");
    const phoneRegex = /^(?:\+8801|01)[3-9]\d{8}$/;

    if (!phone || !phoneRegex.test(phone.value)) {
        document.getElementById("phoneError").innerText = "Enter a valid Bangladeshi phone number.";
        return false;
    }
    document.getElementById("phoneError").innerText = ""; // Clear error if valid
    return true;
}

// Validate Address
function validateAddress() {
    const address = document.getElementById("address");
    if (!address || address.value.trim() === "") {
        document.getElementById("addressError").innerText = "Address is required.";
        return false;
    }
    document.getElementById("addressError").innerText = ""; // Clear error if valid
    return true;
}

// Validate Profile Form
function validateProfile() {
    const isPhoneValid = validatePhone();
    const isAddressValid = validateAddress();

    return isPhoneValid && isAddressValid; // Form is valid if all fields are valid
}

// Validate Password Change
function validatePasswordChange() {
    const currentPassword = document.getElementById("currentPassword");
    const newPassword = document.getElementById("newPassword");

    if (!currentPassword || currentPassword.value.length < 6) {
        document.getElementById("currentPasswordError").innerText = "Current password must be at least 6 characters.";
        return false;
    }
    document.getElementById("currentPasswordError").innerText = ""; // Clear error

    if (!newPassword || newPassword.value.length < 6) {
        document.getElementById("newPasswordError").innerText = "New password must be at least 6 characters.";
        return false;
    }
    document.getElementById("newPasswordError").innerText = ""; // Clear error
    return true;
}

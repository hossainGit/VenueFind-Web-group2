// validation.js
function validateName() {
    const name = document.getElementById("name");
    const errorSpan = document.getElementById("nameError");
    if (!name || name.value.trim() === "") {
        errorSpan.innerText = "Name is required.";
        return false;
    }
    errorSpan.innerText = ""; // Clear error if valid
    return true;
}

// Validate Email
function validateEmail() {
    const email = document.getElementById("email");
    const errorSpan = document.getElementById("emailError");
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!email || !emailRegex.test(email.value)) {
        errorSpan.innerText = "Enter a valid email.";
        return false;
    }
    errorSpan.innerText = ""; // Clear error if valid
    return true;
}

// Validate Password
function validatePassword() {
    const password = document.getElementById("password");
    const errorSpan = document.getElementById("passwordError");
    if (!password || password.value.length < 6) {
        errorSpan.innerText = "Password must be at least 6 characters.";
        return false;
    }
    errorSpan.innerText = ""; // Clear error if valid
    return true;
}

// Login Form Validation
function validateAdminLogin() {
    return validateEmail() && validatePassword();
}

// Add Admin Form Validation
function validateAddAdmin() {
    return validateName() && validateEmail() && validatePassword();
}

// Edit Admin Profile Validation
function validateEditProfile() {
    return validateName() && validateEmail();
}

// Attach validation to form submission
document.addEventListener("DOMContentLoaded", () => {
    const loginForm = document.getElementById("adminLoginForm");
    if (loginForm) {
        loginForm.onsubmit = validateAdminLogin;
    }

    const addAdminForm = document.getElementById("addAdminForm");
    if (addAdminForm) {
        addAdminForm.onsubmit = validateAddAdmin;
    }

    const editProfileForm = document.getElementById("editAdminProfileForm");
    if (editProfileForm) {
        editProfileForm.onsubmit = validateEditProfile;
    }
});

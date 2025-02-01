function validateName() {
    const name = document.getElementById("name");
    if (!name || name.value.trim() === "") {
        document.getElementById("nameError").innerText = "Name is required.";
        return false;
    }
    document.getElementById("nameError").innerText = "";
    return true;
}

function validateEmail() {
    const email = document.getElementById("email");
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!email || !emailRegex.test(email.value)) {
        document.getElementById("emailError").innerText = "Enter a valid email.";
        return false;
    }
    document.getElementById("emailError").innerText = "";
    return true;
}

function validatePassword() {
    const password = document.getElementById("password");
    if (!password || password.value.length < 6) {
        document.getElementById("passwordError").innerText = "Password must be at least 6 characters.";
        return false;
    }
    document.getElementById("passwordError").innerText = "";
    return true;
}

function validatePhone() {
    const phone = document.getElementById("phone").value;
    
    // Regex for Bangladesh phone number
    const phoneRegex = /^(?:\+8801|01)[3-9]\d{8}$/;

    if (!phoneRegex.test(phone)) {
        document.getElementById("phoneError").innerText = "Enter a valid Bangladeshi phone number (e.g., +88017xxxxxxxx or 017xxxxxxxx).";
        return false;
    }

    document.getElementById("phoneError").innerText = ""; // Clear error message
    return true;
}


function validateAddress() {
    const address = document.getElementById("address");
    if (!address || address.value.trim() === "") {
        document.getElementById("addressError").innerText = "Address is required.";
        return false;
    }
    document.getElementById("addressError").innerText = "";
    return true;
}

function validateSpecialization() {
    const specialization = document.getElementById("specialization");
    if (!specialization || specialization.value.trim() === "") {
        document.getElementById("specializationError").innerText = "Specialization is required.";
        return false;
    }
    document.getElementById("specializationError").innerText = "";
    return true;
}

function validateBusinessName() {
    const businessName = document.getElementById("business_name");
    if (!businessName || businessName.value.trim() === "") {
        document.getElementById("businessNameError").innerText = "Business name is required.";
        return false;
    }
    document.getElementById("businessNameError").innerText = "";
    return true;
}

function validation(formId) {
    let isValid = true;

    if (formId === "customerForm") {
        isValid =
            validateName() &&
            validateEmail() &&
            validatePassword() &&
            validatePhone() &&
            validateAddress();
    } else if (formId === "eventOrganizerForm") {
        isValid =
            validateName() &&
            validateEmail() &&
            validatePassword() &&
            validatePhone() &&
            validateSpecialization();
    } else if (formId === "venueOwnerForm") {
        isValid =
            validateName() &&
            validateEmail() &&
            validatePassword() &&
            validatePhone() &&
            validateBusinessName();
    }

    return isValid;
}

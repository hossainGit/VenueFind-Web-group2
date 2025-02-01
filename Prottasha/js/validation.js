// Validate Name
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

// Validate Phone
function validatePhone() {
    const phone = document.getElementById("phone");
    const errorSpan = document.getElementById("phoneError");
    const phoneRegex = /^01[3-9][0-9]{8}$/; // Bangladeshi phone number pattern
    if (!phone || !phoneRegex.test(phone.value)) {
        errorSpan.innerText = "Enter a valid Bangladeshi phone number (e.g., 01712345678).";
        return false;
    }
    errorSpan.innerText = ""; // Clear error if valid
    return true;
}

// Validate Specialization
function validateSpecialization() {
    const specialization = document.getElementById("specialization");
    const errorSpan = document.getElementById("specializationError");
    if (!specialization || specialization.value.trim() === "") {
        errorSpan.innerText = "Specialization is required.";
        return false;
    }
    errorSpan.innerText = ""; // Clear error if valid
    return true;
}

// Validate Service Name
function validateServiceName() {
    const name = document.getElementById("name");
    if (!name || name.value.trim() === "") {
        document.getElementById("serviceNameError").innerText = "Service name is required.";
        return false;
    }
    document.getElementById("serviceNameError").innerText = ""; // Clear error if valid
    return true;
}

// Validate Service Type
function validateServiceType() {
    const type = document.getElementById("type");
    if (!type || type.value.trim() === "") {
        document.getElementById("serviceTypeError").innerText = "Service type is required.";
        return false;
    }
    document.getElementById("serviceTypeError").innerText = ""; // Clear error if valid
    return true;
}

// Validate Service Price
function validateServicePrice() {
    const price = document.getElementById("price");
    if (!price || isNaN(price.value) || parseFloat(price.value) <= 0) {
        document.getElementById("servicePriceError").innerText = "Enter a valid positive price.";
        return false;
    }
    document.getElementById("servicePriceError").innerText = ""; // Clear error if valid
    return true;
}

// Validate Service Description
function validateServiceDescription() {
    const description = document.getElementById("description");
    if (!description || description.value.trim() === "") {
        document.getElementById("serviceDescriptionError").innerText = "Description is required.";
        return false;
    }
    document.getElementById("serviceDescriptionError").innerText = ""; // Clear error if valid
    return true;
}

// Main Validation Function
function validation(formId) {
    if (formId === "editProfileForm") {
        return validateName() && validatePhone() && validateSpecialization();
    } else if (formId === "addServiceForm") {
        return validateServiceName() && validateServiceType() && validateServicePrice() && validateServiceDescription();
    }
    return false;
}

// Attach Validation on Form Submit
document.addEventListener("DOMContentLoaded", () => {
    const forms = ["editProfileForm", "addServiceForm"];
    forms.forEach((formId) => {
        const form = document.getElementById(formId);
        if (form) {
            form.onsubmit = () => validation(formId);
        }
    });
});

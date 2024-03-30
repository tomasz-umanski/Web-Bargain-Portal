const form = document.querySelector("form");

const passwordField = form.querySelector('input[name="password"]');
const togglePassword = form.querySelector('i[name="password_toggle"]');

const confirmPasswordField = form.querySelector('input[name="confirm_password"]');
const confirmTogglePassword = form.querySelector('i[name="confirm_password_toggle"]');

function changePasswordVisibility(passwordField, toggleIcon) {
    if (passwordField.type === "password") {
        passwordField.type = "text";
        toggleIcon.classList.remove("bi-eye-slash-fill");
        toggleIcon.classList.add("bi-eye-fill");
    } else {
        passwordField.type = "password";
        toggleIcon.classList.remove("bi-eye-fill");
        toggleIcon.classList.add("bi-eye-slash-fill");
    }
}

function togglePasswordVisibility(event) {
    const targetName = event.target.getAttribute("name");
    if (targetName === "password_toggle") {
        changePasswordVisibility(passwordField, togglePassword);
    } else if (targetName === "confirm_password_toggle") {
        changePasswordVisibility(confirmPasswordField, confirmTogglePassword);
    }
}

if (togglePassword != null) {
    togglePassword.addEventListener("click", togglePasswordVisibility);
}
if (confirmTogglePassword != null) {
    confirmTogglePassword.addEventListener("click", togglePasswordVisibility);
}

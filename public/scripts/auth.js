const form = document.querySelector("form");

const togglePassword = form.querySelector('i[name="password_toggle"]');
const confirmTogglePassword = form.querySelector('i[name="confirm_password_toggle"]');

const inputFields = {
    'password': document.getElementById('password'),
    'confirmPassword': document.getElementById('confirm_password')
};

function changePasswordVisibility(passwordField, toggleIcon) {
    const isPasswordVisible = passwordField.type === "text";
    passwordField.type = isPasswordVisible ? "password" : "text";
    toggleIcon.classList.toggle("bi-eye-slash-fill", isPasswordVisible);
    toggleIcon.classList.toggle("bi-eye-fill", !isPasswordVisible);
}

function togglePasswordVisibility(event) {
    const targetName = event.target.getAttribute("name");
    const targetField = targetName === "password_toggle" ? inputFields.password : inputFields.confirmPassword;
    const toggleIcon = targetName === "password_toggle" ? togglePassword : confirmTogglePassword;
    changePasswordVisibility(targetField, toggleIcon);
}

if (togglePassword != null) {
    togglePassword.addEventListener("click", togglePasswordVisibility);
}
if (confirmTogglePassword != null) {
    confirmTogglePassword.addEventListener("click", togglePasswordVisibility);
}

form.addEventListener('submit', e => {
    form.submit();
    var loader = document.getElementById("loader");
    loader.classList.remove("hidden");
})
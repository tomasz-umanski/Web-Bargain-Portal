const form = document.querySelector("form");

const inputFields = {
    'email': document.getElementById('email'),
    'userName': document.getElementById('username'),
    'password': document.getElementById('password'),
    'confirmPassword': document.getElementById('confirm_password')
};

const togglePassword = form.querySelector('i[name="password_toggle"]');
const confirmTogglePassword = form.querySelector('i[name="confirm_password_toggle"]');

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

const isValidEmail = email => {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

form.addEventListener('submit', e => {
    e.preventDefault();
    if (validateInputs()) {
        form.submit();
        var loader = document.getElementById("loader");
        loader.classList.remove("hidden");
    }
})

function validateInputs() {
    let isValid = true;

    for (const [fieldName, field] of Object.entries(inputFields)) {
        if (fieldName != null && field != null) {
            const fieldValue = field ? field.value.trim() : '';
            const errorDisplay = field.parentElement.querySelector('.error') || field.parentElement.parentElement.querySelector('.error');
            let errorMessage = '';
    
            switch (fieldName) {
                case 'email':
                    if (fieldValue === '') {
                        errorMessage = 'Email is required';
                    } else if (!isValidEmail(fieldValue)) {
                        errorMessage = 'Provide a valid email address';
                    }
                    break;
                case 'userName':
                    if (fieldValue === '') {
                        errorMessage = 'Username is required';
                    }
                    break;
                case 'password':
                    if (fieldValue === '') {
                        errorMessage = 'Password is required';
                    } else if (fieldValue.length < 8) {
                        errorMessage = 'Password must be at least 8 characters';
                    }
                    break;
                case 'confirmPassword':
                    const passwordValue = inputFields['password'] ? inputFields['password'].value.trim() : '';
                    if (fieldValue === '') {
                        errorMessage = 'Please confirm your password';
                    } else if (fieldValue !== passwordValue) {
                        errorMessage = "Passwords don't match";
                    }
                    break;
            }
    
            if (errorDisplay) {
                errorDisplay.innerText = errorMessage;
            }
    
            if (errorMessage !== '') {
                isValid = false;
            }
        }
    }
    return isValid;
}
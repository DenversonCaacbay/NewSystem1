    const passwordField = document.getElementById('password-field');
    const confirmPasswordField = document.getElementById('confirm-password-field');
    const passwordFeedback = document.querySelector('#password-field + .invalid-feedback');
    const confirmPasswordFeedback = document.querySelector('#confirm-password-field + .invalid-feedback');

    function validatePassword() {
        if (passwordField.value !== confirmPasswordField.value) {
            confirmPasswordField.setCustomValidity('Passwords does not match');
            passwordFeedback.style.display = 'none';
            confirmPasswordFeedback.style.display = 'block';
        } else {
            confirmPasswordField.setCustomValidity('');
            passwordFeedback.style.display = 'block';
            confirmPasswordFeedback.style.display = 'none';
        }
    }

    passwordField.addEventListener('input', validatePassword);
    confirmPasswordField.addEventListener('input', validatePassword);
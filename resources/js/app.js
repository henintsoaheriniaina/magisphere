import Alpine from "alpinejs";
import feather from "feather-icons";
import "./bootstrap";
window.Alpine = Alpine;
Alpine.start();
feather.replace({
    width: 20,
    height: 20,
});
document.addEventListener("DOMContentLoaded", function () {
    const themeToggleButton = document.getElementById("theme");
    themeToggleButton.addEventListener("click", function () {
        document.documentElement.classList.toggle("dark");
    });

    // Mdp
    var showPassword = false;
    var passwordInput = document.getElementById("password-input");
    var togglePasswordButton = document.getElementById("toggle-password");
    var passwordIcon = document.getElementById("password-icon");

    var showPasswordConfirm = false;
    var passwordConfirmationInput = document.getElementById(
        "password-confirmation-input"
    );
    var togglePasswordConfirmationButton = document.getElementById(
        "toggle-password-confirmation"
    );
    var passwordConfirmationIcon = document.getElementById(
        "password-confirmation-icon"
    );

    togglePasswordButton.addEventListener("click", function () {
        showPassword = !showPassword;
        passwordInput.type = showPassword ? "text" : "password";
        passwordIcon.setAttribute(
            "data-feather",
            showPassword ? "eye-off" : "eye"
        );
        feather.replace({ width: 20, height: 20 });
    });

    togglePasswordConfirmationButton.addEventListener("click", function () {
        showPasswordConfirm = !showPasswordConfirm;
        passwordConfirmationInput.type = showPasswordConfirm
            ? "text"
            : "password";
        passwordConfirmationIcon.setAttribute(
            "data-feather",
            showPasswordConfirm ? "eye-off" : "eye"
        );
        feather.replace({ width: 20, height: 20 }); // Update feather icons
    });

    // Apply error class based on server validation
    var errors = {}; // Assume you have this object from server validation

    var passwordField = document.getElementById("password-field");
    if (errors.password) {
        passwordField.classList.add("border-vintageRed-default");
    } else {
        passwordField.classList.add("border-gray-300");
    }

    var passwordConfirmationField = document.getElementById(
        "password-confirmation-field"
    );
    if (errors.password_confirmation) {
        passwordConfirmationField.classList.add("border-vintageRed-default");
    } else {
        passwordConfirmationField.classList.add("border-gray-300");
    }
});

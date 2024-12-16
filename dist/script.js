import showAlert from "./softAlert.js";
const registerForm = document.getElementById("registerForm");
if (registerForm) {
    registerForm.addEventListener("submit", function (event) {
        event.preventDefault();
        const formData = new FormData(this);
        const name = formData.get("registerName");
        const email = formData.get("registerMail");
        const password = formData.get("registerPass");
        const nameRegex = /^[A-Za-z\s]+$/;
        const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
        if (!nameRegex.test(name)) {
            showAlert("Name must only contain letters and spaces");
            return;
        }
        if (!emailRegex.test(email)) {
            showAlert("Please enter a valid email address");
            return;
        }
        if (!passwordRegex.test(password)) {
            showAlert("Password must be at least 8 characters long and contain both letters and numbers");
            return;
        }
        // axios
        //   .post("index.php?action=register", formData)
        //   .then(function (response) {
        //     console.log(response.data);
        //     alert("Registration successful");
        //     window.location.href = "index.php";
        //   })
        //   .catch(function (error) {
        //     console.error("Error:", error);
        //     alert("There was an error during registration");
        //   });
    });
}

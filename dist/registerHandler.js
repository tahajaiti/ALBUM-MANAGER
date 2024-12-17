var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
import showAlert from "./softAlert.js";
const registerForm = document.getElementById("registerForm");
const nameRegex = /^[A-Za-z\s]+$/;
const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
const passwordRegex = /^.{8,}$/;
if (registerForm) {
    registerForm.addEventListener("submit", function (event) {
        return __awaiter(this, void 0, void 0, function* () {
            event.preventDefault();
            const formData = new FormData(this);
            const name = formData.get("registerName");
            const email = formData.get("registerMail");
            const password = formData.get("registerPass");
            const token = formData.get("token");
            let Valid = true;
            if (!nameRegex.test(name)) {
                showAlert("Name must only contain letters and spaces");
                Valid = false;
                return;
            }
            if (!emailRegex.test(email)) {
                showAlert("Please enter a valid email address");
                Valid = false;
                return;
            }
            if (!passwordRegex.test(password)) {
                showAlert("Password must be at least 8 characters long");
                Valid = false;
                return;
            }
            if (Valid) {
                const dataVar = {
                    registerName: name,
                    registerMail: email,
                    registerPass: password,
                    token: token,
                };
                try {
                    const response = yield fetch("index.php?action=register", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify(dataVar),
                    });
                    const data = yield response.json();
                    if (data.status) {
                        window.location.href = "index.php";
                    }
                    else {
                        console.error(data.message);
                        showAlert(data.message || "Registration failed");
                    }
                }
                catch (err) {
                    console.error("error:", err);
                    showAlert("An error occurred, please try again.");
                }
            }
        });
    });
}

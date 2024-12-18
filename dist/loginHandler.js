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
const loginForm = document.getElementById("loginForm");
if (loginForm) {
    loginForm.addEventListener("submit", function (e) {
        return __awaiter(this, void 0, void 0, function* () {
            e.preventDefault();
            const formData = new FormData(this);
            const email = formData.get("loginMail");
            const pass = formData.get("loginPass");
            const token = formData.get("token");
            if (!email || !pass) {
                console.log(email);
                showAlert("Please fill both inputs for email and password");
                return;
            }
            try {
                const response = yield fetch("index.php?action=login", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({
                        loginMail: email,
                        loginPass: pass,
                        token: token,
                    }),
                });
                const data = yield response.json();
                if (data.status) {
                    if (data.redirect) {
                        window.location.href = data.redirect;
                    }
                    else {
                        window.location.href = 'index.php';
                    }
                }
                else {
                    showAlert(data.message);
                }
            }
            catch (err) {
                console.error(err);
                showAlert("An error happened, try again");
            }
        });
    });
}

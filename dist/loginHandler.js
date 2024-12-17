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
const loginForm = document.getElementById('loginForm');
if (loginForm) {
    loginForm.addEventListener('submit', function (e) {
        return __awaiter(this, void 0, void 0, function* () {
            e.preventDefault();
            const formData = new FormData(this);
            const email = formData.get('loginMail');
            const pass = formData.get('loginPass');
            const token = formData.get('token');
            if (!email || !pass) {
                console.log(email);
                showAlert('Please fill both inputs for email and password');
                return;
            }
            try {
                const response = yield axios.post('index.php?action=login', {
                    loginMail: email,
                    loginPass: pass,
                    token: token,
                });
                if (response.data.success) {
                    showAlert('Login sucessful');
                    window.location.href = 'index.php';
                }
                else {
                    showAlert(response.data.message);
                }
            }
            catch (err) {
                console.error(err);
                showAlert('An error happened, try again');
            }
        });
    });
}

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
const form = document.getElementById("uploadForm");
form.addEventListener("submit", (e) => __awaiter(void 0, void 0, void 0, function* () {
    e.preventDefault();
    const formData = new FormData(form);
    try {
        const response = yield fetch("./model/upload_album.php", {
            method: "POST",
            body: formData,
        });
        const result = yield response.json();
        if (result.status) {
            showAlert(result.message);
            if (result.redirect) {
                window.location.href = result.redirect;
            }
        }
        else {
            showAlert(result.message);
        }
    }
    catch (err) {
        console.error(err);
        showAlert("Failed to upload album");
    }
}));

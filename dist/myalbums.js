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
document.addEventListener("DOMContentLoaded", () => {
    const deleteButtons = document.querySelectorAll("#deleteAlbum");
    deleteButtons.forEach((button) => {
        button.addEventListener("click", (e) => __awaiter(void 0, void 0, void 0, function* () {
            var _a;
            const albumId = button.getAttribute("data-id");
            if (!albumId) {
                showAlert("Album ID is missing.");
                return;
            }
            try {
                const response = yield fetch("./model/delete_album.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({ album_id: albumId }),
                });
                const result = yield response.json();
                if (result.status) {
                    showAlert(result.message);
                    (_a = button.closest(".bg-gray-800")) === null || _a === void 0 ? void 0 : _a.remove();
                    if (result.redirect) {
                        window.location.href = 'index.php?view=myalbums';
                    }
                }
                else {
                    showAlert(result.message);
                }
            }
            catch (err) {
                console.error(err);
                showAlert("An error occured while deleting the album");
            }
        }));
    });
});

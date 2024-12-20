var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
import fetchData from "./fetch.js";
document.addEventListener("DOMContentLoaded", () => {
    const buyBtn = document.querySelectorAll(".buyBtn");
    buyBtn.forEach((btn) => {
        const id = btn.previousElementSibling;
        if (id) {
            btn.addEventListener("click", () => __awaiter(void 0, void 0, void 0, function* () {
                const album = yield getAlbum(Number(id.value));
                if (album) {
                }
            }));
        }
    });
});
const getAlbum = (id) => __awaiter(void 0, void 0, void 0, function* () {
    const data = yield fetchData("./model/get_album.php");
    let album = null;
    data.forEach(a => {
        if (a.id === id) {
            album = a;
        }
    });
    return album;
});

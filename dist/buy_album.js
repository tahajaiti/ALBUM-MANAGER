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
import fetchData from "./fetch.js";
document.addEventListener("DOMContentLoaded", () => {
    const buyBtn = document.querySelectorAll(".buyBtn");
    buyBtn.forEach((btn) => {
        const id = btn.previousElementSibling;
        if (id) {
            btn.addEventListener("click", () => __awaiter(void 0, void 0, void 0, function* () {
                const album = yield getAlbum(Number(id.value));
                if (album) {
                    const popUp = document.createElement("div");
                    popUp.classList.add("popUp");
                    popUp.innerHTML = `<div  class="bg-gray-800 bg-opacity-70 backdrop-blur-md rounded-xl shadow-2xl p-8 max-w-md w-full scale-95">
                                            <h2 class="text-2xl font-bold text-primary-400 mb-4">Confirm Purchase</h2>
                                            <p class="text-gray-300 mb-6">Are you sure you want to buy this album?</p>
                                            <div class="flex justify-between items-center mb-4">
                                                <div>
                                                    <h3 class="text-xl font-semibold text-primary-300">${album.title}</h3>
                                                    <p class="text-gray-400">by ${album.artist_name}</p>
                                                </div>
                                                <span class="text-2xl font-bold text-primary-400">$${album.price}</span>
                                            </div>
                                            <div class="flex space-x-4">
                                                <button id="confirmPurchase" class="btn_red flex-1">Confirm</button>
                                                <button id="cancelPurchase" class="btn_black flex-1">Cancel</button>
                                            </div>
                                        </div>`;
                    const confirmPurchase = popUp.querySelector("#confirmPurchase");
                    const cancelPurchase = popUp.querySelector("#cancelPurchase");
                    confirmPurchase.addEventListener("click", () => {
                        showAlert("Album purchased successfully!");
                        popUp.remove();
                    });
                    cancelPurchase.addEventListener("click", () => {
                        popUp.remove();
                    });
                    document.body.appendChild(popUp);
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

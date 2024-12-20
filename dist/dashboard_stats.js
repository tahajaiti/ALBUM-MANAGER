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
import showAlert from "./softAlert.js";
const inputs = {
    new_users: document.getElementById('new_users'),
    total_users: document.getElementById('total_users'),
    active_users: document.getElementById('active_users'),
    archived_users: document.getElementById('archived_users'),
};
const albumInputs = {
    new_albums: document.getElementById('new_albums'),
    total_albums: document.getElementById('total_albums'),
    active_albums: document.getElementById('active_albums'),
    archived_albums: document.getElementById('archived_albums'),
};
document.addEventListener('DOMContentLoaded', () => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const data = yield fetchData('./model/users_stats.php');
        const albumData = yield fetchData('./model/album_stats.php');
        if (data) {
            Object.keys(inputs).forEach((key) => {
                if (data[key]) {
                    inputs[key].textContent = data[key];
                }
                else {
                    inputs[key].textContent = '0';
                }
            });
        }
        if (albumData) {
            Object.keys(albumInputs).forEach((key) => {
                if (albumData[key]) {
                    albumInputs[key].textContent = albumData[key];
                }
                else {
                    albumInputs[key].textContent = '0';
                }
            });
        }
        ;
    }
    catch (error) {
        console.error("Error fetching user stats", error);
        showAlert("Failed to fetch user statistics");
    }
}));

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
const container = document.getElementById('myAlbumsContainer');
const fetchAlbums = () => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const data = yield fetchData('./model/myalbums_fetch.php');
        if (container) {
            container.innerHTML = '';
            if (!data || data.length === 0) {
                container.innerHTML = '<p class="text-2xl">No existing albums.</p>';
                return;
            }
            data.forEach(album => {
                const newDiv = document.createElement('div');
                newDiv.className =
                    'bg-gray-800 bg-opacity-50 backdrop-blur-lg rounded-lg shadow-xl overflow-hidden transition duration-300 ease-in-out transform hover:-translate-y-1';
                newDiv.innerHTML = `
                    <img src="${album.cover_image}" alt="Album Cover" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-primary-400 mb-2">${album.title}</h3>
                        <p class="text-gray-300 mb-4">${album.description}</p>
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-sm text-gray-400">Genres:  ${album.genres}</span>
                            <span class="text-lg font-bold text-primary-300">$${album.price}</span>
                        </div>
                        <div class="flex space-x-2">
                            <button class="btn_black w-full" aria-label="Edit Album">Edit</button>
                            <button id="deleteAlbum" class="btn_red w-full" aria-label="Delete Album">Delete</button>
                        </div>
                    </div>
                `;
                const deleteBtn = newDiv.querySelector('#deleteAlbum');
                deleteBtn.addEventListener('click', () => {
                    console.log(album.id);
                });
                container.appendChild(newDiv);
            });
        }
    }
    catch (error) {
        console.error('Error fetching albums:', error);
        showAlert('Failed to fetch albums. Please try again later.');
    }
});
document.addEventListener('DOMContentLoaded', fetchAlbums);

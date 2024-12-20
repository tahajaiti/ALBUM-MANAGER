import fetchData from "./fetch.js";
import showAlert from "./softAlert.js";

interface Album {
    id: number;
    artist_id: number;
    title: string;
    description: string;
    price: string;
    cover_image: string;
    genres: string[];
    archived: boolean;
}

const container = document.getElementById("myAlbumsContainer") as HTMLDivElement;
const editForm = document.getElementById("editContainer") as HTMLDivElement;
const form = document.getElementById("editForm") as HTMLFormElement;

const fetchAlbums = async () => {
    try {
        const data: Album[] = await fetchData("./model/myalbums_fetch.php");

        if (container) {
            container.innerHTML = "";

            if (!data || data.length === 0) {
                container.innerHTML = '<p class="text-2xl">No existing albums.</p>';
                return;
            }

            data.forEach((album) => {
                const newDiv = document.createElement("div");
                newDiv.className =
                    "bg-gray-800 bg-opacity-50 backdrop-blur-lg rounded-lg shadow-xl overflow-hidden transition duration-300 ease-in-out transform hover:-translate-y-1";
                newDiv.innerHTML = `
                    <img src="${album.cover_image}" alt="Album Cover" class="w-full h-[20rem] object-fit">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-primary-400 mb-2">${album.title}</h3>
                        <p class="text-gray-300 mb-4">${album.description}</p>
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-sm text-gray-400">Genres:  ${album.genres}</span>
                            <span class="text-lg font-bold text-primary-300">$${album.price}</span>
                        </div>
                        <div class="flex space-x-2">
                            <button id="editAlbum" class="btn_black w-full" aria-label="Edit Album">Edit</button>
                            <button id="deleteAlbum" class="btn_red w-full" aria-label="Delete Album">Delete</button>
                        </div>
                    </div>
                `;

                const deleteBtn = newDiv.querySelector("#deleteAlbum") as HTMLButtonElement;
                const editBtn = newDiv.querySelector("#editAlbum") as HTMLButtonElement;

                deleteBtn.addEventListener("click", () => {
                    deleteAlbum(album.id);
                });

                editBtn.addEventListener("click", () => {
                    openEdit(album);
                });

                container.appendChild(newDiv);
            });
        }
    } catch (error) {
        console.error("Error fetching albums:", error);
        showAlert("Failed to fetch albums. Please try again later.");
    }
};

const deleteAlbum = async (id: number) => {
    const response = await fetch("./model/delete_album.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ album_id: id }),
    });

    const result = await response.json();

    if (response.ok && result.success) {
        showAlert(result.message);
        fetchAlbums();
    } else {
        showAlert(result.error || "An error happened.");
    }
};

const openEdit = (album: Album) => {
    const closeBtn = editForm.querySelector("#closeEdit") as HTMLButtonElement;

    if (editForm && closeBtn) {
        editForm.classList.remove("hidden");

        closeBtn.addEventListener("click", () => {
            editForm.classList.add("hidden");
        });

        const inputs = form.querySelectorAll("input, textarea") as NodeListOf<HTMLInputElement | HTMLTextAreaElement>;

        inputs.forEach((input) => {
            if (input instanceof HTMLInputElement) {
                switch (input.name) {
                    case "editId":
                        input.value = String(album.id);
                        break;
                    case "editTitle":
                        input.value = album.title;
                        break;
                    case "editPrice":
                        input.value = album.price;
                        break;
                }
            } else if (input instanceof HTMLTextAreaElement) {
                input.value = album.description;
            }
        });
    }
};

document.addEventListener("DOMContentLoaded", fetchAlbums);

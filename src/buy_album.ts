import showAlert from "./softAlert.js";
import fetchData from "./fetch.js";

interface Album {
    id: number;
    artist_id: number;
    title: string;
    description: string;
    price: string;
    cover_image: string;
    genres: string[];
    archived: boolean;
    artist_name: string;
}

interface response {
    status: boolean;
    message: string;
}

document.addEventListener("DOMContentLoaded", () => {
    const buyBtn = document.querySelectorAll(".buyBtn") as NodeListOf<HTMLButtonElement>;

    buyBtn.forEach((btn) => {
        const id = btn.previousElementSibling as HTMLInputElement;
        if (id) {
            btn.addEventListener("click", async () => {
                const album = await getAlbum(Number(id.value));
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
                                        </div>`

                    const confirmPurchase = popUp.querySelector("#confirmPurchase") as HTMLButtonElement;
                    const cancelPurchase = popUp.querySelector("#cancelPurchase") as HTMLButtonElement;

                    confirmPurchase.addEventListener("click", () => {
                        buyAlbum(album.id, Number(album.price));
                        popUp.remove();
                    });

                    cancelPurchase.addEventListener("click", () => {
                        popUp.remove();
                    });
                    
                    document.body.appendChild(popUp);

                }



            });
        }
    });
});

const getAlbum = async (id: number): Promise<Album | null> => {
    const data: Album[] = await fetchData("./model/get_album.php");

    let album = null;

    data.forEach(a => {
        if (a.id === id) {
            album = a;
        }
    });

    return album;
};

const buyAlbum = async (id: number, price: number): Promise<void> => {
    const response = await fetch("./model/buy_album.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ id, price })
    });

    const result: response = await response.json();

    if (result.status && response.ok) {
        showAlert("Album purchased successfully!");
    } else {
        showAlert("Failed to purchase album. Please try again later.");
    }
}
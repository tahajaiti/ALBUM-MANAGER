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
}

document.addEventListener("DOMContentLoaded", () => {
    const buyBtn = document.querySelectorAll(".buyBtn") as NodeListOf<HTMLButtonElement>;

    buyBtn.forEach((btn) => {
        const id = btn.previousElementSibling as HTMLInputElement;
        if (id) {
            btn.addEventListener("click", async () => {
                const album = await getAlbum(Number(id.value));
                
                if (album) {
                    console.log(album);
                }
                    
                
            });
        }
    });
});

const getAlbum = async (id: number) => {
    const data: Album[] = await fetchData("./model/get_album.php");
    
    let album = null;

    data.forEach(a => {
        if (a.id === id) {
            album = a
        }
    });

    return album;
};
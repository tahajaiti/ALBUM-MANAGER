import showAlert from "./softAlert.js";

interface response {
    status: boolean;
    message: string;
    redirect: string;
}

document.addEventListener("DOMContentLoaded", () => {
    const deleteButtons = document.querySelectorAll<HTMLButtonElement>("#deleteAlbum");

    deleteButtons.forEach((button) => {
        button.addEventListener("click", async (e: MouseEvent) => {
            const albumId = button.getAttribute("data-id");

            if (!albumId) {
                showAlert("Album ID is missing.");
                return;
            }

            try {
                const response = await fetch("./model/delete_album.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({ album_id: albumId }),
                });

                const result: response = await response.json();

                if (result.status) {
                    showAlert(result.message);
                    button.closest(".bg-gray-800")?.remove();
                    if (result.redirect){
                        window.location.href = 'index.php?view=myalbums';
                    }
                } else {
                    showAlert(result.message);
                }
            } catch (err) {
                console.error(err);
                showAlert("An error occured while deleting the album");
            }
        });
    });
});

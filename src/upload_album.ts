import showAlert from "./softAlert.js";

interface Response {
    status: boolean;
    message: string;
    redirect?: string;
}

const form = document.getElementById("uploadForm") as HTMLFormElement;

document.addEventListener("DOMContentLoaded", () => {
    if (form) {
        form.addEventListener("submit", async (e) => {
            e.preventDefault();

            const formData = new FormData(form);
            const selectedGenres = formData.getAll('genres[]');
            const image = formData.get('file-upload') as File;

            if (selectedGenres.length > 3) {
                showAlert("You can only select up to 3 genres.");
                return;
            }

            const type = image.type;

            if (type !== 'image/jpeg' && type !== 'image/png' && type !== 'image/webp') {
                showAlert("Please upload a valid image file (JPG, PNG, or GIF).");
                return; 
            }
            

            try {
                const response = await fetch("./model/upload_album.php", {
                    method: "POST",
                    body: formData,
                });

                const result: Response = await response.json();

                if (result.status) {
                    e.preventDefault();
                    showAlert(result.message);

                    if (result.redirect) {
                        window.location.href = result.redirect;
                    }
                } else {
                    showAlert(result.message);
                }
            } catch (err) {
                e.preventDefault();
                console.error(err);
                showAlert("Failed to upload album");
            }
        });
    }
});

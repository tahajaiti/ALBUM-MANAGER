import showAlert from "./softAlert.js";

interface Response {
    status: boolean;
    message: string;
    redirect?: string;
}

const form = document.getElementById("uploadForm") as HTMLFormElement;

form.addEventListener("submit", async (e) => {
    e.preventDefault();

    const formData = new FormData(form);

    
    try {
        const response = await fetch("./model/upload_album.php", {
            method: "POST",
            body: formData,
        });

        const result: Response = await response.json();

        if (result.status) {
            showAlert(result.message);

            if (result.redirect) {
                window.location.href = result.redirect;
            }

        } else {
            showAlert(result.message);
        }
    } catch (err) {
        console.error(err);
        showAlert("Failed to upload album");
    }
});

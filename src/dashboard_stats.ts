import fetchData from "./fetch.js";
import showAlert from "./softAlert.js";

const inputs = {
    new_users: document.getElementById('new_users') as HTMLParagraphElement,
    total_users: document.getElementById('total_users') as HTMLParagraphElement,
    active_users: document.getElementById('active_users') as HTMLParagraphElement,
    archived_users: document.getElementById('archived_users') as HTMLParagraphElement,
};

const albumInputs = {
    new_albums: document.getElementById('new_albums') as HTMLParagraphElement,
    total_albums: document.getElementById('total_albums') as HTMLParagraphElement,
    active_albums: document.getElementById('active_albums') as HTMLParagraphElement,
    archived_albums: document.getElementById('archived_albums') as HTMLParagraphElement,
};

document.addEventListener('DOMContentLoaded', async () => {
    try {
        const data = await fetchData('./model/users_stats.php');
        const albumData = await fetchData('./model/album_stats.php');
        

        if (data) {
            (Object.keys(inputs) as Array<keyof typeof inputs>).forEach((key) => {
                if (data[key as keyof typeof data]) {
                    inputs[key].textContent = data[key as keyof typeof data];
                } else {
                    inputs[key].textContent = '0';
                }
            });
        }

        if (albumData) {
            (Object.keys(albumInputs) as Array<keyof typeof albumInputs>).forEach((key) => {
                if (albumData[key as keyof typeof data]) {
                    albumInputs[key].textContent = albumData[key as keyof typeof data];
                } else {
                    albumInputs[key].textContent = '0';
                }
            });
        };

    } catch (error) {
        console.error("Error fetching user stats", error);
        showAlert("Failed to fetch user statistics");
    }
});

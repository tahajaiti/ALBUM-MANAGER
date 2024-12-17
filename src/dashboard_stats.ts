import fetchData from "./fetch.js";
import showAlert from "./softAlert.js";

const inputs = {
    new_users: document.getElementById('new_users') as HTMLParagraphElement,
    total_users: document.getElementById('total_users') as HTMLParagraphElement,
    active_users: document.getElementById('active_users') as HTMLParagraphElement,
    archived_users: document.getElementById('archived_users') as HTMLParagraphElement,
};

document.addEventListener('DOMContentLoaded', async () => {
    try {
        const data = await fetchData('./model/users_stats.php');

        if (data) {
            (Object.keys(inputs) as Array<keyof typeof inputs>).forEach((key) => {
                if (data[key as keyof typeof data]) {
                    inputs[key].textContent = data[key as keyof typeof data];
                } else {
                    inputs[key].textContent = '0';
                }
            });
        }

    } catch (error) {
        console.error("Error fetching user stats", error);
        showAlert("Failed to fetch user statistics");
    }
});

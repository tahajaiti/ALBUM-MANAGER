import showAlert from "./softAlert.js";

interface stats {
    new_users: number,
    total_users: number,
    active_users: number,
    archived_users: number,
}

const fetchData = async (location: string) => {
    try {
        const response = await fetch(location);
        const data: stats = await response.json();

        if (response.ok) {
            return data;
        }

    } catch(err) {
        console.error('Error', err);
        showAlert('Error fetching dashboard stats');
    }
}

export default fetchData;
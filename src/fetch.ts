import showAlert from "./softAlert.js";


const fetchData = async (url: string) => {
    try {
        const response = await fetch(url);
        const data: unknown = await response.json();

        if (response.ok) {
            return data;
        }

    } catch(err) {
        console.error('Error', err);
        showAlert('Error fetching dashboard stats');
        return null;
    }
}

export default fetchData;
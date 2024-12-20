import showAlert from "./softAlert.js";


const fetchData = async<T> (url: string): Promise<T> => {
    try {
        const response = await fetch(url);
        const data: T = await response.json();

        if (response.ok) {
            return data;
        } else {
            throw new Error('failed to fetch data');
        }

    } catch(err) {
        console.error('Error', err);
        showAlert('Error fetching dashboard stats');
        throw err;
    }
}

export default fetchData;


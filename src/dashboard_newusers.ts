import fetchData from "./fetch.js";
import showAlert from "./softAlert.js";

interface User {
    id: number,
    role_id: number,
    name: string,
    email: string,
    password: string,
    slug: string,
    is_accepted: boolean,
    is_archived: boolean,
    updated_at: Date,
    updated_by: number,
    created_at: Date,
    created_by: number,
}

const container = document.getElementById('tableBody') as HTMLTableSectionElement;


const fetchNewUser = async () => {
    const data: User[] = await fetchData('./model/newusers_fetch.php');

    if (container && data) {
        container.innerHTML = '';

        if (data.length === 0) {
            container.innerHTML = '<p class="text-center">No pending users.</p>';   
        }

        data.forEach(user => {
            const newRow = document.createElement('tr');
            newRow.className = 'border-b border-gray-700';

            newRow.innerHTML = `
                                    <td class="px-6 py-4">${user.id}</td>
                                    <td class="px-6 py-4">${user.name}</td>
                                    <td class="px-6 py-4">${user.email}</td>
                                    <td class="px-6 py-4">${user.created_at}</td>
                                    <td class="px-6 py-4">
                                        <button data-id=${user.id} id="approveBtn" class="bg-green-600 text-white px-3 py-1 rounded mr-2 hover:bg-green-700">Approve</button>
                                    </td>
                             `  
            container.appendChild(newRow);

        });

        const approveBtns = document.querySelectorAll('#approveBtn') as NodeListOf<HTMLButtonElement>;

        approveBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                const userId = (e.target as HTMLButtonElement).dataset.id;

                if (userId){
                    console.log(userId);
                }
            });
        });
        
    }

};

fetchNewUser();
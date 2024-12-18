import fetchData from "./fetch.js";
import showAlert from "./softAlert.js";

interface User {
    id: number,
    role_id: number,
    role: string,
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

const fetchArchived = async () => {
    const data: User[] = await fetchData('./model/archivedusers_fetch.php');

    if (container && data) {
        container.innerHTML = '';

        if (data.length === 0){
            container.innerHTML = '<p class="text-center">No archived users.</p>'; 
        }

        data.forEach(user => {
            const newRow = document.createElement('tr');
            newRow.className = 'border-b border-gray-700';

            newRow.innerHTML = `
                                    <td class="px-6 py-4">${user.id}</td>
                                    <td class="px-6 py-4">${user.name}</td>
                                    <td class="px-6 py-4">${user.email}</td>
                                    <td class="px-6 py-4">${user.updated_at}</td>
                                    <td class="px-6 py-4">
                                        <button data-id=${user.id} id="restoreBtn" class="bg-orange-600 text-white px-3 py-1 rounded mr-2 hover:bg-orange-700">Restore</button>
                                    </td>
                             `  
            container.appendChild(newRow);
            
        });

        const restoreBtns = document.querySelectorAll('#restoreBtn') as NodeListOf<HTMLButtonElement>;

        restoreBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                const userId = (e.target as HTMLButtonElement).dataset.id;

                if (userId){
                    restoreUser(Number(userId));
                }
            });
        });
    }
};

const restoreUser = async (id: number) => {
    const response = await fetch('./model/restore_user.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ user_id: id }),
    });

    const result = await response.json();

    if (response.ok && result.success){
        showAlert(result.message);
        fetchArchived();
    } else {
        showAlert(result.error || 'An error happened.');
    }
};

fetchArchived();
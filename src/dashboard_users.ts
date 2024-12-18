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
const editForm = document.getElementById('editUserForm') as HTMLDivElement;
const form = document.getElementById('editForm') as HTMLFormElement;

const fetchUsers = async () => {
    const data: User[] = await fetchData('./model/existing_users.php');

    if (container && data) {
        container.innerHTML = '';

        if (data.length === 0) {
            container.innerHTML = '<p class="text-center">No existing users.</p>';   
        }

        data.forEach(user => {
            const newRow = document.createElement('tr');
            newRow.className = 'border-b border-gray-700';

            newRow.innerHTML = `
                                    <td class="px-6 py-4">${user.id}</td>
                                    <td class="px-6 py-4">${user.name}</td>
                                    <td class="px-6 py-4">${user.email}</td>
                                    <td class="px-6 py-4">${user.created_at}</td>
                                    <td class="px-6 py-4">${user.updated_at}</td>
                                    <td class="px-6 py-4">${user.updated_by ?? 'No one'}</td>
                                    <td class="px-6 py-4">${user.role}</td>
                                    <td class="px-6 py-4">
                                        <button data-id=${user.id} id="editBtn" class="bg-blue-600 text-white px-3 py-1 rounded mr-2 hover:bg-blue-700">Edit</button>
                                        <button data-id=${user.id} id="deleteBtn" class="bg-red-600 text-white px-3 py-1 rounded mr-2 hover:bg-red-700">Delete</button>
                                    </td>
                             `  
            container.appendChild(newRow);

            const editBtn = newRow.querySelector('#editBtn') as HTMLButtonElement;

            editBtn.addEventListener('click', (e) => {
                openEdit(user);
            });

        });

        const deleteBtns = document.querySelectorAll('#deleteBtn') as NodeListOf<HTMLButtonElement>;

        deleteBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                const userId = (e.target as HTMLButtonElement).dataset.id;

                if (userId){
                    deleteUser(Number(userId));
                }
            });
        });
        
    }
};

const openEdit = (user: User) => {
    const closeBtn = editForm.querySelector('#closeEdit') as HTMLButtonElement;

    if (editForm && closeBtn) {
        editForm.classList.remove('hidden');
        
        closeBtn.addEventListener('click', () => {
            const inputs = editForm.querySelectorAll('input, select') as NodeListOf<HTMLInputElement | HTMLSelectElement>;

            inputs.forEach(input => {
                if (input instanceof HTMLInputElement) {
                    input.value = "";
                } else if (input instanceof HTMLSelectElement) {
                    input.value = user.role;
                }
            })

            editForm.classList.add('hidden');
        });

        const inputs = editForm.querySelectorAll('input, select') as NodeListOf<HTMLInputElement | HTMLSelectElement>;

        inputs.forEach(input => {
            if (input instanceof HTMLInputElement) {
                switch (input.name) {
                    case 'editName':
                        input.value = user.name;
                        break;
                    case 'editEmail':
                        input.value = user.email;
                        break;
                    default:
                        break;
                }
            } else if (input instanceof HTMLSelectElement) {
                    input.value = user.role;
            }
        });
    }
};

const nameRegex = /^[A-Za-z\s]+$/;
const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

form.addEventListener('submit' , async function (e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const name = formData.get('editName');
    const email = formData.get('editEmail');
    const role = formData.get('editRole');
    const id = formData.get('editId');

    let Valid: boolean = true;
    
});

const editUser = async (id: number) => {
    // const response = await fetch('./model/accept_user.php', {
    //     method: 'POST',
    //     headers: { 'Content-Type': 'application/json' },
    //     body: JSON.stringify({ user_id: id }),
    // });

    // const result = await response.json();

    // if (response.ok && result.success){
    //     showAlert(result.message);
    //     fetchUsers();
    // } else {
    //     showAlert(result.error || 'An error happened.');
    // }
};

const deleteUser = async (id: number) => {
    const response = await fetch('./model/delete_user.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ user_id: id }),
    });

    const result = await response.json();

    if (response.ok && result.success){
        showAlert(result.message);
        fetchUsers();
    } else {
        showAlert(result.error || 'An error happened.');
    }

};

fetchUsers();
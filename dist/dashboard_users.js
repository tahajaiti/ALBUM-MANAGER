var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
import fetchData from "./fetch.js";
import showAlert from "./softAlert.js";
const container = document.getElementById('tableBody');
const fetchUsers = () => __awaiter(void 0, void 0, void 0, function* () {
    const data = yield fetchData('./model/existing_users.php');
    if (container && data) {
        container.innerHTML = '';
        if (data.length === 0) {
            container.innerHTML = '<p class="text-center">No existing users.</p>';
        }
        data.forEach(user => {
            var _a;
            const newRow = document.createElement('tr');
            newRow.className = 'border-b border-gray-700';
            newRow.innerHTML = `
                                    <td class="px-6 py-4">${user.id}</td>
                                    <td class="px-6 py-4">${user.name}</td>
                                    <td class="px-6 py-4">${user.email}</td>
                                    <td class="px-6 py-4">${user.created_at}</td>
                                    <td class="px-6 py-4">${user.updated_at}</td>
                                    <td class="px-6 py-4">${(_a = user.updated_by) !== null && _a !== void 0 ? _a : 'No one'}</td>
                                    <td class="px-6 py-4">${user.role}</td>
                                    <td class="px-6 py-4">
                                        <button data-id=${user.id} id="editBtn" class="bg-blue-600 text-white px-3 py-1 rounded mr-2 hover:bg-blue-700">Edit</button>
                                        <button data-id=${user.id} id="deleteBtn" class="bg-red-600 text-white px-3 py-1 rounded mr-2 hover:bg-red-700">Delete</button>
                                    </td>
                             `;
            container.appendChild(newRow);
        });
        const editBtns = document.querySelectorAll('#editBtn');
        const deleteBtns = document.querySelectorAll('#deleteBtn');
        editBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                const userId = e.target.dataset.id;
                if (userId) {
                    editUser(Number(userId));
                }
            });
        });
        deleteBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                const userId = e.target.dataset.id;
                if (userId) {
                    deleteUser(Number(userId));
                }
            });
        });
    }
});
const editUser = (id) => __awaiter(void 0, void 0, void 0, function* () {
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
});
const deleteUser = (id) => __awaiter(void 0, void 0, void 0, function* () {
    const response = yield fetch('./model/delete_user.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ user_id: id }),
    });
    const result = yield response.json();
    if (response.ok && result.success) {
        showAlert(result.message);
        fetchUsers();
    }
    else {
        showAlert(result.error || 'An error happened.');
    }
});
fetchUsers();

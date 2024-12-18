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
const fetchArchived = () => __awaiter(void 0, void 0, void 0, function* () {
    const data = yield fetchData('./model/archivedusers_fetch.php');
    if (container && data) {
        container.innerHTML = '';
        if (data.length === 0) {
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
                             `;
            container.appendChild(newRow);
        });
        const restoreBtns = document.querySelectorAll('#restoreBtn');
        restoreBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                const userId = e.target.dataset.id;
                if (userId) {
                    restoreUser(Number(userId));
                }
            });
        });
    }
});
const restoreUser = (id) => __awaiter(void 0, void 0, void 0, function* () {
    const response = yield fetch('./model/restore_user.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ user_id: id }),
    });
    const result = yield response.json();
    if (response.ok && result.success) {
        showAlert(result.message);
        fetchArchived();
    }
    else {
        showAlert(result.error || 'An error happened.');
    }
});
fetchArchived();

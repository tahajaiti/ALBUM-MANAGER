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
const fetchHistory = () => __awaiter(void 0, void 0, void 0, function* () {
    const data = yield fetchData("./model/buy_history.php");
    return data;
});
const table = document.getElementById("tableBody");
document.addEventListener("DOMContentLoaded", () => __awaiter(void 0, void 0, void 0, function* () {
    if (table) {
        const history = yield fetchHistory();
        history.forEach(purchase => {
            const newRow = document.createElement("tr");
            newRow.className = "border-b border-gray-700";
            newRow.innerHTML = `
                            <td class="px-6 py-4"><img class="h-32" src="${purchase.cover}" alt="${purchase.title}"></td>
                            <td class="px-6 py-4">${purchase.title}</td>
                            <td class="px-6 py-4">${purchase.pdate}</td>
                            <td class="px-6 py-4">${purchase.price}</td>
            `;
            table.appendChild(newRow);
        });
    }
}));

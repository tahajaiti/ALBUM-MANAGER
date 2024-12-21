import fetchData from "./fetch.js";

interface Purchase {
    uid: number,
    aid: number,
    pdate: string,
    title: string,
    cover: string,
    price: number,
}

const fetchHistory = async (): Promise<Purchase[]> => {
    const data = await fetchData("./model/buy_history.php");
    return data as Purchase[];
};

const table = document.getElementById("tableBody") as HTMLTableSectionElement;

document.addEventListener("DOMContentLoaded", async () => {
    if (table) {
        const history = await fetchHistory();
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
});
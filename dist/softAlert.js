const container = document.getElementById("msgContainer");
const content = document.getElementById("msgContent");
const closeMsg = document.getElementById("closeMsg");
export default function showAlert(msg) {
    if (container && content && closeMsg && msg) {
        container.classList.remove("hidden");
        content.textContent = msg;
        setTimeout(() => {
            container.classList.add("hidden");
        }, 5000);
        closeMsg.addEventListener("click", () => {
            container.classList.add("hidden");
        });
    }
}

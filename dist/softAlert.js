const container = document.getElementById("msgContainer");
const content = document.getElementById("msgContent");
const closeMsg = document.getElementById("closeMsg");
export default function showAlert(msg) {
    if (container && content && closeMsg && msg) {
        container.classList.add("flex");
        container.classList.remove("hidden");
        content.textContent = msg;
        closeMsg.addEventListener("click", () => {
            container.classList.remove("flex");
            container.classList.add("hidden");
        });
    }
}

const container = document.getElementById("msgContainer") as HTMLDivElement;
const content = document.getElementById("msgContent") as HTMLParagraphElement;
const closeMsg = document.getElementById("closeMsg") as HTMLButtonElement;

export default function showAlert(msg: string): void {
  if (container && content && closeMsg && msg) {
    container.classList.remove("hidden");
    content.textContent = msg;

    setTimeout(() => {
      container.classList.add("hidden");      
    },3500)

    closeMsg.addEventListener("click", () => {
      container.classList.add("hidden");
    });
  }
}

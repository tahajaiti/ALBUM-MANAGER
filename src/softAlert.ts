const container = document.getElementById("msgContainer") as HTMLDivElement;
const content = document.getElementById("msgContent") as HTMLParagraphElement;
const closeMsg = document.getElementById("closeMsg") as HTMLButtonElement;

export default function showAlert(msg: string): void {
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

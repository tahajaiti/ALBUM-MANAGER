import showAlert from "./softAlert.js";

interface RegisterResponse {
  success: boolean;
  message: string;
}

const registerForm = document.getElementById("registerForm") as HTMLFormElement;

const nameRegex = /^[A-Za-z\s]+$/;
const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
const passwordRegex = /^^.{8}$/;

if (registerForm) {
  registerForm.addEventListener("submit", async function (event) {
    event.preventDefault();

    const formData = new FormData(this);
    const name = formData.get("registerName") as string;
    const email = formData.get("registerMail") as string;
    const password = formData.get("registerPass") as string;
    const token = formData.get("token");

    let Valid: boolean = true;

    if (!nameRegex.test(name)) {
      showAlert("Name must only contain letters and spaces");
      Valid = false;
      return;
    }

    if (!emailRegex.test(email)) {
      showAlert("Please enter a valid email address");
      Valid = false;
      return;
    }

    if (!passwordRegex.test(password)) {
      showAlert("Password must be at least 8 characters long");
      Valid = false;
      return;
    }

    if (Valid) {

      const dataVar = {
        registerName: name,
        registerMail: email,
        registerPass: password,
        token: token,
      };

      try {
        const response = await axios.post<RegisterResponse>("index.php?action=register", dataVar);

        if (response.data.success) {
          showAlert(response.data.message);
        } else {
            showAlert(response.data.message);
        }
      } catch (err) {
        console.error("error:", err);
      }
    }
  });
}

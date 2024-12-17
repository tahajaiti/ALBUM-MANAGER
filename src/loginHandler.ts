import showAlert from "./softAlert.js";

interface response {
  status: boolean;
  message: string;
}

const loginForm = document.getElementById("loginForm") as HTMLFormElement;

if (loginForm) {
  loginForm.addEventListener("submit", async function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    const email = formData.get("loginMail") as string;
    const pass = formData.get("loginPass") as string;
    const token = formData.get("token") as string;

    if (!email || !pass) {
      console.log(email);

      showAlert("Please fill both inputs for email and password");
      return;
    }

    try {
      const response = await fetch("index.php?action=login", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          loginMail: email,
          loginPass: pass,
          token: token,
        }),
      });

      const data: response = await response.json();

      if (data.status) {
        showAlert("Login successful");
        window.location.href = "index.php";
      } else {
        showAlert(data.message);
      }
    } catch (err) {
      console.error(err);
      showAlert("An error happened, try again");
    }
  });
}

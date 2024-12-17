import showAlert from "./softAlert.js";

interface response {
    success: boolean;
    message: string;
  }

const loginForm = document.getElementById('loginForm') as HTMLFormElement;

if (loginForm) {
    loginForm.addEventListener('submit', async function (e) {
        e.preventDefault();

        const formData = new FormData(this);
        const email = formData.get('loginMail') as string;
        const pass = formData.get('loginPass') as string;
        const token = formData.get('token') as string;

        if (!email || !pass) {
            console.log(email);
            
            showAlert('Please fill both inputs for email and password');
            return;
        }

        try {
            const response = await axios.post<response>(
                'index.php?action=login',
                {
                    loginMail: email,
                    loginPass: pass,
                    token: token,
                }
            );

            if (response.data.success) {
                showAlert('Login sucessful');
                window.location.href = 'index.php'
            } else {
                showAlert(response.data.message);
            }

        } catch (err) {
            console.error(err);
            showAlert('An error happened, try again');
        }

    });
}
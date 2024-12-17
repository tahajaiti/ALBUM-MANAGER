<?php
    if (isset($_SESSION['user_id'])) {
        header("Location: index.php");
        exit();
    }
?>

<section class="w-screen h-screen bg-transparent flex justify-center items-center">
    <div class="flex flex-col justify-center items-center bg-gray-900 p-8 rounded-sm shadow-lg w-full max-w-md">
        <h2 class="text-3xl font-bold mb-6 text-white text-center">Log in</h2>
        <form id="loginForm" class="space-y-4" method="POST" action="./index.php?action=login">
            <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
            <div>
                <label for="loginMail" class="block text-sm font-medium text-gray-300">Email</label>
                <input
                    type="email"
                    id="loginMail"
                    name="loginMail"
                    required
                    class="input-field"
                    placeholder="john@example.com" />
            </div>
            <div>
                <label for="loginPass" class="block text-sm font-medium text-gray-300">Password</label>
                <input
                    type="password"
                    id="loginPass"
                    name="loginPass"
                    required
                    class="input-field"
                    placeholder="••••••••" />
            </div>
            <button
                type="submit"
                class="sub_btn">
                Log In
            </button>
        </form>
        <div class="mt-4 text-center">
            <a href="?view=forgotPass.php" class="text-sm text-red-400 hover:text-red-300">
                Forgot password?
            </a>
        </div>
    </div>
</section>
<section class="flex justify-center items-center min-h-screen bg-blue-300">
    <div class="w-full max-w-sm bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-3xl font-semibold text-gray-800 text-center mb-4">Log in</h2>
        <p class="text-sm text-gray-600 text-center mb-8">Log in to continue</p>
        <form id="loginForm" class="space-y-4" method="POST" action="./index.php?action=login">
            <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
            <input class="input-field " placeholder="Enter your email" type="email" name="loginMail" required>
            <input class="input-field " placeholder="Enter your password" type="password" name="loginPass" required>

            <button type="submit" class="w-full btn">Log in</button>
        </form>

        <a href="?view=forgotPass.php" class="text-sm text-teal-400 hover:text-teal-300 transition duration-200">Forgot Password?</a>
    </div>
</section>
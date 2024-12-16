<section class="flex justify-center items-center min-h-screen bg-dark_purple-200">
    <div class="w-full max-w-sm bg-rich_black-700 p-8 rounded-lg shadow-lg">
        <h2 class="text-3xl font-semibold text-white text-center mb-4">Sign up</h2>
        <p class="text-sm text-dark_purple-100 text-center mb-8">Sign up to continue</p>
        <form class="space-y-4" method="POST" action="register.php">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>"> <input class="input-field" placeholder="Enter your name" type="text" name="registerName" required>
            <input class="input-field" placeholder="Enter your email" type="email" name="registerMail" required>
            <input class="input-field" placeholder="Enter your password" type="password" name="registerPass" required>

            <button type="submit" class="w-full bg-dark_purple-500 py-2 rounded-sm text-white">Sign up</button>
        </form>

        <a href="#" class="text-sm text-dark_purple-400 hover:text-dark_purple-300">Login?</a>
    </div>
</section>
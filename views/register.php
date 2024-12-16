

<section class="flex justify-center items-center min-h-screen bg-blue-300">
    <div class="w-full max-w-sm bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-3xl font-semibold text-gray-800 text-center mb-4">Sign up</h2>
        <p class="text-sm text-gray-600 text-center mb-8">Sign up to continue</p>
        <form id="registerForm" class="space-y-4" method="POST" action="./index.php?action=register">
            <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>"> 
            <input class="input-field " placeholder="Enter your name" type="text" name="registerName" required>
            <input class="input-field " placeholder="Enter your email" type="email" name="registerMail" required>
            <input class="input-field " placeholder="Enter your password" type="password" name="registerPass" required>

            <button type="submit" class="w-full btn">Sign up</button>
        </form>

        <a href="#" class="text-sm text-teal-400 hover:text-teal-300 transition duration-200">Login?</a>
    </div>
</section>

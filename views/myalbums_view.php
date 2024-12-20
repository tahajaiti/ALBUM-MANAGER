<?php

if (!isset($_SESSION['user_id']) && $_SESSION['role'] === 3) {
    header("Location: index.php?view=register");
    exit();
}
?>





<main class="container mx-auto px-4 py-12">
    <h2 class="text-3xl font-bold text-primary-400 mb-8">My Albums</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        <div class="bg-gray-800 bg-opacity-50 backdrop-blur-lg rounded-lg shadow-xl overflow-hidden transition duration-300 ease-in-out transform hover:-translate-y-1">
            <img src="" alt="Album Cover" class="w-full h-64 object-cover">
            <div class="p-6">
                <h3 class="text-xl font-semibold text-primary-400 mb-2"></h3>
                <p class="text-gray-300 mb-4"></p>
                <div class="flex justify-between items-center mb-4">
                    <span class="text-sm text-gray-400">Genres:</span>
                    <span class="text-lg font-bold text-primary-300">$</span>
                </div>
                <div class="flex space-x-2">
                    <button class="btn_black w-full">Edit</button>
                    <button class="deleteAlbum btn_red w-full">Delete</button>
                </div>
            </div>
        </div>
    </div>
</main>

<script type="module" src="./dist/myalbums.js"></script>
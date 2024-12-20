<?php

if (!isset($_SESSION['user_id']) && $_SESSION['role'] === 3) {
    header("Location: index.php?view=register");
    exit();
}
?>



<main class="container mx-auto px-4 py-12">
    <h2 class="text-3xl font-bold text-primary-400 mb-8">My Albums</h2>
    <div id="myAlbumsContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

    </div>
</main>

<script type="module" src="./dist/myalbums.js"></script>
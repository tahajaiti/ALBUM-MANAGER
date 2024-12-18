<?php
$isLoggedIn = isset($_SESSION['user_id']);
?>

<main class="h-[90%] flex justify-center items-center">
    <!-- Home Section -->
    <section id="home" class="mb-16">
        <div class="text-center">
            <h2 class="text-4xl font-bold mb-4 text-primary-500">Welcome to MEZIKKA</h2>
            <p class="text-xl mb-8">Discover and purchase your favorite albums</p>
            <a href="index.php?view=<?php echo $isLoggedIn ? 'library' : 'register'; ?>" class="btn_red">
                Browse library
            </a>
        </div>
    </section>
</main>

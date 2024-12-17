<header class="bg-black text-white shadow-md">
    <div class="container mx-auto px-4 py-3 flex items-center justify-between">
        <div class="flex items-center">
            <a href="index.php" class="text-2xl font-bold text-red-500 hover:text-red-400 transition-colors">
                MEZIKKA
            </a>
        </div>
        <nav>
            <ul class="flex space-x-4">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li>
                        <a
                            href="index.php?view=dashboard"
                            class="btn_red mr-5">
                            DASHBOARD
                        </a>
                        <a
                            href="index.php?action=logout"
                            class="btn_black">
                            Log out
                        </a>
                    </li>
                <?php else: ?>
                    <li>
                        <a
                            href="index.php?view=register"
                            class="btn_red">
                            Sign up
                        </a>
                    </li>
                    <li>
                        <a
                            href="index.php?view=login"
                            class="btn_black">
                            Log in
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>
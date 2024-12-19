<header class="bg-gradient-to-b from-black to-transparent text-white shadow-md absolute top-0 w-full">
    <div class="container mx-auto px-4 py-3 flex items-center justify-between">
        <div class="flex items-center">
            <a href="index.php" class="text-2xl font-bold text-red-500 hover:text-red-400 transition-colors">
                MEZIKKA
            </a>
        </div>
        <ul class="flex space-x-4">
            <li><a
                    class="text-xl hover:text-red-500 transition-all"
                    href="index.php?view=library">LIBRARY</a></li>
            <li><a
                    class="text-xl hover:text-red-500 transition-all"
                    href="index.php?view=about">ABOUT</a></li>
        </ul>
        <nav class="flex justify-between">
            <ul class="flex space-x-4">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li>
                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 2 || $_SESSION['role'] === 1):  ?>
                            <a
                                href="index.php?view=upload_album"
                                class="btn_red mr-5">
                                UPLOAD
                            </a>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 1):  ?>
                            <a
                                href="index.php?view=dashboard"
                                class="btn_red mr-5">
                                DASHBOARD
                            </a>
                        <?php endif; ?>
                        <a
                            href="index.php?action=logout"
                            class="btn_black">
                            LOG OUT
                        </a>
                    </li>
                <?php else: ?>
                    <li>
                        <a
                            href="index.php?view=register"
                            class="btn_red">
                            SIGN UP
                        </a>
                    </li>
                    <li>
                        <a
                            href="index.php?view=login"
                            class="btn_black">
                            LOG IN
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>
<?php
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 1) {
    header("Location: index.php");
    exit();
}
?>

<div class="flex h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800">
        <div class="p-4">
            <h1 class="text-2xl font-bold text-primary-500">Admin Panel</h1>
        </div>
        <nav class="mt-8">
            <a href="index.php?view=dashboard" class="block py-2 px-4 text-gray-400 hover:bg-gray-700 hover:text-white">Dashboard</a>
            <a href="index.php?view=dashboard_newusers" class="block py-2 px-4 text-gray-400 hover:bg-gray-700 hover:text-white">New Users</a>
            <a href="index.php?view=dashboard_user-management" class="block py-2 px-4 text-gray-400 hover:bg-gray-700 hover:text-white">User Management</a>
            <a href="index.php?view=dashboard_archive" class="block py-2 px-4 text-gray-400 hover:bg-gray-700 hover:text-white">Archived Users</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8 overflow-y-auto">
        <!-- Dashboard Section -->
        <section id="dashboard" class="mb-12">
            <h2 class="text-3xl font-bold mb-6">Dashboard Overview</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-gray-800 p-6 rounded-lg">
                    <h3 class="text-xl font-semibold mb-2">New Users Today</h3>
                    <p id="new_users" class="text-4xl font-bold text-primary-500">24</p>
                </div>
                <div class="bg-gray-800 p-6 rounded-lg">
                    <h3 class="text-xl font-semibold mb-2">Total Users</h3>
                    <p id="total_users" class="text-4xl font-bold text-primary-500">1,234</p>
                </div>
                <div class="bg-gray-800 p-6 rounded-lg">
                    <h3 class="text-xl font-semibold mb-2">Active Users</h3>
                    <p id="active_users" class="text-4xl font-bold text-primary-500">987</p>
                </div>
                <div class="bg-gray-800 p-6 rounded-lg">
                    <h3 class="text-xl font-semibold mb-2">Archived Users</h3>
                    <p id="archived_users" class="text-4xl font-bold text-primary-500">47</p>
                </div>
            </div>
        </section>

    </main>
</div>


<script type="module" src="./dist/dashboard_stats.js"></script>
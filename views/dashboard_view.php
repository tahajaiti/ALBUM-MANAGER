<?php
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 1) {
    header("Location: index.php");
    exit();
}
?>

<div class="flex h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800/50 backdrop-blur-lg">
        <div class="p-4">
            <h1 class="text-2xl font-bold text-red-500">Admin Panel</h1>
        </div>
        <nav class="mt-8">
            <a href="index.php?view=dashboard" class="dashSide">Dashboard</a>
            <a href="index.php?view=dashboard_newusers" class="dashSide">New Users</a>
            <a href="index.php?view=dashboard_user-management" class="dashSide">User Management</a>
            <a href="index.php?view=dashboard_archive" class="dashSide">Archived Users</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8 overflow-y-auto">
        <!-- Dashboard Section -->
        <section id="dashboard" class="mb-12 space-y-10">
            <h2 class="text-3xl font-bold mb-6">Dashboard Overview</h2>
            <h3 class="text-xl font-bold mb-6">Users Statistics</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-gray-800/50 backdrop-blur-lg p-6 rounded-lg">
                    <h3 class="text-xl font-semibold mb-2">New Users Today</h3>
                    <p id="new_users" class="text-4xl font-bold text-red-500">24</p>
                </div>
                <div class="bg-gray-800/50 backdrop-blur-lg p-6 rounded-lg">
                    <h3 class="text-xl font-semibold mb-2">Total Users</h3>
                    <p id="total_users" class="text-4xl font-bold text-red-500">1,234</p>
                </div>
                <div class="bg-gray-800/50 backdrop-blur-lg p-6 rounded-lg">
                    <h3 class="text-xl font-semibold mb-2">Active Users</h3>
                    <p id="active_users" class="text-4xl font-bold text-red-500">987</p>
                </div>
                <div class="bg-gray-800/50 backdrop-blur-lg p-6 rounded-lg">
                    <h3 class="text-xl font-semibold mb-2">Archived Users</h3>
                    <p id="archived_users" class="text-4xl font-bold text-red-500">47</p>
                </div>
            </div>
            <h3 class="text-xl font-bold mb-6">Albums Statistics</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-gray-800/50 backdrop-blur-lg p-6 rounded-lg">
                    <h3 class="text-xl font-semibold mb-2">New Albums Today</h3>
                    <p id="new_albums" class="text-4xl font-bold text-red-500">24</p>
                </div>
                <div class="bg-gray-800/50 backdrop-blur-lg p-6 rounded-lg">
                    <h3 class="text-xl font-semibold mb-2">Total Albums</h3>
                    <p id="total_albums" class="text-4xl font-bold text-red-500">1,234</p>
                </div>
                <div class="bg-gray-800/50 backdrop-blur-lg p-6 rounded-lg">
                    <h3 class="text-xl font-semibold mb-2">Active Albums</h3>
                    <p id="active_albums" class="text-4xl font-bold text-red-500">987</p>
                </div>
                <div class="bg-gray-800/50 backdrop-blur-lg p-6 rounded-lg">
                    <h3 class="text-xl font-semibold mb-2">Archived Albums</h3>
                    <p id="archived_albums" class="text-4xl font-bold text-red-500">47</p>
                </div>
            </div>
        </section>

    </main>
</div>


<script type="module" src="./dist/dashboard_stats.js"></script>
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
        <!-- New Users Section -->
        <section id="new-users" class="mb-12">
            <h2 class="text-3xl font-bold mb-6">New User Approval</h2>
            <div class="bg-gray-800 rounded-lg overflow-hidden">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-700">
                            <th class="px-6 py-3 text-left">ID</th>
                            <th class="px-6 py-3 text-left">Name</th>
                            <th class="px-6 py-3 text-left">Email</th>
                            <th class="px-6 py-3 text-left">Registration Date</th>
                            <th class="px-6 py-3 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
        </section>

    </main>
</div>

<script type="module" src="./dist/dashboard_newusers.js"></script>
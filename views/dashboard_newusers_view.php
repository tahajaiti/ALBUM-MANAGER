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
            <h1 class="text-2xl font-bold text-primary-500">Admin Panel</h1>
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
        <!-- New Users Section -->
        <section id="new-users" class="mb-12">
            <h2 class="text-3xl font-bold mb-6">New User Approval</h2>
            <div class="bg-gray-800/50 backdrop-blur-lg rounded-lg overflow-hidden">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-700/50 backdrop-blur-xl">
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
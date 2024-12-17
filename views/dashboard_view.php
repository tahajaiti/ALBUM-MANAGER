<?php
    if (isset($_SESSION['user_id']) && $_SESSION['role'] !== 1) {
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
            <a href="#dashboard" class="block py-2 px-4 text-gray-400 hover:bg-gray-700 hover:text-white">Dashboard</a>
            <a href="#new-users" class="block py-2 px-4 text-gray-400 hover:bg-gray-700 hover:text-white">New Users</a>
            <a href="#user-management" class="block py-2 px-4 text-gray-400 hover:bg-gray-700 hover:text-white">User Management</a>
            <a href="#archived-users" class="block py-2 px-4 text-gray-400 hover:bg-gray-700 hover:text-white">Archived Users</a>
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

        <!-- New Users Section -->
        <section id="new-users" class="mb-12">
            <h2 class="text-3xl font-bold mb-6">New User Approval</h2>
            <div class="bg-gray-800 rounded-lg overflow-hidden">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-700">
                            <th class="px-6 py-3 text-left">Name</th>
                            <th class="px-6 py-3 text-left">Email</th>
                            <th class="px-6 py-3 text-left">Registration Date</th>
                            <th class="px-6 py-3 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-700">
                            <td class="px-6 py-4">John Doe</td>
                            <td class="px-6 py-4">john@example.com</td>
                            <td class="px-6 py-4">2023-05-15</td>
                            <td class="px-6 py-4">
                                <button class="bg-green-600 text-white px-3 py-1 rounded mr-2 hover:bg-green-700">Approve</button>
                                <button class="bg-primary-600 text-white px-3 py-1 rounded hover:bg-primary-700">Reject</button>
                            </td>
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
        </section>

        <!-- User Management Section -->
        <section id="user-management" class="mb-12">
            <h2 class="text-3xl font-bold mb-6">User Management</h2>
            <div class="bg-gray-800 rounded-lg overflow-hidden">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-700">
                            <th class="px-6 py-3 text-left">Name</th>
                            <th class="px-6 py-3 text-left">Email</th>
                            <th class="px-6 py-3 text-left">Role</th>
                            <th class="px-6 py-3 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-700">
                            <td class="px-6 py-4">Jane Smith</td>
                            <td class="px-6 py-4">jane@example.com</td>
                            <td class="px-6 py-4">User</td>
                            <td class="px-6 py-4">
                                <button class="bg-blue-600 text-white px-3 py-1 rounded mr-2 hover:bg-blue-700">Edit</button>
                                <button class="bg-primary-600 text-white px-3 py-1 rounded hover:bg-primary-700">Delete</button>
                            </td>
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Archived Users Section -->
        <section id="archived-users">
            <h2 class="text-3xl font-bold mb-6">Archived Users</h2>
            <div class="bg-gray-800 rounded-lg overflow-hidden">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-700">
                            <th class="px-6 py-3 text-left">Name</th>
                            <th class="px-6 py-3 text-left">Email</th>
                            <th class="px-6 py-3 text-left">Archived Date</th>
                            <th class="px-6 py-3 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-700">
                            <td class="px-6 py-4">Alice Johnson</td>
                            <td class="px-6 py-4">alice@example.com</td>
                            <td class="px-6 py-4">2023-05-10</td>
                            <td class="px-6 py-4">
                                <button class="bg-yellow-600 text-white px-3 py-1 rounded hover:bg-yellow-700">Restore</button>
                            </td>
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</div>


<script type="module" src="./dist/dashboard_stats.js"></script>
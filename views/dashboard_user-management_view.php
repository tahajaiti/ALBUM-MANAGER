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

        <!-- User Management Section -->
        <section id="user-management" class="mb-12">
            <h2 class="text-3xl font-bold mb-6">User Management</h2>
            <div class="bg-gray-800 rounded-lg overflow-hidden">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-700">
                            <th class="px-6 py-3 text-left">ID</th>
                            <th class="px-6 py-3 text-left">Name</th>
                            <th class="px-6 py-3 text-left">Email</th>
                            <th class="px-6 py-3 text-left">Created At</th>
                            <th class="px-6 py-3 text-left">Updated At</th>
                            <th class="px-6 py-3 text-left">Updated By</th>
                            <th class="px-6 py-3 text-left">Role</th>
                            <th class="px-6 py-3 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <tr class="border-b border-gray-700">
                            <td class="px-6 py-4">ID</td>
                            <td class="px-6 py-4">Jane Smith</td>
                            <td class="px-6 py-4">jane@example.com</td>
                            <td class="px-6 py-4">Created at</td>
                            <td class="px-6 py-4">Updated at</td>
                            <td class="px-6 py-4">Updated by</td>
                            <td class="px-6 py-4">Role</td>
                            <td class="px-6 py-4">
                                <button class="bg-blue-600 text-white px-3 py-1 rounded mr-2 hover:bg-blue-700">Edit</button>
                                <button class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Delete</button>
                            </td>
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</div>

<div id="editUserForm" class="fixed hidden inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
    <div class="bg-gray-800 p-8 rounded-lg w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6">Edit User</h2>
        <form id="editForm" for="index.php?view=dashboard_user-management&action=edit_user.php" method="post">
            <input type="hidden" name="editId" id="editId">
            <div class="mb-4">
                <label for="editName" class="block text-sm font-medium text-gray-400 mb-2">Name</label>
                <input type="text" id="editName" name="editName" class="input-field">
            </div>
            <div class="mb-4">
                <label for="editEmail" class="block text-sm font-medium text-gray-400 mb-2">Email</label>
                <input type="email" id="editEmail" name="editEmail" class="input-field">
            </div>
            <div class="mb-6">
                <label for="editRole" class="block text-sm font-medium text-gray-400 mb-2">Role</label>
                <select id="editRole" name="editRole" class="input-field">
                    <option value="customer">Customer</option>
                    <option value="artist">Artist</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="flex justify-end">
                <button id="closeEdit" type="button" class="bg-gray-600 text-white px-4 py-2 rounded mr-2 hover:bg-gray-700">Cancel</button>
                <button id="submitEdit" type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<script type="module" src="./dist/dashboard_users.js"></script>
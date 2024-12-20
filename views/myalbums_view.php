<?php

if (!isset($_SESSION['user_id']) && $_SESSION['role'] === 3) {
    header("Location: index.php?view=register");
    exit();
}

require_once './includes/db.php';

$query = 'SELECT id, name FROM genres ORDER BY name ASC;';
$stmt = $pdo->query($query);
?>



<main class="container mx-auto px-4 py-12">
    <h2 class="text-3xl font-bold text-white mb-8">My Albums</h2>
    <div id="myAlbumsContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

    </div>
</main>


<div id="editContainer" class="hidden flex justify-center items-center bg-black/50 backdrop-blur-xl fixed z-20 h-screen w-screen top-0">
    <div class="bg-gray-800 bg-opacity-50 backdrop-blur-lg rounded-lg shadow-xl overflow-hidden">
        <div class="p-8">
            <div class="flex justify-between items-center p-2 gap-10">
                <h2 class="text-3xl font-bold text-white mb-6">Edit Album</h2>
                <button id="closeEdit" class="text-2xl">X</button>
            </div>
            <form id="editForm">
                <div class="space-y-6">
                    <input type="hidden" name="editId" id="editId">
                    <div>
                        <label for="editTitle" class="block text-sm font-medium text-gray-300 mb-1">Album Title</label>
                        <input type="text" id="editTitle" name="editTitle" class="input-field" required>
                    </div>
                    <div>
                        <label for="editPrice" class="block text-sm font-medium text-gray-300 mb-1">Album Price ($)</label>
                        <input type="number" id="editPrice" name="editPrice" step="0.01" min="0" class="input-field" required>
                    </div>
                    <div>
                        <label for="editDescription" class="block text-sm font-medium text-gray-300 mb-1">Album Description</label>
                        <textarea id="editDescription" name="editDescription" rows="4" class="input-field" required></textarea>
                    </div>
                    <div>
                        <label for="editGenres" class="block text-sm font-medium text-gray-300 mb-1">Album Genre(s)</label>
                        <select id="editGenres" name="editGenres[]" class="input-field" multiple required>
                            <?php
                            try {
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo '
                                    <option value="' . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . '</option>';
                                }
                            } catch (Exception $e) {
                                echo '<option disabled>Failed to load genres</option>';
                            }
                            ?>
                        </select>
                        <p class="text-sm text-gray-400 mt-2">Hold Ctrl to select multiple genres.</p>
                    </div>
                    <div>
                        <button class="btn_red w-full">
                            Upload Album
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="module" src="./dist/myalbums.js"></script>
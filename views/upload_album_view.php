<?php
if (!isset($_SESSION['user_id']) || $_SESSION['role'] === 3) {
    header("Location: index.php");
    exit();
}

require_once './includes/db.php';

$query = 'SELECT id, name FROM genres ORDER BY name ASC;';
$stmt = $pdo->query($query);

?>

<main class="container mx-auto p-6">
    <div class="max-w-2xl mx-auto bg-gray-800 bg-opacity-50 backdrop-blur-lg rounded-lg shadow-xl overflow-hidden">
        <div class="p-8">
            <h2 class="text-3xl font-bold text-primary-400 mb-6">Upload New Album</h2>
            <form id="uploadForm" method="POST" enctype="multipart/form-data">
                <div class="space-y-6">
                    <div>
                        <label for="album-title" class="block text-sm font-medium text-gray-300 mb-1">Album Title</label>
                        <input type="text" id="album-title" name="album-title" class="input-field" required>
                    </div>
                    <div>
                        <label for="album-price" class="block text-sm font-medium text-gray-300 mb-1">Album Price ($)</label>
                        <input type="number" id="album-price" name="album-price" step="0.01" min="0" class="input-field" required>
                    </div>
                    <div>
                        <label for="album-description" class="block text-sm font-medium text-gray-300 mb-1">Album Description</label>
                        <textarea id="album-description" name="album-description" rows="4" class="input-field" required></textarea>
                    </div>
                    <div>
                        <label for="album-genres" class="block text-sm font-medium text-gray-300 mb-1">Album Genre(s)</label>
                        <select id="album-genres" name="genres[]" class="input-field" multiple required>
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
                        <label for="album-cover" class="block text-sm font-medium text-gray-300 mb-1">Album Cover</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-600 hover:border-red-500 transition-all border-dashed rounded-md">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm justify-center items-center text-gray-400">
                                    <label for="file-upload" class="relative cursor-pointer bg-gray-700 rounded-md font-medium text-primary-400 hover:text-primary-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-primary-500">
                                        <span class="px-3 py-2">Upload a file</span>
                                        <input id="file-upload" name="file-upload" type="file" class="sr-only">
                                    </label>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn_red w-full">
                            Upload Album
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>


<script type="module" src="./dist/upload_album.js"></script>
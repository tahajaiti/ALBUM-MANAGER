<?php
if (!isset($_SESSION['user_id']) && $_SESSION['role'] === 3) {
    header("Location: index.php?view=register");
    exit();
}

require_once './includes/db.php'; 

$query = "
    SELECT 
        a.id, 
        a.title, 
        a.description, 
        a.price, 
        a.cover_image, 
        STRING_AGG(DISTINCT g.name, ', ') AS genre_names
    FROM 
        Albums a
    LEFT JOIN 
        album_genres ag ON a.id = ag.album_id
    LEFT JOIN 
        Genres g ON ag.genre_id = g.id
    WHERE 
        a.artist_id = :artist_id 
    GROUP BY 
        a.id
    ORDER BY 
        a.created_at DESC;
";

$stmt = $pdo->prepare($query);
$stmt->execute([':artist_id' => $_SESSION['user_id']]);

$albums = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $albums[] = [
        'id' => $row['id'],
        'title' => $row['title'],
        'description' => $row['description'],
        'price' => $row['price'],
        'cover_image' => $row['cover_image'],
        'genres' => $row['genre_names']
    ];
}

?>
<main class="container mx-auto px-4 py-12">
    <h2 class="text-3xl font-bold text-primary-400 mb-8">My Albums</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php foreach ($albums as $album): ?>
            <div class="bg-gray-800 bg-opacity-50 backdrop-blur-lg rounded-lg shadow-xl overflow-hidden transition duration-300 ease-in-out transform hover:-translate-y-1">
                <img src="<?php echo $album['cover_image'] ?: 'https://via.placeholder.com/400x400'; ?>" alt="Album Cover" class="w-full h-64 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-primary-400 mb-2"><?php echo htmlspecialchars($album['title']); ?></h3>
                    <p class="text-gray-300 mb-4"><?php echo htmlspecialchars($album['description']); ?></p>
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-sm text-gray-400">Genres: <?php echo $album['genres']; ?></span>
                        <span class="text-lg font-bold text-primary-300">$<?php echo number_format($album['price'], 2); ?></span>
                    </div>
                    <div class="flex space-x-2">
                        <button data-id="<?php echo $album['id'] ?>" class="btn_black w-full">Edit</button>
                        <button data-id="<?php echo $album['id'] ?>" class="btn_red w-full">Delete</button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>

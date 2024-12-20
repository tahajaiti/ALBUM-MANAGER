<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 3) {
    http_response_code(401); // Unauthorized
    echo json_encode(['error' => 'Unauthorized access']);
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
        a.is_archived, 
        STRING_AGG(DISTINCT g.name, ', ') AS genre_names
    FROM 
        Albums a
    LEFT JOIN 
        album_genres ag ON a.id = ag.album_id
    LEFT JOIN 
        Genres g ON ag.genre_id = g.id
    WHERE 
        a.artist_id = :artist_id AND
        a.is_archived = false 
    GROUP BY 
        a.id
    ORDER BY 
        a.created_at DESC;
";

try {
    $stmt = $pdo->prepare($query);
$stmt->execute([':artist_id' => $_SESSION['user_id']]);

$albums = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $albums[] = [
        'id' => $row['id'],
        'title' => htmlspecialchars($row['title']),
        'description' => htmlspecialchars($row['description']),
        'price' => number_format($row['price'], 2),
        'cover_image' => $row['cover_image'],
        'genres' => htmlspecialchars($row['genre_names']),
        'archived' => $row['is_archived'],
    ];
}

header('Content-Type: application/json');
echo json_encode($albums);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["status" => False, "error" => "Error fetching albums: " . $e->getMessage()]);
}

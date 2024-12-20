<?php

session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 1) {
    http_response_code(403);
    echo json_encode(["error" => "Unauthorized"]);
    exit();
}

include_once '../includes/db.php';

try {
    $albumId = $_POST['editId'];
    $title = $_POST['editTitle'];
    $price = $_POST['editPrice'];
    $description = $_POST['editDescription'];
    $genres = $_POST['editGenres'];

    if (!$albumId || !$title || !$price || !$description || empty($genres)) {
        http_response_code(400);
        echo json_encode(["status" => false, "message" => "All fields are required."]);
        exit();
    }

    $query = "
                            UPDATE Albums
                                SET title = :title, price = :price, description = :description, updated_at = CURRENT_TIMESTAMP, updated_by = :artist
                                WHERE id = :album_id
                            ";

    $pdo->beginTransaction();

    $stmt = $pdo->prepare($query);
    $stmt->execute([
        ':title' => $title,
        ':price' => $price,
        ':description' => $description,
        ':album_id' => $albumId,
        ':artist' => $_SESSION['user_id']
    ]);

    $deleteGenresQuery = "DELETE FROM album_genres WHERE album_id = :album_id";
    $stmt = $pdo->prepare($deleteGenresQuery);
    $stmt->execute([':album_id' => $albumId]);

    $insertGenreQuery = "INSERT INTO album_genres (album_id, genre_id) VALUES (:album_id, :genre_id)";
    $stmt = $pdo->prepare($insertGenreQuery);
    foreach ($genres as $genreId) {
        $stmt->execute([
            ':album_id' => $albumId,
            ':genre_id' => $genreId,
        ]);
    }

    $pdo->commit();

    echo json_encode(["status" => true, "message" => "Album edited successfully."]);
} catch (PDOException $e) {
    $pdo->rollBack();
    http_response_code(500);
    echo json_encode(["status" => false, "message" => "Failed to edit album: " . $e->getMessage()]);
}

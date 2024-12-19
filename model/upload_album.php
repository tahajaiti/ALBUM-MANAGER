<?php

session_start();

if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 1 && $_SESSION['role'] !== 2)) {
    http_response_code(403);
    echo json_encode(["error" => "Unauthorized"]);
    exit();
}

require_once './../includes/db.php';

try {
    if (
        empty($_POST['album-title']) || 
        empty($_POST['album-price']) || 
        empty($_POST['album-description']) || 
        empty($_POST['genres']) || 
        !isset($_FILES['file-upload'])
    ) {
        throw new Exception("All fields are required.");
    }

    $title = $_POST['album-title'];
    $price = (float) $_POST['album-price'];
    $desc = $_POST['album-description'];
    $genres = $_POST['genres'];
    $artist = $_SESSION['user_id'];

    if ($_FILES['file-upload']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = './../assets/uploads/';

        $fileTmpPath = $_FILES['file-upload']['tmp_name'];
        $fileName = 'cover' . '_' . basename($_FILES['file-upload']['name']);
        $fileDestination = $uploadDir . $fileName;

        if (!move_uploaded_file($fileTmpPath, $fileDestination)) {
            echo json_encode(["success" => false, "message" => "Failed to upload file."]);
            exit;
        }
    } else {
        echo json_encode(["success" => false, "message" => "Invalid image."]);
        exit;
    }

    $query = "INSERT INTO albums (artist_id, title, description, price, cover_image, created_by, updated_by)
              VALUES (:artist_id, :title, :description, :price, :cover_image, :created_by, :updated_by)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        ':artist_id' => $artist,
        ':title' => $title,
        ':description' => $desc,
        ':price' => $price,
        ':cover_image' => $fileDestination,
        ':created_by' => $artist,
        ':updated_by' => $artist,
    ]);

    $albumId = $pdo->lastInsertId();

    foreach ($genres as $genre) {
        $query = 'INSERT INTO album_genres (album_id, genre_id) VALUES (:album_id, :genre_id)';
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            ':album_id' => $albumId,
            ':genre_id' => (int) $genre,
        ]);
    }

    echo json_encode(["success" => true, "message" => "Album uploaded successfully."]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
    exit();
}

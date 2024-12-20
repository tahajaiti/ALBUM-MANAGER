<?php

require_once '../includes/db.php';

try {
    $query = "SELECT albums.*, users.name as artist_name FROM albums 
              JOIN users ON albums.artist_id = users.id 
              WHERE albums.is_archived = false 
              ORDER BY albums.id ASC;";

    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $albums = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($albums);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["status" => False ,"error" => "Error fetching albums: " . $e->getMessage()]);
    exit();
}
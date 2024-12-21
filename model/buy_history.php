<?php

session_start();

include_once '../includes/db.php';

try {
    $query = "SELECT 
            p.user_id AS uId, 
            p.purchase_date AS pDate, 
            a.title,
            a.cover_image AS cover,
            a.price,
            p.album_id AS aId
        FROM purchases p
        JOIN albums a 
        ON p.album_id = a.id
        WHERE p.user_id = :id";

    $stmt = $pdo->prepare($query);
    $stmt->execute([":id" => $_SESSION['user_id']]);

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($rows);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        "status" => false,
        "error" => "Error fetching purchase history: " . $e->getMessage()
    ]);
    exit();
}

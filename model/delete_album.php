<?php

session_start();

if (!isset($_SESSION['user_id']) && $_SESSION['role'] === 3) {
    header("Location: index.php?view=register");
    exit();
}

require_once './../includes/db.php';

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['album_id'])) {
    http_response_code(400);
    echo json_encode(["status" => false,"error" => "Invalid request, No ID"]);
    exit();
}

try {
    $aId = $data["album_id"];
    $artistId = $_SESSION['user_id'];

    $query = "UPDATE Albums SET is_archived = true, updated_by = :ad WHERE id = :album_id";
    $stmt = $pdo->prepare($query);
    $stmt->execute([':ad'=> $artistId, ':album_id' => $aId]);

    echo json_encode(["success" => true, "message" => "Album deleted successfully.", "redirect" => true]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["status" => false,"error"=> $e->getMessage()]);
    exit;
}
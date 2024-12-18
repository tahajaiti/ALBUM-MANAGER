<?php

session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 1) {
    http_response_code(403);
    echo json_encode(["error" => "Unauthorized"]);
    exit();
}

include_once '../includes/db.php';

$data = json_decode(file_get_contents('php://input'), true);
$userId = $data['user_id'];

if (!$userId) {
    http_response_code(400);
    echo json_encode(['error'=> 'User ID is required']);
    exit();
}

try {
    $query = "UPDATE users SET is_accepted = true WHERE id = :id;";
    $stmt = $pdo->prepare($query);
    $stmt->execute(["id"=> $userId]);

    echo json_encode(["success"=> true, "message" => 'User accepted.']);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error"=> $e->getMessage()]);
    exit();
}
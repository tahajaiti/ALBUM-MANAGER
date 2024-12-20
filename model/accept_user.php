<?php

include_once '../includes/permission_check.php';
checkAdmin();

include_once '../includes/db.php';

$data = json_decode(file_get_contents('php://input'), true);
$userId = $data['user_id'];

if (!$userId) {
    http_response_code(400);
    echo json_encode(['error'=> 'User ID is required']);
    exit();
}

try {
    $query = "UPDATE users SET is_accepted = true, updated_by = :adminId, updated_at = CURRENT_TIMESTAMP WHERE id = :id;";
    $stmt = $pdo->prepare($query);
    $stmt->execute(["adminId"=> $_SESSION['user_id'], "id"=> $userId]);

    echo json_encode(["success"=> true, "message" => 'User accepted.']);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error"=> $e->getMessage()]);
    exit();
}
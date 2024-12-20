<?php
include_once '../includes/permission_check.php';
checkAdmin();

require_once '../includes/db.php';

header("Content-Type: application/json");

try {
    $query = "SELECT users.*, roles.role_name AS role
    FROM users
    JOIN roles ON users.role_id = roles.id WHERE is_archived = false AND is_accepted = true
    ORDER BY id ASC;
    ";

    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($users);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["status" => False, "error" => "Error fetching users: " . $e->getMessage()]);
    exit();
}

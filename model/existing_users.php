<?php

session_start();
header("Content-Type: application/json");

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 1) {
    http_response_code(403);
    echo json_encode(["error" => "Unauthorized"]);
    exit();
}

require_once '../includes/db.php';


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

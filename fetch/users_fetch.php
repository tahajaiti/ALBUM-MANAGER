<?php

require_once '../includes/db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    http_response_code(403);
    echo json_encode(["error" => "Unauthorized"]);
    exit();
}


try {
    $query = "SELECT * FROM users WHERE is_accepted = false;";

    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($users);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["status" => False ,"error" => "Error fetching users: " . $e->getMessage()]);
    exit();
}
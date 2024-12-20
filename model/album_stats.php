<?php
session_start();
header("Content-Type: application/json");

// Check if the user is authorized
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 1) {
    http_response_code(403);
    echo json_encode(["error" => "Unauthorized"]);
    exit();
}

require_once '../includes/db.php';

try {
    $queries = [
        "new_albums" => "SELECT COUNT(*) AS count FROM Albums WHERE DATE(created_at) = CURRENT_DATE",
        "total_albums" => "SELECT COUNT(*) AS count FROM Albums",
        "active_albums" => "SELECT COUNT(*) AS count FROM Albums WHERE is_archived = false",
        "archived_albums" => "SELECT COUNT(*) AS count FROM Albums WHERE is_archived = true",
    ];

    $stats = [];

    foreach ($queries as $key => $query) {
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $stats[$key] = (int)$stmt->fetch(PDO::FETCH_ASSOC)['count'];
    }

    echo json_encode($stats);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        "status" => false,
        "error" => "Error fetching stats: " . $e->getMessage()
    ]);
    exit();
}

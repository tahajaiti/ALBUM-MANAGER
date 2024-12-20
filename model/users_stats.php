<?php
header("Content-Type: application/json");

include_once '../includes/permission_check.php';
checkAdmin();

require_once '../includes/db.php';

try {
    $queries = [
        "new_users" => "SELECT COUNT(*) AS count FROM users WHERE DATE(created_at) = CURRENT_DATE",
        "total_users" => "SELECT COUNT(*) AS count FROM users",
        "active_users" => "SELECT COUNT(*) AS count FROM users WHERE is_accepted = true",
        "archived_users" => "SELECT COUNT(*) AS count FROM users WHERE is_archived = true",
    ];

    $stats = [];

    foreach ($queries as $key => $query) {
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $stats[$key] = (int) $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    }

    echo json_encode($stats);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        "status" => false,
        "error" => "Error fetching user statistics: " . $e->getMessage(),
    ]);
    exit();
}

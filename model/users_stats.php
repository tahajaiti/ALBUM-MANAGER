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
    $newQuery = "SELECT COUNT(*) AS new_users FROM users WHERE DATE(created_at) = CURRENT_DATE;";

    $stmtNew = $pdo->prepare($newQuery);
    $stmtNew->execute();
    $newUsers = $stmtNew->fetch(PDO::FETCH_ASSOC)['new_users'];

    $totalQuery = "SELECT COUNT(*) AS total_users FROM users;";

    $stmtTotal = $pdo->prepare($totalQuery);
    $stmtTotal->execute();
    $totalUsers = $stmtTotal->fetch(PDO::FETCH_ASSOC)['total_users'];

    $activeQuery = "SELECT COUNT(*) AS active_users FROM users WHERE is_accepted = true;";

    $stmtActive = $pdo->prepare($activeQuery);
    $stmtActive->execute();
    $activeUsers = $stmtActive->fetch(PDO::FETCH_ASSOC)['active_users'];

    $archiveQuery = "SELECT COUNT(*) AS archived_users FROM users WHERE is_archived = true;";
    $stmtArchived = $pdo->prepare($archiveQuery);
    $stmtArchived->execute();
    $archivedUsers = $stmtArchived->fetch(PDO::FETCH_ASSOC)['archived_users'];

    echo json_encode([
        "new_users" => $newUsers,
        "total_users" => $totalUsers,
        "active_users" => $activeUsers,
        "archived_users" => $archivedUsers
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["status" => false,"error" => "Error fetching stats: " . $e->getMessage()]);
    exit();
}

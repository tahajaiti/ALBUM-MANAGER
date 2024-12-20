<?php
session_start();

include_once '../includes/db.php';

$data = json_decode(file_get_contents('php://input'), true);

try {
    if (!isset($data['id'], $data['price'], $_SESSION['user_id'])) {
        http_response_code(400);
        echo json_encode(['status' => false, 'error' => 'Invalid input data']);
        exit();
    }

    $albumId = $data['id'];
    $price = $data['price'];
    $userId = $_SESSION['user_id'];
    $quantity = 1;
    $totalPrice = $price * $quantity;

    $query = "INSERT INTO Purchases (user_id, album_id, purchase_date, quantity, total_price) 
              VALUES (:user_id, :album_id, NOW(), :quantity, :total_price);";

    $stmt = $pdo->prepare($query);

    $stmt->execute([
        ':user_id' => $userId,
        ':album_id' => $albumId,
        ':quantity' => $quantity,
        ':total_price' => $totalPrice,
    ]);

    echo json_encode(['status' => true, 'message' => 'Album bought! Happy listening.']);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => false, 'error' => 'Failed to buy album: ' . $e->getMessage()]);
    exit();
}

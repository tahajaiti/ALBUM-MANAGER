<?php
include_once '../includes/permission_check.php';
checkAdmin();

include_once '../includes/db.php';

$data = json_decode(file_get_contents('php://input'), true);

try {

    if (
        empty($data['id']) ||
        empty($data['name']) ||
        empty($data['email']) ||
        empty($data['role'])
    ) {
        http_response_code(400);
        echo json_encode(['status' => False, 'error' => 'Missing or false data']);
        return;
    }

    $uId = filter_var($data['id'], FILTER_SANITIZE_NUMBER_INT);
    $name = htmlspecialchars($data['name'], ENT_QUOTES, 'UTF-8');
    $email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
    $role = htmlspecialchars($data['role'], ENT_QUOTES, 'UTF-8');

    $roleId = match ($role) {
        'admin' => 1,
        'artist' => 2,
        'customer' => 3,
        default => throw new Exception('Invalid role.'),
    };
    
    $editQuery = "UPDATE users 
                  SET name = :name, email = :email, updated_by = :adminId, updated_at = CURRENT_TIMESTAMP , role_id = :role 
                  WHERE id=:id";
                  
    $stmt = $pdo->prepare($editQuery);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':adminId', $_SESSION['user_id']);
    $stmt->bindParam(':role', $roleId);
    $stmt->bindParam(':id', $uId);

    if ($stmt->execute()) {
        http_response_code(200);
        echo json_encode(['status'=> True,'message'=> 'User updated.']);
    } else {
        throw new Exception('Failed to update the user');;
    }

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => False, 'error' =>'Failed to get the user'. $e->getMessage()]);
    exit;
}

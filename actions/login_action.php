<?php

include_once './includes/slug_gen.php';

if (!isset($_SESSION['token'])) {
    echo json_encode([
        'success' => false,
        'message' => 'No token in session.'
    ]);
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_GET['action']) && $_GET['action'] === 'login') {
        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['token']) || $data['token'] !== $_SESSION['token']) {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid token, please refresh the page'
            ]);
            exit;
        }

        $email = htmlspecialchars(trim($data['loginMail']), ENT_QUOTES, 'UTF-8');
        $password = trim($data['loginPass']);

        if (empty($email) || empty($password)) {
            echo json_encode(['status' => 'error', 'message' => 'Email and password are required']);
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid email address']);
            exit;
        }

        try {
            $query = 'SELECT id, role_id, email, password, slug FROM users WHERE email = :email LIMIT 1;';

            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role_id'];

                unset($_SESSION['token']);

                echo json_encode(['status' => 'success', 'message' => 'Login successful']);
                exit;
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid email or password']);
                exit;
            }

        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => 'Login failed']);
            exit;
        }
    }
}

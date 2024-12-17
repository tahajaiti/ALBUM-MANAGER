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
    if (isset($_GET['action']) && $_GET['action'] === 'login'){
        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['token']) || $data['token'] !== $_SESSION['token']) {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid token, please refresh the page'
            ]);
            exit;
        }

        unset($_SESSION['token']);

        $email = htmlspecialchars(trim($data['loginMail']), ENT_QUOTES, 'UTF-8');
        $password = htmlspecialchars(trim($data['loginPass']), ENT_QUOTES, 'UTF-8');

        if (empty($email) || empty($password)) {
            echo json_encode(['status' => 'error', 'message' => 'Email and password are required.']);
        exit;
        }

    }

} 
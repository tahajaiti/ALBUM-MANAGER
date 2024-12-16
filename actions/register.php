<?php 

session_start();

if (!isset($_SESSION['token'])) {
    echo json_encode([
        'success' => false,
        'message' => 'No token in session.'
    ]);
    return;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' ){
    if (isset($_GET['action']) && $_GET['action'] === 'register'){
        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['token']) || $data['token'] !== $_SESSION['token']) {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid token, please refresh the page'
            ]);
            return;
        }

        unset($_SESSION['csrf_token']);

    }

    
}
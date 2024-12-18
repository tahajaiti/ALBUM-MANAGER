<?php

include_once './includes/slug_gen.php';

if (!isset($_SESSION['token'])) {
    echo json_encode([
        'status' => false,
        'message' => 'No token in session.'
    ]);
    exit;
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_GET['action']) && $_GET['action'] === 'register') {
        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['token']) || $data['token'] !== $_SESSION['token']) {
            echo json_encode([
                'status' => false,
                'message' => 'Invalid token, please refresh the page'
            ]);
            exit;
        }

        $name = htmlspecialchars(trim($data['registerName']), ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars(trim($data['registerMail']), ENT_QUOTES, 'UTF-8');
        $password = htmlspecialchars(trim($data['registerPass']), ENT_QUOTES, 'UTF-8');

        $errs = [];

        if (!preg_match('/^[A-Za-z\s]+$/', $name)) {
            $errs[] = 'Name must only be letters and spaces';
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errs[] = 'Enter a valid email address';
        }

        if (!preg_match('/^.{8,}$/', $password)) {
            $errs[] = 'Please enter a password thats 8 characters long or more';
        }

        if (!empty($errs)) {
            echo json_encode([
                'status' => false,
                'message' => 'Validation errors.',
                'errors' => $errs
            ]);
            exit;
        }

        $hashPass = password_hash($password, PASSWORD_BCRYPT);
        $slug = genSlug($pdo, 'users', 'slug', $name);

        try {

            $stmt = $pdo->query('SELECT COUNT(*) FROM users');
            $userCount = $stmt->fetchColumn();

            if ($userCount == 0) {
                $stmt = $pdo->prepare('INSERT INTO users (role_id, name, email, password, slug) VALUES (:role_id, :name, :email, :password, :slug)');
                $stmt->execute([
                    ':role_id' => 1,
                    ':name' => $name,
                    ':email' => $email,
                    ':password' => $hashPass,
                    ':slug' => $slug,
                ]);
            } else {
                $stmt = $pdo->prepare('INSERT INTO users (name, email, password, slug) VALUES (:name, :email, :password, :slug)');
                $stmt->execute([
                    ':name' => $name,
                    ':email' => $email,
                    ':password' => $hashPass,
                    ':slug' => $slug
                ]);
            }

            unset($_SESSION['token']);

            echo json_encode([
                'status' => true,
                'message' => 'User registered sucessfuly!'
            ]);
        } catch (Exception $e) {
            echo json_encode([
                'status' => false,
                'message' => 'Registration failed.' . $e->getMessage(),
                'error' => $e->getMessage()
            ]);
        }

        exit;
    }
}

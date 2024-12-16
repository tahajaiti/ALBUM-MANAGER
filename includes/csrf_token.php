<?php

session_start();

function generateCSRFToken() {
    if (empty($_SESSION['token'])) {
        $_SESSION['token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['token'];
}

$csrf_token = generateCSRFToken();

echo ''. $csrf_token .'';
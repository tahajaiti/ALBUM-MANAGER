<?php
$host = 'localhost';
$port = 5432;
$dbname = 'album_manager';
$user = 'postgres';
$password = 'root';

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    $pdo = new PDO($dsn, $user, $password, $options);

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

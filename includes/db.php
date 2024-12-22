<?php
$host = 'localhost';
$db = 'album_manager';
$admindb = 'postgres';
$user = 'postgres';
$pass = 'root';

$connect = "pgsql:host=$host;dbname=$admindb";
$connectReal = "pgsql:host=$host;dbname=$db";

try {
    $pdo = new PDO($connect, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

$query = "SELECT 1 FROM pg_database WHERE datname = :dbname";
$stmt = $pdo->prepare($query);
$stmt->execute(['dbname' => $db]);

if ($stmt->rowCount() === 0) {

    try {
        $pdo->exec("CREATE DATABASE $db");

        $pdo = new PDO($connectReal, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sqlFile = './sql/script.sql';
        $sqlRead = file_get_contents($sqlFile);

        if (!$sqlRead) {
            die("Error reading SQL file");
        }

        $pdo->exec($sqlRead);

        header("Location: ./index.php");
    } catch (PDOException $e) {
        die("Error creating or executing SQL: " . $e->getMessage());
    }
} else {
    try {
        $pdo = new PDO($connectReal, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}

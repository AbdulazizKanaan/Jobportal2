<?php
$host = 'localhost';    // Database host
$db = 'jobquestify';    // Database name
$user = 'root';         // Database username
$pass = '';             // Database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>

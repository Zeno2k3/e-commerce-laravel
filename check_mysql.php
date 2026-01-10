<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1', 'root', '');
    echo "Connected successfully";
    // Try to create test database
    $pdo->exec("CREATE DATABASE IF NOT EXISTS laravel_test");
    echo "\nDatabase laravel_test created/checked";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

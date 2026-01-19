<?php 
$host = 'localhost';
$dbname = 'user_registration';
$username = 'user_registration';
$password = 'user_registration';

// Data source name
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

try {
  $pdo = new PDO($dsn, $username, $password);

  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Database Connection Failed: " . $e->getMessage());
}
?>
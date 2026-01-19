<?php 
$host = '	sql112.infinityfree.com';
$dbname = 'if0_40937098_user_register';
$username = 'if0_40937098';
$password = 'loginform123!';

// Data source name
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

try {
  $pdo = new PDO($dsn, $username, $password);

  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Database Connection Failed: " . $e->getMessage());
}
?>
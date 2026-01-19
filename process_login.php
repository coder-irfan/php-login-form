<?php 
session_start();

require_once "config.php";

// Allow only post methods
if ($_SERVER['REQUEST_METHOD'] !== "POST") {
  header("Location: login.php");
  exit;
}

// Collect and sanitize input
$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

$errors = [];

// Validate input
if (empty($email)) {
  $errors[] = "Email is required!";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $errors[] = "Email format is not correct!";
}

if (empty($password)) {
  $errors[] = "Password is required!";
}

// If validation fails, redirect back
if (!empty($errors)) {
  $_SESSION['errors'] = $errors;
  header("Location: login.php");
  exit;
}

// Fetch user from database
try {
  $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE email = :email LIMIT 1");
  $stmt->execute([':email' => $email]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  // If user exist
  if (!$user) {
    $_SESSION['errors'] = ["Invalid email or password"];
    header("Location: login.php");
    exit;
  }

  // Verify Password
  if (!password_verify($password, $user['password'])) {
    $_SESSION['errors'] = ["Invalid email or password"];
    header("Location: login.php");
    exit;
  }

  // Login successful -> create session
  $_SESSION['user_id'] = $user['id'];
  $_SESSION['username'] = $user['username'];
  
  header("Location: dashboard.php");
  exit;

} catch(PDOException $e) {
  die("Database error: " . $e->getMessage());
}
?>
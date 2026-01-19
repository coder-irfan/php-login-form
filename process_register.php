<?php 
session_start();

require_once "config.php";

// Collect and sanitize form
$username = trim($_POST['username'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');
$confirm_password = trim($_POST['confirm_password'] ?? '');

$errors = [];

// Validation 
if (empty($username)) {
  $errors[] = "Username is required!";
} elseif (strlen($username) < 3) {
  $errors[] = "Username must be at least 3 characters!";
}

if (empty($email)) {
  $errors[] = "Email is required!";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $errors[] = "Invalid email format!";
}

if (empty($password)) {
  $errors[] = "Password is required!";
} elseif (strlen($password) < 6) {
  $errors[] = "Password must be at least 6 characters!";
}

if ($password !== $confirm_password) {
  $errors[] = "Passwords don't match!";
}

// Stop execution if errors exist
if (!empty($errors)) {
  $_SESSION['errors'] = $errors;
  header("Location: register.php");
  exit;
}

// Check for existing username or email
try {
  $stmt = $pdo->prepare("SELECT id FROM users WHERE username = :username OR email = :email");
  $stmt->execute([
    ':username' => $username,
    ':email' => $email
  ]);

  if ($stmt->rowCount() > 0) {
    $_SESSION['errors'] = ["Username or Email already exists!"];
    header("Location: register.php");
    exit;
  }
} catch (PDOException $e) {
  die("Database error: " . $e->getMessage());
}

// Hash Password Securely
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert new user
try {
  $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
  $stmt->execute([
    ':username' => $username,
    ':email' => $email,
    ':password' => $hashed_password
  ]);
  
  $_SESSION['success'] = "Registration successful! You can now login!.";
  header("Location: login.php");
  exit;
} catch(PDOException $e) {
  die("Database error: " . $e->getMessage());
}
?>

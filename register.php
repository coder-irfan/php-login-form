<?php 
session_start();

// If user is already logged in, redirect to dashboard
if (isset($_SESSION['user_id'])) {
  header("Location: dashboard.php");
  exit;
}

// Include db connection
require_once "config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registeration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h1>Register</h1>

    <!-- Display success or error message -->
    <?php 
    if (isset($_SESSION['errors'])) {
      echo "<ul class='error'>";
      foreach ($_SESSION['errors'] as $error) {
        echo "<li>" . htmlspecialchars($error) . "</li>";
      }
      echo "</ul>";
      unset($_SESSION['errors']);
    }

    if (isset($_SESSION['success'])) {
      echo "<p class='success'>" . htmlspecialchars($_SESSION['success']) . "</p>";
      unset($_SESSION['success']);
    }
    ?>

    <form action="process_register.php" method="POST" novalidate>
      <label for="username">Username:</label>
      <input type="text" name="username" id="username" required>

      <label for="email">Email:</label>
      <input type="email" name="email" id="email" required>

      <label for="password">Password:</label>
      <input type="password" name="password" id="password" required>

      <label for="confirm_password">Confirm Password:</label>
      <input type="password" name="confirm_password" id="confirm_password" required>

      <button type="submit">Register</button>
    </form>

     <p>Already have an account? <a href="login.php">Login here</a></p>
  </div>
</body>
</html>
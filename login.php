<?php 
session_start();

// If user is already logged in, redirect them to dashboard
if (isset($_SESSION['user_id'])) {
  header("Location: dashboard.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h1>Login</h1>
     
    <!-- Show error or success message -->
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

    <form action="process_login.php" method="POST" novalidate>
      <label for="email">Email:</label>
      <input type="email" name="email" id="email" required>

      <label for="password">Password:</label>
      <input type="password" name="password" id="password" required>

      <button type="submit">Login</button>
    </form>

    <p>Don’t have an account? <a href="register.php">Register here</a></p>
    
  </div>
</body>
</html>
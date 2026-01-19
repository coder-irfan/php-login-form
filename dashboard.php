<?php 
session_start();

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="dashboard">
  <h1>Welcome 👋</h1>

  <p>
    You are logged in as
    <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>
  </p>

  <a href="logout.php" class="logout-btn">Logout</a>
</div>
</body>
</html>

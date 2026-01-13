<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard</title>
</head>
<body>
  <h1>Welcome, <?php echo $_SESSION['admin_user']; ?>!</h1>
  <p>This is the admin dashboard.</p>
  <a href="logout.php">Logout</a>
</body>
</html>

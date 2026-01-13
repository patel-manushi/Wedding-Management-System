<?php
session_start();
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "", "wedding_planner01");
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

    $username = $_POST['username'];
    $user_id = $_POST['user_id'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    $sql = "SELECT * FROM users WHERE username=? AND user_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $update = $conn->prepare("UPDATE users SET password=? WHERE username=? AND user_id=?");
        $update->bind_param("sss", $new_password, $username, $user_id);
        $update->execute();
        $message = "✅ Password reset successfully!";
    } else {
        $message = "❌ Invalid username or user ID.";
    }
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Forgot Password</title>
  <style>
    body {
      background: linear-gradient(135deg, #a1c4fd, #6a11cb);
      font-family: 'Roboto', 'Arial', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
    }

    .forgot-box {
      background: #ffffff;
      padding: 50px 40px;
      border-radius: 20px;
      box-shadow: 0 12px 40px rgba(106, 17, 203, 0.3);
      width: 400px;
      display: flex;
      flex-direction: column;
      animation: fadeIn 0.8s ease;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(-30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    h2 {
      text-align: center;
      color: #6a11cb;
      font-size: 30px;
      font-weight: bold;
      letter-spacing: 1.5px;
      margin-bottom: 25px;
      font-family: 'Dancing Script', cursive;
      text-shadow: 1px 1px 4px rgba(106, 17, 203, 0.4);
    }

    input {
      width: 93%;
      padding: 14px 18px;
      margin: 10px 0;
      border-radius: 12px;
      border: 1px solid #ddd;
      font-size: 16px;
      background: #f9f7fd;
      transition: all 0.3s ease;
    }

    input:focus {
      border: 1px solid #6a11cb;
      outline: none;
      background: #f0f0f0;
      box-shadow: 0 0 10px rgba(106, 17, 203, 0.3);
    }

    button {
      background: linear-gradient(135deg, #6a11cb, #2575fc);
      color: white;
      padding: 16px;
      border: none;
      width: 100%;
      border-radius: 14px;
      font-size: 20px;
      font-weight: bold;
      cursor: pointer;
      margin-top: 20px;
      transition: all 0.4s ease;
      letter-spacing: 2px;
      font-family: 'Poppins', sans-serif;
    }

    button:hover {
      background: linear-gradient(135deg, #9b59b6, #8e44ad);
      transform: scale(1.05);
      box-shadow: 0 10px 25px rgba(155, 89, 182, 0.5);
    }

    .message {
      text-align: center;
      margin-top: 15px;
      font-size: 16px;
      font-weight: bold;
      color: #2c3e50;
    }

    a {
      display: block;
      margin-top: 15px;
      color: #2575fc;
      text-align: center;
      text-decoration: none;
      font-weight: bold;
    }

    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="forgot-box">
    <h2>Forgot Password</h2>
    <form method="POST">
      <input type="text" name="username" placeholder="Username" required>
      <input type="text" name="user_id" placeholder="User ID" required>
      <input type="password" name="new_password" placeholder="New Password" required>
      <button type="submit">Reset Password</button>
    </form>
    <?php if ($message): ?>
      <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>
    <a href="user_login.php">← Back to Login</a>
  </div>
</body>
</html>

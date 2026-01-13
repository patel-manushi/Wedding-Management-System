<?php
session_start();
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $password = $_POST['password'];

    // Connect to DB
    $conn = new mysqli("localhost", "root", "", "wedding_planner01");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check user credentials
    $stmt = $conn->prepare("SELECT * FROM admin_users WHERE user_id = ? AND password = SHA2(?, 256)");
    $stmt->bind_param("ss", $user_id, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_user'] = $user_id;
        header("Location: packages.php");
        exit();
    } else {
        $error = "Invalid user ID or password.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Login</title>
  <style>
   /* Gradient Background */
body {
  background: linear-gradient(135deg, #a1c4fd, #6a11cb); /* Purple gradient background */
  font-family: 'Roboto', 'Arial', sans-serif; /* Elegant font */
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  margin: 0;
  padding: 40px;
}

/* Login Box Styling */
.login-box {
  background: #fff;
  padding: 50px 40px;
  box-shadow: 0 12px 40px rgba(106, 17, 203, 0.3); /* Soft shadow for depth */
  border-radius: 20px;
  width: 350px;
  display: flex;
  flex-direction: column;
  animation: formSlideIn 0.8s ease;
}

/* Animation for Login Box */
@keyframes formSlideIn {
  from {
    opacity: 0;
    transform: translateY(-50px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Header Style */
.login-box h2 {
  text-align: center;
  color: #6a11cb;
  font-size: 36px;
  font-weight: bold;
  text-transform: uppercase;
  letter-spacing: 1.5px;
  margin-bottom: 30px;
  font-family: 'Dancing Script', cursive; /* Elegant script font */
  text-shadow: 2px 2px 5px rgba(106, 17, 203, 0.5); /* Soft purple glow */
}

/* Input Fields */
.login-box input {
  width: 93%;
  padding: 14px 18px;
  margin: 15px 0;
  border-radius: 12px;
  border: 1px solid #ddd;
  font-size: 16px;
  background: #f9f7fd;
  transition: all 0.3s ease;
  font-family: 'Roboto', sans-serif;
}

.login-box input:focus {
  border: 1px solid #6a11cb;
  outline: none;
  background: #f0f0f0;
  box-shadow: 0 0 10px rgba(106, 17, 203, 0.3);
}

/* Submit Button */
.login-box button {
  background: linear-gradient(135deg, #6a11cb, #2575fc); /* Gradient button */
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
  font-family: 'Poppins', sans-serif; /* Clean modern font */
}

.login-box button:hover {
  background: linear-gradient(135deg, #9b59b6, #8e44ad); /* Darker purple on hover */
  transform: scale(1.1);
  box-shadow: 0 10px 25px rgba(155, 89, 182, 0.5);
}

/* Error Messages */
.error {
  color: #e74c3c;
  text-align: center;
  margin-top: 15px;
  font-size: 16px;
  font-weight: bold;
  font-family: 'Roboto', sans-serif;
}

/* Smooth Hover Effect on Input */
.login-box input:hover {
  background: #f0ebff;
}

/* Disabled Button State */
.login-box button:disabled {
  background: #ddd;
  cursor: not-allowed;
}

  </style>
</head>
<body>

<div class="login-box">
  <h2>Admin Login</h2>
  <form method="post">
    <input type="text" name="user_id" placeholder="User ID" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
    <?php if ($error): ?>
      <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
  </form>
</div>

</body>
</html>

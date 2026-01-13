<?php
session_start();
$conn = new mysqli("localhost", "root", "", "wedding_planner01");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login']; // username or email
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? OR name = ?");
    $stmt->bind_param("ss", $login, $login);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['name'];
            header("Location: home.php");
            exit();
        } else {
            $error = "Invalid User.";
        }
    } else {
        $error = "User not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>User Login</title>

  <style>
   /* Gradient Background */
body {
  background: linear-gradient(135deg, #a1c4fd, #6a11cb); /* Cool purple gradient */
  font-family: 'Roboto', 'Arial', sans-serif; /* Elegant font */
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  margin: 0;
  padding: 40px;
}

/* Form Styling */
form {
  background: #fff;
  padding: 50px 40px;
  border-radius: 20px;
  box-shadow: 0 12px 40px rgba(106, 17, 203, 0.3);
  width: 380px;
  display: flex;
  flex-direction: column;
  animation: formSlideIn 0.8s ease;
}

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

/* Header Styling */
h2 {
  text-align: center;
  color: #6a11cb;
  font-size: 36px;
  font-weight: bold;
  letter-spacing: 1.5px;
  text-transform: uppercase;
  margin-bottom: 30px;
  font-family: 'Dancing Script', cursive; /* Premium script font */
  text-shadow: 2px 2px 5px rgba(106, 17, 203, 0.5); /* Soft purple glow */
}

/* Input Fields */
input {
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

input:focus {
  border: 1px solid #6a11cb;
  outline: none;
  background: #f0f0f0;
  box-shadow: 0 0 10px rgba(106, 17, 203, 0.3);
}

/* Button Styling */
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
  font-family: 'Poppins', sans-serif; /* Clean modern font */
}

button:hover {
  background: linear-gradient(135deg, #9b59b6, #8e44ad);
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

/* Smooth Input Hover */
input:hover {
  background: #f0ebff;
}

/* Button Disabled State */
button:disabled {
  background: #ddd;
  cursor: not-allowed;
}

  </style>
</head>
<body>
  <form method="POST" action="user_login.php">
    <h2>User Login</h2>
    <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
    <input type="text" name="login" placeholder="Email or Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
    <p style="text-align:center;margin-top:10px;">No account? <a href="user_signup.php">Sign up</a></p>
    <p style="text-align:center;margin-top:0px;">Forgot Password? <a href="forgot.php">Forgot</a></p>
  </form>
</body>
</html>

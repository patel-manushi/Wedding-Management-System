<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Index</title>
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
  <style>
   body {
  margin: 0;
  padding: 0;
  background: linear-gradient(135deg, #e0f2fe, #bae6fd); /* Light blue gradient */
  font-family: 'Poppins', sans-serif;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  overflow: hidden;
}

h1 {
  font-family: 'Dancing Script', cursive;
  font-size: 80px;
  color: #2563eb; /* Strong but soft blue */
  margin-bottom: 50px;
  text-shadow: 0 8px 20px rgba(37, 99, 235, 0.3), 0 0 30px rgba(96, 165, 250, 0.5);
  animation: float 6s ease-in-out infinite;
  letter-spacing: 2px;
}

@keyframes float {
  0%, 100% {
    transform: translateY(0px);
  }
  50% {
    transform: translateY(-15px);
  }
}

.button-group {
  display: flex;
  gap: 50px;
}

.button-group a {
  padding: 20px 60px;
  text-decoration: none;
  background: linear-gradient(135deg, #60a5fa, #3b82f6); /* lighter blue gradient */
  color: #ffffff;
  border-radius: 20px;
  font-size: 28px;
  font-weight: 700;
  box-shadow: 0 10px 20px rgba(96, 165, 250, 0.4), 0 5px 15px rgba(59, 130, 246, 0.5);
  transition: all 0.4s ease;
  letter-spacing: 1.5px;
  position: relative;
  overflow: hidden;
}

.button-group a::after {
  content: "";
  position: absolute;
  top: -50%;
  left: -50%;
  width: 200%;
  height: 200%;
  background: rgba(255, 255, 255, 0.2); /* lighter shimmer */
  transform: rotate(45deg);
  transition: all 0.7s ease;
}

.button-group a:hover::after {
  top: 100%;
  left: 100%;
}

.button-group a:hover {
  background: linear-gradient(135deg, #3b82f6, #60a5fa);
  color: #ffffff;
  transform: scale(1.1);
  box-shadow: 0 15px 30px rgba(96, 165, 250, 0.6), 0 8px 25px rgba(59, 130, 246, 0.6);
}


  </style>
</head>
<body>

  <h1>Choose Your Login</h1>

  <div class="button-group">
    <a href="dashboard/admin_login.php">Admin Login</a>
    <a href="user_login.php">User Login</a>
  </div>

</body>
</html>

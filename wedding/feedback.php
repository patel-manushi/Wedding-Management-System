<?php
// Connect to MySQL
$conn = new mysqli('localhost', 'root', '','wedding_planner01');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert review into the database
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $review = $conn->real_escape_string($_POST['comment']);

    $sql = "INSERT INTO comments (name, comment) VALUES ('$name', '$review')";
    $conn->query($sql);
}

// Fetch all reviews
$result = $conn->query("SELECT * FROM comments ORDER BY created_at DESC");
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<style>
    /* Import Google Font */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

/* Container */
.container {
    max-width: 900px;
    margin: 40px auto;
    padding: 30px;
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #e3f2fd, #bbdefb);
    border-radius: 16px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}

/* Heading */
h1, h2 {
    color: #0d47a1;
    text-align: center;
    margin-bottom: 20px;
    letter-spacing: 1px;
    font-weight: 600;
}

/* Form Styling */
form {
    display: flex;
    flex-direction: column;
    gap: 20px;
    margin-bottom: 40px;
}

/* Inputs and Textarea */
input[type="text"],
textarea {
    padding: 15px;
    border: 2px solid #90caf9;
    border-radius: 10px;
    font-size: 1rem;
    background-color: #ffffff;
    transition: all 0.3s ease;
    box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);
}

input[type="text"]:focus,
textarea:focus {
    border-color: #1e88e5;
    box-shadow: 0 0 8px rgba(30, 136, 229, 0.3);
    outline: none;
}

/* Button */
button {
    background: linear-gradient(135deg, #42a5f5, #1e88e5);
    color: #fff;
    border: none;
    padding: 14px;
    font-size: 1.1rem;
    border-radius: 10px;
    cursor: pointer;
    font-weight: 600;
    letter-spacing: 1px;
    transition: all 0.3s ease;
}

button:hover {
    background: linear-gradient(135deg, #1e88e5, #1565c0);
    transform: translateY(-2px) scale(1.03);
}

/* Reviews Section */
.reviews {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

/* Single Review Box */
.review-box {
    background: #ffffff;
    padding: 20px;
    border-radius: 12px;
    border: 2px solid #e3f2fd;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
    transition: transform 0.3s, box-shadow 0.3s;
}

.review-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(30, 136, 229, 0.2);
}

/* Reviewer Name */
.review-box h3 {
    margin: 0 0 10px 0;
    color: #1565c0;
    font-size: 1.2rem;
    font-weight: 600;
}

/* Review Text */
.review-box p {
    margin: 0 0 12px 0;
    color: #555;
    line-height: 1.6;
    font-size: 1rem;
}

/* Review Timestamp */
.review-box span {
    font-size: 0.9rem;
    color: #999;
    display: block;
    margin-top: 10px;
}

/* Responsive */
@media (max-width: 768px) {
    .container {
        padding: 20px;
    }

    input[type="text"],
    textarea {
        font-size: 0.95rem;
    }

    button {
        font-size: 1rem;
    }
}

</style>
<body>

    <!-- Header -->
    <header>
    <div class="navbar">
        <div class="logo">
            <a href="home.php">
                <img src="source images/logo.png" alt="TVW Logo" style="height: 100px;">
            </a>
        </div>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="service.php">Services</a></li>
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="consult.php">Consultant</a></li>
                <li><a href="feedback.php">Feedback</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <li><a href="total.php">Total Payment</a></li>
            </ul>
        </nav>
    </div>
</header>

    <div class="container">
    <h1>We will glade if your write review about us</h1>
    <form method="POST" action="feedback.php">
        <input type="text" name="name" placeholder="Your Name" required>
        <textarea name="comment" placeholder="Write your review..." required></textarea>
        <button type="submit">Submit</button>
    </form>

    <h2>Our happy customer</h2>
    <div class="reviews">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="review-box">
                <h3><?= htmlspecialchars($row['name']) ?></h3>
                <p><?= htmlspecialchars($row['comment']) ?></p>
                <span><?= $row['created_at'] ?></span>
            </div>
        <?php endwhile; ?>
    </div>
</div>
    <!-- Content of your page goes here -->

    <!-- Footer -->
    <footer>
    <button style="border-radius:10%; height:30px; width:100px; background-color:red; border-color:black; border-width:3px" ><a href="user_logout.php" style="text-decoration: none; color:white;"><b>Logout</b></a></button>
    
        <div class="footer-container">
            <!-- Footer Text and Copyright -->
            <p>&copy; 2025 Your Company. All Rights Reserved.</p>
            
            <!-- Footer Links -->
            <p>
                <a href="#privacy-policy">Privacy Policy</a> | 
                <a href="#terms-of-service">Terms of Service</a> | 
                <a href="#contact-us">Contact Us</a>
            </p>
            
            <!-- Footer Social Icons -->
            <div class="footer-social">
                <a href="https://facebook.com" target="_blank" title="Facebook">
                    <i class="fab fa-facebook-f"></i> <!-- Font Awesome Facebook Icon -->
                </a>
                <a href="https://twitter.com" target="_blank" title="Twitter">
                    <i class="fab fa-twitter"></i> <!-- Font Awesome Twitter Icon -->
                </a>
                <a href="https://instagram.com" target="_blank" title="Instagram">
                    <i class="fab fa-instagram"></i> <!-- Font Awesome Instagram Icon -->
                </a>
                <a href="https://linkedin.com" target="_blank" title="LinkedIn">
                    <i class="fab fa-linkedin-in"></i> <!-- Font Awesome LinkedIn Icon -->
                </a>
            </div>
        </div>
    </footer>

</body>
</html>

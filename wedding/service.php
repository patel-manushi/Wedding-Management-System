<?php
$conn = new mysqli('localhost', 'root', '', 'wedding_planner01');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM packages LIMIT 6"; // limit to 6 cards
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"> <!-- Font Awesome for icons -->
    <style>
       body {
    font-family: 'Segoe UI', sans-serif;
    margin: 0;
    background-color: #e3f2fd; /* Light Blue Background */
}

.container {
    width: 90%;
    margin: 30px auto;
}

.row {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    margin-bottom: 20px;
}

.card {
    background: #ffffff; /* White background for the card */
    width: 32%;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 6px 12px rgba(0, 0, 255, 0.1); /* Light blue shadow */
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    margin-bottom: 20px;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 20px rgba(0, 0, 255, 0.2); /* Lighter blue shadow on hover */
}

.card img {
    width: 100%;
    height: 220px;
    object-fit: cover;
}

.card-content {
    padding: 15px;
}

.card-content h3 {
    color: #0288d1; /* Blue text color */
    margin-top: 0;
    font-size: 20px;
}

.card-content p {
    color: #555;
    font-size: 14px;
    margin-bottom: 10px;
}

.card-content a {
    display: inline-block;
    margin-top: 10px;
    color: #0288d1; /* Blue link color */
    text-decoration: none;
    font-weight: bold;
    font-size: 14px;
}

.card-content a:hover {
    color: #03a9f4; /* Lighter blue link on hover */
}

@media (max-width: 992px) {
    .card {
        width: 48%;
    }
}

@media (max-width: 600px) {
    .card {
        width: 100%;
    }
}



    </style>
</head>
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
    <?php
    if ($result->num_rows > 0) {
        $count = 0;
        while($row = $result->fetch_assoc()) {
            if ($count % 3 == 0) echo '<div class="row">';
    ?>
        <div class="card">
            <img src="<?= $row['image_url'] ?>" alt="<?= $row['title'] ?>">
            <div class="card-content">
                <h3><?= $row['title'] ?></h3>
                <p><?= $row['description'] ?></p>
                <a href="<?= $row['link'] ?>">Read More ➞</a>
            </div>
        </div>
    <?php
            $count++;
            if ($count % 3 == 0) echo '</div>';
        }
        if ($count % 3 != 0) echo '</div>'; // Close last row if incomplete
    } else {
        echo "<p>No cards found!</p>";
    }
    $conn->close();
    ?>
</div>


    
    <!-- Footer -->
    <footer>
    <button style="border-radius:10%; height:30px; width:100px; background-color:red; border-color:black; border-width:3px" ><a href="user_logout.php" style="text-decoration: none; color:white;"><b>Logout</b></a></button>
    
        <div class="footer-container">
            <p>&copy; 2025 Your Company. All Rights Reserved.</p>
            <p>
                <a href="#privacy-policy">Privacy Policy</a> |
                <a href="#terms-of-service">Terms of Service</a> |
                <a href="#contact-us">Contact Us</a>
            </p>
            <div class="footer-social">
                <a href="https://facebook.com" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="https://twitter.com" target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a>
                <a href="https://instagram.com" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="https://linkedin.com" target="_blank" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </footer>

</body>
</html>

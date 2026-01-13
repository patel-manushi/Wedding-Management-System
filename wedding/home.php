<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<header>
    <div class="navbar">
        <div class="logo">
            <a href="home.php">
                <img src="source images/logo.png" alt="TVW Logo" style="height: 80px;">
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


<!-- About Section -->
<section class="about">
    <h2>About <span>The Velvet Weddings</span></h2>
    <p><strong>'The Velvet Weddings'</strong> entered the Indian wedding planning industry in 2016 and has since been an integral part of hosting many beautiful weddings.</p>
    <p>Our young and passionate team transforms dreams into reality with elegant decor, smooth execution, and unforgettable celebrations. We strive to redefine wedding planning by combining tradition and modern flair.</p>
    <a href="about.php" class="btn">Read More</a>
</section>

<!-- Services Section -->
<section class="services">
    <h2>Our <span>Services</span></h2>
    <div class="services-container">
        <div class="service-card">
            <h3>Design</h3>
            <p>Design & Décor</p>
            <p>Bring your vision to life with stunning venues, floral arrangements, and personalized themes.</p>
        </div>
        <div class="service-card">
            <h3>Musical</h3>
            <p>Entertainment</p>
            <p>Live music, DJs, folk dancers and stunning light shows for lively celebrations.</p>
        </div>
        <div class="service-card">
            <h3>Destination</h3>
            <p>Weddings</p>
            <p>Celebrate at exotic venues with our expert team handling everything end-to-end.</p>
        </div>
        <div class="service-card">
            <h3>Management</h3>
            <p>Vendor Management</p>
            <p>Effortless coordination with photographers, caterers, decorators and more.</p>
        </div>
        <div class="service-card">
            <h3>Transportation</h3>
            <p>Hospitality & Travel</p>
            <p>Seamless travel arrangements and VIP guest hospitality services.</p>
        </div>
        <div class="service-card">
            <h3>Budget</h3>
            <p>Management</p>
            <p>Plan your dream wedding within your budget with expert cost control strategies.</p>
        </div>
    </div>
</section>

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

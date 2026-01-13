<?php
// about.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<style>
    /* Resetting some default styles */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  
}

/* Body Styles */
body {
  font-family: 'Georgia', serif;
  line-height: 1.6;
  background-color: #e0f7fa; /* Light blue background */
  color: #333;
  padding: 0;
  margin: 0;
}

/* Main Container */
.container {
  width: 80%;
  margin: 0 auto;
  padding: 30px;
  background-color: #fff;
  box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
  border-radius: 10px;
}

/* Heading Styles */
h1 {
  font-size: 36px;
  font-weight: 700;
  color: #d8a7a1;
  text-align: center;
  margin-bottom: 20px;
}

h2 {
  font-size: 28px;
  color: #555;
  margin-bottom: 15px;
}

h3 {
  font-size: 20px;
  color: #777;
  margin-bottom: 15px;
}

/* Section Styles */
section {
  margin-bottom: 30px;
}

/* About Us Paragraph */
p {
  font-size: 18px;
  color: #555;
  margin-bottom: 20px;
  line-height: 1.8;
}

/* Mission and Services Section */
section.mission, section.services {
  padding: 20px;
  background-color: #f4f4f4;
  border-radius: 10px;
  margin-bottom: 30px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Added shadow for depth */
  border-left: 6px solid #d8a7a1; /* Left border for a stylish effect */
}

/* Add background box for About Us content */
.about-us {
    background-color: #fff;
    border-radius: 10px;
    padding: 40px;
    box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.1);
    margin-bottom: 40px;
    border-left: 6px solid #d8a7a1; /* Left border for a stylish effect */
}

ul.services-list {
  list-style-type: none;
}

ul.services-list li {
  font-size: 18px;
  margin-bottom: 10px;
  padding-left: 20px;
  position: relative;
}

ul.services-list li::before {
  content: '✔';
  color: #d8a7a1;
  position: absolute;
  left: 0;
  top: 0;
}

</style>
<!-- Navbar -->
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

<body>
    <div class="container">
        <section class="about-us">
            <h2>About Us</h2>
            <p>Welcome to [Your Website Name], where every love story is celebrated, and every wedding is crafted to perfection. We are passionate about turning your wedding dreams into reality with elegance, style, and personalized touches.</p>
            <p>At [Your Website Name], we understand that your wedding day is one of the most important and memorable moments of your life. Our team is dedicated to making sure every detail is taken care of, from the grandest of celebrations to the most intimate of gatherings. Whether you're looking for a traditional ceremony or a modern twist, we bring creativity and professionalism to every aspect of your event.</p>
        </section>

        <section class="mission">
            <h2>Our Mission</h2>
            <p>Our mission is simple: To create weddings that reflect the unique personalities and love stories of each couple. We work with a variety of partners, including florists, photographers, and caterers, to offer the best services and products to suit your needs. Every couple deserves a wedding day that is as extraordinary as their love story, and we're here to make it happen.</p>
        </section>

        <section class="services">
            <h2>Why Choose Us?</h2>
            <ul class="services-list">
                <li>Personalized Planning: We take the time to get to know you and your vision, ensuring your wedding day is everything you’ve dreamed of.</li>
                <li>Expert Team: Our experienced wedding planners and vendors work seamlessly to make sure your event runs smoothly.</li>
                <li>Attention to Detail: From the invitations to the last dance, we focus on every detail to make your day perfect.</li>
                <li>Stress-Free Experience: We handle all the logistics, so you can focus on enjoying the special moments with your loved ones.</li>
            </ul>
        </section>

        <section class="services">
            <h2>Our Services</h2>
            <ul class="services-list">
                <li>Wedding Planning & Coordination</li>
                <li>Venue Selection & Design</li>
                <li>Catering & Menu Design</li>
                <li>Floral & Decor Arrangements</li>
                <li>Photography & Videography</li>
                <li>Entertainment & Music</li>
            </ul>
        </section>
    </div>

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
                <a href="https://facebook.com" target="_blank" title="Facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://twitter.com" target="_blank" title="Twitter">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="https://instagram.com" target="_blank" title="Instagram">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="https://linkedin.com" target="_blank" title="LinkedIn">
                    <i class="fab fa-linkedin-in"></i>
                </a>
            </div>
        </div>
    </footer>
</body>
</html>

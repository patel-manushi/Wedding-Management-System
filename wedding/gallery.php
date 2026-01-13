<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
     
        /* Gallery Section */
        .gallery {
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* 3-column grid */
            gap: 20px;
            padding: 50px;
            background-color: #e0f7fa; /* Light blue background */
        }

        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            height: 300px; /* Fixed height for all gallery boxes */
            background-color: #e0f7fa; /* Light blue background */
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Ensures images fit the box without distortion */
            transition: transform 0.3s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.05); /* Subtle zoom effect on hover */
        }

        /* Text Overlay */
        .gallery-item .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .gallery-item:hover .overlay {
            opacity: 1;
        }

        .overlay-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #fff;
            font-size: 20px;
            font-weight: bold;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7);
        }

        /* Title and Description for Gallery */
        .gallery-description {
            text-align: center;
            margin-top: 20px;
            font-size: 24px;
            font-weight: 600;
            color: #333;
        }

        /* Content Section */
        .gallery-content {
            text-align: center;
            font-size: 18px;
            color: #666;
            margin: 40px 0;
            line-height: 1.6;
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
 

    <!-- Gallery Description -->
    <div class="gallery-description">
        <h2>Wedding Planner Gallery</h2>
        <p>Explore the beautiful moments captured at weddings we've organized. From stunning decor to joyful ceremonies, we bring your dream wedding to life!</p>
    </div>

    <!-- Gallery Items (Photos) -->
    <div class="gallery">
        <div class="gallery-item">
            <img src="source images\1jpg.jpg" alt="Wedding Image 1">
            <div class="overlay">
                <div class="overlay-text">Wedding Ceremony</div>
            </div>
        </div>
        <div class="gallery-item">
            <img src="source images\2jpg.jpg" alt="Wedding Image 2">
            <div class="overlay">
                <div class="overlay-text">Glamorous Decor</div>
            </div>
        </div>
        <div class="gallery-item">
            <img src="source images\3jpg.jpg" alt="Wedding Image 3">
            <div class="overlay">
                <div class="overlay-text">Bridal Bouquet</div>
            </div>
        </div>
        <div class="gallery-item">
            <img src="source images\4jpg.jpg" alt="Wedding Image 4">
            <div class="overlay">
                <div class="overlay-text">First Dance</div>
            </div>
        </div>
        <div class="gallery-item">
            <img src="source images\5jpg.jpg" alt="Wedding Image 5">
            <div class="overlay">
                <div class="overlay-text">Wedding Cake</div>
            </div>
        </div>
        <div class="gallery-item">
            <img src="source images\6jpg.jpg" alt="Wedding Image 6">
            <div class="overlay">
                <div class="overlay-text">Reception Hall</div>
            </div>
        </div>
        <div class="gallery-item">
            <img src="source images\7jpg.jpg" alt="Wedding Image 7">
            <div class="overlay">
                <div class="overlay-text">Couple's Portrait</div>
            </div>
        </div>
        <div class="gallery-item">
            <img src="source images\8jpg.jpg" alt="Wedding Image 8">
            <div class="overlay">
                <div class="overlay-text">Bride and Bridesmaids</div>
            </div>
        </div>
        <div class="gallery-item">
            <img src="source images\9jpg.jpg" alt="Wedding Image 9">
            <div class="overlay">
                <div class="overlay-text">Groom and Groomsmen</div>
            </div>
        </div>
    </div>

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

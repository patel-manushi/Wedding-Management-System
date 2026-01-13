<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    
</head>
<style>
 /* Import Google Font */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

/* Contact Form Section */
.contact-form {
  margin: 50px auto;
  background: linear-gradient(135deg, #e3f2fd, #bbdefb);
  padding: 50px 30px;
  max-width: 600px;
  border-radius: 16px;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
  font-family: 'Poppins', sans-serif;
}

/* Heading */
.contact-form h2 {
  text-align: center;
  font-size: 2.2rem;
  color: #0d47a1;
  margin-bottom: 10px;
  font-weight: 600;
  letter-spacing: 1px;
}

/* Sub-heading Paragraph */
.contact-form p {
  text-align: center;
  font-size: 1.1rem;
  color: #555;
  margin-bottom: 30px;
}

/* Form Fields */
.contact-form form {
  display: flex;
  flex-direction: column;
  gap: 20px;
  align-items: center;
}

/* Input and Textarea */
.contact-form input[type="text"],
.contact-form input[type="email"],
.contact-form textarea {
  width: 90%;
  padding: 15px;
  border: 2px solid #90caf9;
  border-radius: 10px;
  font-size: 1rem;
  background-color: #ffffff;
  transition: all 0.3s ease;
  box-shadow: inset 0 1px 4px rgba(0, 0, 0, 0.05);
}

/* Focus Effect */
.contact-form input[type="text"]:focus,
.contact-form input[type="email"]:focus,
.contact-form textarea:focus {
  border-color: #1e88e5;
  box-shadow: 0 0 8px rgba(30, 136, 229, 0.3);
  outline: none;
}

/* Textarea */
.contact-form textarea {
  resize: vertical;
  min-height: 140px;
}

/* Submit Button */
.contact-form button[type="submit"] {
  width: 50%;
  padding: 15px;
  font-size: 1.1rem;
  font-weight: 600;
  background: linear-gradient(135deg, #42a5f5, #1e88e5);
  color: white;
  border: none;
  border-radius: 10px;
  cursor: pointer;
  transition: all 0.3s ease;
  letter-spacing: 1px;
}

.contact-form button[type="submit"]:hover {
  background: linear-gradient(135deg, #1e88e5, #1565c0);
  transform: translateY(-3px) scale(1.03);
}

/* Responsive Design */
@media (max-width: 768px) {
  .contact-form {
    padding: 30px 20px;
  }

  .contact-form input[type="text"],
  .contact-form input[type="email"],
  .contact-form textarea {
    width: 100%;
  }

  .contact-form button[type="submit"] {
    width: 70%;
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

    
    <!-- Content of your page goes here -->
    <section class="contact-form">
  <h2>Get In Touch</h2>
  <p>We would love to hear from you! Contact us directly by filling this form.</p>
  <form action="https://api.web3forms.com/submit" method="POST">

      <input type="hidden" name="access_key" value="addeb99a-4161-48ac-b52c-5e0da33539e7">

      <input type="text" placeholder="Enter Name" name="name" required>
      <input type="email" placeholder="Enter Email" name="email" required>
      <textarea placeholder="Your Message" name="Message" required></textarea>
      <button type="submit">Send Message</button>
  </form>
</section>
    <!-- Footer -->
    <footer>
    <button style="border-radius:10%; height:30px; width:100px; background-color:red; border-color:black; border-width:3px" ><a href="user_logo\ut.php" style="text-decoration: none; color:white;"><b>Logout</b></a></button>
    
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

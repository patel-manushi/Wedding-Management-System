<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultant</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<style>
 /* Import Google Font */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

/* General Styles */
body {
  background-color: #e0f7fa;
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    color: #444; /* Changed font color */
}

/* Heading */
h1 {
    text-align: center;
    margin-top: 40px;
    color: #0d6efd; /* Changed font color to bright blue */
    font-size: 2.8rem; /* Slightly bigger heading */
    letter-spacing: 2px;
    font-weight: 700;
    text-transform: uppercase;
    font-family: 'Poppins', sans-serif;
    text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.1);
}

/* Image */
img {
    display: block;
    margin: 40px auto 30px;
    width: 400px; /* Made image bigger */
    height: auto;
    border-radius: 20px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

img:hover {
    transform: scale(1.08);
    box-shadow: 0 10px 35px rgba(0, 0, 0, 0.25);
}

/* Dropdowns */
select {
    margin: 40px auto;
    display: block;
    padding: 15px 20px;
    font-size: 1.1rem;
    border-radius: 8px;
    border: 2px solid #ccc;
    width: 80%;
    max-width: 400px;
    box-sizing: border-box;
    background-color: #fff;
    color: #444;
    transition: all 0.3s ease;
}

select:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 12px rgba(13, 110, 253, 0.4);
    outline: none;
}

/* Doctor Container */
#doctorContainer {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    margin-top: 40px;
    gap: 25px;
    padding: 20px;
}

/* Doctor Card */
.doctor-card {
    background-color: #fff;
    border-radius: 18px;
    padding: 25px;
    width: 300px; /* Slightly wider card */
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    text-align: center;
    transition: all 0.3s ease;
    border: 1px solid #eee;
    overflow: hidden;
}

.doctor-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 18px 40px rgba(13, 110, 253, 0.2);
    border-color: #0d6efd;
    cursor: pointer;
}

/* Doctor Info */
.doctor-info h3 {
    color: #0d6efd; /* Matching font color */
    font-size: 1.4rem;
    margin-bottom: 12px;
    font-weight: 700;
    font-family: 'Poppins', sans-serif;
    text-transform: uppercase;
}

.doctor-info p {
    font-size: 1rem;
    color: #666;
    margin-bottom: 15px;
    line-height: 1.6;
}

/* Buttons */
.buttons {
    display: flex;
    justify-content: space-between;
    margin-top: 25px;
    gap: 15px;
    flex-wrap: wrap;
}

/* Action Buttons */
.action-btn {
    flex: 1;
    padding: 14px;
    font-size: 1rem;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    color: white;
    text-align: center;
    text-transform: uppercase;
    font-weight: 600;
    letter-spacing: 1px;
}

.call {
    background-color: #28a745;
}
.call:hover {
    background-color: #218838;
    transform: translateY(-5px);
}

.whatsapp {
    background-color: #25d366;
}
.whatsapp:hover {
    background-color: #1ebe5b;
    transform: translateY(-5px);
}

.location {
    background-color: #0d6efd;
}
.location:hover {
    background-color: #0056b3;
    transform: translateY(-5px);
}

/* Responsive Styling */
@media (max-width: 768px) {
    h1 {
        font-size: 2.2rem;
    }

    img {
        width: 90%; /* Full width on mobile */
    }

    .doctor-card {
        width: 90%;
    }

    select {
        width: 90%;
    }

    .buttons {
        flex-direction: column;
        align-items: center;
    }

    .action-btn {
        width: 100%;
        margin: 10px 0;
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
    
  <img src="source images\c.webp" height="180px" width="300px">
  <h1 style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">Consultate With Our Best Wedding Planner</h1>

  <select id="citySelect">
    <option value="">Select City</option>
    <option value="ahmedabad">Ahmedabad</option>
    <option value="surat">Surat</option>
    <option value="patan">Patan</option>
  </select>

  <select id="areaSelect" disabled>
    <option value="">Select Area</option>
  </select>

  <div id="doctorContainer"></div>

  <script>
    const citySelect = document.getElementById('citySelect');
    const areaSelect = document.getElementById('areaSelect');
    const doctorContainer = document.getElementById('doctorContainer');

    const areaData = {
      ahmedabad: ["Chandkheda", "Thaltej", "Sabarmati"],
      surat: ["Piplod", "Vesu", "Adajan", "Udhna"],
      patan: ["Sidhpur", "Chanasma", "Harij"]
    };

    const doctors = {
      chandkheda: [
        {
          name: "Ravi Bhai Patel",
          experience: "8 years",
          fees: "₹600",
          phone: "+911111111111",
          whatsapp: "+911111111111",
          location: "Chandkheda, Ahmedabad"
        },
        {
          name: "Manish Bhai Mehta",
          experience: "12 years",
          fees: "₹800",
          image: "source\per.png",
          phone: "+912222222222",
          whatsapp: "+912222222222",
          location: "Chandkheda, Ahmedabad"
        }
      ],
      thaltej: [
        {
          name: "Sonal Ben Desai",
          experience: "10 years",
          fees: "₹700",
          image: "source\per.png",
          phone: "+913333333333",
          whatsapp: "+913333333333",
          location: "Thaltej, Ahmedabad"
        },
        {
          name: "Karan Bhai Patel",
          experience: "9 years",
          fees: "₹650",
          image: "source\per.png",
          phone: "+914444444444",
          whatsapp: "+914444444444",
          location: "Thaltej, Ahmedabad"
        }
      ],
      // Add remaining areas with placeholder image
      sabarmati: [
        {
          name: "Ayesha Ben Thakkar",
          experience: "5 years",
          fees: "₹500",
          image: "source\per.png",
          phone: "+915555555555",
          whatsapp: "+915555555555",
          location: "Sabarmati, Ahmedabad"
        },
        {
          name: "Raj Bhai Joshi",
          experience: "7 years",
          fees: "₹750",
          image: "source\per.png",
          phone: "+916666666666",
          whatsapp: "+916666666666",
          location: "Sabarmati, Ahmedabad"
        }
      ],
      piplod: [
        {
          name: "Neha Ben Soni",
          experience: "6 years",
          fees: "₹550",
          image: "source\per.png",
          phone: "+917777777777",
          whatsapp: "+917777777777",
          location: "Piplod, Surat"
        },
        {
          name: "Mihir Bhai Shah",
          experience: "10 years",
          fees: "₹950",
          image: "source\per.png",
          phone: "+918888888888",
          whatsapp: "+918888888888",
          location: "Piplod, Surat"
        }
      ],
      // Add other areas similarly...
    };

    citySelect.addEventListener('change', () => {
      const selectedCity = citySelect.value;
      areaSelect.innerHTML = `<option value="">Select Area</option>`;
      areaSelect.disabled = true;
      doctorContainer.innerHTML = "";

      if (areaData[selectedCity]) {
        areaData[selectedCity].forEach(area => {
          const val = area.toLowerCase();
          const opt = document.createElement("option");
          opt.value = val;
          opt.textContent = area;
          areaSelect.appendChild(opt);
        });
        areaSelect.disabled = false;
      }
    });

    areaSelect.addEventListener('change', () => {
      const selectedArea = areaSelect.value;
      doctorContainer.innerHTML = "";

      if (doctors[selectedArea]) {
        doctors[selectedArea].forEach(doc => {
          const card = document.createElement("div");
          card.className = "doctor-card";
          card.innerHTML = `
            <div class="doctor-info">
              <h3>${doc.name}</h3>
              <p><strong>Experience:</strong> ${doc.experience}</p>
              <p><strong>Consultation Fee:</strong> ${doc.fees}</p>
              <div class="buttons">
                <button class="action-btn call" onclick="window.location.href='tel:${doc.phone}'">📞 Call</button>
                <button class="action-btn whatsapp" onclick="window.open('https://wa.me/${doc.whatsapp.replace('+','')}', '_blank')">💬 WhatsApp</button>
                <button class="action-btn location" onclick="openMap('${doc.location}')">📍 Location</button>
              </div>
            </div>
          `;
          doctorContainer.appendChild(card);
        });
      }
    });

    function openMap(location) {
      const url = `https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(location)}`;
      window.open(url, '_blank');
    }
  </script>
    <!-- Footer -->
    <footer>
    <button style="border-radius:10%; height:30px; width:100px; background-color:red; border-color:black; border-width:3px" ><a href="logout.php" style="text-decoration: none; color:white;"><b>Logout</b></a></button>
    
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

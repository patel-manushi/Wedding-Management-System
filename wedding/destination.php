<?php
// Connect to MySQL Database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wedding_planner01"; // Change to your actual DB name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all destinations
$sql = "SELECT * FROM destination_places";
$result = $conn->query($sql);

// Fetch package details for each destination
$destinations = [];

while($row = $result->fetch_assoc()) {
    $destination_id = $row['id'];
    
    // Fetch Basic and Premium packages for the current destination
    $package_sql = "SELECT * FROM destination_package_types WHERE place_id = $destination_id";
    $package_result = $conn->query($package_sql);
    
    if ($package_result->num_rows > 0) {
        $packages = [];
        while ($package_row = $package_result->fetch_assoc()) {
            $package_id = $package_row['id'];
            
            // Fetch package features for each package
            $feature_sql = "SELECT * FROM destination_package_features WHERE package_id = $package_id";
            $feature_result = $conn->query($feature_sql);
            $features = [];
            
            while ($feature_row = $feature_result->fetch_assoc()) {
                $features[] = $feature_row['feature_name'];
            }
            
            $package_row['features'] = $features;
            $packages[] = $package_row;
        }
        
        $row['packages'] = $packages;
    } else {
        $row['packages'] = []; // If no packages, set empty array
    }
    
    $destinations[] = $row;
}

// Handle form submission to store user data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $package_type = $_POST['package_type'];
    $destination_name = $_POST['destination_name'];

    // Insert user data into the database
    $insert_sql = "INSERT INTO destination_user_applications (name, phone_number, email, package_type, destination_name) 
                   VALUES ('$name', '$phone_number', '$email', '$package_type', '$destination_name')";
    
    if ($conn->query($insert_sql) === TRUE) {
        echo "Application submitted successfully!";
    } else {
        echo "Error: " . $insert_sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destination Wedding Places</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Additional styles for the form toggle */
.apply-form {
    display: none; /* Hide the form by default */
    margin-top: 20px;
}

/* General Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Basic Page Styles */
body {
    font-family: 'Arial', sans-serif;
    line-height: 1.6;
    background-color: #eaf2f8; /* Light Blue Background */
    color: #003d6b; /* Dark Blue text */
    margin: 0;
    padding: 0;
}

/* Header */
header {
    text-align: center;
    background-color: #1565c0; /* Dark Blue */
    padding: 30px 0;
    color: #ffffff;
}

header h1 {
    font-family: 'Georgia', serif;
    font-size: 38px;
    font-weight: bold;
    letter-spacing: 2px;
}

/* Container */
.container {
    width: 85%;
    max-width: 1200px;
    margin: 30px auto;
}

/* Grid for the destination places */
.destination-grid {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    gap: 30px;
}

/* Individual destination box */
.destination {
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.08);
    width: 48%;
    padding: 25px;
    margin-bottom: 40px;
    transition: transform 0.3s ease;
}

.destination:hover {
    transform: translateY(-5px);
}

/* Image styling */
.destination-image img {
    width: 100%;
    height: 260px;
    object-fit: cover;
    border-radius: 10px;
}

/* Destination content styling */
.destination-content {
    padding-top: 15px;
}

/* Destination name */
.destination h2 {
    font-family: 'Georgia', serif;
    font-size: 26px;
    font-weight: bold;
    color: #003d6b; /* Dark Blue */
}

/* Destination description */
.destination p {
    font-size: 16px;
    color: #444;
    margin-top: 10px;
}

/* Packages grid for Basic and Premium */
.packages-grid {
    display: flex;
    justify-content: space-between;
    gap: 20px;
    margin-top: 20px;
}

/* Package box styling */
.package {
    background-color: #f0f8ff; /* Alice Blue */
    border-radius: 10px;
    padding: 20px;
    width: 48%;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.06);
    transition: transform 0.3s ease;
}

.package:hover {
    transform: scale(1.02);
}

.package h3 {
    font-size: 22px;
    font-family: 'Georgia', serif;
    font-weight: bold;
    margin-bottom: 10px;
}

.package p {
    font-size: 15px;
    color: #333;
    margin-bottom: 10px;
}

.package ul {
    list-style-type: disc;
    padding-left: 18px;
    font-size: 14px;
}

.package ul li {
    color: #333;
    margin-bottom: 6px;
}

/* Basic package styling */
.package.basic {
    background-color: #cce7ff; /* Light Blue */
    border: 2px solid #1e88e5; /* Blue */
}

.package.basic h3 {
    color: #1e88e5;
}

/* Premium package styling */
.package.premium {
    background-color: #d6eaff; /* Softer Blue */
    border: 2px solid #1565c0; /* Darker Blue */
}

.package.premium h3 {
    color: #1565c0;
}

/* Booking Form */
form {
    margin-top: 25px;
    display: flex;
    flex-direction: column;
    background: #ffffff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
}

form div {
    margin-bottom: 15px;
}

form label {
    font-size: 16px;
    color: #333;
}

form input {
    padding: 10px;
    font-size: 15px;
    margin-top: 6px;
    border: 1px solid #ccc;
    border-radius: 6px;
    width: 100%;
}

form button {
    background-color: #1565c0; /* Button Blue */
    color: white;
    padding: 12px 25px;
    font-size: 17px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background 0.3s ease;
}

form button:hover {
    background-color: #1e88e5; /* Lighter Blue */
}

/* Center the Apply Now button */
.apply-now-btn {
    display: block;
    width: 100%;
    background-color: #1e88e5;
    color: white;
    padding: 12px;
    font-size: 16px;
    text-align: center;
    cursor: pointer;
    border: none;
    border-radius: 6px;
    margin-top: 15px;
}

.apply-now-btn:hover {
    background-color: #1565c0;
}

/* Responsive Design */
@media (max-width: 768px) {
    .destination-grid,
    .packages-grid {
        flex-direction: column;
    }

    .destination,
    .package {
        width: 100%;
    }
}

    </style>
</head>
<body>
    <header>
        <h1>Destination Wedding Packages</h1>
    </header>
    
    <section class="container">
        <?php if(count($destinations) > 0): ?>
            <div class="destination-grid">
                <?php foreach ($destinations as $destination): ?>
                    <div class="destination">
                        <div class="destination-image">
                            <img src="<?php echo $destination['image_url']; ?>" alt="<?php echo $destination['location_name']; ?>">
                        </div>
                        <div class="destination-content">
                            <h2><?php echo $destination['location_name']; ?></h2>
                            <p><?php echo $destination['description']; ?></p>

                            <div class="packages">
                                <?php if(count($destination['packages']) > 0): ?>
                                    <div class="packages-grid">
                                        <?php foreach ($destination['packages'] as $package): ?>
                                            <div class="package <?php echo strtolower($package['package_type']); ?>">
                                                <h3><?php echo $package['package_type']; ?> Package</h3>
                                                <p><strong>Price:</strong> ₹<?php echo number_format($package['price']); ?></p>
                                                <p><strong>Max Guests:</strong> <?php echo $package['max_guests']; ?></p>
                                                <p><strong>Description:</strong> <?php echo $package['description']; ?></p>

                                                <h4>Features:</h4>
                                                <ul>
                                                    <?php foreach ($package['features'] as $feature): ?>
                                                        <li><?php echo $feature; ?></li>
                                                    <?php endforeach; ?>
                                                </ul>

      <!-- Apply Now Button -->
  <button class="apply-now-btn" onclick="toggleForm('<?php echo $package['package_type']; ?>', '<?php echo $destination['location_name']; ?>')">Apply Now</button>

                                                <!-- Form for application (hidden by default) -->
                                                <div class="apply-form" id="form-<?php echo $package['package_type']; ?>-<?php echo $destination['location_name']; ?>">
                                                    <form action="destination.php" method="POST">
                                                        <input type="hidden" name="destination_name" value="<?php echo $destination['location_name']; ?>">
                                                        <input type="hidden" name="package_type" value="<?php echo $package['package_type']; ?>">
                                                        
                                                        <div>
                                                            <label for="name">Name:</label>
                                                            <input type="text" name="name" id="name" required>
                                                        </div>
                                                        <div>
                                                            <label for="phone_number">Phone Number:</label>
                                                            <input type="text" name="phone_number" id="phone_number" required>
                                                        </div>
                                                        <div>
                                                            <label for="email">Email ID:</label>
                                                            <input type="email" name="email" id="email" required>
                                                        </div>
                                                        <button type="submit">Submit</button>
                                                    </form>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php else: ?>
                                    <p>No packages available for this destination.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No destinations found.</p>
        <?php endif; ?>
    </section>

    <script>
        // Toggle visibility of the form when Apply Now button is clicked
        function toggleForm(packageType, destinationName) {
            var formId = 'form-' + packageType + '-' + destinationName;
            var form = document.getElementById(formId);
            
            // Toggle form visibility
            if (form.style.display === "none" || form.style.display === "") {
                form.style.display = "block";
            } else {
                form.style.display = "none";
            }
        }
    </script>
</body>
</html>
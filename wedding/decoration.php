
<?php
$conn = new mysqli("localhost", "root", "", "wedding_planner01");

// Handle form submission
$total = null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $budget = $_POST['budget'];
    $theme = $_POST['theme'];
    $areas = implode(",", $_POST['areas']);
    $sofa = $_POST['sofa_qty'];
    $chair = $_POST['chair_qty'];
    $flower = $_POST['flower'];
    $lighting = $_POST['lighting'];
    $contact = $_POST['contact'];
    $date = $_POST['event_date'];
    $time = $_POST['event_time'];

    $themePrice = $conn->query("SELECT price FROM decoration_themes WHERE id=$theme")->fetch_assoc()['price'];
    $flowerPrice = $conn->query("SELECT price FROM decoration_flowers WHERE id=$flower")->fetch_assoc()['price'];
    $lightingPrice = $conn->query("SELECT price FROM decoration_lighting WHERE id=$lighting")->fetch_assoc()['price'];

    $areaPrices = 0;
    foreach ($_POST['areas'] as $areaId) {
        $areaPrices += $conn->query("SELECT price FROM decoration_areas WHERE id=$areaId")->fetch_assoc()['price'];
    }

    $furniture = $conn->query("SELECT name, price FROM decoration_furniture");
    $furniturePrices = [];
    while ($row = $furniture->fetch_assoc()) {
        $furniturePrices[$row['name']] = $row['price'];
    }

    $sofaPrice = $sofa * $furniturePrices['sofa'];
    $chairPrice = $chair * $furniturePrices['chair'];

    $total = $themePrice + $areaPrices + $sofaPrice + $chairPrice + $flowerPrice + $lightingPrice;

    if ($total <= $budget) {
        $stmt = $conn->prepare("INSERT INTO decoration_bookings (budget, theme_id, area_ids, sofa_qty, chair_qty, flower_id, lighting_id, contact, event_date, event_time, total_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iisiiiisssi", $budget, $theme, $areas, $sofa, $chair, $flower, $lighting, $contact, $date, $time, $total);
        $stmt->execute();
        echo "<div style='color: green; text-align:center; font-weight:bold;'>Booking successful! Total: ₹$total</div>";
    } else {
       
    }
}

$themes = $conn->query("SELECT * FROM decoration_themes");
$areas = $conn->query("SELECT * FROM decoration_areas");
$furniture = $conn->query("SELECT * FROM decoration_furniture");
$flowers = $conn->query("SELECT * FROM decoration_flowers");
$lighting = $conn->query("SELECT * FROM decoration_lighting");
?>

<!DOCTYPE html>
<html>
<head>
    <title> Decoration </title>
    <style>
      
/* General Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body Styling */
body {
    font-family: 'Poppins', sans-serif;
    background: #e3f2fd;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    padding: 20px;
    animation: fadeIn 1s ease-in-out;
}

/* Fade In Animation */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Form Container */
form {
    background-color: #ffffff;
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 15px 40px rgba(0, 0, 50, 0.1);
    max-width: 1000px;
    width: 100%;
    transition: transform 0.3s ease;
}

form:hover {
    transform: translateY(-5px);
}

/* Heading */
h2 {
    color: #1565c0;
    text-align: center;
    margin-bottom: 30px;
    font-size: 30px;
    font-weight: 700;
}

/* Labels */
label {
    display: block;
    margin: 20px 0 8px;
    font-weight: 600;
    color: #0d47a1;
}

/* Input, Select Styling */
select,
input[type="number"],
input[type="text"],
input[type="date"],
input[type="time"] {
    width: 100%;
    padding: 12px 15px;
    border: 2px solid #90caf9;
    border-radius: 10px;
    font-size: 16px;
    background-color: #e3f2fd;
    transition: all 0.3s ease;
    color: #333;
}

select:focus,
input:focus {
    border-color: #42a5f5;
    background-color: #ffffff;
    outline: none;
}

/* Hover Effects */
select:hover,
input[type="number"]:hover,
input[type="text"]:hover,
input[type="date"]:hover,
input[type="time"]:hover {
    background-color: #f0faff;
    box-shadow: 0 0 8px rgba(33, 150, 243, 0.2);
}

/* Checkbox Group */
.checkbox-group {
    margin-top: 8px;
    padding-left: 8px;
}

.checkbox-group label {
    display: block;
    background-color: #e3f2fd;
    padding: 10px 14px;
    border-radius: 8px;
    margin: 8px 0;
    font-weight: 500;
    transition: background-color 0.3s ease;
    cursor: pointer;
}

.checkbox-group label:hover {
    background-color: #bbdefb;
}

input[type="checkbox"] {
    margin-right: 10px;
    transform: scale(1.2);
    accent-color: #1565c0;
}

/* Submit Button */
.submit-btn {
    background: linear-gradient(135deg, #1565c0, #42a5f5);
    color: white;
    font-size: 18px;
    font-weight: 600;
    padding: 14px 0;
    border: none;
    border-radius: 12px;
    width: 100%;
    margin-top: 35px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.submit-btn:hover {
    background: linear-gradient(135deg, #0d47a1, #2196f3);
    transform: scale(1.02);
}

/* Total Display Styling */
.total-display {
    margin-top: 25px;
    font-size: 20px;
    text-align: center;
    font-weight: bold;
    color: #1565c0;
    background-color: #e3f2fd;
    padding: 12px;
    border-radius: 10px;
    margin-bottom: 10px;
}

/* Responsive */
@media (max-width: 768px) {
    form {
        padding: 25px;
    }

    h2 {
        font-size: 26px;
    }
}

     
   
    </style>
</head>
<body>

<form method="post" action="decoration.php">
    <h2> Decoration </h2>

    <label>Budget (₹):</label>
    <input type="number" name="budget" required>

    <label>Decoration Theme:</label>
    <select name="theme" class="hover" required>
        <?php while ($row = $themes->fetch_assoc()) {
            echo "<option value='{$row['id']}'>{$row['name']} - ₹{$row['price']}</option>";
        } ?>
    </select>

    <label>Decoration Areas:</label>
    <div class="checkbox-group">
        <?php while ($row = $areas->fetch_assoc()) {
            echo "<label class='hover'><input type='checkbox' name='areas[]' value='{$row['id']}'> {$row['name']} - ₹{$row['price']}</label>";
        } ?>
    </div>

    <label>Number of Sofas:</label>
    <input type="number" name="sofa_qty" value="0">

    <label>Number of Chairs:</label>
    <input type="number" name="chair_qty" value="0">

    <label>Flower Selection:</label>
    <select name="flower" class="hover" required>
        <?php while ($row = $flowers->fetch_assoc()) {
            echo "<option value='{$row['id']}'>{$row['name']} - ₹{$row['price']}</option>";
        } ?>
    </select>

    <label>Lighting Type:</label>
    <select name="lighting" class="hover" required>
        <?php while ($row = $lighting->fetch_assoc()) {
            echo "<option value='{$row['id']}'>{$row['name']} - ₹{$row['price']}</option>";
        } ?>
    </select>

    <label>Contact Number:</label>
    <input type="text" name="contact" required>

    <label>Event Date:</label>
    <input type="date" name="event_date" required>

    <label>Event Time:</label>
    <input type="time" name="event_time" required>

    <button type="submit" class="submit-btn">Submit Booking</button>

    <?php if ($total !== null): ?>
        <div class="total-display">Total Cost: ₹<?php echo $total; ?></div>
    <?php endif; ?>
</form>

</body>
</html>

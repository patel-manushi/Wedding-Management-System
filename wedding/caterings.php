<?php
$conn = mysqli_connect("localhost", "root", "", "wedding_planner01");

function getPrice($conn, $id) {
    $res = mysqli_query($conn, "SELECT price_per_person FROM catering_custom_items WHERE id = $id");
    $data = mysqli_fetch_assoc($res);
    return $data ? $data['price_per_person'] : 0;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit_fixed'])) {
        $dish_id = $_POST['dish_id'];
        $people = $_POST['people'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];

        $price = mysqli_fetch_assoc(mysqli_query($conn, "SELECT price_per_person FROM catering_fixed_dishes WHERE id = $dish_id"))['price_per_person'];
        $total = $price * $people;

        mysqli_query($conn, "INSERT INTO catering_fixed_orders (dish_id, people, total_price, customer_name, phone, email)
                            VALUES ($dish_id, $people, $total, '$name', '$phone', '$email')");
        echo "<script>alert('Fixed order placed!');</script>";
    }

    if (isset($_POST['submit_custom'])) {
        $item_ids = $_POST['items'];
        $people = $_POST['people'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];

        $total = 0;
        foreach ($item_ids as $id) {
            $total += getPrice($conn, $id);
        }

        $total_price = $total * $people;
        $items_json = json_encode($item_ids);

        mysqli_query($conn, "INSERT INTO catering_custom_orders (items_json, people, total_price, customer_name, phone, email)
                            VALUES ('$items_json', $people, $total_price, '$name', '$phone', '$email')");
        echo "<script>alert('Custom order placed!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Catering</title>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Great+Vibes&family=Poppins:wght@300;400;600&display=swap');

body {
    font-family: 'Poppins', sans-serif;
    background: #f0f8ff;
    color: #333;
    margin: 0;
    padding: 0;
    font-size: 18px; /* Increased base font size */
}

h2, h3 {
    font-family: 'Great Vibes', cursive;
    font-size: 48px; /* Larger font size for headings */
    color: #0047ab;
    text-align: center;
    margin-top: 40px;
}

.container {
    display: flex;
    margin-left: 120px;
    gap: 20px;  
    margin-top: 30px;
    overflow-x: auto;
    padding-bottom: 20px;
}

.card-container {
    display: flex;
    justify-content: flex-start;
    flex-wrap: nowrap;
}

.card {
    width: 280px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 6px 18px rgba(0, 71, 171, 0.2);
    transition: transform 0.2s ease;
    padding: 15px; /* Increased padding for more spacious cards */
}

.card:hover {
    transform: translateY(-5px);
}

.card img {
    width: 100%;
    height: 220px; /* Slightly larger image */
    object-fit: cover;
    border-radius: 14px;
}

.card h4 {
    font-size: 24px; /* Increased font size for service titles */
    color: #002855;
    margin: 15px 0 8px;
}

.card p {
    font-size: 16px; /* Increased paragraph font size */
    color: #555;
    margin-bottom: 10px;
}

.card strong {
    font-size: 18px; /* Increased font size for price */
    color: #0047ab;
    display: block;
    margin-bottom: 15px;
}

.card form input,
.card form button {
    width: 90%;
    padding: 12px;
    font-size: 16px; /* Larger input font size */
    margin-top: 20px;
    border-radius: 30px;
    border: 1px solid #ccc;
}

.card form button {
    background: linear-gradient(135deg, #007bff, #3399ff);
    color: white;
    font-weight: bold;
    border: none;
    transition: background 0.3s;
}

.card form button:hover {
    background: linear-gradient(135deg, #0056b3, #007bff);
}

.section {
    margin-top: 80px;
    padding: 30px; /* More padding for sections */
}

#customMealForm {
    background: #fff;
    padding: 50px;
    border-radius: 20px;
    max-width: 700px;
    margin: auto;
    box-shadow: 0 10px 30px rgba(0, 71, 171, 0.2);
}

#customMealForm h3 {
    color: #0047ab;
    font-size: 32px; /* Larger form heading */
    margin-bottom: 15px;
}

#customMealForm label {
    font-weight: 600;
    color: #333;
    font-size: 16px; /* Larger label font size */
}

#customMealForm select,
#customMealForm input[type="number"],
#customMealForm input[type="text"],
#customMealForm input[type="tel"],
#customMealForm input[type="email"] {
    width: 100%;
    padding: 16px; /* Larger padding for inputs */
    font-size: 16px; /* Larger font size for inputs */
    margin-top: 6px;
    border-radius: 10px;
    border: 1px solid #ccc;
    margin-bottom: 20px;
}

.starter-list {
    margin-bottom: 25px;
}

.starter-item {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px dashed #eee;
    font-size: 18px; /* Larger font size for starter items */
}

.starter-item input[type="checkbox"] {
    transform: scale(1.5); /* Larger checkboxes */
    accent-color: #0047ab;
}

#customMealForm button {
    background: linear-gradient(135deg, #007bff, #3399ff);
    border: none;
    color: white;
    padding: 16px 25px; /* Larger padding for buttons */
    font-size: 18px; /* Larger button font size */
    border-radius: 30px;
    cursor: pointer;
    font-weight: bold;
    margin-top: 15px;
}

#customMealForm button:hover {
    background: linear-gradient(135deg, #0056b3, #007bff);
}

.total-price {
    text-align: right;
    font-size: 22px; /* Larger font size for total price */
    font-weight: bold;
    color: #0047ab;
    margin-top: 15px;
}

@media (max-width: 768px) {
    .container {
        flex-direction: column;
        align-items: center;
    }

    .card {
        width: 90%;
    }

    #customMealForm {
        padding: 25px;
    }
}


</style>

</head>
<body>

<h2>📦 Fixed Menu Dishes</h2>
<br>
<div class="container">
    <?php
    $dishes = mysqli_query($conn, "SELECT * FROM catering_fixed_dishes");
    while ($row = mysqli_fetch_assoc($dishes)) {
        $dishId = $row['id'];
        $price = $row['price_per_person'];
        ?>
        <div class="card">
            <img src="<?= $row['image'] ?>" alt="">
            <h4><?= $row['name'] ?> (<?= $row['type'] ?>)</h4>
            <p><?= $row['description'] ?></p>
            <strong>₹<?= $price ?>/person</strong>

            <form method="POST" id="form_<?= $dishId ?>" action="caterings.php">
                <input type="hidden" name="dish_id" value="<?= $dishId ?>">
                <input type="number" name="people" placeholder="People" required oninput="calculateTotal(<?= $dishId ?>, <?= $price ?>)">
                <div id="total_<?= $dishId ?>" style="margin-top: 5px; font-weight: bold;"></div>

                <div id="contact_<?= $dishId ?>" style="display: none;">
                    <input type="text" name="name" placeholder="Name" required>
                    <input type="tel" name="phone" placeholder="Phone" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <button type="submit" name="submit_fixed">Apply</button>
                </div>
                <button type="button" onclick="showContact(<?= $dishId ?>)">Next</button>
            </form>
        </div>
    <?php } ?>
</div>

<script>
    function calculateTotal(id, price) {
        const people = document.querySelector(`#form_${id} input[name='people']`).value;
        const total = people * price;
        const totalDiv = document.getElementById('total_' + id);
        if (!isNaN(total) && people > 0) {
            totalDiv.innerHTML = "Total: ₹" + total;
        } else {
            totalDiv.innerHTML = "";
        }
    }

    function showContact(id) {
        const peopleInput = document.querySelector(`#form_${id} input[name='people']`);
        if (peopleInput.value > 0) {
            document.getElementById('contact_' + id).style.display = 'block';
        } else {
            alert("Please enter the number of people first.");
        }
    }
</script>

<div class="section">
    <h2>🛠️ Customize Your Meal</h2>
    <br>
    
    <form method="POST" id="customMealForm" action="caterings.php">
        <h3>🥟 Starters</h3>
        <div class="starter-list">
            <?php
            $starters = mysqli_query($conn, "SELECT * FROM catering_custom_items WHERE category='starter'");
            while ($item = mysqli_fetch_assoc($starters)) {
                echo "
                <div class='starter-item'>
                    <span>{$item['name']} (₹{$item['price_per_person']})</span>
                    <input type='checkbox' name='items[]' value='{$item['id']}' data-price='{$item['price_per_person']}' onchange='updateCustomTotal()'>
                </div>";
            }
            ?>
        </div>

        <h3>🍽️ Main Course</h3>
        <?php
        $categories = ['sweet', 'subji', 'roti', 'dal', 'rice', 'fries', 'drink'];
        foreach ($categories as $cat) {
            $items = mysqli_query($conn, "SELECT * FROM catering_custom_items WHERE category='$cat' LIMIT 2");
            echo "<label>" . ucfirst($cat) . ":</label><select name='items[]' onchange='updateCustomTotal()'>";
            while ($item = mysqli_fetch_assoc($items)) {
                echo "<option value='{$item['id']}' data-price='{$item['price_per_person']}'>{$item['name']} (₹{$item['price_per_person']})</option>";
            }
            echo "</select><br><br>";
        }
        ?>
         <input type="number" name="people" placeholder="People" oninput="updateCustomTotal()" required>
        <div id="customTotal" class="total-price"></div>

        <div id="customContact" style="display: none;">
            <input type="text" name="name" placeholder="Name" required>
            <input type="tel" name="phone" placeholder="Phone" required>
            <input type="email" name="email" placeholder="Email" required>
            <button type="submit" name="submit_custom">Apply</button>
        </div>
        <button type="button" onclick="showCustomContact()">Next</button>
    </form>
</div>

<script>
    function updateCustomTotal() {
        let total = 0;
        const form = document.getElementById('customMealForm');
        const checkboxes = form.querySelectorAll("input[type='checkbox']:checked");
        const selects = form.querySelectorAll("select");

        checkboxes.forEach(cb => {
            total += parseFloat(cb.dataset.price);
        });

        selects.forEach(sel => {
            const selectedOption = sel.options[sel.selectedIndex];
            total += parseFloat(selectedOption.dataset.price);
        });

        const people = form.querySelector("input[name='people']").value;
        const final = total * (people > 0 ? people : 0);
        document.getElementById('customTotal').innerText = final > 0 ? "Total: ₹" + final : "";
    }

    function showCustomContact() {
        const people = document.querySelector("#customMealForm input[name='people']").value;
        if (people > 0) {
            document.getElementById('customContact').style.display = 'block';
        } else {
            alert("Please enter the number of people first.");
        }
    }
</script>

</body>
</html>


<?php
include 'db.php';
$service = $_GET['service'];

$table_map = [
    'makeup' => 'makeup_applications',
    'hotel' => 'hotel_applications',
    'catering' => 'catering_custom_orders',
    'photographer' => 'photography_bookings',
    'decoration' => 'decoration_bookings',
    'destination' => 'destination_user_applications'
];

if (!isset($table_map[$service])) {
    echo "Invalid service selected.";
    exit;
}

$table = $table_map[$service];
$query = "SELECT * FROM `$table`";
$result = mysqli_query($conn, $query);

if (!$result) {
    echo "Query failed: " . mysqli_error($conn);
    exit;
}

echo "<h2>" . ucfirst($service) . " Bookings</h2>";
echo "<table><tr>";

while ($fieldinfo = mysqli_fetch_field($result)) {
    echo "<th>{$fieldinfo->name}</th>";
}
echo "<th>Actions</th></tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    foreach ($row as $key => $value) {
        echo "<td><input type='text' value='" . htmlspecialchars($value) . "' data-key='$key' data-id='{$row['id']}' data-table='$table'></td>";
    }
    echo "<td class='action-buttons'>
            <button class='update' onclick='updateRow(this)'>Update</button>
            <button class='delete' onclick='deleteRow(this)'>Delete</button>
          </td>";
    echo "</tr>";
}

echo "</table>";
?>

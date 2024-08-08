<?php
include_once 'database.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vehicleID = $_POST['vehicleID'];
    $date = $_POST['date'];
    $description = $_POST['description'];
    $cost = $_POST['cost'];

    $sql = "INSERT INTO Maintenance (VehicleID, Date, Description, Cost) VALUES ('$vehicleID', '$date', '$description', '$cost')";

    if ($conn->query($sql) === TRUE) {
        echo "New maintenance record added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch vehicles for the dropdown
$vehicles_sql = "SELECT VehicleID, Make, Model FROM Vehicle";
$vehicles_result = $conn->query($vehicles_sql);

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Maintenance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <h1>Add New Maintenance Record</h1>
    <a href="view_maintenance.php">Maintenance List</a>
    <form action="add_maintenance.php" method="post">
        <label for="vehicleID">Vehicle:</label>
        <select id="vehicleID" name="vehicleID" required>
            <?php
            if ($vehicles_result->num_rows > 0) {
                while($row = $vehicles_result->fetch_assoc()) {
                    echo "<option value='{$row['VehicleID']}'>{$row['Make']} {$row['Model']}</option>";
                }
            }
            ?>
        </select><br>
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required><br>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea><br>
        <label for="cost">Cost:</label>
        <input type="number" id="cost" name="cost" required step="0.01"><br>
        <input type="submit" value="Add Maintenance">
    </form>
</body>
</html>

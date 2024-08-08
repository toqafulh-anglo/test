<?php
include_once 'database.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vehicleID = $_POST['vehicleID'];
    $date = $_POST['date'];
    $startLocation = $_POST['startLocation'];
    $endLocation = $_POST['endLocation'];
    $distance = $_POST['distance'];

    $sql = "INSERT INTO Trip (VehicleID, Date, StartLocation, EndLocation, Distance) VALUES ('$vehicleID', '$date', '$startLocation', '$endLocation', '$distance')";

    if ($conn->query($sql) === TRUE) {
        echo "New trip record added successfully";
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
    <title>Add Trip</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <h1>Add New Trip Record</h1>
    <a href="view_trips.php">Trip List</a>
    <form action="add_trip.php" method="post">
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
        <label for="startLocation">Start Location:</label>
        <input type="text" id="startLocation" name="startLocation" required><br>
        <label for="endLocation">End Location:</label>
        <input type="text" id="endLocation" name="endLocation" required><br>
        <label for="distance">Distance (km):</label>
        <input type="number" id="distance" name="distance" required step="0.01"><br>
        <input type="submit" value="Add Trip">
    </form>
</body>
</html>

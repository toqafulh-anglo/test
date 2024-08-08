<?php
include_once 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $make = $_POST['make'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $licensePlate = $_POST['licensePlate'];
    $vin = $_POST['vin'];

    $sql = "INSERT INTO Vehicle (Make, Model, Year, LicensePlate, VIN) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiss", $make, $model, $year, $licensePlate, $vin);

    if ($stmt->execute()) {
        echo "New vehicle added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Vehicle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <h1>Add New Vehicle</h1>
    <a href="index.php">Vehicle List</a>
    <form action="add_vehicle.php" method="post">
        <label for="make">Make:</label>
        <input type="text" id="make" name="make" required><br>
        <label for="model">Model:</label>
        <input type="text" id="model" name="model" required><br>
        <label for="year">Year:</label>
        <input type="number" id="year" name="year" required><br>
        <label for="licensePlate">License Plate:</label>
        <input type="text" id="licensePlate" name="licensePlate" required><br>
        <label for="vin">VIN:</label>
        <input type="text" id="vin" name="vin" required><br>
        <input type="submit" value="Add Vehicle">
    </form>
</body>
</html>

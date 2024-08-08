<?php
include_once 'database.php';

$sql = "SELECT * FROM Vehicle";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vehicle List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <h1>Vehicle List</h1>
    <table class="table">
        <tr>
            <th>Vehicle ID</th>
            <th>Make</th>
            <th>Model</th>
            <th>Year</th>
            <th>License Plate</th>
            <th>VIN</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["VehicleID"]. "</td>
                        <td>" . $row["Make"]. "</td>
                        <td>" . $row["Model"]. "</td>
                        <td>" . $row["Year"]. "</td>
                        <td>" . $row["LicensePlate"]. "</td>
                        <td>" . $row["VIN"]. "</td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No vehicles found</td></tr>";
        }
        ?>
    </table>
    <a href="add_vehicle.php">Add New Vehicle</a>
</body>
</html>

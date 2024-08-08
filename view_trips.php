<?php
include_once 'database.php';

$sql = "SELECT Trip.TripID, Vehicle.Make, Vehicle.Model, Trip.Date, Trip.StartLocation, Trip.EndLocation, Trip.Distance 
        FROM Trip 
        JOIN Vehicle ON Trip.VehicleID = Vehicle.VehicleID";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Trips</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <h1>List of Trips</h1>
    <table class="table">
        <tr>
            <th>TripID</th>
            <th>Vehicle</th>
            <th>Date</th>
            <th>Start Location</th>
            <th>End Location</th>
            <th>Distance (km)</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['TripID']}</td>
                        <td>{$row['Make']} {$row['Model']}</td>
                        <td>{$row['Date']}</td>
                        <td>{$row['StartLocation']}</td>
                        <td>{$row['EndLocation']}</td>
                        <td>{$row['Distance']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No trips found</td></tr>";
        }
        ?>
    </table>
</body>
</html>

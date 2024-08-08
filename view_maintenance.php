<?php
include_once 'database.php';

$sql = "SELECT Maintenance.MaintenanceID, Vehicle.Make, Vehicle.Model, Maintenance.Date, Maintenance.Description, Maintenance.Cost 
        FROM Maintenance 
        JOIN Vehicle ON Maintenance.VehicleID = Vehicle.VehicleID";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Maintenance Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <h1>List of Maintenance Records</h1>
    <table class="table">
        <tr>
            <th>MaintenanceID</th>
            <th>Vehicle</th>
            <th>Date</th>
            <th>Description</th>
            <th>Cost</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['MaintenanceID']}</td>
                        <td>{$row['Make']} {$row['Model']}</td>
                        <td>{$row['Date']}</td>
                        <td>{$row['Description']}</td>
                        <td>{$row['Cost']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No maintenance records found</td></tr>";
        }
        ?>
    </table>
</body>
</html>

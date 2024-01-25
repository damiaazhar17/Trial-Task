<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electricity Bill Calculator</title>
    <link rel="stylesheet" href="calculate.css">
</head>
<body>
<header>
    <h1 style="text-align: center;">The Electricity Consumption Charge Calculator</h1>
</header>

<form method="post">
    <label for="voltage">Voltage (V): </label>
    <input type="number" name="voltage" required step="any"><br>

    <label for="current">Current (A): </label>
    <input type="number" name="current" required step="any"><br>

    <label for="rate">Current Rate (sen/kWh): </label>
    <input type="number" name="rate" required step="any"><br>

    <input type="submit" value="Calculate">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $voltage = $_POST["voltage"];
    $current = $_POST["current"];
    $rate = $_POST["rate"];

    // Calculate and display results for a single hour
    echo "<div style='text-align: center;'>";
    echo "<h2>Electricity Rates per Hour</h2>";
    echo "<table border='1' style='margin: 0 auto;'>";
    echo "<tr><th> Hour </th><th> Power (W) </th><th> Energy (kWh) </th><th> Total Charge (RM) </th></tr>";

    $hour = 1;
    // Calculate Power (W)
    $power = $voltage * $current;

    // Calculate Energy (kWh)
    $energy = ($power * $hour) / 1000;

    // Calculate Total Charge
    $totalCharge = $energy * ($rate / 100);

    // Format totalCharge to two decimal places
    $formattedNumber = number_format($totalCharge, 2);

    // Display results in a table row
    echo "<tr><td>{$hour}</td><td>{$power}</td><td>{$energy}</td><td>{$formattedNumber}</td></tr>";

    echo "</table>";
    echo "</div>";

    // Assuming 24 hours for the display
    echo "<div style='text-align: center;'>";
    echo "<h2>Electricity Rates per Day</h2>";
    echo "<table border='1' style='margin: 0 auto;'>";
    echo "<tr><th> Hour </th><th> Power (W) </th><th> Energy (kWh) </th><th> Total Charge (RM) </th></tr>";

    for ($hour = 1; $hour <= 24; $hour++) {
        // Calculate Power (W)
        $power = ($voltage * $current);

        // Calculate Energy (kWh)
        $energy = ($power * $hour) / 1000;

        // Calculate Total Charge
        $totalCharge = $energy * ($rate / 100);

        // Format totalCharge to two decimal places
        $formattedTotalCharge = number_format($totalCharge, 2);
        
        // Display results in a table row
        echo "<tr><td>{$hour}</td><td>{$power}</td><td>{$energy}</td><td>{$formattedTotalCharge}</td></tr>";
    }

    echo "</table>";
}
?>


</body>
</html>

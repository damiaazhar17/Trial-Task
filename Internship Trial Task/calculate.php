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
function calculateElectricityRates($voltage, $current, $rate, $hours) {
    echo "<div style='text-align: center;'>";

    // Calculate and display results per hour
    echo "<h2>Electricity Rates per Hour</h2>";
    echo "<table border='1' style='margin: 0 auto;'>";
    echo "<tr><th>Hour</th><th>Power (W)</th><th>Energy (kWh)</th><th>Total Charge (RM)</th></tr>";

    $hour = 1;
    $power = $voltage * $current;
    $energy = ($power * $hour) / 1000;
    $totalCharge = $energy * ($rate / 100);
    $formattedTotalCharge = number_format($totalCharge, 2); // round off to 2 decimal places

    echo "<tr><td>{$hour}</td><td>{$power}</td><td>{$energy}</td><td>{$formattedTotalCharge}</td></tr>";
    echo "</table>";

    // Calculate and display results per day (24 hours)
    echo "<h2>Electricity Rates per Day</h2>";
    echo "<table border='1' style='margin: 0 auto;'>";
    echo "<tr><th>Hour</th><th>Power (W)</th><th>Energy (kWh)</th><th>Total Charge (RM)</th></tr>";

    for ($hour = 1; $hour <= $hours; $hour++) {
        $power = $voltage * $current;
        $energy = ($power * $hour) / 1000;
        $totalCharge = $energy * ($rate / 100);
        $formattedTotalCharge = number_format($totalCharge, 2); // round off to 2 decimal places

        echo "<tr><td>{$hour}</td><td>{$power}</td><td>{$energy}</td><td>{$formattedTotalCharge}</td></tr>";
    }

    echo "</table>";
    echo "</div>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $voltage = $_POST["voltage"];
    $current = $_POST["current"];
    $rate = $_POST["rate"];

    // Call the function for results per day (24 hours)
    calculateElectricityRates($voltage, $current, $rate, 24);
}
?>


</body>
</html>

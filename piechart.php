<?php
// Database connection
include "conn2.php";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch CGPA data from the database
$sql = "SELECT cgpa FROM students";
$result = $conn->query($sql);

// Initialize variables to count pass, average, distinction, and fail
$passCount = 0;
$averageCount = 0;
$distinctionCount = 0;
$failCount = 0;
$TotalCount = 0;


// Process fetched data
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cgpa = $row['cgpa'];
        // Categorize CGPA into pass, average, distinction, and fail
        if ($cgpa < 5) {
            $failCount++;
        } if ($cgpa < 5.5 && $cgpa >=5) {
            $passCount++;
        } if ($cgpa >= 5.5 && $cgpa <=6.9) {
            $averageCount++;
        } if ($cgpa >= 7) {
            $distinctionCount++;
        }
    }
}
$TotalCount =$passCount+$averageCount+$distinctionCount+$failCount;
$T=$passCount+$averageCount+$distinctionCount;
$Z=$T/$TotalCount;

// Close connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CGPA Classification Pie Chart</title>
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        h2 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }
        #myChart {
            width: 400px;
            height: 400px;
            margin: auto;
            margin-top: 20px;
            border-radius: 10px;
            box-shadow: 0 0 50px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 300px;
            margin: auto;
            margin-top: 20px;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>CGPA Classification Pie Chart</h2>

<!-- Canvas element for Chart.js -->
<canvas id="myChart"></canvas>

<!-- Table to display criteria counts -->
<table>
    <tr>
        <th>Criteria</th>
        <th>Count</th>
    </tr>
    <tr>
        <td>Pass</td>
        <td><?php echo $passCount; ?></td>
    </tr>
    <tr>
        <td>Average</td>
        <td><?php echo $averageCount; ?></td>
    </tr>
    <tr>
        <td>Distinction</td>
        <td><?php echo $distinctionCount; ?></td>
    </tr>
    <tr>
        <td>Fail</td>
        <td><?php echo $failCount; ?></td>
    </tr>
    <tr>
        <th>Total Count</th>
        <th><?php echo $TotalCount; ?></th>
    </tr>
</table>

<script>
    // Get pass, average, distinction, and fail counts from PHP and convert to JavaScript array
    var passCount = <?php echo $passCount; ?>;
    var averageCount = <?php echo $averageCount; ?>;
    var distinctionCount = <?php echo $distinctionCount; ?>;
    var failCount = <?php echo $failCount; ?>;

    // Create a pie chart using Chart.js
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Pass', 'Average', 'Distinction', 'Fail'],
            datasets: [{
                data: [passCount, averageCount, distinctionCount, failCount],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.5)', // green for pass
                    'rgba(54, 162, 235, 0.5)', // Blue for average
                    'rgba(255, 206, 86, 0.5)', // Yellow for distinction
                    'rgba(255, 99, 132, 0.5)' // red for fail
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: false,
            animation: {
                animateRotate: true, // Rotate animation on hover
                animateScale: true // Scale animation on hover
            }
        }
    });
</script>

</body>
</html>
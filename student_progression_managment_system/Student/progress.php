<?php
include("menus.php");

$deg = htmlspecialchars($_POST["deg"]);
$data = $_POST["data"];
$ay = $data[0][0];  // Assuming AY is in the first row and first column
$ayear = explode("-", $ay)[0];
$years = [];
for ($i = 0; $i <= 4; $i++) {
    $years[] = $ayear + $i;
}
?>
<div class="home-section">
    <div class="home-content">
        <i class="fas fa-bars"></i>
        <span class="text">Student Progression Management System</span>
    </div>
    <br clear="all"><br>
    <main class="main-container">
        <!-- Main Title -->
        <div class="main-title">
            <h2>
                Progress of <?php echo $deg . " Engineering"; ?> for Admitted Year <?php echo $ayear; ?>
            </h2>
        </div>
        <hr>
        <?php
        // Collect data for the chart
        $head = ["AY", "F.Y. Admitted", "S.Y. Admitted", "T.Y. Admitted", "B.Tech. Admitted", "B.Tech. Passed", "% Progression"];
        $selected_data = array_filter($data, function($row) use ($ay) {
            return $row[0] === $ay;
        });
        $selected_data = array_shift($selected_data);
        ?>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f7f7f7;
                margin: 0;
                padding: 0;
            }
            h2 {
                text-align: center;
                color: #333;
                margin-top: 20px;
            }
            .chart-container {
                width: 70%; /* Adjust width as needed */
                margin: 0 auto;
                text-align: center;
            }
            canvas {
                width: 100%; /* Ensure canvas fills its container */
                height: 400px; /* Set desired height */
                margin: 0 auto;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }
        </style>
        <div class="chart-container">
            <!-- Canvas element for Chart.js -->
            <canvas id="myChart"></canvas>
        </div>

        <script>
            // Get the dataset from PHP
            var head = <?php echo json_encode($head); ?>;
            var selectedData = <?php echo json_encode($selected_data); ?>;
            var labels = <?php echo json_encode($years); ?>;

            // Extract data for each category
            var dataRegular = [];
            var dataDSY = [];
            for (var i = 1; i < selectedData.length; i += 2) {
                dataRegular.push(selectedData[i]);
                dataDSY.push(selectedData[i + 1]);
            }

            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels, // Year labels
                    datasets: [
                        {
                            label: 'Regular',
                            data: dataRegular,
                            backgroundColor: 'rgba(54, 162, 235, 0.5)', // Blue color with transparency
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'DSY',
                            data: dataDSY,
                            backgroundColor: 'rgba(255, 99, 132, 0.5)', // Red color with transparency
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </main>
</div>

<?php
include("footer.php");
?>

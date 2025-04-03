<?php
include("menus.php");
$ay=$_GET["ay"];
$ayear=explode("-",$ay)[0];
$deg=$_GET["deg"];
$years=[];
for($i= 0;$i<=3;$i++){
    $years[]=$ayear+$i;
}
//echo json_encode($years);
$fnm=$_GET["fnm"];
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
          Progress of <?php echo $deg." Diploma"; ?> for Admitted Year <?php echo $ayear; ?>    
        </h2>

      </div>

<hr>
<?php
if (($handle = fopen("files/".$fnm, "r")) !== false) {
    // Skip the first row if it contains headers
  
    // Prepare the SQL statement to insert data
    //$stmt = $conn->prepare("INSERT INTO students (name, email, prn, cgpa, gender, dob, course, year) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind parameters
    //$stmt->bind_param("ssssssss", $name, $email, $prn, $cgpa, $gender, $dob, $course, $year);

    // Read and insert data row by row
    $i=0;
    $head=[];
    $dt=[];
    while (($data = fgetcsv($handle, 1000, ",")) !== false) {
      if($i==0)
      {
        $head[] = $data;
        $i++;
      }
      else if($data[0]==$ay)
      {
$po=0;
for($pos=1;$pos<count($data);$pos++)      
$dt[$po++]=$data[$pos];
      }
      
        
      //  $stmt->execute();
        
    }
  
    fclose($handle);
  }

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
            width: 90%; /* Adjust width as needed */
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
    // Get CGPA and PRN data from PHP and convert to JavaScript arrays
    var cgpaData = <?php  echo json_encode($dt); ?>;
    var prnData = <?php echo json_encode($years); ?>;
//alert(cgpaData);
//alert(prnData);
    // Create a bar graph using Chart.js
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: prnData, // PRN as labels
            datasets: [{
                label: 'Student Count',
                data: cgpaData, // CGPA as data
                backgroundColor: 'rgba(54, 162, 235, 0.5)', // Blue color with transparency
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>

</main>
  </div>
  
<?php
include("footer.php");
?>
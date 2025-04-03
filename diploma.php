<?php 
include("menus.php");
$deg=$_GET["name"];
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
          <h2><?php
          echo $deg." Diploma Department";
          ?></h2>

      </div>

  <?php
  $fnm="Diploma_".$deg.".csv";
//  echo $fnm;

  if (($handle = fopen("files/".$fnm, "r")) !== false) {
    // Skip the first row if it contains headers
  
    // Prepare the SQL statement to insert data
    //$stmt = $conn->prepare("INSERT INTO students (name, email, prn, cgpa, gender, dob, course, year) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind parameters
    //$stmt->bind_param("ssssssss", $name, $email, $prn, $cgpa, $gender, $dob, $course, $year);

    // Read and insert data row by row
    $i=0;
    echo"<table border=1 cellpadding=20px cellspacing=5px width=70% align=center>";
    while (($data = fgetcsv($handle, 1000, ",")) !== false) {
      if($i==0)
      {
        echo "<thead><tr><th>".$data[0]."</th><th>".$data[1]."</th><th>".$data[2]."</th><th>".$data[3]."</th><th>".$data[4]."</th><th>" .$data[5]."</th></tr></thead><tbody>";
        $i++;
      }
      else
      echo "<tr><td><a href=progress1.php?ay=".$data[0]."&fnm=".$fnm."&deg=".$deg.">".$data[0]."</a></td><td>".$data[1]."</td><td>".$data[2]."</td><td>".$data[3]."</td><td>".$data[4]."</td><td>" .$data[5]."</td></tr>";
        
      //  $stmt->execute();
        
    }
  }

  ?>   
  </tbody>
</table>

        
         

        
  
  </main>
  </div>
  
<?php
include("footer.php");
?>
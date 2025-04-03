<?php 
include("menus.php");
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
          <h2>DASHBOARD</h2>
      </div>

      <!-- Main Cards -->
      <div class="main-cards">
          <!-- Card 1: Products -->
          <div class="card">
              <div class="card-inner">
                  
                  <a href="upload.php"><h3>Upload CSV File</h3></a>
              </div>
             
          </div>
          
          <!-- Card 2: Categories -->
          <div class="card">
              <div class="card-inner">
                  <a href="search.php"><h3>Search Student</h3></a>
                  
              </div>
              
          </div>
          
          <!-- Card 3: Customers -->
          <div class="card">
              <div class="card-inner">
                  <a href="barghraph.php"><h3>Graph-wise Progression</h3></a>
                  
              </div>

          </div>
          
          <div class="card">
            <div class="card-inner">
                <a href="piechart.php"><h3></h3>Viwe All Class Progression</h3></a>
                
            </div>

        </div>

        
         

          </div>
      </div>
  </main>
  </div>
  
<?php
include("footer.php");
?>
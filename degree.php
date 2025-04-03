<?php 
include("menus.php");
$deg = htmlspecialchars($_GET["name"]);
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
            <h2><?php echo $deg . " Engineering Department"; ?></h2>
        </div>

        <div class="table-container">
            <form method="post" action="progress.php">
                <input type="hidden" name="deg" value="<?php echo $deg; ?>">
                <div class="table-wrapper">
                    <table border="1" cellpadding="20px" cellspacing="5px">
                        <thead>
                            <tr>
                                <?php
                                $mainHeaders = [
                                    "AY",
                                    "F.Y. Admitted",
                                    "S.Y. Admitted",
                                    "T.Y. Admitted",
                                    "B.Tech. Admitted",
                                    "B.Tech. Passed",
                                    "% Progression"
                                ];

                                foreach ($mainHeaders as $header) {
                                    if ($header == "AY") {
                                        echo "<th rowspan='2'>$header</th>";
                                    } else {
                                        echo "<th colspan='2'>$header</th>";
                                    }
                                }
                                ?>
                                <th rowspan='2'>View Graph</th>
                            </tr>
                            <tr>
                                <?php
                                for ($i = 1; $i < count($mainHeaders); $i++) {
                                    echo "<th>Regular</th><th>DSY</th>";
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $numRows = 10;

                            for ($i = 0; $i < $numRows; $i++) {
                                echo "<tr>";
                                echo "<td><input type='text' name='data[$i][0]' value=''></td>"; // AY column
                                for ($j = 1; $j < count($mainHeaders) * 2; $j++) { // Create empty cells for data
                                    echo "<td><input type='text' name='data[$i][$j]' value=''></td>";
                                }
                                echo "<td><button type='submit'>View Graph</button></td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </main>
</div>
<style>
.home-section {
    width: 100%;
    background-color: #fff;
}

.main-container {
    width: 100%;
    padding-left: 20px;
}

.table-container {
    width: 100%;
    overflow-x: auto; /* Enables horizontal scrolling */
    background-color: #fff;
    padding-bottom: 20px; /* For better UX */
}

.table-wrapper {
    width: 100%;
    overflow-x: auto;
    max-height: 600px; /* Limit the height and make it scrollable */
}

table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    background-color: #fff;
}

table th, table td {
    padding: 10px;
    text-align: left;
    background-color: #fff;
    position: relative;
}

table thead th {
    background-color: #f2f2f2;
    position: sticky;
    top: 0;
    z-index: 1;
}

.main-title h2 {
    text-align: left;
    margin-left: 20px;
}

input[type="text"] {
    width: 100%;
    box-sizing: border-box;
}

button {
    margin: 20px 0;
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    border: none;
    cursor: pointer;
}

button:hover {
    background-color: #45a049;
}

</style>

<?php
include("footer.php");
?>

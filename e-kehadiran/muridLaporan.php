<?php
session_start();
require_once "db_connect.php";

$muridName = $_SESSION['muridName'];
$muridID = $_SESSION['muridID'];
if (!isset($muridName)) {
    header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--title-->
    <title>e-attendance</title>
    <!--favicon-->
    <link rel="icon"
        href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>📆</text></svg>">
    <!--css-->
    <link rel="stylesheet" href="css/style.css">
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
</head>

<body>
    <?php include 'muridNav.php'; ?>   

    <!-- Attendance report -->
    <div class="container-table">
        <h1>Attendance Report</h1>
        <table border='1' id="reportTable">
            <tr>
                <th>GKK ID</th>
                <th>Date</th>
                <th>Activity</th>
                <th>Status Kehadiran</th>
            </tr>

            <?php
            $sql = "SELECT murid.Nama_Murid, kehadiran.ID_GKK, kehadiran.Status_Kehadiran, gkk.Tarikh, gkk.Aktiviti 
                    FROM kehadiran 
                    INNER JOIN murid ON kehadiran.ID_Pelajar = murid.ID_Pelajar 
                    INNER JOIN gkk ON kehadiran.ID_GKK = gkk.ID_GKK 
                    WHERE murid.ID_Pelajar = '$muridID'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    $IDGKK = $row['ID_GKK']; 
                    $Tarikh = $row['Tarikh'];
                    $Aktiviti = $row['Aktiviti'];
                    $StatusKehadiran = $row['Status_Kehadiran'];
                    echo "<tr>";
                    echo "<td>".$IDGKK."</td>";
                    echo "<td>".$Tarikh."</td>";
                    echo "<td>".$Aktiviti."</td>";
                    echo "<td>".$StatusKehadiran."</td>";
                    echo "</tr>";
                }
            } else {
                // No records found
                echo "<tr><td colspan='4'>No Information Available.</td></tr>";
            }
            ?>
        </table>
        <div class="tbaction">
            <button onclick="printTable()" class="btn">Print Report</button>
            <script>
                function printTable() {
                    var table = document.getElementById("reportTable");
                    var newWin = window.open('');
                    newWin.document.write("<h1>Attendance Report</h1>");
                    newWin.document.write("<h3>Student ID: <?php echo $muridID; ?></h3>");
                    newWin.document.write("<h3>Student Name: <?php echo $muridName; ?></h3>");
                    newWin.document.write(table.outerHTML);
                    newWin.document.close(); // necessary for IE >= 10
                    newWin.focus();
                    newWin.print();
                    newWin.close();
                    return true;
                }
            </script>
        </div>
    </div>

<!--footer-->
<?php include 'footer.php'; ?>  
<!--js-->
<script src="js/script.js"></script>
</body>
</html>

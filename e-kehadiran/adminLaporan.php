<?php
session_start();
require_once "db_connect.php";

$adminName = $_SESSION['adminName'];
$adminID = $_SESSION['adminID'];
if (!isset($adminName)) {
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
    <?php include 'adminNav.php'; ?>   

    <!-- Attendance report -->
    <div class="container-table">
        <h1>Attendance Report</h1>
        <table border='1' id="reportTable">
            <tr>
                <th>GKK ID</th>
                <th>Date</th>
                <th>Activity</th>
                <th>Name</th>
                <th>Class</th>
                <th>Status Kehadiran</th>
            </tr>

            <?php
            $sql = "SELECT murid.ID_Pelajar, murid.Nama_Murid, murid.ID_Kelas, kelas.ID_Kelas, kelas.Kelas,  kehadiran.ID_GKK, kehadiran.Status_Kehadiran, gkk.Tarikh, gkk.Aktiviti 
                    FROM kehadiran 
                    INNER JOIN murid ON kehadiran.ID_Pelajar = murid.ID_Pelajar 
                    INNER JOIN kelas ON murid.ID_Kelas = kelas.ID_Kelas
                    INNER JOIN gkk ON kehadiran.ID_GKK = gkk.ID_GKK";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    $IDGKK = $row['ID_GKK']; 
                    $Tarikh = $row['Tarikh'];
                    $Aktiviti = $row['Aktiviti'];
                    $Nama = $row['Nama_Murid'];
                    $Kelas = $row['Kelas'];
                    $StatusKehadiran = $row['Status_Kehadiran'];
                    
                    echo "<tr>";
                    echo "<td>".$IDGKK."</td>";
                    echo "<td>".$Tarikh."</td>";
                    echo "<td>".$Aktiviti."</td>";
                    echo "<td>".$Nama."</td>";
                    echo "<td>".$Kelas."</td>";
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
                    newWin.document.write("<h3>Admin ID: <?php echo $adminID; ?></h3>");
                    newWin.document.write("<h3>Admin Name: <?php echo $adminName; ?></h3>");
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

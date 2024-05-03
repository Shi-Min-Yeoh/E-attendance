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
<!--header-->
<?php include 'muridNav.php'; ?>   
<!--main-->
<!--record attendance-->
<div class="container-table">
<h1>Record Attendance</h1>
<?php
print "<table border='1'>";
print "<tr>";
print "<th>GKK ID</th>";
print "<th>Date</th>";
print "<th>Activity</th>";
print "<th>Action</th>";
print "</tr>";

date_default_timezone_set('Asia/Kuala_Lumpur');
$date = date("Y-m-d");
$counter = 0;

$sql = "SELECT * FROM gkk WHERE Tarikh = '$date'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

while ($row = mysqli_fetch_array($result)) {
    $ID_GKK = $row['ID_GKK']; // Moved the assignment here
    $Tarikh = $row['Tarikh'];
    $Aktiviti = $row['Aktiviti'];
    $counter++;

    // Check if the student has already marked their attendance for this activity
    $attendance_sql = "SELECT * FROM kehadiran WHERE ID_GKK = '$ID_GKK' AND Status_Kehadiran = 'Hadir'";
    $attendance_result = mysqli_query($conn, $attendance_sql);
    $attended = mysqli_num_rows($attendance_result) > 0;

    // If the student has not attended, show the table row
    if (!$attended) {
        echo "<tr>";
        echo "<td>$ID_GKK</td>";
        echo "<td>$Tarikh</td>";
        echo "<td>$Aktiviti</td>";
        echo "<td>";
        echo "<form method='post' action='rekodkehadiran.php'>";
        echo "<input type='hidden' name='ID_GKK' value='$ID_GKK'>";
        echo "<input type='submit' class='btn inline-option-btn' value='Hadir' name='submit'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
}

print "</table>";
?>
</div>

<!--footer-->
<?php include 'footer.php'; ?>  
<!--js-->
<script src="js/script.js"></script>
</body>
</html>

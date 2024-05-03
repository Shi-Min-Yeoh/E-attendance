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
<!--header-->
<?php include 'adminNav.php'; ?>   
<!--main-->
<!--about-->
<section class="about">
   <div class="row">
      <div class="image">
         <img src="assets/images/about-img.svg" alt="">
      </div>
      <div class="content">
         <h3>Welcome To Stem Club</h3>
         <p>The STEM Club inspires students to explore Science, Technology, Engineering, and 
            Mathematics (STEM) through hands-on activities like robotics, coding, 
            and science fairs. Fostering critical thinking and teamwork, the club provides an 
            inclusive space for collaboration and growth, shaping future leaders in STEM fields</p>
      </div>
   </div>
</section>

<!--attendance-->
<section class="home-grid">
<h1 class="heading">attendance quick view</h1>
<?php
// SQL query to fetch attendance status
$sql = "SELECT
            (SELECT COUNT(*) FROM kehadiran WHERE Status_Kehadiran = 'Lewat') AS lewat_count,
            (SELECT COUNT(*) FROM kehadiran WHERE Status_Kehadiran = 'Tidak Hadir') AS tidak_hadir_count,
            (SELECT COUNT(*) FROM kehadiran WHERE Status_Kehadiran = 'Hadir') AS hadir_count,
            (SELECT COUNT(*) FROM gkk) AS gkk_total
        FROM dual";

// Prepare and execute the statement
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

// Fetch the results
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Calculate Tidak Hadir count
    $tidak_hadir_count = $row['gkk_total'] - $row['hadir_count'] - $row['lewat_count'];

    // Display the results in three boxes
    echo "<div class='box-container'>";
    echo "<div class='box'><h1 class='number'>" . $row['lewat_count'] . "</h1><h3 class='title'>Lewat</h3></div>";
    echo "<div class='box'><h1 class='number'>" . $tidak_hadir_count . "</h1><h3 class='title'>Tidak Hadir</h3></div>";
    echo "<div class='box'><h1 class='number'>" . $row['hadir_count'] . "</h1><h3 class='title'>Hadir</h3></div>";
    echo "</div>";
} else {
    // If no attendance records found, consider all GKK as Tidak Hadir
    $sql_gkk = "SELECT COUNT(*) AS gkk_total FROM gkk";
    $result_gkk = $conn->query($sql_gkk);
    if ($result_gkk->num_rows > 0) {
        $row_gkk = $result_gkk->fetch_assoc();
        echo "<div class='box-container'>";
        echo "<div class='box'><h1 class='number'>0</h1><h3 class='title'>Lewat</h3></div>";
        echo "<div class='box'><h1 class='number'>" . $row_gkk['gkk_total'] . "</h1><h3 class='title'>Tidak Hadir</h3></div>";
        echo "<div class='box'><h1 class='number'>0</h1><h3 class='title'>Hadir</h3></div>";
        echo "</div>";
      } else {
         echo "<div class='box-container'>";
         echo "<div class='box'>Error: Unable to fetch GKK count.</div>";
         echo "</div>";
    }
}
// Close statement and connection
$stmt->close();
$conn->close();
?>
<!--view more-->
<div class="more-btn">
   <a href="adminLaporan.php" class="inline-option-btn">view all attendance</a>
</div>
</section>

<!--footer-->
<?php include 'footer.php'; ?>  
<!--js-->
<script src="js/script.js"></script>
</body>
</html>
<?php
session_start();
require_once "db_connect.php";

$adminName = $_SESSION['adminName'];
$adminID = $_SESSION['adminID'];
if (!isset($adminName)) {
    header('location:index.php');
}

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query to retrieve record based on ID
    $sql = "SELECT * FROM gkk WHERE ID_GKK = '$id'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        // Assign record values to variables
        $idgkk = $row['ID_GKK'];
        $tarikh = $row['Tarikh'];
        $aktiviti = $row['Aktiviti'];
    } else {
        // Handle record not found
        echo "Tiada Data.";
        exit();
    }
} else {
    // Handle ID parameter not set
    echo "Kehilangan Data.";
    exit();
}


if (isset($_POST['submit'])) {

    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $activity = mysqli_real_escape_string($conn, $_POST['activity']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);

    mysqli_query($conn, "UPDATE `gkk` SET Tarikh = '$date', Aktiviti = '$activity'WHERE ID_GKK = '$id'") or die('query failed');

    echo '<script language="javascript">';
    echo 'alert("updated successfully")';
    echo '</script>';

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
    <!-- edit acc-->
    <section class="account">
        <div class="form-container">
            <form action="" method="post" enctype="multipart/form-data">
                <h3>GKK Data</h3>
                <label for="id">ID</label><br>
                <input type="text" name="id" value="<?php echo $idgkk; ?>" class="box" required>

                <label for="date">Date</label><br>
                <input type="date" name="date" value="<?php echo $tarikh; ?>" class="box" required>

                <label for="activity">Activity</label><br>
                <input type="text" name="activity" value="<?php echo $aktiviti; ?>" class="box" required>
                
                <input type="submit" name="submit" value="submit" class="btn">
                </form>
            </div>
        </section>

<!--footer-->
<?php include 'footer.php'; ?>  
<!--js-->
<script src="js/script.js"></script>
</body>
</html>
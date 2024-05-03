<?php
session_start();
require_once "db_connect.php";

$adminName = $_SESSION['adminName'];
$adminID = $_SESSION['adminID'];
if (!isset($adminName)) {
    header('location:index.php');
}

//update acc
if (isset($_POST['submit'])) {

    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $ic = mysqli_real_escape_string($conn, $_POST['ic']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);

    mysqli_query($conn, "UPDATE `admin` SET Kad_Pengenalan = '$ic', Nama_Admin = '$name', Kata_Laluan = '$pass' WHERE ID_Admin = '$id'") or die('query failed');

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
                <h3>Profile Data</h3>
                <input type="hidden" name="id" value="<?php echo $_SESSION['adminID'] ?>">
                <label for="ic">IC</label><br>
                <input type="text" name="ic" value="<?php echo $_SESSION['adminic'] ?>" class="box" required
                    pattern="\d{6}-\d{2}-\d{4}">

                <label for="name">Name</label><br>
                <input type="text" name="name" value="<?php echo $_SESSION['adminName']; ?>" class="box" required>

                <label for="password">Password</label><br>
                <input type="text" name="password" placeholder="enter your password"
                    value="<?php echo $_SESSION['adminpass']; ?>" class="box" required pattern="[a-zA-Z0-9_]{4,12}"
                    oninvalid="setCustomValidity('Please enter a password with at least 4 and max 12 characters.')"
                    oninput="setCustomValidity('')">
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
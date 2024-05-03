<?php
session_start();
require_once "db_connect.php";

$muridName = $_SESSION['muridName'];
$muridID = $_SESSION['muridID'];
if (!isset($muridName)) {
    header('location:index.php');
}

//update acc
if (isset($_POST['submit'])) {

    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $ic = mysqli_real_escape_string($conn, $_POST['ic']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $tel = mysqli_real_escape_string($conn, $_POST['tel']);
    $class = mysqli_real_escape_string($conn, $_POST['class']);
    $jantina = mysqli_real_escape_string($conn, $_POST['jantina']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);

    mysqli_query($conn, "UPDATE `murid` SET Kad_Pengenalan = '$ic', Nama_Murid = '$name', No_Telefon = '$tel', ID_Kelas = '$class', Jantina = '$jantina', Kata_Laluan = '$pass' WHERE ID_Pelajar = '$id'") or die('query failed');

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
    <?php include 'muridNav.php'; ?>
    <!--main-->
    <!-- edit acc-->
    <section class="account">
        <div class="form-container">
            <form action="" method="post" enctype="multipart/form-data">
                <h3>Profile Data</h3>
                <input type="hidden" name="id" value="<?php echo $_SESSION['muridID'] ?>">
                <label for="ic">IC</label><br>
                <input type="text" name="ic" value="<?php echo $_SESSION['muridic'] ?>" class="box" required
                    pattern="\d{6}-\d{2}-\d{4}">

                <label for="name">Name</label><br>
                <input type="text" name="name" value="<?php echo $_SESSION['muridName']; ?>" class="box" required>

                <label for="tel">Telephone Num.</label><br>
                <input type="numbers" name="tel" value="<?php echo $_SESSION['muridTel']; ?>" class="box" required>
                
                <label for="class">Class ID</label><br>
                <input type="text" name="class" class="box" value="<?php echo $_SESSION['muridKelas'] ?>">

                <label for="jantina">Jantina</label><br>
                <select id="jantina" name="jantina" required class="box">
                    <option value="" disabled>Jantina</option>
                    <option value="Lelaki"
                        <?php if(isset($_SESSION['muridJantina']) && $_SESSION['muridJantina'] == 'Lelaki') echo 'selected'; ?>>
                        Lelaki</option>
                    <option value="Perempuan"
                        <?php if(isset($_SESSION['muridJantina']) && $_SESSION['muridJantina'] == 'Perempuan') echo 'selected'; ?>>
                        Perempuan</option>
                </select>


                <label for="password">Password</label><br>
                <input type="text" name="password" placeholder="enter your password"
                    value="<?php echo $_SESSION['muridpass']; ?>" class="box" required pattern="[a-zA-Z0-9_]{4,12}"
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
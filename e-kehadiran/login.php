<?php
session_start();
require_once "db_connect.php";

//login func.
if (isset($_POST['submit'])){
    $ic = $_POST['ic'];
    $password = $_POST['password'];

    $muridQuery = "SELECT * FROM murid WHERE Kad_Pengenalan = '$ic' AND Kata_Laluan = '$password'";
    $muridResult = mysqli_query($conn, $muridQuery);

    $adminquery = "SELECT * FROM admin WHERE Kad_Pengenalan = '$ic' AND Kata_Laluan = '$password'";
    $adminResult = mysqli_query($conn, $adminquery);

    if (mysqli_num_rows($muridResult) >0) {

        $muridData = mysqli_fetch_assoc($muridResult);
        $_SESSION['role'] = 'murid';
        $_SESSION['muridID'] = $muridData['ID_Pelajar'];
        $_SESSION['muridName'] = $muridData['Nama_Murid'];
        $_SESSION['muridTel'] = $muridData['No_Telefon'];
        $_SESSION['muridpass'] = $muridData['Kata_Laluan'];
        $_SESSION['muridJantina'] = $muridData['Jantina'];
        $_SESSION['muridKelas'] = $muridData['ID_Kelas'];
        $_SESSION['muridic'] = $muridData['Kad_Pengenalan'];
        print "<script>alert('Welcome ". $_SESSION['muridName']. "'); window.location = 'muridHome.php'</script>";

     } else if (mysqli_num_rows($adminResult) > 0){

        $adminData = mysqli_fetch_assoc($adminResult);
        $_SESSION['role']= 'admin';
        $_SESSION['adminID'] = $adminData['ID_Admin'];
        $_SESSION['adminName'] = $adminData['Nama_Admin'];
        $_SESSION['adminpass'] = $adminData['Kata_Laluan'];
        $_SESSION['adminic'] = $adminData['Kad_Pengenalan'];
        print "<script>alert('Welcome ". $_SESSION['adminName']. "'); window.location = 'adminHome.php'</script>";

     }else {
      print "<script>alert('Login failed. Please check your ic number and password again.'); window.location='admin.php'</script>";
    }
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
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <!--login form-->
    <div class="form-container">
        <form action="" method="post">
            <h3 class="title">login now</h3>

            <?php
         if(isset($error)){
            foreach($error as $error){
               echo '<span class="error-msg">'.$error.'</span>';
            }
         }
      ?>

            <input type="text" name="ic" placeholder="enter your ic number with -" class="box" required
                pattern="\d{6}-\d{2}-\d{4}">
            <input type="password" name="password" placeholder="enter your password" class="box" required
                pattern="[a-zA-Z0-9_]{4,12}"
                oninvalid="setCustomValidity('Please enter a password with at least 4 and max 12 characters.')"
                oninput="setCustomValidity('')">
            <input type="submit" value="login now" class="form-btn" name="submit">
            <p>don't have an account? <a href="register.php">register now!</a></p>
        </form>
    </div>

</body>
</html>
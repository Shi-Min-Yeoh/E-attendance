<?php

require_once "db_connect.php";

//login func.
if (isset($_POST['submit'])) {
    $username = $_POST["username"];
    $class =  $_POST["ID_Kelas"];
    $gender = $_POST["Jantina"];
    $ic = $_POST["ic"];
    $noTelefon = $_POST["noTelefon"]; 
    $password = $_POST["password"];

    
    $sql = "INSERT INTO murid (Nama_Murid, ID_Kelas, Jantina, Kad_Pengenalan, NO_Telefon, Kata_Laluan) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssssss", $username, $class, $gender, $ic, $noTelefon, $password); // Corrected variable name
        if (mysqli_stmt_execute($stmt)) {
            print "<script>alert('Registered successfully'); window.location = 'login.php'</script>";
        } else {
            print "<script>alert('Registration Failed.'); window.location = 'register.php'</script>";
        }
    }

    // Close statement
    mysqli_stmt_close($stmt);
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
            <h3 class="title">Register now</h3>

            <?php
         if(isset($error)){
            foreach($error as $error){
               echo '<span class="error-msg">'.$error.'</span>';
            }
         }
      ?>

            <input type="text" name="ic" placeholder="IC number with -" class="box" required
                pattern="\d{6}-\d{2}-\d{4}">
            <input type="text" name="username" class="box" required placeholder="Nama Murid">
            <input type="text" name="ID_Kelas" class="box" required placeholder=" ID Kelas">
            <input type="text" name="noTelefon" class="box" required placeholder="No Telefon">


            <select id="Jantina" name="Jantina" required class="box">
                <option value="" disabled selected>Jantina</option>
                <option value="Lelaki">Lelaki</option>
                <option value="Perempuan">Perempuan</option>
            </select>

            <input type="password" name="password" placeholder="Password" class="box" required
                pattern="[a-zA-Z0-9_]{4,12}"
                oninvalid="setCustomValidity('Please enter a password with at least 4 and max 12 characters.')"
                oninput="setCustomValidity('')">
            <input type="submit" value="register now" class="form-btn" name="submit">
            <input type="reset" value="reset" class="form-btn">
            <p>already have an account? <a href="login.php">login now!</a></p>
        </form>
    </div>
</body>

</html>
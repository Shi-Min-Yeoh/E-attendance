<?php
require_once "db_connect.php";
session_start();
$muridID = $_SESSION['muridID'];
$muridSql = "SELECT ID_Pelajar, Nama_Murid FROM murid WHERE ID_Pelajar = '$muridID'";
$muridResult = mysqli_query($conn, $muridSql);
$muridData = mysqli_fetch_assoc($muridResult);

if (isset($_POST['submit'])) {
    if (isset($_SESSION['muridID'])) {
        
            $IDGKK = $_POST['ID_GKK'];
            $NoSekolah = $muridData['ID_Pelajar']; // Fetching Id_Murid from the result of the query, not from $pesertaData

            // Ensure table name is correct and escaped with backticks
            $insertSql = "INSERT INTO `kehadiran` (`ID_Pelajar`, `ID_GKK`, `Status_Kehadiran`) VALUES ('$NoSekolah', '$IDGKK', 'Hadir')";

            $sqlInsert = mysqli_query($conn, $insertSql); 

            if ($sqlInsert) {
                echo "<script>alert('Berjaya!');</script>";
                echo "<script>window.location ='muridRekodKehadiran.php';</script>"; // Adjusted file name
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Error: ID_GKK is not set in the form.";
        }
    }

?>

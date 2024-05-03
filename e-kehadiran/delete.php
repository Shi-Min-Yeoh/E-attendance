<?php
session_start();
require_once "db_connect.php";

if(isset($_GET['id'])){
    $ID_GKK = mysqli_real_escape_string($conn, $_GET['id']); // Correct variable name

    // SQL statement for deletion
    $sql = "DELETE FROM gkk WHERE ID_GKK = '$ID_GKK'";
    
    // Execute the SQL statement
    $sqlInsert = mysqli_query($conn, $sql);

    if($sqlInsert) { // Check if deletion was successful
        echo "<script>
        alert('Delete successfully');
        window.location.replace('adminGKK.php');
        </script>";
    } else {
        echo "<script>
        alert('Delete failed');
        window.location.replace('adminGKK.php'); // Redirect to 'index.php' on error
        </script>";
    }

}
?>
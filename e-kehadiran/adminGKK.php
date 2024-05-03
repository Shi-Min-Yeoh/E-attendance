<?php
session_start();
require_once "db_connect.php";

$adminName = $_SESSION['adminName'];
$adminID = $_SESSION['adminID'];
if (!isset($adminName)) {
    header('location:index.php');
}

if(isset($_POST["submit"]))
{
    $filename=$_FILES['file']['tmp_name'];
    
        $handle= fopen($_FILES['file']['tmp_name'],"r");
        
        while (($data= fgetcsv($handle, 1000, ",")) !== FALSE){
            $item1= mysqli_real_escape_string($conn, $data[0]);
            $item2= mysqli_real_escape_string($conn, $data[1]);
            $item3= mysqli_real_escape_string($conn, $data[2]);


            $sql= "INSERT into gkk(ID_GKK, Tarikh, Aktiviti )values('$item1', '$item2','$item3' )";
            $sqlInsert = mysqli_query($conn, $sql);

                 if($sqlInsert) {
                echo "<script>
                alert('Import Berjaya.');
                window.location.replace('adminGKK.php');
                </script>";
            } else {
                echo "<script>
                alert('Harap maaf, import tidak Berjaya.');
                window.location.replace('adminGKK.php');
                </script>";
            }
        }
        fclose($handle);
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

    <!-- GKK lists -->
    <div class="container-table">
        <h1>GKK List</h1>
        <div class="form-container">
        <form method="POST" action="" enctype="multipart/form-data">
            <label for="file">Select a file to import:</label>
            <input type="file" name="file" required class="box">
            <input type="submit" name="submit" value="Import" class="btn">
        </form>
</div>

        <script type="text/javascript">
      function table(){
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function(){
          document.getElementById("table").innerHTML = this.responseText;
        }
        xhttp.open("GET", "system.php");
        xhttp.send();
      }

      setInterval(function(){
        table();
      }, 1);
    </script>

<table border='1' id="reportTable">
    <tr>
        <th>GKK ID</th>
        <th>Date</th>
        <th>Activity</th>
        <th>Action</th>
    </tr>

    <!-- Form for inserting data -->
    <tr>
        <form action="insert.php" method="post">
            <td><input type="text" name="id" placeholder="GKK ID" required class="box"></td>
            <td><input type="date" name="date" required class="box"></td>
            <td><input type="text" name="activity" placeholder="Activity" required class="box"></td>
            <td>
            <input type="submit" name="submit" value="Insert" class="btn">
            </td>
        </form>
    </tr>

    <?php
    $sql = "SELECT * FROM gkk";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $IDGKK = $row['ID_GKK']; 
            $Tarikh = $row['Tarikh'];
            $Aktiviti = $row['Aktiviti'];
            echo "<tr>";
            echo "<td>".$IDGKK."</td>";
            echo "<td>".$Tarikh."</td>";
            echo "<td>".$Aktiviti."</td>";
            echo "<td class='tdaction'>";
            echo "<a class='btn inline-option-btn' href='adminEditGkk.php?id=" . $row['ID_GKK'] . "'>Edit</a>";
            echo "<a class='btn inline-delete-btn' href='delete.php?id=" . $row['ID_GKK'] . "'>Delete</a>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        // No records found
        echo "<tr><td colspan='4'>No Information Available.</td></tr>";
    }
    ?>
</table>



    </div>

    <!--footer-->
    <?php include 'footer.php'; ?>  
    <!--js-->
    <script src="js/script.js"></script>
</body>
</html>

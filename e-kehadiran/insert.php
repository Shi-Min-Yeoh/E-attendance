<?php
session_start();
require_once "db_connect.php";

if (isset($_POST['submit'])) {

$id = mysqli_real_escape_string($conn, $_POST['id']);
$activity = mysqli_real_escape_string($conn, $_POST['activity']);
$date = mysqli_real_escape_string($conn, $_POST['date']);

mysqli_query($conn, "INSERT INTO `gkk` (ID_GKK, Tarikh, Aktiviti) VALUES ('$id','$date', '$activity')") or die('query failed');

echo '<script language="javascript">';
echo 'alert("updated successfully")';
echo '</script>';

header("Location: adminGKK.php");

}
?>
<?php
include('includes/config.php');
include('includes/showerror.php');
session_start();
include('includes/issetlogin.php');
$del=$_POST['d1'];
echo $del;
$sql = "DELETE FROM post WHERE pid='$del'";  
$rs_result = pg_query($con, $sql);
header('location:dashboard.php');
?>
<?php

include('includes/config.php');
include('includes/showerror.php');
session_start();
include('includes/issetlogin.php');

$id=$_SESSION['aid'];
$mm=$_POST['d2'];
$re1=$_POST['res1'];
$re2=$_POST['res2'];
$re="! ";
$res=$re1.$re.$re2;
$sql=pg_query($con,"update post set pstatus='suspended',reason='$res',aid=$id where pid=$mm");
     header('location:post.php');

?>
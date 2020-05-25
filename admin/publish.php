<?php

include('includes/config.php');
include('includes/showerror.php');
session_start();
include('includes/issetlogin.php');

$id=$_SESSION['aid'];
$mm=$_POST['d2'];
	$sql=pg_query($con,"update post set pstatus='active',reason='',aid=$id where pid=$mm");
      header('location:post.php');

?>
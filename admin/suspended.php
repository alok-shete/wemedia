<?php

include('includes/config.php');
include('includes/showerror.php');
session_start();
include('includes/issetlogin.php');

$id=$_SESSION['aid'];
$mm=$_POST['d1'];
	$sql=pg_query($con,"update writer set wstatus='suspended',aid=$id where wid=$mm");
      header('location:writer.php');

?>
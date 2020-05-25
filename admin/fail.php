<?php

include('includes/config.php');
include('includes/showerror.php');
session_start();
include('includes/issetlogin.php');

$id=$_SESSION['aid'];
$pp=$_POST['d2'];
$mm=$_POST['d1'];
	$sql=pg_query($con,"update payment set payincome=$pp ,payrequest=0,aid=$id where payid=$mm");
      header('location:payment.php');

?>
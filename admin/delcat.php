<?php

include('includes/config.php');
include('includes/showerror.php');
session_start();
include('includes/issetlogin.php');

$id=$_SESSION['aid'];
$pp=$_POST['d1'];
$mm=$_POST['d2'];
echo $pp;
echo "<br>".$mm;
if($mm==1)
{
	$sql=pg_query($con,"update post set cid=21 where cid=$pp");
	$r="delete from category where cid=$pp";
	$rr=pg_query($con,$r);
	
}
if($$mm==0)
{
	$r="delete from post where cid=$pp";
	$rr=pg_query($con,$r);
	$r1="delete from category where cid=$pp";
	$rr1=pg_query($con,$r1);

}
  header('location:category.php');

?>
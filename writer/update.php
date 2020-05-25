
<?php

include('includes/config.php');
include('includes/showerror.php');
session_start();
include('includes/issetlogin.php');
$aa=$_SESSION['id'];
                
                  $sql4=pg_query($con,"select sum(pview) from post where wid=$aa");
                  if(($row4 = pg_fetch_array($sql4))!= null)
                  {
                    $tpview=$row4['sum'];
                  }
                  $sql4=pg_query($con,"select * from payment where wid=$aa");
                  if(($row4 = pg_fetch_array($sql4))!= null)
                  {
                    $tp=$row4['payrequest'];
                    $tw=$row4['twithdraw'];
                  }
                  $temp=$tp+$tw;
                  $temp2=$tpview/100;
                  $ti=$temp2-$temp;
                   $sql1 = " update payment set payincome=$ti where wid=$aa;";  
                    $rs_result1 = pg_query($con, $sql1);    
                          header('location:income.php');
?>
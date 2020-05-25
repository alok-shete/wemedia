<?php

include('includes/config.php');
include('includes/showerror.php');
session_start();
include('includes/issetlogin.php');

  $sql5=pg_query($con,"select * from writer where wstatus='active'");
  $row1 = pg_num_rows($sql5);

                     
  $sql5=pg_query($con,"select * from writer where wstatus='pending'");
  $row2 = pg_num_rows($sql5);

                     
  $sql5=pg_query($con,"select * from writer where wstatus='suspended'");
  $row3 = pg_num_rows($sql5);

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wemedia Admin | Payment</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body>
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="dashboard.php"><b>Wemedia</b></a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="dashboard.php"><b>Dashboard</b></a></li>
              <li ><a href="post.php"><b>Post</b></a></li>
              <li><a href="writer.php"><b>Writer</b></a></li>
              <li class="active"><a href="#"><b>Payment</b></a></li>
              <li><a href="category.php"><b>Category</b></a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><b>Welcome, <?php echo $_SESSION['alogin'];?> </b><span class="glyphicon glyphicon-cog"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="change-password.php">Change Password</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="logout.php">Logout</a></li>
                </ul>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
    <br>
    <section id="breadcrumb">
        <div class="container">
          <ol class="breadcrumb">
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="#">Payment</a></li>
          </ol>
        </div>
      </div>  
    </section>
    <section id="main">
      <div class="container">
        <div class="col-md-12"> 
          <div class="row"> 
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Posts</h3>
              </div>
                <!----active---->
                <table class="table table-striped table-hover">
                  <tr>
                    <th width="">Pay ID</th>
                    <th width="">Writer Id</th>
                    <th width="">Paytm Number</th>
                    <th width="">Income</th>
                    <th width="">Request</th>
                    <th width="">Total Withdraw</th>
                    <th width="">Status</th> 
                  </tr>

                  <!-- paging -->

                  <?php
                    $limit = 2;  
                    if (isset($_GET["page"])) 
                    { 
                      $page  = $_GET["page"]; 
                    } 
                    else 
                    { 
                      $page=1; 
                    };  
                    $id=$_SESSION['aid'];
                    $start_from = ($page-1) * $limit;  
                    $sql = "SELECT * FROM payment WHERE payrequest>0 ORDER BY payid DESC LIMIT $limit offset $start_from ";  
                    $rs_result = pg_query($con, $sql);    
                    while(($row=pg_fetch_array($rs_result))!=null)
                    {
                     
                      $wno=$row['wid'];
                      $sql1 = "SELECT * FROM writer WHERE wid=$wno";  
                      $rs_result1 = pg_query($con, $sql1);    
                      if(($row1=pg_fetch_array($rs_result1))!=null)
                      {
                        echo"<tr>"; 
                        $wno=$row1['wid'];

                        $wname=$row1['wname'];
                        $wemail=$row1['wemail'];
                        $wphone=$row1['wphone'];
                        $wdate=$row1['wdate'];
                        $wstatus=$row1['wstatus'];
                      }
                      $pno=$row['payid'];
                      $tt=$row['twithdraw']+$row['payrequest'];
                      $ff=$row['payincome']+$row['payrequest'];
                      echo"<tr>"; 
                      echo"<td>".$row['wid'];
                      echo"<td>".$row['payid'];
                      echo"<td>".$row['payno'];
                      echo"<td>".$row['payincome'];
                      echo"<td>".$row['payrequest'];
                      echo"<td>".$row['twithdraw'];
                      echo"<td>";
                      



                      ?>
                      <button type="button" class="btn btn-default" data-toggle="modal" data-target="#view<?php echo $wno; ?>">View</button> 
                        <!-- Modal -->
                      <div class="modal fade" id="view<?php echo $wno; ?>" role="dialog">
                        <div class="modal-dialog">
                        <!-- Modal content-->
                          <div class="modal-content">
                            
                             
                            <div class="modal-body">
                              <div class="container">
                                <div style="width: 535px">   
                                  <div class="modal-header">
                                    <h4 class="modal-title">Writer Details</h4>
                                  </div>

                                  <table>
                                  <th>
                                  <h4>Writer ID: </h4>
                                  <h4>Writer Name: </h4>
                                  <h4>Email: </h4>
                                  <h4>Phone Number: </h4>
                                  <h4>Date: </h4>
                                  <h4>Status: </h4>
                                  <h4>Writer Income:</h4>
                                  <h4>Total Withdraw:</h4>
                                  <h4></h4>
                                  </th>
                                  <th>
                                    
                                    <h4><?php echo $row1['wid'];?></h4>
                                    <h4><?php echo $row1['wname'];?></h4>
                                    <h4><?php echo $row1['wemail'];?></h4>
                                    <h4><?php echo $row1['wphone'];?></h4>
                                    <h4><?php echo $row1['wdate'];?></h4>
                                    <h4><?php echo $row1['wstatus'];?></h4>
                                    <h4><?php echo $row['payincome'];?></h4>
                                    <h4><?php echo $row['twithdraw'];?></h4>
                                  </th>

                                  </table>
                                  <div class="modal-header">
                                    <h4 class="modal-title">payment Details</h4>
                                  </div>
                                  <table>
                                    <th>
                                    <h4>Pay ID: </h4>
                                    <h4>Paytm Number: </h4>
                                    <h4>Pay Request: </h4>
                                    </th>
                                    <th>
                                      <h4><?php echo $row['payid'];?></h4>
                                      <h4><?php echo $row['payno'];?></h4>
                                      <h4><?php echo $row['payrequest'];?></h4>
                                    </th>
                                </table>

                                </div>
                              </div>  
                            </div>
                            <div class="modal-footer">
                              <form action="pay.php" method="POST">
                                <input type="hidden" name="d1" value="<?php echo $pno?>">
                                <input type="hidden" name="d2" value="<?php echo $tt?>">
                                <input type="submit" class="btn btn-success" name="pay" value="Pay">
                                <p></p>
                                </form>
                                <form action="fail.php" method="post">
                                   <input type="hidden" name="d1" value="<?php echo $pno?>">
                                   <input type="hidden" name="d2" value="<?php echo $ff?>">
                                  <input type="submit" class="btn btn-danger" name="fail" value="Fail">
                                 
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      <?php
                      echo"</td>";
                      echo"</tr>";
                    }  
                    echo"</table>";
                    $sql = "SELECT * FROM payment WHERE payrequest>0";  
                    $rs_result = pg_query($con, $sql);  
                    $row = pg_num_rows($rs_result);
                    if($row==0)
                    {
                      $row=1;
                    }
                    $total_pages = ceil($row / $limit);
                    $pagLink = "<div class='pagination'>";  
                    for ($i=1; $i<=$total_pages; $i++) 
                    {  
                      $pagLink .= "<a href='post.php?page=".$i."'>".$i."</a>";  
                    };  
                    if (isset($_GET["page"])) 
                    { 
                      $v=$_GET["page"];

                      if($v>1 && $v<$total_pages)
                      {
                        $q=$_GET["page"]-1;
                        $e=$_GET["page"]+1;
                        echo"<a href='payment.php?page=".$q."'><button   class='btn btn-default' id=>prev</button></a>";    
                        echo"<button class='btn btn-default' id=>".$_GET["page"]."</button>";
                        echo"<a href='payment.php?page=".$e."'><button   class='btn btn-default' id=>Next</button></a>";
                      }
                      elseif ($v==$total_pages) 
                      {
                        $q=$_GET["page"]-1;
                        echo"<a href='payment.php?page=".$q."'><button   class='btn btn-default' id=>prev</button></a>";    
                        echo"<button class='btn btn-default' id=>".$_GET["page"]."</button>";
                      }
                      elseif ($v==1) 
                      {
                        echo"<button class='btn btn-default' id=>".$_GET["page"]."</button>";
                        
                          $e=$_GET["page"]+1;
                        echo"<a href='payment.php?page=".$e."'><button   class='btn btn-default' id=>Next</button></a>";
                      }
                    } 
                    else 
                    { 
                      $n=1;
                      echo"<button class='btn btn-default' id=>".$n."</button>";
                      $e=$n+1;
                      if($total_pages!=1)
                        {
                          echo"<a href='payment.php?page=".$e."'><button   class='btn btn-default' id=>Next</button></a>";
                      }
                    };   
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  <!-- post -->
    <footer id="footer">
      <p>Copyright Alok & Amol, &copy; 2019</p>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>


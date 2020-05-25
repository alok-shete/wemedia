<?php

include('includes/config.php');
include('includes/showerror.php');
session_start();
if(isset($_SESSION['post']))
{
  echo "<script>alert('Post uploaded');</script>";
  unset($_SESSION['post']);
}
if(isset($_SESSION['edit']))
{
  echo "<script>alert('Post Is Updated');</script>";
  unset($_SESSION['edit']);
}

include('includes/issetlogin.php');
  $aa=$_SESSION['id'];
$sql3=pg_query($con,"select * from payment where wid=$aa");
  if(($row3 = pg_fetch_array($sql3))!= null)
  {
    $payin=$row3['payincome'];
  }

  $sql4=pg_query($con,"select sum(pview) from post where wid=$aa");
//echo $sql4;
  if(($row4 = pg_fetch_array($sql4))!= null)
  {
    $tpview=$row4['sum'];
  }
    $sql5=pg_query($con,"select * from post where wid=$aa");
//echo $sql4;
  $row5 = pg_num_rows($sql5);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wemedia Writer | Dashboard</title>
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
              <li class="active"><a href="dashboard.php"><b>Dashboard</b></a></li>
              <li><a href="post.php"><b>Post</b></a></li>
              <li><a href="income.php"><b>Income</b></a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><b>Welcome, <?php echo $_SESSION['login'];?> </b><span class="glyphicon glyphicon-cog"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="account.php">Account</a></li>
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
            <li class="active">Dashboard</li>
          </ol>
        </div>
      </div>  
    </section>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title"> Overview</h3>
              </div>
              <div class="panel-body">
                <div class="col-md-4">
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span><?php echo $row5;?></h2>
                      <h4>Posts</h4>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-stats" aria-hidden="true"></span><?php echo $tpview?></h2>
                      <h4>Visitors</h4>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="well dash-box">
                    <h2><span aria-hidden="true">&#8377;</span> <?php echo $payin;?></h2>
                      <h4>Income</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>         
        </div>
      </div>
    </section>

  <!-- post -->

<section id="main">
  <div class="container">
    <div class="col-md-12"> 
      <div class="row"> 
        <!-- Website Overview -->
        <div class="panel panel-default">
          <div class="panel-heading main-color-bg">
            <h3 class="panel-title">Post</h3>
          </div>
          <div class="panel-body">
            <table class="table table-striped table-hover">
                  <tr>
                    <th width="40%">Artical Name</th>
                    <th width="7%">Status</th>
                    <th width="7%">Views</th>
                    <th width="10%">Created</th>
                    <th width="10%">Categories</th>
                    <th width="4%"></th>
                    <th width="6%"></th>
                    <th width="6%"></th>
                  </tr>

                  <!-- paging -->

                  <?php
                    $limit = 10;  
                    if (isset($_GET["page"])) 
                    { 
                      $page  = $_GET["page"]; 
                    } 
                    else 
                    { 
                      $page=1; 
                    };  
                    $id=$_SESSION['id'];
                    $start_from = ($page-1) * $limit;  
                    $sql = "SELECT * FROM post WHERE wid=$id ORDER BY pdate DESC LIMIT $limit offset $start_from ";  
                    $rs_result = pg_query($con, $sql);    
                    while(($row=pg_fetch_array($rs_result))!=null)
                    {
                      echo"<tr>";
                      $pno=$row['pid'];
                      $pt=$row['pname'];
                      $ph=$row['fphoto'];
                      $pcon=$row['pcontent'];
                      $rr=$row['reason'];
                      echo "<td>".$row['pname']."</td>";
                      echo "<td>".$row['pstatus']."</td>";
                      echo"<td>".$row['pview']."</td>";
                      echo"<td>".$row['pdate']."</td>";
                      $p=$row['cid'];
                      $sqll="select cname from category where cid=$p";
                      $rs_resultt = pg_query($con, $sqll);    
                      if(($roww=pg_fetch_array($rs_resultt))!=null)
                      {
                        echo"<td>".$roww['cname']."</td>";
                      }
                      echo"<td>";
                      ?>
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#view<?php echo $pno; ?>">View</button> 
                        <!-- Modal -->
                        <div class="modal fade" id="view<?php echo $pno; ?>" role="dialog">
                          <div class="modal-dialog">
                          <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">                              
                                <h4 class="modal-title"><?php echo $pt; ?></h4>
                                <h7
                              </div>
                              <div class="modal-body">
                                
                                  <div class="container">
                                    <div style="width: 505px">                                
                                      <img src="photo/<?php echo $ph;?>" width=505px height="300"/><br>
                                      <?php echo "<br>".$pcon; ?>
                                    </div>
                                  </div>
                                
                              </div>
                              <?php echo $rr;?>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>

                      <?php
                      echo"</td>"; 

                      echo"<td><div><form action='edit.php' method='POST'>";
                      echo"<input type='hidden' name=pno value=".$pno.">";
                      echo" <input type='submit' value='Edit' class='btn btn-default'></form></div></td>";   

                      echo"<td>";
                      ?>
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#delete<?php echo $pno; ?>">Delete</button> 
                        <!-- Modal -->
                        <div class="modal fade" id="delete<?php echo $pno; ?>" role="dialog">
                          <div class="modal-dialog">
                          <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">                              
                                <h4 class="modal-title">You Want to Delete This Post</h4>
                              </div>
                              <div class="modal-body">
                                <p>
                                  <div class="container">
                                    <div class="col-md-4">                          
                                      <?php echo $pt; ?>
                                    </div>
                                  </div>
                                </p>
                              </div>
                              <div class="modal-footer">
                                <form action="delete.php" method="POST">
                                  <input type="hidden" name="d1" value="<?php echo $pno?>">
                                  <input type="submit" class="btn btn-danger" name="Delete" value="Delete">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>

                      <?php
                      echo"</td>";



                      echo"</td>";
                      echo"</tr>";
                    }  
                    echo"</table>";
                    $sql = "SELECT * FROM post where wid=$id";  
                    $rs_result = pg_query($con, $sql);  
                    $row = pg_num_rows($rs_result);
                   
                    $total_pages = ceil($row / $limit);
                    $pagLink = "<div class='pagination'>";  
                    for ($i=1; $i<=$total_pages; $i++) 
                    {  
                      $pagLink .= "<a href='dashboard.php?page=".$i."'>".$i."</a>";  
                    };  
                    if (isset($_GET["page"])) 
                    { 
                      $v=$_GET["page"];

                      if($v>1 && $v<$total_pages)
                      {
                        $q=$_GET["page"]-1;
                        $e=$_GET["page"]+1;
                        echo"<a href='dashboard.php?page=".$q."'><button   class='btn btn-default' id=>prev</button></a>";    
                        echo"<button class='btn btn-default' id=>".$_GET["page"]."</button>";
                        echo"<a href='dashboard.php?page=".$e."'><button   class='btn btn-default' id=>Next</button></a>";
                      }
                      elseif ($v==$total_pages) 
                      {
                        $q=$_GET["page"]-1;
                        echo"<a href='dashboard.php?page=".$q."'><button   class='btn btn-default' id=>prev</button></a>";    
                        echo"<button class='btn btn-default' id=>".$_GET["page"]."</button>";
                      }
                      elseif ($v==1) 
                      {
                        echo"<button class='btn btn-default' id=>".$_GET["page"]."</button>";
                        
                          $e=$_GET["page"]+1;
                        echo"<a href='dashboard.php?page=".$e."'><button   class='btn btn-default' id=>Next</button></a>";
                      }
                    } 
                    else 
                    { 
                      $n=1;
                      echo"<button class='btn btn-default' id=>".$n."</button>";
                      $e=$n+1;
                      if($total_pages!=1 && $row!=0)
                        {
                          echo"<a href='dashboard.php?page=".$e."'><button   class='btn btn-default' id=>Next</button></a>";
                        }
                    };
                  ?>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</section>

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


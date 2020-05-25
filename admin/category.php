<?php

include('includes/config.php');
include('includes/showerror.php');
session_start();
include('includes/issetlogin.php');
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wemedia Admin | Category</title>
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
              <li><a href="payment.php"><b>Payment</b></a></li>
              <li class="active"><a href="#"><b>Category</b></a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><b>Welcome, <?php echo $_SESSION['alogin'];?></b> <span class="glyphicon glyphicon-cog"></span></a>
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
            <li><a href="#">Category</a></li>
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
                <h3 class="panel-title">ADD Category</h3>
              </div>
              <div class="col-md-12">
                <div class="input-group">
                  <form class="navbar-form navbar-left" action="#" method="POST">
                    <div class="form-group">
                      <input type="text" class="form-control" name='cat' placeholder="Category Name" required="" autocomplete="off">
                    </div>
                    <button type="submit" class="btn btn-default">ADD</button>
                  </form>
                  <?php
                      if(isset($_POST['cat']))
                      {
                        $c=$_POST['cat'];
                        $sql9 = "SELECT * FROM category WHERE cname='$c'" ;  
                        $rs_result9 = pg_query($con, $sql9);
                        $sqlll = "SELECT max(cid) FROM category" ;  
                        $rs_resulttt = pg_query($con, $sqlll);    
                        if(($row=pg_fetch_array($rs_resulttt))!=null)
                        {
                          $cnoo=$row[0];
                        }    
                        if(($row=pg_fetch_array($rs_result9))==null)
                        {
                          $aaid=$_SESSION['aid'];
                          $cnoo=$cnoo+1;
                          $sql6=pg_query($con,"insert into category values($cnoo,'$c',$aaid)");
                         
                        }
                      }
                  ?>
                </div>  
              </div>
            </div>
          </div>
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
                <h3 class="panel-title">Category</h3>
              </div>
                <!----active---->
                <table class="table table-striped table-hover">
                  <tr>
                    <th width="">Category ID</th>
                    <th width="">Category Name</th>
                    <th width="">NO. Post</th>
                    <th></th>
                  

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
                    $id=$_SESSION['aid'];
                    $start_from = ($page-1) * $limit;  
                    $sql = "SELECT * FROM category ORDER BY cid DESC LIMIT $limit offset $start_from ";  
                    $rs_result = pg_query($con, $sql);    
                    while(($row=pg_fetch_array($rs_result))!=null)
                    {
                     
                      $cno=$row['cid'];
                      echo"<tr>"; 
                      echo"<td>".$row['cid']."</td>";
                      echo"<td>".$row['cname']."</td>";
                      echo"<td>";
                        $sql1 = "SELECT * FROM post WHERE cid='$cno'";  
                        $rs_result1 = pg_query($con, $sql1);  
                        $row1 = pg_num_rows($rs_result1);
                        echo $row1;
                        echo "</td>";
                        echo "<td>";
                      ?>
                      <button type="button" class="btn btn-default" data-toggle="modal" data-target="#view<?php echo $cno; ?>">View</button> 
                        <!-- Modal -->
                      <div class="modal fade" id="view<?php echo $cno; ?>" role="dialog">
                        <div class="modal-dialog">
                        <!-- Modal content-->
                          <div class="modal-content">
                            
                             
                            <div class="modal-body">
                              <div class="container">
                                <div style="width: 535px">   
                                  <div class="modal-header">
                                    <h4 class="modal-title">Delete Category</h4>
                                  </div>
                                  <div>
                                    <table>
                                      <th>
                                      <h4>Category ID: </h4>
                                      <h4>Category Name: </h4>
                                      <h4>NO. Post: </h4>
                                      </th>
                                      <th>
                                        <h4><?php echo $row['cid']; ?></h4>
                                        <h4><?php echo $row['cname']; ?></h4>
                                        <h4><?php echo $row1;?></h4>
                                      </th>
                                    </table>
                                  </div>
                                </div>
                              </div>  
                            </div>
                            <?php if($cno==21) 
                                  {
                                    $hh='disabled';
                                  }
                                  else
                                  {
                                    $hh='';
                                  }
                              ?>
                            <div class="modal-footer">
                              <form action="delcat.php" method="POST">
                                <input type="hidden" name="d1" value="<?php echo $cno?>" <?php echo $hh;?>>
                                <input type="hidden" name="d2" value=0 <?php echo $hh;?>>
                                <input type="submit" class="btn btn-danger" name="Delete Category As Well As Related Post" value="Delete Category As Well As Related Post" <?php echo $hh;?>>
                                <p></p>
                                </form>
                                <form action="delcat.php" method="post">
                                   <input type="hidden" name="d1" value="<?php echo $cno?>" <?php echo $hh;?>>
                                   <input type="hidden" name="d2" value=1 <?php echo $hh;?>>
                                  <input type="submit" class="btn btn-success" name="" value="Delete Category But No Related Post" <?php echo $hh;?>>
                                 
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
                    $sql = "SELECT * FROM category";  
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
                      $pagLink .= "<a href='category.php?page=".$i."'>".$i."</a>";  
                    };  
                    if (isset($_GET["page"])) 
                    { 
                      $v=$_GET["page"];

                      if($v>1 && $v<$total_pages)
                      {
                        $q=$_GET["page"]-1;
                        $e=$_GET["page"]+1;
                        echo"<a href='category.php?page=".$q."'><button   class='btn btn-default' id=>prev</button></a>";    
                        echo"<button class='btn btn-default' id=>".$_GET["page"]."</button>";
                        echo"<a href='category.php?page=".$e."'><button   class='btn btn-default' id=>Next</button></a>";
                      }
                      elseif ($v==$total_pages) 
                      {
                        $q=$_GET["page"]-1;
                        echo"<a href='category.php?page=".$q."'><button   class='btn btn-default' id=>prev</button></a>";    
                        echo"<button class='btn btn-default' id=>".$_GET["page"]."</button>";
                      }
                      elseif ($v==1) 
                      {
                        echo"<button class='btn btn-default' id=>".$_GET["page"]."</button>";
                        
                          $e=$_GET["page"]+1;
                        echo"<a href='category.php?page=".$e."'><button   class='btn btn-default' id=>Next</button></a>";
                      }
                    } 
                    else 
                    { 
                      $n=1;
                      echo"<button class='btn btn-default' id=>".$n."</button>";
                      $e=$n+1;
                      if($total_pages!=1 && $row!=0)
                        {
                          echo"<a href='category.php?page=".$e."'><button   class='btn btn-default' id=>Next</button></a>";
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


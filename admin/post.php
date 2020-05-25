<?php

include('includes/config.php');
include('includes/showerror.php');
session_start();
include('includes/issetlogin.php');

  $sql5=pg_query($con,"select * from post where pstatus='active'");
  $row1 = pg_num_rows($sql5);

                     
  $sql5=pg_query($con,"select * from post where pstatus='pending'");
  $row2 = pg_num_rows($sql5);

                     
  $sql5=pg_query($con,"select * from post where pstatus='suspended'");
  $row3 = pg_num_rows($sql5);

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wemedia Admin | post</title>
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
              <li class="active"><a href="#"><b>Post</b></a></li>
              <li><a href="writer.php"><b>Writer</b></a></li>
              <li><a href="payment.php"><b>Payment</b></a></li>
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
            <li><a href="post.php">Post</a></li>
          </ol>
        </div>
      </div>  
    </section>

    <?php
      if (isset($_GET['post'])) 
        { 
          $sel  = $_GET['post']; 
        } 
        else 
        { 
          $sel=1; 
        };
        if($sel==2)
        {

          $ll="active";
          $kk="";
          $jj="";
         
        }
        elseif ($sel==3) 
        {
          $ll="";
          $kk="";
          $jj="active";
        }
        else
        {


           $ll="";
          $kk="active";
          $jj="";
        }

    ?>
    <section id="main">
      <div class="container">
        <div class="col-md-12"> 
          <div class="row"> 
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Posts</h3>
              </div>
              <div class="panel-body">
                <ul class="nav nav-tabs">
                  <li class="<?php echo $kk;?>"><a href='post.php?post=1'>Pending <span class="badge"><?php  echo $row2;?></span></a>
                  <li class="<?php echo $ll;?>"><a href='post.php?post=2'>Active <span class="badge"><?php  echo $row1;?></span></a></li>
                  </li>
                  <li class="<?php echo $jj;?>"><a href='post.php?post=3'>Suspended <span class="badge"><?php  echo $row3;?></span></a>
                  </li>
                </ul>
                <!----active---->
                <?php 
                  if($sel==1)
                  {
                     $sss='pending';
                  }
                  elseif ($sel==2)
                  {
                    $sss='active';
                  }
                  elseif($sel==3)
                  {
                    $sss='suspended';
                  }
                  ?>
                    <table class="table table-striped table-hover">
                  <tr>
                    <th width="40%">Artical Name</th>
                    <th>Writer Id</th>
                    <th>Status</th>
                    <th >Views</th>
                    <th >Created</th>
                    <th >Categories</th>
                    <th ></th>
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
                    $id=$_SESSION['aid'];
                    $start_from = ($page-1) * $limit;  
                    $sql = "SELECT * FROM post WHERE pstatus='$sss' ORDER BY pdate DESC LIMIT $limit offset $start_from ";  
                    $rs_result = pg_query($con, $sql);    
                    while(($row=pg_fetch_array($rs_result))!=null)
                    {
                      echo"<tr>";
                      $pno=$row['pid'];
                      $wno=$row['wid'];
                      $pt=$row['pname'];
                      $ph=$row['fphoto'];
                      $pcon=$row['pcontent'];
                      echo "<td>".$row['pname']."</td>";
                      echo "<td>".$row['wid']."</td>";
                      echo "<td>".$row['pstatus']."</td>";
                      echo"<td>".$row['pview']."</td>";
                      echo"<td>".$row['pdate']."</td>";
                      $ree=$row['reason'];
                      $p=$row['cid'];
                      $sqll="select cname from category where cid=$p";
                      $rs_resultt = pg_query($con, $sqll);    
                      if(($roww=pg_fetch_array($rs_resultt))!=null)
                      {
                        $cname=$roww['cname'];
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
                              </div>

                              
                              <div class="modal-body">
                                
                                  <div class="container">
                                    <div style="width: 535px">                                
                                      <img src="/wemedia/writer/photo/<?php echo $ph;?>" width=535px height="300"/><br>
                                      <?php echo "<br>".$pcon; ?>
                                    </div>
                                  </div>
                                
                              </div>
                              <div class="modal-footer">
                                <?php echo $ree; ?>
                                <form action="publish.php" method="POST">

                                  <input type="hidden" name="d2" value="<?php echo $pno?>">
                                  <input type="submit" class="btn btn-success" name="Delete" value="Publish">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  <p></p>
                                </form>
                                <form action="suspend.php" method="post">
                                  <div class="col-md-5">
                                    <select class="form-control" required name="res1">
                                    <option value="">None</option>
                                    <option>Wrong category</option>
                                    <option>Low content</option>
                                    <option>Pornographic or vulgar content</option>
                                    <option>Political or religious sensitive content</option>
                                    <option >Blood or horror or violence or disgusting content</option>
                                    <option>Fake news or rumors</option>
                                    <option>Serious infringement plagiarism</option>
                                    <option>Old news content</option>
                                    <option>Inductive title, Usage of inductive cover figure</option>
                                    <option>Fake hot topic</option>
                                    <option>Advertising or marketing information</option>
                                    <option>Hard news</option>
                                    <option>Low thumbnail</option>

                         
                                  </select>
                                  </div>
                                  <div class="col-md-5">
                                    <textarea rows="1" cols="5" class="form-control" name ="res2" ></textarea>
                                  </div>
                                  
                                   <input type="hidden" name="d2" value="<?php echo $pno?>">
                                  <input type="submit" class="btn btn-danger" name="Delete" value="Suspend">
                                 
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
                    $sql = "SELECT * FROM post where pstatus='$sss'";  
                    $rs_result = pg_query($con, $sql);  
                    $row = pg_num_rows($rs_result);
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
                        echo"<a href='post.php?post=".$sel."&page=".$q."'><button   class='btn btn-default' id=>prev</button></a>";    
                        echo"<button class='btn btn-default' id=>".$_GET["page"]."</button>";
                        echo"<a href='post.php?post=".$sel."&page=".$e."'><button   class='btn btn-default' id=>Next</button></a>";
                      }
                      elseif ($v==$total_pages) 
                      {
                        $q=$_GET["page"]-1;
                        echo"<a href='post.php?post=".$sel."&page=".$q."'><button   class='btn btn-default' id=>prev</button></a>";    
                        echo"<button class='btn btn-default' id=>".$_GET["page"]."</button>";
                      }
                      elseif ($v==1) 
                      {
                        echo"<button class='btn btn-default' id=>".$_GET["page"]."</button>";
                        
                          $e=$_GET["page"]+1;
                        echo"<a href='post.php?post=".$sel."&page=".$e."'><button   class='btn btn-default' id=>Next</button></a>";
                      }
                    } 
                    else 
                    { 
                      $n=1;
                      echo"<button class='btn btn-default' id=>".$n."</button>";
                      $e=$n+1;
                      if($total_pages!=1 &&  $row!=0 )
                        {
                          echo"<a href='post.php?post=".$sel."&page=".$e."'><button   class='btn btn-default' id=>Next</button></a>";
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


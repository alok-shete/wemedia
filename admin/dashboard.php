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
    <title>Wemedia Admin | Dashboard</title>
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
              <li class="active"><a href="#"><b>Dashboard</b></a></li>
              <li><a href="post.php"><b>Post</b></a></li>
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
                    <h2>
                      <span class="glyphicon glyphicon-stats" aria-hidden="true">
                        </span>
                        <?php
                          $sql1=pg_query($con,"select sum(pview) from post");
                          if(($row1 = pg_fetch_array($sql1))!= null)
                          {
                            $payre=$row1['sum'];
                            echo $payre;
                          }
                        ?>
                      </h2>
                      <h4>Total Visitors</h4>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="well dash-box">
                    <h2><span aria-hidden="true">&#8377;</span>
                      <?php
                        $sql2=pg_query($con,"select sum(payrequest) from payment");
                        if(($row2 = pg_fetch_array($sql2))!= null)
                        {
                          $payre=$row2['sum'];
                          echo $payre;
                        }
                      ?>
                    </h2>
                      <h4>Request Amount</h4>
                  </div>
                </div>
                 <div class="col-md-4">
                  <div class="well dash-box">
                    <h2><span aria-hidden="true">&#8377;</span>
                      <?php
                        $sql2=pg_query($con,"select sum(twithdraw) from payment");
                        if(($row2 = pg_fetch_array($sql2))!= null)
                        {
                          $payre=$row2['sum'];
                          echo $payre;
                        }
                      ?>
                    </h2>
                      <h4>Pay Amount</h4>
                  </div>
                </div>
              </div>
              <div class="panel-body">
                <div class="col-md-4">
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                      <?php
                          $sql5=pg_query($con,"select * from post where pstatus='active'");
                          $row5 = pg_num_rows($sql5);
                          echo $row5;
                      ?>
                    </h2>
                      <h4>Active Posts</h4>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                      <?php
                          $sql5=pg_query($con,"select * from post where pstatus='pending'");
                          $row5 = pg_num_rows($sql5);
                          echo $row5;
                      ?>
                    </h2>
                      <h4>Pending Post</h4>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                      <?php
                          $sql5=pg_query($con,"select * from post where pstatus='suspended'");
                          $row5 = pg_num_rows($sql5);
                          echo $row5;
                      ?>
                    </h2>
                      <h4>Suspended Post</h4>
                  </div>
                </div>
              </div>
              <div class="panel-body">
                <div class="col-md-4">
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                      <?php
                          $sql5=pg_query($con,"select * from writer where wstatus='active'");
                          $row5 = pg_num_rows($sql5);
                          echo $row5;
                      ?>
                    </h2>
                      <h4>Active Writer</h4>
                  </div>
                </div> 
                <div class="col-md-4">
                  <div class="well dash-box">
                    <h2><span  class="glyphicon glyphicon-user" aria-hidden="true"></span>
                      <?php
                          $sql5=pg_query($con,"select * from writer where wstatus='pending'");
                          $row5 = pg_num_rows($sql5);
                          echo $row5;
                      ?>
                    </h2>
                      <h4>Pending Writer</h4>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="well dash-box">
                    <h2><span  class="glyphicon glyphicon-user" aria-hidden="true"></span>
                      <?php
                          $sql5=pg_query($con,"select * from writer where wstatus='suspended'");
                          $row5 = pg_num_rows($sql5);
                          echo $row5;
                      ?>
                    </h2>
                      <h4>Suspended Writer</h4>
                  </div>
                </div>
                 
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


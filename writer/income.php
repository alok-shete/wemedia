<?php

include('includes/config.php');
include('includes/showerror.php');
session_start();
include('includes/issetlogin.php');
$uname=$_SESSION['id'];
$sql3=pg_query($con,"select * from payment where wid=$uname");
  if(($row3 = pg_fetch_array($sql3))!= null)
  {
    $payin=$row3['payincome'];
    $payre=$row3['payrequest'];
    $paywi=$row3['twithdraw'];
  }
  if(isset($_POST['payno']))
  {
    if($payin>=1000)
    {
      $pp=$_POST['payno'];
      $ppp=$_POST['payno1'];
      if($pp==$ppp)
     {
        $payre1=$payre+$payin;
        $payin1=0;
        $sql=pg_query($con,"update payment set payno=$ppp,payincome=$payin1,payrequest=$payre1 where wid=$uname");
        header('location:income.php');
      }
      else
      {
        echo "<script>alert('Paytm No is not Match');</script>";
      }
    }
    else
    {
      echo "<script>alert('Insufficient Balance');</script>";
    }
  }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wemedia Writer | Income</title>
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
              <li><a href="post.php"><b>Post</b></a></li>
              <li class="active"><a href="#"><b>Income</b></a></li>
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
            <li >Dashboard</li>
            <li class="active"><a href="income.php">Income</a></li>
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
                <form action="update.php" method="POST">
                  <h3 class="panel-title">Update Writer Income <input type="submit" value="Update"class="btn btn-success" name="up"></h3>
                </form>
              </div>
            </div>
          </div>
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
                    <h2><span  aria-hidden="true">&#8377;</span> <?php echo $payin;?></h2>
                    <h4>Income</h4>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="well dash-box">
                    <h2><span aria-hidden="true">&#8377;</span> <?php echo $payre;?></h2>
                    <h4>Withdraw request</h4>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="well dash-box">
                    <h2><span aria-hidden="true">&#8377;</span> <?php echo $paywi;?></h2>
                    <h4>Total Withdrawal</h4>
                  </div>
                </div>
              </div>
            </div>         
          </div>
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
                <h3 class="panel-title"> Payment Info & Rules</h3>
              </div>
              <div class="panel-body">
                <div class="col-md-4">
                  <form id="signup" action="#" class="well" method="POST">
                    <div class="form-group">
                      <label>Paytm Number</label>
                      <input type="text" class="form-control" autocomplete="off" name ="payno" pattern="[7-9]{1}[0-9]{9}" required="">
                    </div>
                    <div class="form-group">
                      <label>confirm Number</label>
                      <input type="text" class="form-control" autocomplete="off" name ="payno1" pattern="[7-9]{1}[0-9]{9}" required="">
                    </div>
                    <?php
                    $dd=date("d");
                      if($dd<=15 && $dd>=10)
                      {
                        echo "<input type='submit' name='submit' value='Withdraw Money' class='btn btn-default btn-block'>";
                      }
                      else
                      {
                        echo "<input type='submit' name='submit' value='Withdraw Money' class='btn btn-default btn-block' disabled>";
                      }
                    

                    ?>
                  </form>
                </div>
                <div class="col-md-8">
                  <h5>
                      <p><li><b>You can withdraw to Paytm when your balance reaches Rs 1,000.</li></p>
                      <p><li>You shall only apply for withdrawal once between 10th and 15th of each month, and the amount will be transferred to your Paytm within 7 business days. The amount will be accumulated to the next month if you do not apply for the withdrawal.</li></p>
                      <p><li>Your Revenue is Update Everyday</b></li></p>
                      
                  </h5>
                </div>
              </div>
            </div>         
          </div>
        </div>
      </div>
    </section>

        <footer  id="footer">
      <p>Copyright Alok & Amol, &copy; 2019</p>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>


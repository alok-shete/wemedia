<?php

include('includes/config.php');
include('includes/showerror.php');
session_start();
include('includes/issetlogin.php');

if(isset($_POST['password']))
{
    // Getting username/ email and password
    $p=$_POST['password'];
    $p1=$_POST['password1'];
    $p2=$_POST['password2'];
    $uno=$_SESSION['id'];
    // Fetch data from database on the basis of username/email and password
    $sql=pg_query($con,"SELECT * FROM writer WHERE wid='$uno' AND wpass='$p'");
    $row = pg_fetch_array($sql);
    if($row!= null)
    {
      if((strcmp($p1,$p2))==0)
      {
        $sql=pg_query($con,"update writer set wpass='$p2' where wid='$uno'");
        echo "<script>alert('Password Changed');</script>";
      }
      else
      {
          echo "<script>alert('Password Miss Match');</script>";
      }
    }
    else
    {
        echo "<script>alert('Wrong Password');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wemedia Writer | Password Change</title>
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
              <li><a href="income.php"><b>Income</b></a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><b>Welcome, <?php echo $_SESSION['login'];?> </b><span class="glyphicon glyphicon-cog"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="account.php">Account</a></li>
                  <li><a href="#">Change Password</a></li>
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
          <li>Change Password</li>
          </ol>
        </div>
      </div>  
    </section>
    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
              <form id="login" action="#" class="well" method="POST">
                  <div class="form-group">
                    <label>Current Passwod</label>
                    <input type="password" class="form-control" name="password" placeholder="Current Password" required>
                  </div>
                    <div class="form-group">
                    <label>New Password</label>
                    <input type="text" class="form-control" autocomplete="off" name="password1" placeholder="New Password" required>
                  </div>
                  <div class="form-group">
                    <label>Re-Enter Password</label>
                    <input type="password" class="form-control" name="password2" placeholder="Re-Enter Password" required>
                  </div>
                  <button type="submit" class="btn btn-default btn-block">Change</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <br>
      <br>
      <br>
      <br>
      <br>
</section>

    <style>
          .footer {
               position: fixed;
               left: 0;
               bottom: 0;
               width: 100%;
               background-color: red;
               color: white;
               text-align: center;
            }
    </style>
      <footer class="footer" id="footer">
    <p>Copyright Alok & Amol, &copy; 2019</p>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

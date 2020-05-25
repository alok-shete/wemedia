<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if(isset($_SESSION['alogin']))
{
  header('location:dashboard.php');  
}


//Database Configuration File
include('includes/config.php');
//error_reporting(0);
if(isset($_POST['username']))
{
    // Getting username/ email and password
    $uname=$_POST['username'];
    $password=$_POST['password'];
    // Fetch data from database on the basis of username/email and password
		$sql=pg_query($con,"SELECT * FROM admin WHERE aemail='$uname' AND apass='$password'");
		$row = pg_fetch_array($sql);
		if($row!= null)
		{
        $_SESSION['aid']=$row[0];
        $_SESSION['alogin']=$row[1];
        header('location:dashboard.php'); 
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
    <title>Admin Area | Account Login</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body>

    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><b>Wemedia</b></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">

        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="text-center"> Admin Area <small>Account Login</small></h1>
          </div>
        </div>
      </div>
    </header>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <form id="login" action="#" class="well" method="POST">
                  <div class="form-group">
                    <label>Email Address</label>
                    <input type="text" class="form-control" name ="username" placeholder="Enter Email" required autocomplete="OFF">
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                  </div>
                  <button type="submit" class="btn btn-default btn-block">Login</button>
            </form> 
          </div>
        </div>
      </div>
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



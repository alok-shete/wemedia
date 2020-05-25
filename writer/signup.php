
<?php
include('includes/showerror.php');  
include('includes/config.php');
session_start();
if(isset($_POST['fname']))
{
  $pass=$_POST['password'];
  $fname=$_POST['fname'];
  $lname=$_POST['lname'];
  $email=$_POST['email'];
  $pno=$_POST['number'];
  $add=$_POST['address'];
  $space=' ';
  $name=$fname.$space.$lname;
  $date=date("Y/m/d");
  $status='pending';
  // Fetch data from database on the basis of username/email and password
  $sql=pg_query($con,"SELECT * FROM writer WHERE wemail='$email'");
  if(($row = pg_fetch_array($sql)) == null)
  {
    $sql1=pg_query($con,"select max(wid) from writer");
    if(($row1 = pg_fetch_array($sql1))!= null)
    {
      $no=$row1[0]+1;
      $sql2=pg_query($con,"insert into writer values($no,'$name','$email','$add','$pno','$pass','$date','$status',0)");
      $sql4=pg_query($con,"select max(payid) from payment");
      if(($row4 = pg_fetch_array($sql4))!= null)
      {
        $pay=$row4[0]+1;
        $sql3=pg_query($con,"insert into payment values($pay,0,$no,'$pno',0,0,0)");
        $_SESSION['signup']="signup";

        header('location:index.php');
        
      }
    }
  }
  else
  {
      echo "<script>alert('Email already registered');</script>";
  }
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wrier Area | Account Signup</title>
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
            <h1 class="text-center"> Writer Area <small>Account Sign Up</small></h1>
          </div>
        </div>
      </div>
    </header>

     <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <form id="signup" action="#" class="well" method="POST">
            	<div class="form-group">
                    <label>First Name</label>
                    <input type="text" class="form-control" name ="fname" placeholder="Enter First Name" required autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" class="form-control" name ="lname" placeholder="Enter Last Name" required autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" class="form-control" name ="email" placeholder="Enter Email" required autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label>Phone Number</label>
                    <input type="tel" class="form-control"  pattern="[7-9]{1}[0-9]{9}" name="number" placeholder="Enter Phone Number" required autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter Password" required autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label>Address</label>
                    <textarea rows="4" cols="6" class="form-control" name ="address" placeholder="Enter Address" required></textarea>
                  </div>
                  <button type="submit" class="btn btn-default btn-block">Sign Up</button>
              </form>
              <form id="signup" action="index.php" class="well">
                  <div class="form-group">
                <button type="submit" class="btn btn-default btn-block">Login</button>
                </div>
                </form>
            </form>
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



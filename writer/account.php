<?php

include('includes/config.php');
include('includes/showerror.php');
session_start();
include('includes/issetlogin.php');
$uname=$_SESSION['id'];
$sql=pg_query($con,"SELECT * FROM writer WHERE wid='$uname'");
if(($row = pg_fetch_array($sql)) != null)
  {
    $t=$row[1];
    $t1=$row[2];
    $t3=$row[3];
    $t2=$row[4];
  }
  if(isset($_POST['submit']))
  {
    $email=$_POST['email'];
    $pno=$_POST['number'];
    $add=$_POST['address'];
    $sql=pg_query($con,"update writer set wemail='$email',waddress='$add',wphone='$pno' where wid='$uname'");
      echo "<script>alert('Account Updated');</script>";
  }

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
            <a class="navbar-brand" href="dashboard.php"><b>Wemedia</b>s</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="dashboard.php"><b>Dashboard</b></a></li>
              <li><a href="post.php"><b>Post</b></a></li>
              <li><a href="income.php"><b>Income</b></a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><b>Welcome, <?php echo $_SESSION['login'];?></b> <span class="glyphicon glyphicon-cog"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Account</a></li>
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
          <li class="active">Account</li>
        </ol>
      </div>
    </section>
    <section id="breadcrumb">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <form id="edit" action="#" class="well" method="POST">
              
              <div class="form-group">
                  <label>Name</label>
                  <textarea rows="1" cols="6" class="form-control" name ="name"required disabled><?php echo $t?> </textarea>
                </div>
                <div class="form-group">
                  <label>Email Address</label>
                  <input type="email" class="form-control" name ="email" required="" value=<?php echo $t1 ?> >
                </div>
                <div class="form-group">
                  <label>Phone Number</label>
                  <input type="tel" class="form-control" pattern="[7-9]{1}[0-9]{9}" name="number" required="" value=<?php echo $t2?> >
                </div>
                <div class="form-group">
                  <label>Address</label>
                  <textarea rows="4" cols="6" class="form-control"  name ="address"required><?php echo $t3?> </textarea>
                </div>
                <input type="submit" name="submit" value="Update" class="btn btn-default btn-block">
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

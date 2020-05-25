
<?php

include('includes/config.php');
include('includes/showerror.php');
session_start();
if(!isset($_GET['pno']))
{
  header('location:index.php');  
}
$pno=$_GET['pno'];
if($pno==null)
{
  header('location:index.php'); 
}
$sql="SELECT * FROM post WHERE pid=$pno";
$rs_result = pg_query($con, $sql);    
  while(($row=pg_fetch_array($rs_result))!=null)
  {
    $pname=$row['pname'];
    $photo=$row['fphoto'];
    $content=$row['pcontent'];
    $cat=$row['cid'];
  }
$sql1="update post set pview = pview+1 where pid=$pno;";
$re=pg_query($sql1);
$sql="SELECT * FROM category WHERE cid=$cat";
$rs_result = pg_query($con, $sql);    
  while(($row=pg_fetch_array($rs_result))!=null)
  {
    $cat=$row['cname'];
  }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wemedia</title>
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
          <a class="navbar-brand" href="index.php"><B>Wemedia</B></a>
        </div>
      </div>
    </nav>
   <br> 
    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-10 col-md-offset-1">
            <div class="jumbotron">
               <h3><b><?php echo $pname;?></b></h3>
               <h4><span class="label label-success"><?php echo $cat;?></span></h4>
               <br>
               <img src='/wemedia/writer/photo/<?php echo $photo; ?>' alt=""style="width:830px;height:500px;">
               <p>
                 <?php echo $content; ?>
               </p>
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
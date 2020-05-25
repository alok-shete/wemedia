
<?php
if(!isset($_POST['pno']))
{
  header('location:dashboard.php');  
}

$b=$_POST['pno'];
include('includes/config.php');
include('includes/showerror.php');
session_start();
include('includes/issetlogin.php');
if(isset($_POST['title']))
{
   $category=$_POST['category'];
  $str=$_POST['content'];
  $content=pg_escape_string($str);
  $str1=$_POST['title'];
  $title=pg_escape_string($str1);
  $photo=$_POST['photo'];
  //content
  if(empty($content))
  {
    echo "<script>alert('Please Fill The Textarea');</script>";
  }
  //title
  if(empty($title))
  {
    echo "<script>alert('Please Fill The Title');</script>";

  }
  //photo
  if(empty($photo))
  {
    echo "<script>alert('Upload Image');</script>";

  }
  //category
  if(empty($category))
  {
    echo "<script>alert('Select Category');</script>";
  }
  if(!empty($content) && !empty($category) && !empty($photo) && !empty($title))
  {
    $date=date("Y/m/d");
    $status='pending';
    $user=$_SESSION['login'];
    $view=0;
    $wno=$_SESSION['id'];
    $sql1=pg_query($con,"select * from category where cname='$category'");
    if(($row1=pg_fetch_array($sql1))!=null)
    {
      $cno=$row1[0];
    }
    $no=$_POST['pno'];
    $q="update post set cid=$cno, pname='$title',pcontent='$content', pdate='$date',pview=$view,pstatus='$status',fphoto='$photo',aid=0 where pid=$no";
    $sql2=pg_query($con,$q);
     $_SESSION['edit']="edit";
    header('location:dashboard.php');
  }
  else
  {
    echo "<script>alert('Recode Is Not Inserted');</script>";
  }
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wemedia Publisher | Posts</title>
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
          <li><a href="dashboard.php">Dashboard</a></li>
          <li class="active">Post</li>
        </ol>
      </div>
    </section>
    <?php
    	$sql3=pg_query($con,"select * from post where pid=$b");
    	if(($row3=pg_fetch_array($sql3))!=null)
    	{
      		$name=$row3['pname'];
      		$content=$row3['pcontent'];	
 		}   
    ?>
    

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
          </div>
          <div class="col-md-12">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Edit Artical</h3>
              </div>
              <div class="panel-body">
                <form action="#" method="POST">
                  <div class="form-group">
                  	<input type='hidden' name=pno value="<?php echo $_POST['pno'];?>">
                    <label>Artical Title</label>
                    <textarea rows="1" cols="6" class="form-control" name ="title" required><?php echo $name?> </textarea>
                  </div>
                  <div class="form-group">
                    <label>Artical Body</label>
                    <textarea class="tinymce" name="content">
                    <?php echo $content; ?>
                    </textarea>
                  </div>
                  <div class="container">
                    <div class="col-md-3">                    
                      <div class="input-group">
                  <label >Upload Image</label>
                      </div>
                    </div>
                  </div>
                  <div class="container">
                    <div class="col-md-3">                    
                      <div class="input-group">
                           <input type="file" name="photo" id="real-file" required="" style="display: none;" />
                        <button type="button" class="btn btn-default" accept="image/*" id="custom-button">Select</button>
                        <span id="custom-text"> No file chosen,yet.</span>
                        <script>
                         const realFileBtn = document.getElementById("real-file");
                        const customBtn = document.getElementById("custom-button");
                        const customTxt = document.getElementById("custom-text");

                        customBtn.addEventListener("click", function() {
                          realFileBtn.click();
                        });

                        realFileBtn.addEventListener("change", function() {
                          if (realFileBtn.value) {
                            customTxt.innerHTML = realFileBtn.value.match(
                              /[\/\\]([\w\d\s\.\-\(\)]+)$/
                            )[1];
                          } else {
                            customTxt.innerHTML = " No file chosen, yet.";
                          }
                        });

                        </script>
                      </div>
                    </div>
                  </div>
                  <div class="container">
                    <div class="col-md-3">
                       <div class="form-group">
                        <label >Select Catrgory:</label>
                        <select class="form-control" name="category">
                          <?php 
                          $sql=pg_query($con,"SELECT * FROM category");
                          while(($row =  pg_fetch_array($sql))!= null)
                          {
                            echo"<option>".$row['1'];
                            echo"</option>";
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="container">
                    <div class="col-md-6">
                      <div class="form-group">  
                        <input type="submit" class="btn btn-default" value="Submit"> 
                      </div>
                    </div>
                  </div>
                </form>
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
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="plugin/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="plugin/tinymce/init-tinymce.js"></script>
  </body>
</html>




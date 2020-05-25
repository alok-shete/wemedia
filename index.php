
<?php

include('includes/config.php');
include('includes/showerror.php');
session_start();
if(!isset($_GET['cno']))
{
  $mm=0;
  $pp="class='active'"; 
}
else
{
  $mm=$_GET['cno'];
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
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <?php
              if($mm==0)
              {
                echo "<li class='active'><a href='index.php'><b>ALL</b></a></li>";
              }
              else
              {
                echo "<li><a href='index.php'><b>ALL</b></a></li>";
              }
              
              $sql=pg_query($con,"SELECT * FROM category ORDER BY cid ASC");
              while(($row = pg_fetch_array($sql)) != null)
              {
                $a=$row['cname'];
                $b=$row['cid'];
                if($mm==$b)
                {
                  echo"<li class='active'><a href='index.php?cno=".$b."'><b>".$a."</b></a></li>";
                }
                else
                {
                  echo"<li ><a href='index.php?cno=".$b."'><b>".$a."</b></a></li>";
                }
              } 
              if(isset($_GET['cno']))
              {
                $cc=$_GET['cno'];
                $aa="WHERE cid='$cc' AND pstatus='active'";
              
              }
              else
              {
                $aa="WHERE pstatus='active'"; 
              }
              ?>
            </ul>
          </div>
        </div>
      </nav>
    <br>
  <!-- post -->

<section id="main">
  <div class="container">
    <?php
      $limit = 9;  
      if (isset($_GET["page"])) 
      { 
        $page  = $_GET["page"]; 
      } 
      else 
      { 
        $page=1; 
      };  
      $start_from = ($page-1) * $limit;  
      $sql = "SELECT * FROM post $aa ORDER BY pdate DESC LIMIT $limit offset $start_from ";  
      $rs_result = pg_query($con, $sql);    
      while(($row=pg_fetch_array($rs_result))!=null)
      {?>
        <div class="col-sm-6 col-md-4">
          <div class="thumbnail">
           <img src='/wemedia/writer/photo/<?php echo $row['fphoto']; ?>' alt="" style="width:342px;height:200px;">
            <div class="caption">
              <h4><a href="post.php?pno=<?php echo $row['pid']; ?>"><?php echo $row['pname']; ?></a></h4>
            </div>
          </div>
        </div>
      <?php
      }
    ?>
  </div>
  <div class="container">
  <?php
    $sql = "SELECT * FROM post $aa";  
    $rs_result = pg_query($con, $sql);  
    $row = pg_num_rows($rs_result);
    $total_pages = ceil($row / $limit);
    $pagLink = "<div class='pagination'>";
    if(isset($_GET['cno'])) 
    {
      if(isset($_GET["page"])) 
      { 
        $v=$_GET["page"];
        if($v>1 && $v<$total_pages)
        {
          $q=$_GET["page"]-1;
          $e=$_GET["page"]+1;
          echo"<a href='index.php?cno=".$cc."&page=".$q."'><button   class='btn btn-default' id=>prev</button></a>";    
          echo"<button class='btn btn-default' id=>".$_GET["page"]."</button>";
          echo"<a href='index.php?cno=".$cc."&page=".$e."'><button   class='btn btn-default' id=>Next</button></a>";
        }
        elseif ($v==$total_pages) 
        {
          $q=$_GET["page"]-1;
          echo"<a href='index.php?cno=".$cc."&page=".$q."'><button   class='btn btn-default' id=>prev</button></a>";    
          echo"<button class='btn btn-default' id=>".$_GET["page"]."</button>";
        }
        elseif ($v==1) 
        {
          echo"<button class='btn btn-default' id=>".$_GET["page"]."</button>";
          $e=$_GET["page"]+1;
          echo"<a href='index.php?cno=".$cc."&page=".$e."'><button   class='btn btn-default' id=>Next</button></a>";
        }
      } 
      else 
      { 
        $n=1;
        echo"<button class='btn btn-default' id=>".$n."</button>";
        $e=$n+1;
        if($total_pages!=1 &&  $row!=0 )
        {
          echo"<a href='index.php?cno=".$cc."&page=".$e."'><button   class='btn btn-default' id=>Next</button></a>";
        }
      };
     } 
     else
     {
      if(isset($_GET["page"])) 
      { 
        $v=$_GET["page"];
        if($v>1 && $v<$total_pages)
        {
          $q=$_GET["page"]-1;
          $e=$_GET["page"]+1;
          echo"<a href='index.php?page=".$q."'><button   class='btn btn-default' id=>prev</button></a>";    
          echo"<button class='btn btn-default' id=>".$_GET["page"]."</button>";
          echo"<a href='index.php?page=".$e."'><button   class='btn btn-default' id=>Next</button></a>";
        }
        elseif ($v==$total_pages) 
        {
          $q=$_GET["page"]-1;
          echo"<a href='index.php?page=".$q."'><button   class='btn btn-default' id=>prev</button></a>";    
          echo"<button class='btn btn-default' id=>".$_GET["page"]."</button>";
        }
        elseif ($v==1) 
        {
          echo"<button class='btn btn-default' id=>".$_GET["page"]."</button>";
          $e=$_GET["page"]+1;
          echo"<a href='index.php?page=".$e."'><button   class='btn btn-default' id=>Next</button></a>";
        }
      } 
      else 
      { 
        $n=1;
        echo"<button class='btn btn-default' id=>".$n."</button>";
        $e=$n+1;
        if($total_pages!=1 &&  $row!=0 )
        {
          echo"<a href='index.php?page=".$e."'><button   class='btn btn-default' id=>Next</button></a>";
        }
      };
     }
                  
  ?>
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




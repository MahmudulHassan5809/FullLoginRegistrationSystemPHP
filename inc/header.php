<?php  
include 'lib/Session.php';
Session::init();


include 'lib/Database.php' ;
include 'helpers/Format.php';
 include_once 'classes/User.php';
$db=new Database();
$fm=new Format();
$user=new User();

?>
<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<script type="text/javascript" src="js/myjavascript.js"></script>
</head>
<body>
    <?php 
               if (isset($_GET['id'])) {
                $id=$_GET['id'];
                
                Session::destroy();
               }
       ?>

   <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Login Registration Sysytem</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
         <?php 
            $login=Session::get('login');
            if($login==true){?>
                 <li><a href="profile">Profile</a></li>
               <li><a href="?id=<?php echo Session::get('userid');?>">Logout</a></li>
          <?php   } else {?>
        
        <li><a href="register.php">Register</a></li>
        <?php } ?>
     
    </ul>
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

   
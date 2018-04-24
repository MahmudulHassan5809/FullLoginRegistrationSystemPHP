<?php 
 include_once 'classes/User.php';
  $user=new User();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<script type="text/javascript" src="js/myjavascript.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
</head>
<body>

 <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <h2>Login And Registration System</h2>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
     
    
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php" class="btn btn-info md">Back</a></li>
      </ul>
    </div>
  </div>
</nav>
  <?php 
  if($_SERVER['REQUEST_METHOD']== 'POST')
   {
       $passreset=$user->passReset($_POST);
   }
 ?>
 <section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
       <div class="form-wrap">
      <h1>Log in with your email account</h1>
      <?php 
          if (isset($passreset)) {
          	echo $passreset;
          }
      ?>
         <form role="form" action="" method="POST" id="login-form" >
         <div class="form-group">
          <label for="email" class="sr-only">Email</label>
          <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
        </div>
         <button type="submit" class="btn btn-success"/>Reset</button>
   </form> 
       
          <hr>              
      </div>
         </div>
           </div>
   </section>   
   
</body>
</html>

<?php include 'inc/footer.php' ?>
	 
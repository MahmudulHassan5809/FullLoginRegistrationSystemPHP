<?php 
include_once ('lib/Session.php');
include_once ('lib/Database.php');
Session::init();
 $db= new Database();
 if( isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']) ){

     $email=mysqli_real_escape_string($db->link,$email);
     $hash=mysqli_real_escape_string($db->link,$hash);  
     
     $query="SELECT  * FROM users WHERE email='$email' AND hash='$hash'";
     $result=$this->db->select($query);
     if ($result==false) {
        $_SESSION['message'] = "You have entered invalid URL for password reset!";
        header("location: error.php");
      } 
  }
  else {
    $_SESSION['message'] = "Sorry, verification failed, try again!";
    header("location: error.php");  
      }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Reset Your Password</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<script type="text/javascript" src="js/myjavascript.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
</head>
    
    <section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
       <div class="form-wrap">
      <h1>Reset Your Password</h1>
      <?php 
          if (isset($passreset)) {
          	echo $passreset;
          }
      ?>
         <form role="form" action="reset_password.php" method="POST" id="login-form" >
         <div class="form-group">
          <label for="password" class="sr-only">Email</label>
          <input type="password" name="newpassword" id="password" class="form-control" placeholder="somebody@example.com">
        </div>
         
       <div class="form-group">
          <label for="password" class="sr-only">Email</label>
          <input type="password" name="confirmpassword" id="password" class="form-control" placeholder="somebody@example.com">
        </div>
        <div class="form-group">
        	 <input type="hidden" name="email" value="<?= $email ?>">    
              <input type="hidden" name="hash" value="<?= $hash ?>">
        </div>

        <button type="submit" class="btn btn-success"/>Reset</button>
        <hr>        
   </form> 
         </div>
         </div>
           </div>
   </section>   

<body>

</body>
</html>
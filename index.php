<?php include 'inc/header.php';
  Session::CheckLogin();
 ?>

 <?php 
  if($_SERVER['REQUEST_METHOD']== 'POST' && isset($_POST['login']))
   {
       $userlogin=$user->userLogin($_POST);
   }
?>
 <section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="form-wrap">
                <h1>Log in with your email account</h1>
                <?php 
                    if (isset($userlogin)) {
                        echo $userlogin;
                    }

                ?>
                    <form role="form" action="" method="POST" id="login-form" >
                        <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                        <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                        <div class="checkbox">
                            <span class="character-checkbox" onclick="showPassword()"></span>
                            <span class="label">Show password</span>
                        </div>
                        <input type="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Log in" name="login">
                    </form>
                    <a href="forgot.php" class="forget" data-toggle="modal" data-target=".forget-modal">Forgot your password?</a>
                    <hr>
                </div>
            </div>
        </div> 
    </div> 
</section>

<?php include 'inc/footer.php'; ?>
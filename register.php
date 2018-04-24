<?php include 'inc/header.php'; ?>

<?php 
  if($_SERVER['REQUEST_METHOD']== 'POST' && isset($_POST['register']))
   {
       $userreg=$user->userReg($_POST);
   }



?>

<div class="container">
  <div class="row">
    <div class="col-md-6 col-sm-12 col-lg-6 col-md-offset-3">
    <div class="panel panel-primary">
      <div class="panel-heading">Enter Your Details Here
        <?php 
          if (isset($userreg)) {
             echo $userreg;
          }

        ?>
      </div>
      <div class="panel-body">
        <form name="myform" action="" method="POST">
          <div class="form-group">
            <label for="firsname">First Name *</label>
            <input id="myName" name="first_name" class="form-control" type="text" data-validation="required">
            <span id="error_name" class="text-danger"></span>
          </div>
          <div class="form-group">
            <label for="lastname">Last Name *</label>
            <input id="lastname" name="last_name" class="form-control" type="text" data-validation="email">
            <span id="error_lastname" class="text-danger"></span>
          </div>

          <div class="form-group">
            <label for="email">Email*</label>
            <input id="email" name="email" class="form-control" type="text" data-validation="email">
            <span id="error_email" class="text-danger"></span>
          </div>

           <div class="form-group">
            <label for="password">Password*</label>
            <input id="password" name="password" class="form-control" type="password" data-validation="password">
            <span id="error_password" class="text-danger"></span>
          </div>


         
          
          <button id="submit" type="submit" value="submit" name="register" class="btn btn-primary center">Submit</button>
      
        </form>

      </div>
    </div>
  </div>

</div>

<?php include 'inc/footer.php'; ?>










<?php include 'inc/header.php';
Session::init();
   
?>

<div class="container">
   <?php 
     $rmessage=Session::get("rmessage");
     if(isset($rmessage)) { ?>
    <div class="well"><?php echo $rmessage; ?></div>
     <?php session_unset(); } ?>
     
    

   </div>

<?php include 'inc/footer.php';
     
<?php include 'inc/header.php';
 Session::init();
 Session::checkSession(); 

?>

<div class="container">
   <?php 
    if (isset($_SESSION['message'])) { ?>
    <div class="well"><?php echo $_SESSION['message']; ?></div>
     <?php  }unset($_SESSION['message']);?>

  <table class="table">
  <thead class="thead-default">
    <tr>
      <th>Serial No</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
  	<?php
  	   $id=Session::get('userid'); 
       $getprofile=$user->getProById($id);
       if(isset($getprofile)){
       	$i=0;
      while ($result=$getprofile->fetch_assoc()) {
        $i++;
  	?>
    <tr>
      <th scope="row"><?php echo $i;  ?></th>
      <td><?php echo $result['first_name']; ?></td>
      <td><?php echo $result['last_name']; ?></td>
      <td><?php echo $result['email'];?> </td>
      <td>
      <a href="edit.php?id=<?php echo $id; ?>">Edit</a>
      <a href="delete.php?id=<?php echo $id; ?>">Delete</a>
     </td>
    </tr>

    <?php } } ?>
 </tbody>
</table>
  
  <?php
   
     
   
    $active=Session::get('active');
    if ( !$active ){
              echo
              '<div class="info">
              Account is unverified, please confirm your email by clicking
              on the email link!
              </div>';
          }
        


  ?>


</div>  





<?php include 'inc/footer.php'; ?>
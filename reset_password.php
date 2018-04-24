<?php
  include 'classes/User.php';
  $user=new User();

  if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $confirmpass=$user->confirmPass($_POST);

  }
?>
<?php 
/* Verifies registered user email, the link to this page
   is included in the register.php email message 
*/
include_once ('lib/Session.php');
include_once ('lib/Database.php');


Session::init();

$db=new Database();
//$fm=new Format();
// Make sure email and hash variables aren't empty
if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']))
{
    $email = mysqli_real_escape_string($db->link,$_GET['email']); 
    $hash = mysqli_real_escape_string($db->link,$_GET['hash']); 
    
    // Select user with matching email and hash, who hasn't verified their account yet (active = 0)
    $query="SELECT * FROM users WHERE email='$email' AND hash='$hash' AND active='0'";
    $result=$this->db->select($query);
    if ( $result->num_rows == 0 )
    { 
        $_SESSION['message'] = "Account has already been activated or the URL is invalid!";

        header("location: error.php");
    }
    else {
        $_SESSION['message'] = "Your account has been activated!";
        
        
        
           $query="UPDATE users
                   SET active='1'
                   Where email='$email'
                       ";
        $result=$this->db->update($query);
        $_SESSION['active'] = 1;
        
        header("location: success.php");
    }
}
else {
    $_SESSION['message'] = "Invalid parameters provided for account verification!";
    header("location: error.php");
}     
?>
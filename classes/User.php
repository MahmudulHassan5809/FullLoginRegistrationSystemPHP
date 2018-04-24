<?php 
$filepath=realpath(dirname(__FILE__));  
include_once ($filepath.'/../lib/Database.php') ;
include_once ($filepath.'/../lib/Session.php') ;
include_once ($filepath.'/../helpers/Format.php') ;

?>
<?php 

 class User
 {
	    private $db;
	    private $fm;
		public function __construct()
		{
		  $this->db=new Database();
		  $this->fm=new Format();
		}

   public function userReg($data)
   {
        $first_name=$this->fm->validation($data['first_name']);
        $first_name=mysqli_real_escape_string($this->db->link,$data['first_name']);

        $last_name=$this->fm->validation($data['last_name']);
        $last_name=mysqli_real_escape_string($this->db->link,$data['last_name']);

        $email=$this->fm->validation($data['email']);
        $email=mysqli_real_escape_string($this->db->link,$data['email']);

        $password=$this->fm->validation($data['password']);
        $password=mysqli_real_escape_string($this->db->link,$data['password']);

        if($first_name==""|| $last_name==""|| $email==""|| $password=="")
        {
        	$msg="<span style='color:red;font-size:20px;'>Field Must Not Be Empty</span>";
        	return $msg;
        }

        $mailcheck="SELECT users.email FROM users Where email='$email'";
        $mailres=$this->db->select($mailcheck);
        if ($mailres!=false) {
                $msg="<span style='color:red;font-size:20px;'>Email already Esits</span>";
                return $msg;
        }

        elseif (filter_var($email, FILTER_VALIDATE_EMAIL)==false) {
        	$msg="<span style='color:red;font-size:20px;'>Invalid Email</span>";
        	return $msg;
        }
        elseif (strlen($password)<6) {
        	$msg="<span style='color:red;font-size:20px;'>password To Short</span>";
        	return $msg;
        }
        else
        {
        	$password=password_hash($password,PASSWORD_BCRYPT);
        	$hash=mysqli_real_escape_string($this->db->link,md5(rand(0,1000)));
        	$query="INSERT INTO users(first_name,last_name,email,password,hash)
	        VALUES('$first_name','$last_name','$email','$password','$hash')";
	    $result=$this->db->insert($query);
	   	if($result)
	   	{
	   		$iquery="SELECT id from users where email='$email'";
            $iresult=$this->db->select($iquery);
            $ivalue=$iresult->fetch_assoc();
	   		
            Session::init();
            Session::set('login',true);
            Session::set('userid',$ivalue['id']);
            Session::set('active',0);
	   		$_SESSION['logged_in']=true;
	   		$_SESSION['message']=
	   		    "Confirmation link has been sent to $email,  please verify
                 your account by clicking on the link in the message!";
	   		
	   	$to      = $email;
        $subject = 'Account Verification (  )';
        $message_body = '
        Hello '.$first_name.',

        Thank you for signing up!

        Please click this link to activate your account:

        http://localhost/project/FullLoginRegistraionProject/verify.php?email='.$email.'&hash='.$hash;  

        mail( $to, $subject, $message_body );
        //header("location: profile.php"); 
	   	}
	   	else
	   	{
	      $_SESSION['message'] = 'Registration failed!';
          header("location: error.php");
	   	}
    
    

   }		

 }

 public function userLogin($data)
 {
        $email=$this->fm->validation($data['email']);
        $email=mysqli_real_escape_string($this->db->link,$data['email']);

        $password=$this->fm->validation($data['password']);
        $password=mysqli_real_escape_string($this->db->link,$data['password']);


        if ($email=="" or $password=="") {
            $msg="<span style='color:red;font-size:20px;'>Field Must Not Be Empty</span>";
            return $msg;
        }
        elseif(filter_var($email, FILTER_VALIDATE_EMAIL)==false) {
            $msg="<span style='color:red;font-size:20px;'>Invalid Email</span>";
            return $msg;
        }
        $mailcheck="SELECT users.email FROM users Where email='$email'";
        $mailres=$this->db->select($mailcheck);
        if($mailres==false) {
                $msg="<span style='color:red;font-size:20px;'>Email Doesn't Esits</span>";
                return $msg;
        }

        else
        {   
            
            $query="SELECT  * FROM users WHERE email='$email'";
            $result=$this->db->select($query);
            if($result!=false )
            {
                 $value=$result->fetch_assoc();
                if(password_verify($password,$value['password'])){
                 Session::init(); 
                 Session::set("login",true);
                 Session::set("userid",$value['id']);
                 Session::set("username",$value['first_name']);
                 header("Location: profile.php");
                   }
            else
            {
                $msg="<span style='color:red;font-size:20px;'>Password not matched</span>";
                return $msg; 
            }
            }
            else
            {
                $msg="<span style='color:red;font-size:20px;'>Email or Password not matched</span>";
                return $msg; 
            }
        
        }
}

 public function getProById($id)
 {
        $id=$this->fm->validation($id);
        $id=mysqli_real_escape_string($this->db->link,$id);

       $query="SELECT * FROM users where id='$id'";
       $result=$this->db->select($query);
       return $result;
}

  public function passReset($data)
  {
        $email=$this->fm->validation($data['email']);
        $email=mysqli_real_escape_string($this->db->link,$data['email']);
         
        if ($email=="") {
            $msg="<span style='color:red;font-size:20px;'>Field Must Not Be Empty</span>";
            return $msg;
        }
        elseif(filter_var($email, FILTER_VALIDATE_EMAIL)==false) {
            $msg="<span style='color:red;font-size:20px;'>Invalid Email</span>";
            return $msg;
        }

        $mailcheck="SELECT users.email FROM users Where email='$email'";
        $mailres=$this->db->select($mailcheck);
        if ($mailres==false) {
                $msg="<span style='color:red;font-size:20px;'>Email Does Not Exists</span>";
                return $msg;
        }
        else
        {
            $query="SELECT * FROM users Where email='$email'";
            $result=$this->db->select($query);
            $value=$result->fetch_assoc();

            $email=$value['email'];
            $hash=$value['hash'];
            $first_name=$value['first_name'];

            Session::init();
            Session::set("rmessage",'Please check your email '.$email.'
            for a confirmation link to complete your password reset!</p>');
        $to      = $email;
        $subject = 'Password Reset Link (  )';
        $message_body = '
        Hello '.$first_name.',

        You have requested password reset!

        Please click this link to reset your password:

        http://localhost/project/FullLoginRegistraionProject/reset.php?email='.$email.'&hash='.$hash;  

        mail($to, $subject, $message_body);

        header("location: success.php");
        }
}

 public function confirmPass($data)
 {
  
   $newpassword=$this->fm->validation($data['newpassword']);
   $newpassword=mysqli_real_escape_string($this->db->link,$data['newpassword']);

   $confirmpassword=$this->fm->validation($data['confirmpassword']);
   $confirmpassword=mysqli_real_escape_string($this->db->link,$data['confirmpassword']);
   
   $email=$this->fm->validation($data['email']);
   $email=mysqli_real_escape_string($this->db->link,$data['email']);

   $hash=$this->fm->validation($data['hash']);
   $hash=mysqli_real_escape_string($this->db->link,$data['hash']);



   if ($newpassword==$confirmpassword) {
      $new_password=password_hash($newpassword, PASSWORD_BCRYPT);

       $query="UPDATE users
              SET password='$new_password',
              hash='$hash'
              Where email='$email'
                       ";
    $result=$this->db->update($query);
    $_SESSION['message'] = "Your password has been reset successfully!";
    header("location: success.php");                  
   }
    else {
        $_SESSION['message'] = "Two passwords you entered don't match, try again!";
        header("location: error.php");    
    }

 }

}

<?php
session_start();
ob_start();
require '../db.php';

$u_email    = "";
$errors = array();

?>

<?php

//if user click continue button in forgot password form
if(isset($_POST['set_password'])){
    $u_email = mysqli_real_escape_string($connection, $_POST['u_email']);
    $check_u_email = "SELECT * FROM users WHERE u_email='$u_email'";
    $run_sql = mysqli_query($connection, $check_u_email);
    if(mysqli_num_rows($run_sql) > 0){
        $code = rand(999999, 111111);
        $insert_code = "UPDATE users SET code = $code WHERE u_email = '$u_email'";
        $run_query =  mysqli_query($connection, $insert_code);

        // getting verification code 
        if ($run_query){

            $query = "SELECT * FROM users WHERE u_email=".$u_email;
             $results = mysqli_query($connection, $query);
             if (mysqli_num_rows($results) == 1) {
                 while ($row=mysqli_fetch_assoc($results)) {
                     echo $code =$row['code'];
               }
            }
          } 

        if($run_query){
            $subject = "Password Reset Code";
            $message = "Your password reset code is $code";
            $sender = "From: shahiprem7890@gmail.com";
            if(mail($u_email, $subject, $message, $sender)){
                $info = "We've sent a passwrod reset otp to your u_email - $u_email";
                $lastid = "Your Email Verification Code : ".$code; // getting verification code 
                $_SESSION['info'] = $info;
                $_SESSION['lastid'] = $code; // getting verification code 
                $_SESSION['u_email'] = $u_email;
                header('location: reset_code.php');
                exit();
            }else{
                $errors['otp-error'] = "Failed while sending code!";
            }
        }else{
            $errors['db-error'] = "Something went wrong!";
        }
    }else{
        $errors['u_email'] = "This u_email address does not exist!";
    }
}


     //if user click check reset otp button
     if(isset($_POST['check-reset-otp'])){
         $_SESSION['info'] = "";
         $otp_code = mysqli_real_escape_string($connection, $_POST['otp']);
         $check_code = "SELECT * FROM users WHERE code = $otp_code";
         $code_res = mysqli_query($connection, $check_code);
         if(mysqli_num_rows($code_res) > 0){
             $fetch_data = mysqli_fetch_assoc($code_res);
             $u_email = $fetch_data['u_email'];
             $_SESSION['u_email'] = $u_email;
             $info = "Please create a new password that you don't use on any other site.";
             $_SESSION['info'] = $info;
             header('location: new_password.php');
             exit();
         }else{
             $errors['otp-error'] = "You've entered incorrect code!";
         }
     }


         //if user click change password button
        if(isset($_POST['change-password'])){
           $_SESSION['info'] = "";
           $password = mysqli_real_escape_string($connection, $_POST['u_password']);
           $cpassword = mysqli_real_escape_string($connection, $_POST['cpassword']);
           if($password !== $cpassword){
               $errors['u_password'] = "Confirm password not matched!";
           }elseif (empty($password)) {
             $errors['u_password'] = "Password is Required";
           }elseif (empty($cpassword)) {
             $errors['u_password'] = "Conform Password is Required";
           }else{
               $code = 0;
               $email = $_SESSION['u_email']; //getting this email using session
               $encpass = md5($password);
               $update_pass = "UPDATE users SET code = $code, u_password = '$encpass' WHERE u_email = '$email'";
               $run_query = mysqli_query($connection, $update_pass);
               if($run_query){
                   $info = "Your password changed. Now you can login with your new password.";
                   $_SESSION['info'] = $info;
                   header('Location: password_changed.php');
               }else{
                   $errors['db-error'] = "Failed to change your password!";
               }
           }
        }


 ?>
<?php  if (count($errors) > 0) : ?>
  <div class="error">
    <?php foreach ($errors as $error) : ?>
      <p><?php echo $error ?></p>
    <?php endforeach ?>
  </div>
<?php  endif ?>

<style media="screen">
* {
  margin: 0px;
  padding: 0px;
}

.error {
  width: 92%;
  margin: 0px auto;
  padding: 10px;
  border: 1px solid #a94442;
  color: #a94442;
  background: #f2dede;
  border-radius: 5px;
  text-align: left;
}
.success {
  color: #3c763d;
  background: #dff0d8;
  border: 1px solid #3c763d;
  margin-bottom: 20px;
}

</style>

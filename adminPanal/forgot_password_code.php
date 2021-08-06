<?php
session_start();
ob_start();

require '../db.php';

$email    = "";
$errors = array();

?>

<?php
//if user click continue button in forgot password form
if(isset($_POST['set_password'])){
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $check_email = "SELECT * FROM admin WHERE email='$email'";
    $run_sql = mysqli_query($connection, $check_email);
    if(mysqli_num_rows($run_sql) > 0){
        $code = rand(999999, 111111);
        $insert_code = "UPDATE admin SET code = $code WHERE email = '$email'";
        $run_query =  mysqli_query($connection, $insert_code);
                // getting verification code 
        if ($run_query){

            $query = "SELECT * FROM admin WHERE email=".$email;
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
            if(mail($email, $subject, $message, $sender)){
                $info = "We've sent a passwrod reset otp to your email - $email";
                $lastid = "Your Email Verification Code : ".$code; // getting verification code 
                $_SESSION['info'] = $info;
                $_SESSION['lastid'] = $code; // getting verification code
                $_SESSION['email'] = $email;
                header('location: reset_code.php');
                exit();
            }else{
                $errors['otp-error'] = "Failed while sending code!";
            }
        }else{
            $errors['db-error'] = "Something went wrong!";
        }
    }else{
        $errors['email'] = "This email address does not exist!";
    }
}

     //if user click check reset otp button
     if(isset($_POST['check-reset-otp'])){
         $_SESSION['info'] = "";
         $otp_code = mysqli_real_escape_string($connection, $_POST['otp']);
         $check_code = "SELECT * FROM admin WHERE code = $otp_code";
         $code_res = mysqli_query($connection, $check_code);
         if(mysqli_num_rows($code_res) > 0){
             $fetch_data = mysqli_fetch_assoc($code_res);
             $email = $fetch_data['email'];
             $_SESSION['email'] = $email;
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
           $password = mysqli_real_escape_string($connection, $_POST['password']);
           $cpassword = mysqli_real_escape_string($connection, $_POST['cpassword']);


           // Validate password strength
           $uppercase = preg_match('@[A-Z]@', $password);
           $lowercase = preg_match('@[a-z]@', $password);
           $number    = preg_match('@[0-9]@', $password);
           $specialChars = preg_match('@[^\w]@', $password);

           if($password !== $cpassword){
               $errors['password'] = "Confirm password not matched!";
           }elseif (empty($password)) {
             $errors['password'] = "Password is Required";
           }elseif (empty($cpassword)) {
             $errors['password'] = "Conform Password is Required";
           }elseif(strlen($password)<4 ){
             $errors['password'] = "Password Can Not be Less than 4 character";
           }elseif(strlen($password)>8 ){
             $errors['password'] = "Password Can Not be Greater than 8 character";
           }elseif(!$uppercase){
             $errors['password'] = "password must have uppercase value";
           }elseif(!$lowercase){
             $errors['password'] = "password must have lowercase value";
           }elseif(!$number){
             $errors['password'] = "password must have number value";
           }else{
               $code = 0;
               $email = $_SESSION['email']; //getting this email using session
               $encpass = md5($password);
               $update_pass = "UPDATE admin SET code = $code, password = '$encpass' WHERE email = '$email'";
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

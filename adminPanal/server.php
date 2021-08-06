<?php
session_start();
ob_start();
require '../db.php';

$f_name = "";
$l_name   = "";
$email    = "";
$password  = "";
$errors = array();

?>

<?php
// LOGIN USER
// if (isset($_POST['login_user'])) {
//   $email = mysqli_real_escape_string($connection, $_POST['email']);
//   $password = mysqli_real_escape_string($connection, $_POST['password']);
//
//   if (empty($email)) {
//     array_push($errors, "Email is required");
//   }
//   if (empty($password)) {
//     array_push($errors, "Password is required");
//   }
//
//   if (count($errors) == 0) {
//     $password = md5($password);
//     $query = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
//     $results = mysqli_query($connection, $query);
//     if (mysqli_num_rows($results) == 1) {
//       $_SESSION['email'] = $email;
//       $_SESSION['password'] = $password;
//      echo '
//      <div class="text-center">
//        <div class="spinner-grow" role="status">
//          <span class="sr-only">Loading...</span>
//        </div>
//      </div>
//      ';
//      header('Refresh:1,url=index.php');
//     }else {
//       array_push($errors, "Wrong email/password combination");
//     }
//   }
// }


// LOGIN USER
if (isset($_POST['login_user'])) {
  $email = mysqli_real_escape_string($connection, $_POST['email']);
  $password = mysqli_real_escape_string($connection, $_POST['password']);
  $status =$_POST['status'];
  $code =$_POST['code'];

  if (empty($email)) {
    array_push($errors, "Email is required");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }
  if (count($errors) == 0) {
     $password;
     $password = md5($password);
     $query = "SELECT * FROM admin WHERE email = '$email' and password='$password' and status='$status' and code='$code'";
     $results = mysqli_query($connection, $query);
    if (mysqli_num_rows($results) == 1) {
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
     echo '
     <div class="text-center">
       <div class="spinner-grow" role="status">
         <span class="sr-only text-danger">Loading...</span>
       </div>
     </div>
     ';
     header('Refresh:1,url=index.php');
    }else {
      array_push($errors, "Wrong Email/Password combination/Account is Not Verified Yet");
    }
  }
}

?>


<?php

// initializing variables


// REGISTER USER
// if (isset($_POST['reg_user'])) {
//   // receive all input values from the form
//   $f_name = mysqli_real_escape_string($connection, $_POST['f_name']);
//   $l_name = mysqli_real_escape_string($connection, $_POST['l_name']);
//   $email = mysqli_real_escape_string($connection, $_POST['email']);
//   $p1 = mysqli_real_escape_string($connection, $_POST['p1']);
//   $p2 = mysqli_real_escape_string($connection, $_POST['p2']);
//
//   // form validation: ensure that the form is correctly filled ...
//   // by adding (array_push()) corresponding error unto $errors array
//   if (empty($f_name)) { array_push($errors, "Frist Name is required"); }
//   if (empty($l_name)) { array_push($errors, "Last Name is required"); }
//   if (empty($email)) { array_push($errors, "Email is required"); }
//   if (empty($p1)) { array_push($errors, "Password is required"); }
//   if ($p1 != $p2) {
// 	array_push($errors, "The two passwords do not match");
//   }
//
//   // first check the database to make sure
//   // a user does not already exist with the same f_name and/or email
//   $user_check_query = "SELECT * FROM admin WHERE f_name='$f_name' OR email='$email' LIMIT 1";
//   $result = mysqli_query($connection, $user_check_query);
//   $user = mysqli_fetch_assoc($result);
//   $countuser = mysqli_num_rows($result);
//
//   if ($user) { // if user exists
//     if ($user['f_name'] === $f_name) {
//       array_push($errors, "Frist Name already exists");
//     }
//
//     if ($user['email'] === $email) {
//       array_push($errors, "email already exists");
//     }
//   }
//
//   // Finally, register user if there are no errors in the form
//   if (count($errors) == 0) {
//   	$password = md5($p1);//encrypt the password before saving in the database
//
//   	$query = "INSERT INTO admin (f_name,l_name, email, password)
//   			  VALUES('$f_name', '$l_name', '$email', '$password') limit 1";
//   	mysqli_query($connection, $query);
//     echo '
//     <div class="alert alert-success  alert-dismissible">
//       <button type="button" class="close" data-dismiss="alert">&times;</button>
//      <strong> Your Account is Created Successfully ! </strong>
//    </div>
//    ';
//    header('Refresh:2,url=login.php');
//  }
//
// }


//if user signup button
if(isset($_POST['reg_user'])){
    $f_name = mysqli_real_escape_string($connection, $_POST['f_name']);
    $l_name = mysqli_real_escape_string($connection, $_POST['l_name']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $p1 = mysqli_real_escape_string($connection, $_POST['p1']);
    $p2 = mysqli_real_escape_string($connection, $_POST['p2']);
    if($p1 !== $p2){
      $errors['password'] = "Confirm password not matched!";
    }

    if(strlen($p1)<4 ){
      $errors['password'] = "Password Can Not be Less than 4 character";
    }
    if(strlen($p1)>8 ){
      $errors['password'] = "Password Can Not be Grater than 8 character";
    }

    // Validate password strength
    $uppercase = preg_match('@[A-Z]@', $p1);
    $lowercase = preg_match('@[a-z]@', $p1);
    $number    = preg_match('@[0-9]@', $p1);
    $specialChars = preg_match('@[^\w]@', $p1);

    if(!$uppercase || !$lowercase || !$number || !$specialChars ) {
        $errors['password'] = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
    }

    if (empty($f_name)) { array_push($errors, "Frist Name is required"); }
    if (empty($l_name)) { array_push($errors, "Last Name is required"); }
    if (empty($email)) { array_push($errors, "email is required"); }
    if (empty($p1)) { array_push($errors, "password is required"); }

    $email_check = "SELECT * FROM admin WHERE email = '$email'";
    $res = mysqli_query($connection, $email_check);
    if(mysqli_num_rows($res) > 0){
        $errors['email'] = "Email that you have entered is already exist!";
    }
    if(count($errors) === 0){
        // $encpass = password_hash($p1, PASSWORD_BCRYPT);
        $encpass = md5($p1);
        $code = rand(999999, 111111);
        $status = "notverified";
        $insert_data = "INSERT INTO admin(f_name,l_name ,email,password, code, status)
                        values('$f_name','$l_name','$email', '$encpass', '$code', '$status')";
        $data_check = mysqli_query($connection, $insert_data);

            // getting verification code 
        if ($data_check){
            $last_id = $connection->insert_id;

            $query = "SELECT * FROM admin WHERE id=".$last_id;
             $results = mysqli_query($connection, $query);
             if (mysqli_num_rows($results) == 1) {
                 while ($row=mysqli_fetch_assoc($results)) {
                     echo $sid =$row['code'];
               }
            }
          }
        // 

        if($data_check){
            $subject = "Email Verification Code";
            $message = "Your verification code is";
            $sender = "From: zairzair691@gmail.com";
            if(mail($email, $subject, $message, $sender)){
                $info = "We've sent a verification code to your email - $email";
               
                $lastid = "Your Email Verification Code : ".$sid; // getting verification code 
                $_SESSION['info'] = $info;
                $_SESSION['lastid'] = $lastid; // getting verification code 

                $_SESSION['email'] = $email;
                $_SESSION['password'] = $p1;
                header('location: user_otp.php');
                exit();
            }else{
                $errors['otp-error'] = "Failed while sending code!";
            }
        }else{
            $errors['db-error'] = "Failed while inserting data into database!";
        }
     }
  }



  //if user click verification code submit button
  if(isset($_POST['check'])){
      $_SESSION['info'] = "";
      $otp_code = mysqli_real_escape_string($connection, $_POST['otp']);
       $check_code = "SELECT * FROM admin WHERE code = $otp_code";
      $code_res = mysqli_query($connection, $check_code);
      if(mysqli_num_rows($code_res) > 0){
          $fetch_data = mysqli_fetch_assoc($code_res);
          $fetch_code = $fetch_data['code'];
          $email = $fetch_data['email'];
          $code = 0;
          $status = 'verified';
          $update_otp = "UPDATE admin SET code = $code, status = '$status' WHERE code = $fetch_code";
          $update_res = mysqli_query($connection, $update_otp);
          if($update_res){
              header('location: login.php');
              exit();
          }else{
              $errors['otp-error'] = "Failed while updating code!";
          }
      }else{
          $errors['otp-error'] = "You've entered incorrect code!";
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

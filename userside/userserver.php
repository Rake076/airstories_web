<?php
session_start();
ob_start();
require '../db.php';

$frist_name = "";
$last_name   = "";
$u_email    = "";
$u_password  = "";
$errors = array();

?>

<?php
// LOGIN USER
if (isset($_POST['login_user'])) {
  $u_email = mysqli_real_escape_string($connection, $_POST['u_email']);
  $u_password = mysqli_real_escape_string($connection, $_POST['u_password']);
  $status =$_POST['status'];
  $code =$_POST['code'];

  if (empty($u_email)) {
    array_push($errors, "Email is required");
  }
  if (empty($u_password)) {
    array_push($errors, "Password is required");
  }
  if (count($errors) == 0) {
     $u_password;
     $u_password = md5($u_password);
     $query = "SELECT * FROM users WHERE u_email = '$u_email' and u_password='$u_password' and status='$status' and code='$code'";
     $results = mysqli_query($connection, $query);
    if (mysqli_num_rows($results) == 1) {
      $_SESSION['u_email'] = $u_email;
      $_SESSION['u_password'] = $u_password;
     echo '
     <div class="text-center">
       <div class="spinner-grow" role="status">
         <span class="sr-only text-danger">Loading...</span>
       </div>
     </div>
     ';
     header('Refresh:1,url=index.php');
    }else {
      array_push($errors, "Wrong u_email/u_password combination/Account is Not Verified Yet");
    }
  }
}

?>


<?php

// initializing variables

//
// // REGISTER USER
// if (isset($_POST['reg_user'])) {
//   // receive all input values from the form
//   $frist_name = mysqli_real_escape_string($connection, $_POST['frist_name']);
//   $last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
//   $u_email = mysqli_real_escape_string($connection, $_POST['u_email']);
//   $p1 = mysqli_real_escape_string($connection, $_POST['p1']);
//   $p2 = mysqli_real_escape_string($connection, $_POST['p2']);
//
//   // form validation: ensure that the form is correctly filled ...
//   // by adding (array_push()) corresponding error unto $errors array
//   if (empty($frist_name)) { array_push($errors, "Frist Name is required"); }
//   if (empty($last_name)) { array_push($errors, "Last Name is required"); }
//   if (empty($u_email)) { array_push($errors, "u_email is required"); }
//   if (empty($p1)) { array_push($errors, "u_password is required"); }
//   if ($p1 != $p2) {
// 	array_push($errors, "The two u_passwords do not match");
//   }
//
//   // first check the database to make sure
//   // a user does not already exist with the same frist_name and/or u_email
//   $user_check_query = "SELECT * FROM users WHERE frist_name='$frist_name' OR u_email='$u_email' LIMIT 1";
//   $result = mysqli_query($connection, $user_check_query);
//   $user = mysqli_fetch_assoc($result);
//   $countuser = mysqli_num_rows($result);
//
//   if ($user) { // if user exists
//     if ($user['frist_name'] === $frist_name) {
//       array_push($errors, "Frist Name already exists");
//     }
//
//     if ($user['u_email'] === $u_email) {
//       array_push($errors, "u_email already exists");
//     }
//   }
//
//   // Finally, register user if there are no errors in the form
//   if (count($errors) == 0) {
//   	$u_password = md5($p1);//encrypt the u_password before saving in the database
//
//   	$query = "INSERT INTO users (frist_name,last_name, u_email, u_password)
//   			  VALUES('$frist_name', '$last_name', '$u_email', '$u_password') limit 1";
//   	mysqli_query($connection, $query);
//     echo '
//     <div class="alert alert-success  alert-dismissible">
//       <button type="button" class="close" data-dismiss="alert">&times;</button>
//      <strong> Your Account is Created Successfully ! </strong>
//    </div>
//    ';
//    header('Refresh:2,url=user_login.php');
//  }
//
// }

//if user signup button
if(isset($_POST['reg_user'])){
    $frist_name = mysqli_real_escape_string($connection, $_POST['frist_name']);
    $last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
    $u_email = mysqli_real_escape_string($connection, $_POST['u_email']);
    $p1 = mysqli_real_escape_string($connection, $_POST['p1']);
    $p2 = mysqli_real_escape_string($connection, $_POST['p2']);

    if($p1 !== $p2){
      $errors['u_password'] = "Confirm password not matched!";
    }

    if(strlen($p1)<4 ){
      $errors['u_password'] = "Password Can Not be Less than 4 character";
    }
    if(strlen($p1)>8 ){
      $errors['u_password'] = "Password Can Not be Grater than 8 character";
    }
  //   $uppercase = preg_match('@[A-Z]@', $p1);
  //   if(!$uppercase){
  //     $errors['u_password'] = "Password must have At least One Uppercase Value";
  //   }
  //    $lowercase = preg_match('@[a-z]@', $p1);
  //   if(!$lowercase){
  //     $errors['u_password'] = "Password must have At least One Lowercase Value";
  //   }
  //   $number    = preg_match('@[0-9]@', $p1);
  //  if(!$number){
  //    $errors['u_password'] = "Password must have At least One Number";
  //  }
  //  $specialChars = preg_match('@[^\w]@', $p1);
  // if(!$specialChars){
  //   $errors['u_password'] = "Password must have At least One Special character";
  // }

    // Validate password strength
    $uppercase = preg_match('@[A-Z]@', $p1);
    $lowercase = preg_match('@[a-z]@', $p1);
    $number    = preg_match('@[0-9]@', $p1);
    $specialChars = preg_match('@[^\w]@', $p1);

    if(!$uppercase || !$lowercase || !$number || !$specialChars ) {
        $errors['u_password'] = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
    }


    if (empty($frist_name)) { array_push($errors, "Frist Name is required"); }
    if (empty($last_name)) { array_push($errors, "Last Name is required"); }
    if (empty($u_email)) { array_push($errors, "u_email is required"); }
    if (empty($p1)) { array_push($errors, "u_password is required"); }


    $email_check = "SELECT * FROM users WHERE u_email = '$u_email'";
    $res = mysqli_query($connection, $email_check);
    if(mysqli_num_rows($res) > 0){
        $errors['u_email'] = "Email that you have entered is already exist!";
    }
    if(count($errors) === 0){
        // $encpass = password_hash($p1, PASSWORD_BCRYPT);
        $encpass = md5($p1);
        $code = rand(999999, 111111);
        $status = "notverified";
        $insert_data = "INSERT INTO users (frist_name,last_name ,u_email, u_password, code, status)
                        values('$frist_name','$last_name','$u_email', '$encpass', '$code', '$status')";
        $data_check = mysqli_query($connection, $insert_data);
        // getting verification code 
        if ($data_check){
            $last_id = $connection->insert_id;

            $query = "SELECT * FROM users WHERE id=".$last_id;
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
                $info = "We've sent a verification code to your email - $u_email";
                $lastid = "Your Email Verification Code : ".$sid; // getting verification code 
                $_SESSION['info'] = $info;
                $_SESSION['lastid'] = $lastid; // getting verification code 
                $_SESSION['u_email'] = $u_email;
                $_SESSION['u_password'] = $p1;
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
     $check_code = "SELECT * FROM users WHERE code = $otp_code";
    $code_res = mysqli_query($connection, $check_code);
    if(mysqli_num_rows($code_res) > 0){
        $fetch_data = mysqli_fetch_assoc($code_res);
        $fetch_code = $fetch_data['code'];
        $email = $fetch_data['u_email'];
        $code = 0;
        $status = 'verified';
        $update_otp = "UPDATE users SET code = $code, status = '$status' WHERE code = $fetch_code";
        $update_res = mysqli_query($connection, $update_otp);
        if($update_res){
            $_SESSION['frist_name'] = $name;
            $_SESSION['u_email'] = $email;
            header('location: index.php');
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

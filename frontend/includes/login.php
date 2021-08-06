<?php
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
      header('location:../userside/index.php');
     }else {
       array_push($errors, "Wrong email/password combination");
     }
  }
}

?>
<?php  if (count($errors) > 0) : ?>
  <div class="row">
    <div class="col-md-4 offset-4">
        <div id="alertError" class="alert alertt alert-danger" role="alert">
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <?php foreach ($errors as $error) : ?>
            <span><?php echo $error ?></span>
        <?php endforeach ?>
    </div>
  </div>
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

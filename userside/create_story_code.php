<?php

$b_tittle = "";
$b_type   = "";
$b_description    = "";
$cover_photo  = "";

$b_author = "";
$b_status= "";
$user_id= "";

$role= "";
$errors = array();


?>

<?php
// initializing variables

// sending to datbase
if (isset($_POST['save_story'])) {
  // receive all input values from the form
  $user_id = mysqli_real_escape_string($connection, $_POST['user_id']);
  $role = mysqli_real_escape_string($connection, $_POST['role']);
  $b_tittle = mysqli_real_escape_string($connection, $_POST['b_tittle']);
  $b_type = mysqli_real_escape_string($connection, $_POST['b_type']);
  $b_description = mysqli_real_escape_string($connection, $_POST['b_description']);
  $b_author = mysqli_real_escape_string($connection, $_POST['b_author']);
  $b_status = mysqli_real_escape_string($connection, $_POST['b_status']);

  $cover_photo = $_FILES['cover_photo']['name'];
  $target_dir = "../coverphotos/";
  $target_file = $target_dir . basename($_FILES["cover_photo"]["name"]);
  move_uploaded_file($_FILES['cover_photo']['tmp_name'],$target_dir.$cover_photo);


  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($user_id)) { array_push($errors, "Uer ID is missing"); }
  if (empty($role)) { array_push($errors, "Role is required"); }
  if (empty($b_tittle)) { array_push($errors, "Book Tittle is required"); }
  if (empty($b_type)) { array_push($errors, "Book Type is required"); }
  if (empty($b_description)) { array_push($errors, "Book Description is required"); }
  if (empty($cover_photo)) { array_push($errors, "cover_photo is required"); }
  if (empty($b_author)) { array_push($errors, "Book Author Name is required"); }
  if (empty($b_status)) { array_push($errors, "Book Status is required"); }


  // first check the database to make sure
  // a user does not already exist with the same b_tittle and/or b_description
  $user_check_query = "SELECT * FROM stories WHERE b_tittle='$b_tittle' LIMIT 1";
  $result = mysqli_query($connection, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  $countuser = mysqli_num_rows($result);

  if ($user) { // if user exists
    if ($user['b_tittle'] === $b_tittle) {
      array_push($errors, "Book Tittle already Given");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$query = "INSERT INTO stories (user_id,b_tittle,b_type, b_description, cover_photo,b_author,b_status,role)
  			  VALUES('$user_id','$b_tittle', '$b_type', '$b_description', '$cover_photo','$b_author','$b_status','$role')";
  	mysqli_query($connection, $query);
    $id = mysqli_insert_id($connection);
    echo '
    <div class="text-center">
      <div class="spinner-grow" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>
    ';
   header('Refresh:0,url=add_chapters.php?add_chapters='.$id);
 }else{
   echo '
   <div class="alert alert-danger  alert-dismissible">
     <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Query Failed ! </strong>
  </div>
  ';
   }

}

?>
<?php  if (count($errors) > 0) : ?>
  <div class="error">
    <?php foreach ($errors as $error) : ?>
      <p class="text-danger font-weight-bold"><?php echo $error ?></p>
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

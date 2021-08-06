<?php
include '../db.php';

$tittle = "";
$jdate  = "";
$type   = "";
$detail    = "";
$author = "";
$author_id= "";

$errors = array();


?>

<?php
// initializing variables

// sending to datbase
if (isset($_POST['save_journal'])) {
  // receive all input values from the form
  $tittle = mysqli_real_escape_string($connection, $_POST['tittle']);
  $type = mysqli_real_escape_string($connection, $_POST['type']);
  $jdate = mysqli_real_escape_string($connection, $_POST['jdate']);
  $detail = mysqli_real_escape_string($connection, $_POST['detail']);
  $author_id = mysqli_real_escape_string($connection, $_POST['author_id']);
  $author = mysqli_real_escape_string($connection, $_POST['author']);
  $readings = mysqli_real_escape_string($connection, $_POST['readings']);
  $likes= mysqli_real_escape_string($connection, $_POST['likes']);
  $comments= mysqli_real_escape_string($connection, $_POST['comments']);

  $cover_photo = $_FILES['cover_photo']['name'];
  $target_dir = "../journalsImages/";
  $target_file = $target_dir . basename($_FILES["cover_photo"]["name"]);
  move_uploaded_file($_FILES['cover_photo']['tmp_name'],$target_dir.$cover_photo);


  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($tittle)) { array_push($errors, "Journal Tittle is required"); }
  if (empty($type)) { array_push($errors, "Type is required"); }
  if (empty($jdate)) { array_push($errors, "Date is required"); }
  if (empty($detail)) { array_push($errors, "Description is required"); }
  if (empty($author_id)) { array_push($errors, "Uer ID is missing"); }
  if (empty($cover_photo)) { array_push($errors, "cover_photo is required"); }
  if (empty($author)) { array_push($errors, "Author Name is required"); }


  // first check the database to make sure
  // a user does not already exist with the same tittle and/or detail
  $user_check_query = "SELECT * FROM journals WHERE tittle='$tittle' LIMIT 1";
  $result = mysqli_query($connection, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  $countuser = mysqli_num_rows($result);

  if ($user) { // if user exists
    if ($user['tittle'] === $tittle) {
      array_push($errors, "Journal Tittle already Given");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
   	$query = "INSERT INTO journals (tittle,type,jdate,detail,cover_photo,author,author_id,readings,likes,comments, status)
  			  VALUES('$tittle','$type','$jdate','$detail','$cover_photo','$author','$author_id','$readings','$likes','$comments', 1)";
  	mysqli_query($connection, $query);
    $id = mysqli_insert_id($connection);
    echo '
      <div class="alert alert-success  alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
       <strong> Data Save successfully </strong>
     </div>
     ';
   header('Refresh:0,url=view_journal.php');
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

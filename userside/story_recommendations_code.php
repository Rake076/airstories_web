<?php
 include '../db.php';

 $errors = array();

// sending to datbase
if (isset($_POST['save'])) {

  $bid = "";
  $sid   = "";
  $uid   = "";
  // receive all input values from the form
  $bid = $_POST['bid'];
  $sid = $_POST['sid'];
  $uid = $_POST['uid'];

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($bid)) { array_push($errors, "Book ID is missing"); }
  if (empty($sid)) { array_push($errors, "Sender ID is missing"); }
  if (empty($uid)) { array_push($errors, "Please Select User"); }

// for($i=0;$i<count($uid);$i++){
//  $user_value = $uid[$i];
//  $user_check_query = "SELECT * FROM story_recommendations WHERE uid='$user_value' and bid='$bid'";
//  $result = mysqli_query($connection, $user_check_query);
//  $countuser = mysqli_num_rows($result);
//  if ($countuser>0) { // if user exists
//     array_push($errors, "$bid is already recommended to $user_value");
//  }
//  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
    $uid = $_POST['uid'];
         for($i=0;$i<count($uid);$i++){
         $check_value = $uid[$i];
         mysqli_query($connection,"insert into story_recommendations (bid,sid,uid) values ('".$bid."','".$sid."','".$check_value."')") or die(mysqli_error());
        }
    echo '
    <div class="alert alert-success  alert-dismissible">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
     <strong class="text-sm"> Story Recommendation Sent Successfully ! </strong>
   </div>
   ';
   header("Refresh:0,url=recommendation.php");
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

<?php


$email = "";
$phone1   = "";
$phone2    = "";
$description  = "";
$fb = "";
$tw= "";
$linkedin= "";
$website_link= "";

$errors = array();

?>

<?php
// initializing variables

// sending to datbase
if (isset($_POST['save_website_info'])) {
  // receive all input values from the form
  $fb = mysqli_real_escape_string($connection, $_POST['fb']);
  $tw = mysqli_real_escape_string($connection, $_POST['tw']);
  $linkedin = mysqli_real_escape_string($connection, $_POST['linkedin']);
  $email = mysqli_real_escape_string($connection, $_POST['email']);
  $phone1 = mysqli_real_escape_string($connection, $_POST['phone1']);
  $phone2 = mysqli_real_escape_string($connection, $_POST['phone2']);
  $description= mysqli_real_escape_string($connection, $_POST['description']);
  $website_link = mysqli_real_escape_string($connection, $_POST['website_link']);


  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($linkedin)) { array_push($errors, "LinkedIn Field is missing"); }
  if (empty($website_link)) { array_push($errors, "website_link is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($phone1)) { array_push($errors, "phone1 is required"); }
  if (empty($phone2)) { array_push($errors, "phone2 is required"); }
  if (empty($description)) { array_push($errors, "description is required"); }
  if (empty($fb)) { array_push($errors, "Facebook Link is required"); }
  if (empty($tw)) { array_push($errors, "Twitter Link is required"); }

  if(strlen($phone1) !==11 ){
    $errors['phone1'] = "Phone1 no is not Correct";
  }
  if(strlen($phone2) !==11 ){
    $errors['phone2'] = "Phone2 no is not Correct";
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
    $query = "INSERT INTO website_info (description,phone1, phone2,email,website_link,fb,tw,linkedin)
         VALUES( '$description','$phone1', '$phone2','$email','$website_link','$fb','$tw','$linkedin') limit 1";
   mysqli_query($connection, $query);
    echo '
    <div class="alert alert-success  alert-dismissible">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
     <strong> Data Saved Successfully ! </strong>
   </div>
   ';
   header('Refresh:0,url=web_info.php');
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

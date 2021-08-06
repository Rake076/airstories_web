<?php

$book_id = "";
$reviewi_id = "";
$review   = "";
$errors = array();

?>

<?php
// initializing variables

// sending to datbase
if (isset($_POST['save_reviews'])) {
  // receive all input values from the form
  $reviewi_id = mysqli_real_escape_string($connection, $_POST['reviewi_id']);
  $book_id = mysqli_real_escape_string($connection, $_POST['book_id']);
  $review = mysqli_real_escape_string($connection, $_POST['review']);


  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($reviewi_id)) { array_push($errors, "Reviewi ID is Missing"); }
  if (empty($book_id)) { array_push($errors, "Book ID is required"); }
  if (empty($review)) { array_push($errors, "Story Review is required"); }


  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {

  	$query = "INSERT INTO reviews (book_id,reviewi_id,review)
  			  VALUES('$book_id','$reviewi_id' ,'$review') limit 1";
  	mysqli_query($connection, $query);
    echo '
    <div class="alert alert-success  alert-dismissible">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
     <strong> Data Saved Successfully ! </strong>
   </div>
   ';
    echo '
    <div class="text-center">
      <div class="spinner-grow" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>
    ';
   header("Refresh:0,url=reviews.php");
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

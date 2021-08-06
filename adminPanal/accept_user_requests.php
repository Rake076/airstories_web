
<?php
require '../db.php';

if (isset($_POST['liked'])) {
  $id = $_POST['id'];

  mysqli_query($connection, "UPDATE users set ver_status='0' WHERE id=$id");

}
?>

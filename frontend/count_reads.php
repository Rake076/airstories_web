<?php
require '../db.php';
 ?>
<?php
if (isset($_POST['read'])) {
  $bookid = $_POST['bookid'];
  $result = mysqli_query($connection, "SELECT * FROM stories WHERE id=".$bookid);
  $row = mysqli_fetch_array($result);
  $n = $row['readings'];

  mysqli_query($connection, "UPDATE stories SET readings=$n+1 WHERE id=".$bookid);

  echo $n+1;
}
?>

<?php
// couting journal readings
if (isset($_POST['read_j'])) {
  $jid = $_POST['jid'];
  $result = mysqli_query($connection, "SELECT * FROM journals WHERE id=".$jid);
  $row = mysqli_fetch_array($result);
  $n = $row['readings'];

  mysqli_query($connection, "UPDATE journals SET readings=$n+1 WHERE id=".$jid);

  echo $n+1;
}
 ?>

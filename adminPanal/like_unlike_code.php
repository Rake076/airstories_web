
<?php
require '../db.php';

if (isset($_POST['liked'])) {
  $bookid = $_POST['bookid'];
  $result = mysqli_query($connection, "SELECT * FROM stories WHERE id=$bookid");
  $row = mysqli_fetch_array($result);
  $n = $row['likes'];

  mysqli_query($connection, "INSERT INTO likeunlike (bookid) VALUES ($bookid)");
  mysqli_query($connection, "UPDATE stories SET likes=$n+1 WHERE id=$bookid");

  echo $n+1;
}
if (isset($_POST['unliked'])) {
  $bookid = $_POST['bookid'];
  $result = mysqli_query($connection, "SELECT * FROM stories WHERE id=$bookid");
  $row = mysqli_fetch_array($result);
  $n = $row['likes'];

  mysqli_query($connection, "DELETE FROM likeunlike WHERE bookid=$bookid");
  mysqli_query($connection, "UPDATE stories SET likes=$n-1 WHERE id=$bookid");

  echo $n-1;
}
?>


<?php
// like and dislike journals

if (isset($_POST['likedj'])) {
  $jid = $_POST['jid'];
  $result = mysqli_query($connection, "SELECT * FROM journals WHERE id=$jid");
  $row = mysqli_fetch_array($result);
  $n = $row['likes'];

  mysqli_query($connection, "INSERT INTO likeunlike (bookid,type) VALUES ($jid,'journal')");
  mysqli_query($connection, "UPDATE journals SET likes=$n+1 WHERE id=$jid");

  echo $n+1;
}
if (isset($_POST['unlikedj'])) {
  $jid = $_POST['jid'];
  $result = mysqli_query($connection, "SELECT * FROM journals WHERE id=$jid");
  $row = mysqli_fetch_array($result);
  $n = $row['likes'];

  mysqli_query($connection, "DELETE FROM likeunlike WHERE bookid=$jid");
  mysqli_query($connection, "UPDATE journals SET likes=$n-1 WHERE id=$jid");

  echo $n-1;
}
?>

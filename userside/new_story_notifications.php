<?php
include '../db.php';
?>

<?php
$query="select * from stories where status='1'";
$query=mysqli_query($connection,$query);
$req_count=mysqli_num_rows($query);
echo $req_count;
?>

<?php
include '../db.php';
?>

<?php
$status = 'notverified';
$query="select * from users where status='$status' and code !='0'";
$query=mysqli_query($connection,$query);
$req_count=mysqli_num_rows($query);
echo $req_count;
?>

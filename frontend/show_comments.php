<?php
include '../db.php';

$query="select * from public_comments";
$query=mysqli_query($connection,$query);
$req_count=mysqli_num_rows($query);
echo $req_count;
?>

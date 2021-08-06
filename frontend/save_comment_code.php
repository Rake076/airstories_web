<?php
	include '../db.php';
  $name=$_POST['name'];
  $email=$_POST['email'];
  $bookid=$_POST['book_id'];
  $post_id=$_POST['post_id'];
  $message=$_POST['message'];
   $sql ="INSERT INTO public_comments(name,email,book_id,post_id,message)
  VALUES ('$name','$email','$bookid','$post_id','$message')";
	if (mysqli_query($connection,$sql)) {
		echo json_encode(array("statusCode"=>200));
	}
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($connection);
?>

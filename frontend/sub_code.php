<?php
	include '../db.php';
	$sub_email=$_POST['sub_email'];
	$duplicate=mysqli_query($connection,"select * from subscribtion where sub_email='$sub_email'");
	if (mysqli_num_rows($duplicate)>0)
	{
		echo json_encode(array("statusCode"=>201));
	}
	else{
		$sql = "INSERT INTO subscribtion(sub_email)VALUES ('$sub_email')";
		if (mysqli_query($connection, $sql)) {
			echo json_encode(array("statusCode"=>200));
		}
		else {
			echo json_encode(array("statusCode"=>201));
		}
	}
	mysqli_close($connection);
?>

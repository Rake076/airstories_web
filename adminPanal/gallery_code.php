<?php
include '../db.php';

// updating admin table
if(isset($_POST['save_gallery'])){

				$gname = $_FILES['gname']['name'];
				$target_dir = "../gallery/";
				$target_file = $target_dir . basename($_FILES["gname"]["name"]);
				move_uploaded_file($_FILES['gname']['tmp_name'],$target_dir.$gname);

			  $sql = "INSERT INTO gallery(gname)VALUES('$gname')";
				$c = mysqli_query($connection,$sql);
				if ($c) {
					echo '
					<div class="alert alert-success  alert-dismissible">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
					 <strong> Image Published Successfully ! </strong>
				 </div>
				 ';
				 header('Refresh:0,url=gallery.php');
				} else {
					echo '
					 <div class="alert alert-danger  alert-dismissible">
						 <button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong> Sorry Image is not Published Try Again ! </strong>
					</div>
					';
					header('Refresh:0,url=gallery.php');
				}
	 }
?>

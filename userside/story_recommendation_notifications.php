<?php
session_start();
include '../db.php';

// getting current user id
$u_email = $_SESSION['u_email'];
 $u_password = $_SESSION['u_password'];
  if($_SESSION["u_email"] && $_SESSION["u_password"]==true ){
       $query = "SELECT * FROM users WHERE u_email='$u_email' AND u_password='$u_password'";
       $results = mysqli_query($connection, $query);
       if (mysqli_num_rows($results) == 1) {
           while ($row=mysqli_fetch_assoc($results)) {
               $userid =$row['id'];
          }
        }
      }
?>

<?php
$query = "SELECT * FROM story_recommendations where uid='$userid' and status='1'";
$query=mysqli_query($connection,$query);
$req_count=mysqli_num_rows($query);
echo $req_count;
?>


<?php
ob_start();
if(isset($_GET['user'])) {
session_start();
unset($_SESSION['u_email']);
header('location:../frontend/index.php');
}
?>

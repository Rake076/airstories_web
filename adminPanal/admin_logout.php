
<?php
          ob_start();
          if(isset($_GET['admin'])) {
            session_start();
            unset($_SESSION['email']);
              header('location:login.php');
          }
?>

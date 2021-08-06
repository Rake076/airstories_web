<?php
include '../db.php';

 ?>
 <style media="screen">
   .adminheaderColor{
    background-color: #ef6c00;
   }
 </style>
<nav class="main-header navbar navbar-expand  navbar-light adminheaderColor">
   <!-- Left navbar links -->
   <ul class="navbar-nav">
     <li class="nav-item">
       <a class="nav-link text-white" data-widget="pushmenu" href="#" role="button"><i class="fa fa-bars"></i></a>
     </li>
   </ul>

   <!-- Right navbar links -->
   <ul class="navbar-nav ml-auto">
     <li class="nav-item dropdown">
       <a class="nav-link text-white font-weight-bold text-capitalize btn btn-sm bg-danger btn-outline" href="../frontend/index.php"target="_blank"> Visit Website </a>
     </li>
     <!-- Messages Dropdown Menu -->
     <li class="nav-item dropdown">
       <a class="nav-link" data-toggle="dropdown" href="#">
         <i class="fa fa-users"></i>
         <span class="badge badge-danger navbar-badge"id="noti_number"> </span>
       </a>

     <script type="text/javascript">
        function loadDoc() {
          setInterval(function(){

           var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
             document.getElementById("noti_number").innerHTML = this.responseText;
           }
           };
           xhttp.open("GET", "notifications.php", true);
          xhttp.send();
        },1000);
       }
       loadDoc();
    </script> <!-- real time  notification -->

    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
      <div class="users dropdown-item dropdown-footer">Users Registration Requests </div>
      <?php
      $query="select * from users where status='notverified' and code !='0' limit 3";
         $conn=mysqli_query($connection,$query);
         $count = mysqli_num_rows($conn);
         while ($row=mysqli_fetch_assoc($conn)) {
           $id = $row['id'];
           $frist_name = $row['frist_name'];
           $last_name = $row['last_name'];
           $created_at = $row['created_at'];
           $status = $row['status'];
           ?><?php
           if ($count>0) {
            ?>
           <a href="view_users.php" class="text-capitalize text-success text-center" class="dropdown-item">
                 <h3 class="dropdown-item-title mt-3">
                   <?php echo $frist_name.'  '.$last_name; ?>
                  </h3>
               <p>
                 <?php
                 if ($status =='notverified') {
                   echo "<span class='time'> $status </span>";
                   }
                  ?>
               </p>
           </a>
           <?php
             if ($count>0) {
               $created_at = date('d-M-Y ',strtotime($created_at));
               echo '<span class="time"> '.$created_at.' </span>';
             }
            ?>
       <?php }  // if count is greater than zero  ?>
       <hr class="hr">
    <?php }  // while loop  ?>
    <a href="view_users.php" class="dropdown-item dropdown-footer seeallmsg">See All Users</a>
    <div class="dropdown-divider"></div>
    </div>
     </li>
     <li class="nav-item">
       <a class="nav-link" data-widget="fullscreen" href="#" role="button">
         <i class="fa fa-expand-arrows-alt"></i>
       </a>
     </li>
  <li class="nav-item dropdown">
   <a class="nav-link" data-toggle="dropdown" href="#">
     <?php
         if($_SESSION["email"]==true){
                  $email= $_SESSION['email'];
               echo '<span class="text-uppercase text-white"> '.$email.'</span>';
         }else{
           header('location:login.php');
         }
         ?>
       <i class="fa fa-caret-down" aria-hidden="true"></i>
       </a>
       <div class="dropdown-menu ">
         <a href="admin_logout.php?admin" class="logout ml-3">
           LOGOUT
         </a>
       </div>

     </li>
   </ul>
 </nav>
<script language="JavaScript" type="text/javascript">
$(document).ready(function(){
    $("a.logout").click(function(e){
        if(!confirm('Are You Sure To Logout')){
            e.preventDefault();
            return false;
        }
        return true;
    });
});
</script>

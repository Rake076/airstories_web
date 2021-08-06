<?php include '../db.php'; ?>
<nav class="main-header navbar navbar-expand userHeaderColor">
   <!-- Left navbar links -->
   <ul class="navbar-nav">
     <li class="nav-item">
       <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fa fa-bars"></i></a>
     </li>
   </ul>
   <!-- Right navbar links -->
   <ul class="navbar-nav ml-auto">
     <li class="nav-item dropdown">
       <a class="nav-link text-white font-weight-bold text-capitalize btn btn-sm bg-danger btn-outline" href="../frontend"target="_blank"> Visit Website </a>
     </li>

     <!-- Messages Dropdown Menu -->
     <li class="nav-item dropdown">
       <a class="nav-link" data-toggle="dropdown" href="#">
         <i class="fa fa-book"></i>
         <span class="badge badge-danger navbar-badge noti_style"id="story_recomendation_notification"> </span>
       </a>

     <script type="text/javascript">
     function loadDoc() {
          setInterval(function(){

           var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
             document.getElementById("story_recomendation_notification").innerHTML = this.responseText;
           }
           };
           xhttp.open("GET", "story_recommendation_notifications.php", true);
          xhttp.send();
        },1000);
       }
       loadDoc();
     </script> <!-- real time  notification -->
     <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
      <div class="users dropdown-item dropdown-footer">Story Recommendations </div>
      <?php
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
         $conn=mysqli_query($connection,$query);
         $count = mysqli_num_rows($conn);
         while ($row=mysqli_fetch_assoc($conn)) {
           $id = $row["id"];
           $sid= $row['sid'];
           $bid= $row['bid'];
           $uid= $row['uid'];
           $created_at = $row['created_at'];
           ?><?php
           if ($count>0) {
            ?>
           <a href="view_recommended_stories.php?change_status_read=<?php echo $uid; ?>" class="text-capitalize text-success text-center" class="dropdown-item">
                 <h3 class="dropdown-item-title mt-3">
                   <?php
                   $sql2 = "SELECT * FROM stories where id=$bid";
                    $result2 =mysqli_query($connection,$sql2);
                      while($row =mysqli_fetch_assoc($result2)){
                     echo   $b_tittle= $row['b_tittle'];
                      $b_author= $row['b_author'];
                    }
                     ?>
                  </h3>
               <p>
                 <?php
                 if ($count>0) {
                   $sql1 = "SELECT * FROM users where id=$sid";
                    $result1 =mysqli_query($connection,$sql1);
                      while($row =mysqli_fetch_assoc($result1)){
                       $frist_name= $row['frist_name'];
                        $last_name= $row['last_name'];
                      $u_email= $row['u_email'];
                    }
                   echo "<span class='time'>Sender :  $frist_name  </span>";
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
            <hr class="hr">
     <?php }  // while loop  ?>
     <?php }  // if count is greater than zero  ?>
     <a href="view_recommended_stories.php?change_status_read=<?php echo $uid; ?>" class="dropdown-item dropdown-footer seeallmsg">See All Stories</a>
     <div class="dropdown-divider"></div>
     </div>

     <li class="nav-item">
       <a class="nav-link" data-widget="fullscreen" href="#" role="button">
         <i class="fa fa-expand-arrows-alt"></i>
       </a>
     </li>
  <li class="nav-item dropdown">
   <a class="nav-link" data-toggle="dropdown" href="#">
     <?php
         if($_SESSION["u_email"]==true){
                  $u_email= $_SESSION['u_email'];
               echo '<span class="text-uppercase text-white"> '.$u_email.'</span>';
         }else{
           header('location:user_login.php');
         }
         ?>
       <i class="fa fa-caret-down" aria-hidden="true"></i>
       </a>
       <div class="dropdown-menu ">
         <a href="user_logout.php?user" class="">
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

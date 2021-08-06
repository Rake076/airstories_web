<?php
 include '../db.php';
 ?>
<style media="screen">
  nav ul li a p{
    color: white;
    font-family: monospace;
  }
  .userSidebarColor{
    background-color: #ef6c00;
  }
</style>
<aside class="main-sidebar sidebar-dark-info elevation-4 custom_bg userSidebarColor">
  <!-- Brand Logo -->
  <a href="index.php" class="brand-link">
    <span class="brand-text font-weight-light ml-1 ">
      <i class="fa fa-book" aria-hidden="false">
     </i>
    User Menu
    </span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar ">
    <!-- Sidebar Menu -->
    <nav class="mt-2 ">
          <ul class="nav nav-pills nav-sidebar flex-column " data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the . class
                 with font-awesome or any other icon font library -->
                 <li class="nav-item ">
                 <a href="#" class="nav-link ">
                   <i class="fa fa-user"></i>
                 <i class="right fa fa-angle-left"></i>
                   <p >
                   <?php
                     $u_email = $_SESSION['u_email'];
                      $u_password = $_SESSION['u_password'];
                       if($_SESSION["u_email"] && $_SESSION["u_password"]==true ){
                            $email= $_SESSION['u_email'];
                            $password= $_SESSION['u_password'];
                            $query = "SELECT * FROM users WHERE u_email='$u_email' AND u_password='$u_password'";
                            $results = mysqli_query($connection, $query);
                            if (mysqli_num_rows($results) == 1) {
                                while ($row=mysqli_fetch_assoc($results)) {
                                    $id =$row['id'];
                                    $frist_name =$row['frist_name'];
                                    $last_name =$row['last_name'];
                                    $u_email =$row['u_email'];
                                    $u_password =$row['u_password'];
                                    $profile =$row['u_profile_image'];
                                    $fb = $row["fb"];
                                    $tw = $row["tw"];
                                    $exp = $row["exp"];
                                    $sk = $row["sk"];
                                    $pno = $row["pno"];
                                    $about = $row["about"];

                                }
                               echo '<span class="text-uppercase"> '.$frist_name.' '.$last_name.'</span>';
                             }else{
                           header('location:user_login.php');
                          }
                        }
                     ?>
                   </p>
                 </a>
                 <ul class="nav nav-treeview">
                   <li class="nav-item">
                     <a href="user_logout.php?user" class="nav-link">
                       <i class="fa fa-circle "></i>
                       <p>Logout</p>
                     </a>
                   </li>
                   <li class="nav-item">
                     <a href="userProfile.php" class="nav-link">
                       <i class="fa fa-circle "></i>
                       <p>Profile</p>
                     </a>
                   </li>
                 </ul>
               </li>
               <hr>
           <li class="nav-item">
             <a href="userProfile.php" class="nav-link">
               <i class="fa fa-user-secret"></i>
               <i class="right fa fa-angle-left"></i>
                <p>User Profile </p>
               </a>
           </li>
           <li class="nav-item">
             <a href="reviews.php" class="nav-link">
               <i class="fa fa-sitemap"></i>
               <i class="right fa fa-angle-left"></i>
                <p>stories Reviews </p>
             </a>
           </li>
           <li class="nav-item">
             <a href="view_reports.php" class="nav-link">
               <i class="fa fa-qrcode"></i>
               <i class="right fa fa-angle-left"></i>
                <p>Reports </p>
             </a>
           </li>
           <li class="nav-item">
             <a href="create_story.php" class="nav-link">
               <i class="fa fa-envelope"></i>
               <i class="right fa fa-angle-left"></i>
                <p>Write Your Own Stories</p>
               </a>
           </li>
           <li class="nav-item">
             <a href="all_stories.php" class="nav-link">
               <i class="fa fa-diamond"></i>
               <i class="right fa fa-angle-left"></i>
                <p> All Stories </p>
               </a>
           </li>
           <li class="nav-item">
             <a href="view_journal.php" class="nav-link">
               <i class="fa fa-book"></i>
               <i class="right fa fa-angle-left"></i>
                <p> Write Journal </p>
               </a>
           </li>
           <li class="nav-item">
             <a href="your_stories.php" class="nav-link">
               <i class="fa fa-file-text-o"></i>
               <i class="right fa fa-angle-left"></i>
                <p> Your Stories </p>
               </a>
           </li>
       <li class="nav-item">
         <a href="completed_stories.php" class="nav-link">
           <i class="fa fa-sliders"></i>
           <i class="right fa fa-angle-left"></i>
            <p>Completed Stories</p>
           </a>
       </li>
       <li class="nav-item">
         <a href="short_stories.php" class="nav-link">
           <i class="fa fa-money"></i>
           <i class="right fa fa-angle-left"></i>
            <p>Short Stories</p>
           </a>
       </li>

       <li class="nav-item">
         <a href="view_comments.php" class="nav-link">
           <i class="fa fa-qrcode"></i>
           <i class="right fa fa-angle-left"></i>
            <p>Comments</p>
           </a>
       </li>
       <li class="nav-item">
         <a href="recommendation.php" class="nav-link">
           <i class="fa fa-snowflake-o"></i>
           <i class="right fa fa-angle-left"></i>
            <p>Recomend Story to Others</p>
           </a>
       </li>
       <li class="nav-item">
         <a href="view_recommended_stories.php" class="nav-link">
           <i class="fa fa-file-code-o"></i>
           <i class="right fa fa-angle-left"></i>
            <p>Recommended Stories </p>
           </a>
       </li>
       <li class="nav-item">
         <a href="public_comments.php" class="nav-link">
           <i class="fa fa-comments"></i>
           <i class="right fa fa-angle-left"></i>
            <p> Public Comments </p>
           </a>
       </li>
        <li class="nav-item">
         <a href="reading_list.php" class="nav-link">
           <i class="fa fa-comments"></i>
           <i class="right fa fa-angle-left"></i>
            <p> Reading List </p>
           </a>
       </li>



          </ul>
        </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

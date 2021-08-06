<?php include '../db.php'; ?>
<style media="screen">
  nav ul li a p{
    color: white;
    font-family: monospace;
  }
</style>
<aside class="main-sidebar sidebar-dark-info  elevation-4 custom_bg adminsidebarColor">
  <!-- Brand Logo -->
  <a href="index.php" class="brand-link">
    <span class="brand-text font-weight-light ml-1 ">
      <i class="fa fa-book" aria-hidden="false">
     </i>
     Admin Menu
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
                     if($_SESSION["email"] && $_SESSION["password"]==true ){
                          $email= $_SESSION['email'];
                          $password= $_SESSION['password'];
                          $query = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
                          $results = mysqli_query($connection, $query);
                          if (mysqli_num_rows($results) == 1) {
                              while ($row=mysqli_fetch_assoc($results)) {
                                  $id =$row['id'];
                                  $f_name =$row['f_name'];
                                  $l_name =$row['l_name'];
                                  $email =$row['email'];
                                  $password =$row['password'];
                                  $profile =$row['profile_image'];
                              }
                             echo '<span class="text-uppercase"> '.$f_name.' '.$l_name.'</span>';
                           }else{
                         header('location:login.php');
                        }
                      }
                      ?>
                   </p>
                 </a>
                 <ul class="nav nav-treeview">
                   <li class="nav-item">
                     <a href="admin_logout.php?admin" class="nav-link">
                       <i class="fa fa-circle "></i>
                       <p>Logout</p>
                     </a>
                   </li>
                   <li class="nav-item">
                     <a href="admin_profile.php" class="nav-link">
                       <i class="fa fa-circle "></i>
                       <p>Profile</p>
                     </a>
                   </li>
                 </ul>
               </li>
               <hr>
           <li class="nav-item">
             <a href="admin.php" class="nav-link">
               <i class="fa fa-user-secret"></i>
               <i class="right fa fa-angle-left"></i>
                <p>Admin </p>
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
             <a href="all_stories.php" class="nav-link">
               <i class="fa fa-envelope"></i>
               <i class="right fa fa-angle-left"></i>
                <p> All Stories </p>
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
           <a href="create_journal.php" class="nav-link">
             <i class="fa fa-book"></i>
             <i class="right fa fa-angle-left"></i>
              <p>Write Your Journal</p>
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
         <a href="view_users.php" class="nav-link">
           <i class="fa fa-qrcode"></i>
           <i class="right fa fa-angle-left"></i>
            <p>Registerd Users</p>
           </a>
       </li>
       <li class="nav-item">
         <a href="public_comments.php" class="nav-link">
           <i class="fa fa-qrcode"></i>
           <i class="right fa fa-angle-left"></i>
            <p>Public Commetns </p>
           </a>
       </li>
       <li class="nav-item">
         <a href="view_contact_requests.php" class="nav-link">
           <i class="fa fa-qrcode"></i>
           <i class="right fa fa-angle-left"></i>
            <p>Public Contacts Requests </p>
           </a>
       </li>

       <li class="nav-item">
         <a href="web_info.php" class="nav-link">
           <i class="fa fa-qrcode"></i>
           <i class="right fa fa-angle-left"></i>
            <p>Website Info </p>
           </a>
       </li>
       <li class="nav-item">
         <a href="view_subscribtion.php" class="nav-link">
           <i class="fa fa-qrcode"></i>
           <i class="right fa fa-angle-left"></i>
            <p>Subsribtion Requests </p>
           </a>
       </li>
         <li class="nav-item">
         <a href="reading_list.php" class="nav-link">
           <i class="fa fa-qrcode"></i>
           <i class="right fa fa-window-left"></i>
            <p>Reading List </p>
           </a>
       </li>

          </ul>
        </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

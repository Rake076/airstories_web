<?php
session_start();
ob_start();
  include '../db.php';
       ?>
<!DOCTYPE html>
<html>
<head>
     <?php include 'includes/head.php'; ?>
<style media="screen">

</style>
</head>
 <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
       <!--Top Navbar  -->
        <?php include 'includes/header.php'; ?>
          <!-- /.navbar -->

       <!-- Main Sidebar start -->
         <?php include 'includes/sidebar.php'; ?>
            <!-- Main Sidebar end -->

      <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <div class="content-header">
            <div class="container-fluid m1">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1 class="m-0 text-muted text-lg">Welcome : <kbd class="bg-success rounded-circle text-uppercase"><?php echo $frist_name.' '.$last_name ?> </kbd> </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Home</li>
                  </ol>
                </div><!-- /.col -->
              </div><!-- /.row -->
              <hr>
            </div><!-- /.container-fluid -->
          </div>
          <!-- /.content-header -->

              <!-- Main content -->
          <section class="content">
            <?php

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
          <div class="container-fluid">
            <div class="row">
            <div class="col-12 col-sm-6 col-md-3 m2"> <!-- /.col -->
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-danger elevation-1"><i class="fa  fa-user-secret"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text"> <a href="userProfile.php">Your Profile</a> </span>
                    <span class="info-box-number">
                      <?php
                      $u_email = $_SESSION['u_email'];
                       $u_password = $_SESSION['u_password'];
                       $query="select * from users where u_email='$u_email' and u_password='$u_password' and status='verified'";
                        $r = mysqli_query($connection,$query);
                         $count_story = mysqli_num_rows($r);
                         if ($count_story>0) {
                           echo $count_story;
                         } else {
                           // code...
                           echo '<span class=" text-sm text-danger">Your Profile Not Exist</span>';
                         }
                       ?>
                    </span>
                  </div>
                </div>
              </div> <!-- /.col -->
              <div class="col-12 col-sm-6 col-md-3 m2"> <!-- /.col -->
                  <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fa  fa-sitemap"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text"> <a href="reviews.php">Reviews</a> </span>
                      <span class="info-box-number">
                        <?php
                           $sql = "SELECT count(*) FROM reviews where reviewi_id='$userid'";
                            $result =mysqli_query($connection,$sql);
                              while($row =mysqli_fetch_assoc($result)){
                              $presents= $row['count(*)'];
                           echo $presents;
                          }
                         ?>
                      </span>
                    </div>
                  </div>
                </div> <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3 m2"> <!-- /.col -->
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-qrcode" aria-hidden="true"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text"> <a href="view_reports.php">Reports</a> </span>
                    <span class="info-box-number">
                      <?php
                         $sql = "SELECT count(*) FROM reports where reporti='$userid'";
                          $result =mysqli_query($connection,$sql);
                            while($row =mysqli_fetch_assoc($result)){
                            $presents= $row['count(*)'];
                         echo $presents;
                        }
                       ?>
                    </span>
                  </div>
                </div>
              </div> <!-- /.col -->
             <div class="col-12 col-sm-6 col-md-3 m2"> <!-- /.col -->
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-dark elevation-1"><i class="fa fa-qrcode" aria-hidden="true"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text"> <a href="view_comments.php">Private Users Comments</a> </span>
                    <span class="info-box-number">
                      <?php  $obj->count_data('comments'); ?>
                    </span>
                  </div>
                </div>
              </div> <!-- /.col -->

            </div>  <!-- 1st row end -->
              <hr>
            <div class="row">
              <div class="col-12 col-sm-6 col-md-3 m2"> <!-- /.col -->
                 <div class="info-box mb-3">
                   <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-diamond" aria-hidden="true"></i></span>
                   <div class="info-box-content">
                     <span class="info-box-text"> <a href="all_stories.php">Stories Published On Website</a> </span>
                     <span class="info-box-number">
                       <?php
                           $sql = "SELECT count(*) FROM stories where status='0'";
                             $result =mysqli_query($connection,$sql);
                               while($row =mysqli_fetch_assoc($result)){
                               $total_stories= $row['count(*)'];
                            echo $total_stories;
                           }
                        ?>
                     </span>
                   </div>
                 </div>
               </div> <!-- /.col -->
              <div class="col-12 col-sm-6 col-md-3 m2"> <!-- /.col -->
                 <div class="info-box mb-3">
                   <span class="info-box-icon bg-info elevation-1"><i class="fa fa-file-text-o" aria-hidden="true"></i></span>
                   <div class="info-box-content">
                     <span class="info-box-text"> <a href="your_stories.php">Your Stories</a> </span>
                     <span class="info-box-number">
                       <?php
                           $sql = "SELECT count(*) FROM stories where user_id='$userid'";
                             $result =mysqli_query($connection,$sql);
                               while($row =mysqli_fetch_assoc($result)){
                               $presents= $row['count(*)'];
                            echo $presents;
                           }
                        ?>
                     </span>
                   </div>
                 </div>
               </div> <!-- /.col -->
               <div class="col-12 col-sm-6 col-md-3 m2"> <!-- /.col -->
                  <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-money" aria-hidden="true"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text"> <a href="short_stories.php">Short Stories</a> </span>
                      <span class="info-box-number">
                        <?php
                        $s = "SELECT * FROM stories where b_status='short_story' and user_id='$userid'";
                          $r = mysqli_query($connection,$s);
                           $count_story = mysqli_num_rows($r);
                           if ($count_story>0) {
                             echo $count_story;
                           } else {
                             // code...
                             echo '<span class=" text-sm text-danger"> Story Not Exist</span>';
                           }
                         ?>
                      </span>
                    </div>
                  </div>
                </div> <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3 m2"> <!-- /.col -->
                   <div class="info-box mb-3">
                     <span class="info-box-icon bg-secondary elevation-1"><i class="fa fa-sliders" aria-hidden="true"></i></span>
                     <div class="info-box-content">
                       <span class="info-box-text"> <a href="completed_stories.php">Completed Stories</a> </span>
                       <span class="info-box-number">
                         <?php
                         $s = "SELECT * FROM stories where b_status='completed_story' and user_id='$userid'";
                           $r = mysqli_query($connection,$s);
                            $count_story = mysqli_num_rows($r);
                            if ($count_story>0) {
                              echo $count_story;
                            } else {
                              // code...
                              echo '<span class=" text-sm text-danger"> Story Not Exist </span>';
                            }
                          ?>
                       </span>
                     </div>
                   </div>
                 </div> <!-- /.col -->
             </div>  <!-- 2nd row end -->
             <hr>
            <div class="row">
              <div class="col-12 col-sm-6 col-md-3 m2"> <!-- /.col -->
                 <div class="info-box mb-3">
                   <span class="info-box-icon bg-success elevation-1"><i class="fa fa-file-code-o" aria-hidden="true"></i></span>
                   <div class="info-box-content">
                     <span class="info-box-text"> <a href="view_recommended_stories.php">Recommended Stories</a> </span>
                     <span class="info-box-number">
                     <?php
                       $sql = "SELECT count(*) FROM story_recommendations where uid='$userid'";
                        $result =mysqli_query($connection,$sql);
                          while($row =mysqli_fetch_assoc($result)){
                          $presents= $row['count(*)'];
                          if ($presents>0) {
                            echo $presents;
                          } else {
                          echo '<span class=" text-sm text-danger"> No Recommendations</span>';
                        }
                      }
                    ?>
                   </span>
                 </div>
               </div>
             </div> <!-- /.col -->
             <div class="col-12 col-sm-6 col-md-3 m2"> <!-- /.col -->
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-white elevation-1"><i class="fa fa-comments" aria-hidden="true"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text"> <a href="public_comments.php">Public Comments</a> </span>
                    <span class="info-box-number">
                    <?php
                      $sql = "SELECT count(*) FROM public_comments ";
                       $result =mysqli_query($connection,$sql);
                         while($row =mysqli_fetch_assoc($result)){
                         $presents= $row['count(*)'];
                         if ($presents>0) {
                           echo $presents;
                         } else {
                         echo '<span class=" text-sm text-danger"> No Public comment</span>';
                       }
                     }
                   ?>
                  </span>
                </div>
              </div>
            </div> <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3 m2"> <!-- /.col -->
               <div class="info-box mb-3">
                 <span class="info-box-icon bg-primary elevation-1"><i class="fa fa-book" aria-hidden="true"></i></span>
                 <div class="info-box-content">
                   <span class="info-box-text"> <a href="view_journal.php">Journals</a> </span>
                   <span class="info-box-number">
                   <?php
                     $sql = "SELECT count(*) FROM journals where author_id='$userid'";
                      $result =mysqli_query($connection,$sql);
                        while($row =mysqli_fetch_assoc($result)){
                        $presents= $row['count(*)'];
                        if ($presents>0) {
                          echo $presents;
                        } else {
                        echo '<span class=" text-sm text-danger"> No Journal Exist</span>';
                      }
                    }
                  ?>
                 </span>
               </div>
             </div>
            </div> <!-- /.col -->
           <div class="col-12 col-sm-6 col-md-3 m2"> <!-- /.col -->
               <div class="info-box mb-3">
                 <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-window-restore"></i></span>
                 <div class="info-box-content">
                   <span class="info-box-text"> <a href="reading_list.php">Reading Lists</a> </span>
                   <span class="info-box-number">
                   <?php
                     $sql = "SELECT count(*) FROM readinglist where user_id='$userid'";
                      $result =mysqli_query($connection,$sql);
                        while($row =mysqli_fetch_assoc($result)){
                        $presents= $row['count(*)'];
                        if ($presents>0) {
                          echo $presents;
                        } else {
                        echo '<span class=" text-sm text-danger"> No Reading List Exist</span>';
                      }
                    }
                  ?>
                 </span>
               </div>
             </div>
            </div> <!-- /.col -->
           </div>  <!-- 3rd row end -->
          </div>      <!-- container-fluid -->
        </section>
      </div> <!-- contecnt wrapper -->

    <?php include 'includes/footer.php'; ?>

  </body>

</html>

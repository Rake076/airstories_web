<?php include '../db.php'; ?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
<!-- Meta Tags -->
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<meta name="description" content="StudyPress | Education & Courses HTML Template" />
<meta name="keywords" content="academy, course, education, education html theme, elearning, learning," />
<meta name="author" content="ThemeMascot" />
<!-- Page Title -->
<title> Users Detaila </title>
<?php include 'includes/head.php'; ?>
</head>
  <body class="boxed-layout pt-40 pb-40 pt-sm-0" data-bg-img="images/pattern/p13.png">
    <div id="wrapper" class="clearfix">
       <!-- Header -->
         <?php include 'includes/header.php'; ?>
            <!-- Start main-content -->
               <div class="main-content">
                <!-- users Details start here -->
                      <!-- Section: inner-header -->
                      <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="images/bg/bg3.jpg">
                        <div class="container pt-70 pb-20">
                          <!-- Section Content -->
                          <div class="section-content">
                            <div class="row">
                              <div class="col-md-12">
                                <h2 class="title text-white">Users Details</h2>
                                <ol class="breadcrumb text-left text-black mt-10">
                                  <li><a href="#">Home</a></li>
                                  <li class="active text-gray-silver">User Detail</li>
                                </ol>
                              </div>
                            </div>
                          </div>
                        </div>
                      </section>
                      <!-- Section: Experts Details -->
                      <section>
                        <?php
                        if (isset($_GET['user_details'])) {
                           $id = $_GET['user_details'];

                           $sql = "select * from users where id='$id'";
                            $rql = mysqli_query($connection,$sql);
                             $count_story = mysqli_num_rows($rql);
                                while ($row=mysqli_fetch_assoc($rql)) {
                                  $id = $row["id"];
                                  $u_profile_image= $row["u_profile_image"];
                                   $frist_name = $row["frist_name"];
                                   $last_name = $row["last_name"];
                                   $u_email = $row["u_email"];
                                  $u_password = $row["u_password"];
                                  $status= $row["status"];
                                $code= $row["code"];
                                $fb = $row["fb"];
                               $tw = $row["tw"];
                              $exp = $row["exp"];
                            $sk = $row["sk"];
                          $pno = $row["pno"];
                          $about = $row["about"];

                          }
                         }
                         ?>
                        <div class="container">
                          <div class="section-content">
                            <div class="row">
                              <div class="col-md-4">
                                <div class="thumb">
                                  <img src="../userProfileImage/<?php echo $u_profile_image; ?>" alt="">
                                </div>
                              </div>
                              <div class="col-md-8">
                                <h4 class="name font-24 mt-0 mb-0 text-capitalize"><?php echo $frist_name.' '.$last_name; ?></h4>
                                <h5 class="mt-5 text-theme-color-2"></h5>
                                <p><?php echo $about; ?></p>
                                <ul class="styled-icons icon-dark icon-theme-colored icon-sm mt-15 mb-0">
                                  <li><a href="<?php echo $fb ?>"><i class="fa fa-facebook"></i></a></li>
                                  <li><a href="<?php echo $tw ?>"><i class="fa fa-twitter"></i></a></li>
                                  <li><a href="<?php echo $sk ?>"><i class="fa fa-skype"></i></a></li>
                               </ul>
                              </div>
                            </div>
                            <div class="row mt-30">
                              <div class="col-md-4">
                                <!-- <div class="bg-light media border-bottom p-15 mb-20">
                                  <div class="media-left">
                                    <i class="fa fa-map-marker text-theme-colored font-24 mt-5"></i>
                                  </div>
                                  <div class="media-body">
                                    <h5 class="mt-0 mb-0">Address:</h5>
                                    <p>Village 856 Broadway New York</p>
                                  </div>
                                </div> -->
                              </div>
                              <div class="col-md-4">
                                <div class="bg-light media border-bottom p-15 mb-20">
                                  <div class="media-left">
                                    <i class="pe-7s-pen text-theme-colored font-24 mt-5"></i>
                                  </div>
                                  <div class="media-body">
                                    <h5 class="mt-0 mb-0">Experiences:</h5>
                                    <p><?php echo $exp; ?></p>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="bg-light media border-bottom p-15">
                                  <div class="media-left">
                                    <i class="fa fa-phone text-theme-colored font-24 mt-5"></i>
                                  </div>
                                  <div class="media-body">
                                    <h5 class="mt-0 mb-0">Contact:</h5>
                                    <p><span>Phone:</span> <?php echo $pno; ?><br><span>Email:</span> <?php echo $u_email; ?> </p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </section>
                    <!-- users Details end here  -->
                    <section class="bg-theme-color-2"id="sub">
                      <?php include 'includes/subscribe.php'; ?>
                   </section>
                 <!-- end main-content -->
               </div>
             <!-- Footer -->
          <?php include 'includes/footer.php'; ?>
        <a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
     </div>
   <!-- end wrapper -->
 </body>
</html>

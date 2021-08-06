<?php
ob_start();
 include '../db.php';
 ?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <title>Admin Login/Registeration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <!-- External CSS libraries -->
    <link  rel="stylesheet" href="assets/fonts/font-awesome/css/font-awesome.min.css">
    <!-- Favicon icon -->
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon" >
    <!-- Google fonts -->
    <link rel="stylesheet"  href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800%7CPoppins:400,500,700,800,900%7CRoboto:100,300,400,400i,500,700">
    <!-- Custom Stylesheet -->
    <link  rel="stylesheet" href="assets/css/style.css">

    <!--Bootstrap 4 -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


</head>
<body id="top">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TAGCODE"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<div class="page_loader"></div>

<!-- Login 20 start -->
<div class="login-20">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-12 bg-color-10">
                <div class="form-section">
                    <div class="logo clearfix">
                        <a href="#">
                            <img src="../adminPanal/assets/img/books1.jpg" alt="logo">
                        </a>
                    </div>
                    <h3>Sign into your account</h3>
                    <div class="extra-login clearfix">
                        <span></span>
                        <?php include('forgot_password_code.php') ?>
                    </div>
                    <div class="row">
                       <div class="col-md-12">
                         <?php
                              if(isset($_SESSION['info'])){
                                  ?>
                                  <div class="alert alert-success text-center">
                                      <?php echo $_SESSION['info']; ?>
                                  </div>
                                  <?php
                              }
                              ?>

                       </div>
                    </div>
                         <div class="login-inner-form">
                           <form method="POST" autocomplete="off">
                             <div class="form-group form-box ">
                                 <label for=""class="text-danger">New Password</label>
                                   <input class="form-control input-text" type="password" name="password" placeholder="Enter New Password" >
                               </div>
                               <div class="form-group form-box ">
                                 <label for=""class="text-danger">Conform New Password</label>
                                   <input class="form-control input-text" type="password" name="cpassword" placeholder="Conform New Password" >
                               </div>
                               <div class="form-group">
                                   <input class="form-control button btn-md btn-theme btn-block" type="submit" name="change-password" value="Save">
                               </div>
                           </form>
                         </div>
                    <p>Don't have an account? <a href="register.php" class="thembo text-primary"> Register here</a></p>
                </div>
            </div>
            <div class="col-xl-8 col-lg-7 col-md-12 bg-img none-992">
                <div class="info">
                  <h1>Welcome to  StudyPress</h1>
                  <p class="text-success">
                  The ultimate goal of the Open This Platform is to make all the published works of human kind available to everyone in the world.
                  While large in scope and ambition, this goal is within our grasp. Achieving it will require the participation of librarians, authors,
                  government officials and technologists.
                  Our hope is that Many and individual Story readers and Writers will join this project and together we can build towards universal access to all knowledge.
                  </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login 20 end -->

</body>

<!-- Mirrored from storage.googleapis.com/themevessel-products/logdy/main/login-20.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 06 Feb 2020 09:37:09 GMT -->
</html>

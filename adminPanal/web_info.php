<?php
session_start();
    ob_start();
       ?>
<!DOCTYPE html>
<html>
<head>
     <?php include '../includes/head.php'; ?>
<style media="screen">
  .hr{
    margin-top: 1rem;
    margin-bottom: 2rem;
    border: 0;
    border-top: 5px solid rgba(25,15,3,.1);
    background-color: darkturquoise;
  }
</style>
</head>
 <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
       <!--Top Navbar  -->
        <?php include '../includes/header.php'; ?>
          <!-- /.navbar -->

       <!-- Main Sidebar start -->
         <?php include '../includes/sidebar.php'; ?>
            <!-- Main Sidebar end -->

      <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <div class="content-header">
            <div class="container-fluid m1">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1 class="m-0 text-dark text-lg">Website Information </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Home</li>
                    <li class="breadcrumb-item active">Website Information</li>
                  </ol>
                </div><!-- /.col -->
              </div><!-- /.row -->
              <a href="view_web_info.php"class="btn btn-sm btn-dark">View web_info</a>
              <hr>
            </div><!-- /.container-fluid -->
          </div>
          <!-- /.content-header -->

              <!-- Main content -->
          <section class="content">
           <div class="container-fluid">
             <div class="row">
               <div class="col-md-8 offset-2 mb-2">
                  <?php include 'web_info_code.php'; ?>
               </div>
             </div>
            <div class="row">
             <div class="col-md-12 text-sm text-muted"> <!-- /.col -->
               <form method="post"enctype='multipart/form-data'class="text-muted">
                 <div class="form-row">
                   <div class="form-group col-md-4">
                     <label for="inputEmail4">Email</label>
                     <input type="email" class="form-control form-control-sm"name="email"value="<?php echo $email ?>"  autocomplete="off" placeholer="Email">
                   </div>
                   <div class="form-group col-md-4">
                     <label for="inputPassword4">Phone1</label>
                     <input type="number" class="form-control form-control-sm"name="phone1"value="<?php echo $phone1 ?>" autocomplete="off" placeholer="enter Phone Number">
                   </div>
                   <div class="form-group col-md-4">
                     <label for="inputAddress2">phone2</label>
                     <input type="number" class="form-control form-control-sm"name="phone2"value="<?php echo $phone2 ?>"autocomplete="off" placeholer="Enter Phone no ">
                   </div>
                 </div>
                 <div class="form-row">
                 <div class="form-group col-md-4">
                   <label for="inputAddress">Description</label>
                   <textarea  name="description"class="form-control form-control-sm" rows="1" cols="40"><?php echo $description ?></textarea>

                 </div>
                 <div class="form-group col-md-4">
                   <label for="inputAddress2">Facebook</label>
                   <input type="url" class="form-control form-control-sm"name="fb"value="<?php echo $fb ?>"autocomplete="off" placeholer="Enter Phone no ">
                 </div>
                 <div class="form-group col-md-4">
                   <label for="inputAddress2">Twitter</label>
                   <input type="url" class="form-control form-control-sm"name="tw"value="<?php echo $tw ?>"autocomplete="off" placeholer="Enter Phone no ">
                 </div>
                 <div class="form-group col-md-4">
                   <label for="inputAddress2">LinkedIn</label>
                   <input type="url" class="form-control form-control-sm"name="linkedin"value="<?php echo $linkedin ?>" autocomplete="off" placeholer="Enter Linked link ">
                 </div>
                 <div class="form-group col-md-4">
                   <label for="inputAddress2">Website Link </label>
                   <input type="url" class="form-control form-control-sm"name="website_link"value="<?php echo $website_link ?>"autocomplete="off" placeholer="Enter Website link ">
                 </div>
                 </div>
                 <div class="row">
                   <div class="col-md-2 offset-5">
                     <input type="submit"name="save_website_info" class="btn btn-success btn-block btn-sm m-2 float-right"value="Save">
                   </form>
                   </div>
                 </div>
                 </div>

              </div> <!-- /.col -->
              <hr class="hr">
            </div> <!--1srt form row /.col -->

          </div>      <!-- container-fluid -->
          </section>
      </div> <!-- contecnt wrapper -->

    <?php include '../includes/footer.php'; ?>

  </body>

</html>

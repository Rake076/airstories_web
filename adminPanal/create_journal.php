<?php
session_start();
ob_start();
include '../db.php';
 ?>
<!DOCTYPE html>
<html>
<head>
  <title>User-Journalism</title>
     <?php include '../includes/head.php'; ?>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<style media="screen">
  .hr{
    margin-top: 1rem;
    margin-bottom: 2rem;
    border: 0;
    border-top: 5px solid rgba(25,15,3,.1);
    background-color: darkturquoise;
  }

  .navbar {
       margin-bottom: 0px;
  }
  .backbtnz{
    display: inline;
    border: 1px solid green;
  }
  .main-header .nav-link {
      height: auto;
      position: relative;
  }

  .navbar-expand .navbar-nav .nav-link {
      padding-right: 1rem;
      padding-left: 1rem;
      display: unset;
  }

.noti_style{
    border-radius: 10px;
    margin: -9px;
    padding: 5px;
}
.dropdown-item-title {
    font-size: initial;
    margin: 0;
}
.dropdown-menu-lg .dropdown-item {
    padding: 0.5rem;
    font-size: medium;
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
                  <h1 class="m-0"> Journals</h1>
                  <?php
                  // getting current user id
                  $email = $_SESSION['email'];
                   $password = $_SESSION['password'];
                    if($_SESSION["email"] && $_SESSION["password"]==true ){
                         $query = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
                         $results = mysqli_query($connection, $query);
                         if (mysqli_num_rows($results) == 1) {
                             while ($row=mysqli_fetch_assoc($results)) {
                                 $admin_id =$row['id'];
                                 $f_name =$row['f_name'];
                                 $l_name =$row['l_name'];
                            }
                          }
                        }
                   ?>
                  <span class="text-muted">Total Journal :</span> <kbd class="bg-success rounded-circle"><?php
                          $sql = "SELECT count(*) FROM journals where author_id='$admin_id'";
                           $result =mysqli_query($connection,$sql);
                             while($row =mysqli_fetch_assoc($result)){
                             $presents= $row['count(*)'];
                          echo $presents;
                         }
                    ?></kbd>

                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Home</li>
                    <li class="breadcrumb-item active"> Journals </li>
                  </ol>
                </div><!-- /.col -->
              </div><!-- /.row -->
              <hr>
              <a href="view_journal.php"class="btn btn-danger btn-outline-success">View Your journals </a>
              <a href="view_all_journal.php"class="btn btn-warning btn-outline-warning">View All journals </a>
              <div class="row">
                <div class="col-sm-6 offset-3">
                  <?php include 'create_journal_code.php'; ?>
                </div>
              </div>
              <hr>
            </div><!-- /.container-fluid -->
          </div>
          <!-- /.content-header -->

              <!-- Main content -->
          <section class="content">
            <div class="container-fluid">
              <div class="row">
                 <div class="col-md-12">
                   <div class="">
                     <form method="post"enctype="multipart/form-data">
                       <div class="col-sm-6 pt-0 pb-0">
                         <div class="form-group">
                           <label for=""class="text-muted">Title</label>
                           <input type="text" class="form-control"value="<?php echo $tittle ?>"  name="tittle"autocomplete="off" id="" placeholder="Title">
                         </div>
                         <div class="form-group">
                           <label for=""class="text-muted">Date</label>
                           <input type="date"  class="form-control"value="<?php echo date('Y-m-d'); ?>" name="jdate"autocomplete="off" id="" placeholder="Date">
                         </div>
                       </div>
                       <div class="col-sm-6">
                         <div class="form-group">
                           <label for=""class="text-muted">Type</label>
                           <select id="inputState" class="form-control form-control-sm"name="type">
                             <option value="<?php echo $type ?>"> <?php echo $type ?> </option>
                             <option value="happy"> Happy </option>
                             <option value="sad"> Sad </option>
                             <option value="event"> Events </option>
                             <option value="Entertainment"> Entertainment </option>
                             <option value="movies"> Movies </option>
                             <option value="songs"> Songs </option>
                             <option value="others"> Others </option>
                           </select>
                         </div>
                         <div class="form-group">
                           <label for=""class="text-muted">Cover Photo</label>
                           <input type="file" placeholder=""class="form-control"value="<?php echo $cover_photo ?>" name="cover_photo">
                         </div>
                         <input type="hidden"class="form-control"name="author"value="<?php echo $f_name.' '.$l_name; ?>" placeholder="Author Name">
                         <input type="hidden"class="form-control" name="author_id"value="<?php echo $admin_id; ?>" placeholder="Author ID">
                         <input type="hidden"class="form-control"value="0" name="readings">
                         <input type="hidden"class="form-control"value="0" name="likes">
                         <input type="hidden"class="form-control"value="0" name="comments">
                       </div>
                       <div class="row">
                          <div class="col-md-8 offset-2">
                            <div class="form-group">
                              <label for=""class="text-muted">Write Your Journal </label>
                              <textarea class="form-control"name="detail" placeholder="write Details"cols="15" rows="5"><?php echo $detail ?></textarea>
                            </div>
                          </div>
                       </div>
                       <div class="form-group">
                         <button type="submit"name="save_journal" class="btn btn-dark btn-lg btn-flat pull-right m-2" data-loading-text="Please wait...">Save</button>
                       </div>
                     </form>
                  </div>
               </div>
            </div>  <!--table 1st row end -->
          </div>      <!-- container-fluid -->
        </section>
      </div> <!-- contecnt wrapper -->
    <?php include '../includes/footer.php'; ?>
  </body>
</html>

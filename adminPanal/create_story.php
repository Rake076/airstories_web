<?php
session_start();
ob_start();
include '../db.php';
 ?>
<!DOCTYPE html>
<html>
<head>
  <title>User-Story</title>
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
.note-editor .note-editing-area .note-editable {
    outline: none;
    height: 171px;
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
                  <h1 class="m-0"> Stories </h1>
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
                            }
                          }
                        }
                   ?>
                  <span class="text-muted">Total Stories :</span> <kbd class="bg-success rounded-circle"><?php
                            $sql = "SELECT count(*) FROM stories where user_id='$admin_id'";
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
                    <li class="breadcrumb-item active"> Stories </li>
                  </ol>
                </div><!-- /.col -->
              </div><!-- /.row -->
              <hr>
              <a href="view_stories.php"class="btn btn-danger btn-outline-success">View Your Stoires </a>
              <a href="all_stories.php"class="btn btn-warning btn-outline-warning">View All Stories </a>
              <div class="row">
                <div class="col-sm-6 offset-3">
                  <?php require('create_story_code.php') ?>
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
                           <input type="hidden" class="form-control form-control-sm"name="role"value="admin"  placeholder="">
                           <input type="hidden" class="form-control form-control-sm"name="user_id"value="<?php echo  $id; ?>"  placeholder="">
                           <label for=""class="text-muted">Story Title</label>
                           <input type="text" class="form-control"value="<?php echo $b_tittle ?>"  name="b_tittle"autocomplete="off" id="" placeholder="Title">
                         </div>
                         <div class="form-group">
                           <label for=""class="text-muted"> Genre</label>
                           <select id="inputState" class="form-control form-control-sm"name="b_type">
                             <option selected>Choose...</option>
                             <option  value="<?php echo $b_tittle ?>"><?php echo $b_tittle ?></option>
                             <option value="Action"> Action </option>
                             <option value="Commedy"> Commedy </option>
                             <option value="Thriller"> Thriller </option>
                             <option value="Adventure"> Adventure </option>
                             <option value="Criminal"> Criminal </option>
                             <option value="Mystery"> Mystery </option>
                             <option value="Fantasy"> Fantasy  </option>
                             <option value="Hisotrycal"> Hisotrycal </option>
                             <option value="Rommance"> Rommance </option>
                             <option value="Satire"> Satire </option>
                             <option value="section Fiction"> Science Fiction </option>
                             <option value="Cyberpunk">Cyberpunk  </option>
                             <option value="Speculative"> Speculative </option>
                             <option value="western"> western </option>
                           </select>

                         </div>
                         <div class="form-group">
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
                                    }
                                 }
                              }
                            ?>

                           <label for=""class="text-muted">Author Name</label>
                           <input type="text" class="form-control"value="<?php echo $f_name.' '.$l_name; ?>"  name="b_author"autocomplete="off" id="" placeholder="Author Name">
                         </div>
                         <div class="form-group">
                           <label for=""class="text-muted">Status</label>
                           <select id="inputState" class="form-control form-control-sm"name="b_status">
                             <option selected>Choose...</option>
                             <option  value="<?php echo $b_status ?>"><?php echo $b_status ?></option>
                             <option value="short_story">Short Story</option>
                             <option value="completed_story">Completed Story</option>
                           </select>
                         </div>
                         <img id="user_img"height="40"width="40"style="border:solid green" />
                         <div class="form-group mb-5">
                            <input type="file" title="search image" id="file" name="cover_photo" onchange="show(this)" />
                          </div>
                       </div>
                       <div class="col-sm-6 pt-0 pb-0">
                         <div class="form-group">
                           <label for=""class="text-muted">Desciption</label>
                           <textarea id="" name="b_description"class="form-control form-control-sm" rows="4" cols="100" maxlength="75" minlength="25" ><?php echo $b_description ?></textarea>
<!--                          <script>
                             $(function () {
                                 // Set up your summernote instance
                                 $("#txtTest").summernote();
                                 // When the summernote instance loses focus, update the content of your <textarea>
                                 $("#txtTest").on('summernote.blur', function () {
                                     $('#txtTest').html($('#txtTest').summernote('code'));
                                 });
                             });
                         </script> -->
                       </div>
                       </div>
                       <div class="form-group">
                         <button type="submit"name="save_story" class="btn btn-dark btn-lg btn-flat pull-right m-2" data-loading-text="Please wait...">Save</button>
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

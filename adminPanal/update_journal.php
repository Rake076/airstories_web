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
                  <h1 class="m-0">Update Journalism </h1>
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
                  <span class="text-muted">Total Journalism :</span> <kbd class="bg-success rounded-circle"><?php
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
                    <li class="breadcrumb-item active">Update Journalism </li>
                  </ol>
                </div><!-- /.col -->
              </div><!-- /.row -->
              <hr>
              <a href="view_journal.php"class="btn btn-danger btn-outline-success">View </a>
              <a href="create_journal.php"class="btn btn-success btn-outline-success">Create  </a>
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
                <div class="col-sm-6 offset-3">
                  <?php
            // getting admin's table for update
                  if (isset($_GET['edit'])) {
                    $id = $_GET['edit'];
                    $query="select * from journals where id='$id'";
                     $r = mysqli_query($connection,$query);
                      $count_story = mysqli_num_rows($r);
                        while ($row=mysqli_fetch_assoc($r)) {
                          $id = $row["id"];
                           $tittle = $row["tittle"];
                           $type = $row["type"];
                           $detail = $row["detail"];
                           $jdate = $row["jdate"];
                           $cover_photo = $row["cover_photo"];

                            // updating admin table
                           if(isset($_POST['update_journal'])){
                             $tittle = mysqli_real_escape_string($connection, $_POST['tittle']);
                             $type = mysqli_real_escape_string($connection, $_POST['type']);
                             $detail = mysqli_real_escape_string($connection, $_POST['detail']);
                             $jdate = mysqli_real_escape_string($connection, $_POST['jdate']);
                               $s =  $obj->update('journals',['tittle'=>$tittle,'type'=>$type,'detail'=>$detail,'jdate'=>$jdate],'id='.$id.'');
                                   if($s){
                                     $cover_photo = $_FILES['cover_photo']['name'];
                                     $target_dirr = "../journalsImages/";
                                     $target_file = $target_dirr . basename($_FILES["cover_photo"]["name"]);
                                     move_uploaded_file($_FILES['cover_photo']['tmp_name'],$target_dirr.$cover_photo);

                                     // updating only cover_photo
                                     if (empty($cover_photo)) {
                                       // getting data from empdocuments tabel
                                         $query = "SELECT * FROM journals where id=$id";
                                           $result = $connection->query($query);
                                             if($result->num_rows > 0){
                                             while($row = $result->fetch_assoc()){
                                             $cover_photo = $row['cover_photo'];
                                             }
                                           }
                                          $cover_photo = $cover_photo;
                                         $s =  $obj->update('journals',['cover_photo'=>$cover_photo],'id='.$id.'' );
                                       }else{
                                      $s =  $obj->update('journals',['cover_photo'=>$cover_photo],'id='.$id.'' );
                                     }

                                    echo '
                                      <div class="alert alert-success  alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                       <strong> Data Updated  Successfully ! </strong>
                                     </div>
                                     ';
                                     header('Refresh:1,url=view_journal.php?get='.$id.'');
                                   } else {
                                     echo '
                                      <div class="alert alert-warning  alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                       <strong> Sorry Data Not Updated Try Again ! </strong>
                                     </div>
                                     ';
                                   }

                               }
                            }
                         }
                       ?>

                </div>
              </div>
              <div class="row">
                 <div class="col-md-12">
                   <div class="">
                     <form method="post"enctype="multipart/form-data">
                       <div class="col-sm-6 pt-0 pb-0">
                         <div class="form-group">
                           <label for=""class="text-muted">Tittle</label>
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
                           <?php
                           if (!$cover_photo) {
                             ?>
                             <img  src="../journalsImages/placeholder1.jpg" height="50px"width="50px">
                              <?php
                               }else {
                              ?>
                             <img  src="../journalsImages/<?php echo $cover_photo; ?>" height="50px"width="50px">
                             <?php
                            }
                          ?>
                           <label for=""class="text-muted">Cover Photo</label>
                           <input type="file" placeholder=""class="form-control"value="<?php echo $cover_photo ?>" name="cover_photo">
                         </div>
                       </div>
                       <div class="row">
                          <div class="col-md-8 offset-2">
                            <div class="form-group">
                              <label for=""class="text-muted">Detail</label>
                              <textarea class="form-control"name="detail" placeholder="write Details"cols="15" rows="5"><?php echo $detail ?></textarea>
                            </div>
                          </div>
                       </div>
                       <div class="form-group">
                         <button type="submit"name="update_journal" class="btn btn-dark btn-lg btn-flat pull-right m-2" data-loading-text="Please wait...">Update</button>
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

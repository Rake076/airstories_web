<?php
session_start();  // to start session
    ob_start();  // for  header already sent error
  ?>
<!DOCTYPE html>
<html>
<head>
     <!--to view gallery images -->
     <link rel="stylesheet" href="includes/ekko-lightbox/ekko-lightbox.css">
     <?php include 'includes/head.php'; ?>
<style media="screen">
table {
    color: #333;
    font-family: Helvetica, Arial, sans-serif;
    width: 640px;
    border-collapse: collapse;
    border-spacing: 0;
}
td, th {
    border: 1px solid transparent; /* No more visible border */
    height: 30px;
    font-size: 11px;
}
th {
    background: #DFDFDF;  /* Darken header a bit */
    font-weight: bold;
}
td {
    background: #FAFAFA;
    text-align: center;
}
.pro_item{
  color: #333;
  font-family: Helvetica, Arial, sans-serif;
  font-size: 14px;
}
.pro_item li a{
  color: #333;
  font-family: Helvetica, Arial, sans-serif;
  font-size: 14px;
}

</style>
<style>

.image {
  opacity: 1;
  display: block;
  width: 100%;
  height: auto;
  transition: .5s ease;
  backface-visibility: hidden;
}

.middle {
  transition: .5s ease;
  opacity: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
}


.container:hover .middle {
  opacity: 1;

  color: red;
  font-size: 52px !important;
  padding: 16px 3px;
  margin-bottom: 140px;
  font-weight: bolder;
}

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
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark text-muted text-lg"> Profile: </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="patient_view.php">Home</a></li>
              <li class="breadcrumb-item active ">Profile </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <hr>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->


    <section class="content">
      <div class="contact1">
         <div class="container-contact1">
           <div class="container">
             <button class=" btn m-1 btn-xs btn-outline-info "><i class="fa fa-plus" aria-hidden="true"> <a href="index.php">Back</a> </i></button>
             <span class="contact1-form-title text-center text-muted text-lg">
                 User Profile
              </span> <hr>
                <div class="row justify-content-around">
                   <div class="col-12">
                     <!-- Main content -->
                     <section class="content">
                       <div class="container-fluid">
                         <div class="row">
                           <div class="col-md-3">
                             <!-- Profile Image -->
                             <div class="card card-info card-outline">
                               <div class="card-body box-profile">
                                 <div class="text-center">

                                   <?php
                                     if(mysqli_num_rows($results) ==1) {
                                        echo '<img class="profile-user-img img-fluid img-circle"src="../userprofileImage/'.$profile.'"height="100px">';
                                        echo'
                                        <div class="middle">
                                          <a href="update_user_profile.php?edit='.$id.'" class="text-danger">Change</a>
                                        </div>
                                        ';
                                        }else{
                                       echo '<img src="../profileImage/profile.png"width="100px"height="100px">';
                                       echo'
                                       <div class="middle">
                                         <a href="update_user_profile.php?edit='.$id.'" class="text-danger">Change</a>
                                       </div>
                                       ';
                                     }
                                    ?>
                                 </div>
                                 <h3 class="profile-username text-center text-capitalize">
                                  <?php
                                   if (mysqli_num_rows($results) == 1) {
                                      echo $frist_name.' '.$last_name;
                                    }else {
                                     echo "Name not Found";
                                   }
                                  ?>
                                 </h3>
                               </div>
                               <!-- /.card-body -->
                             </div>
                             <!-- /.card -->
                             <!-- other user information -->

                             <div class="card">
                               <div class="card-body ">
                                 <h5 class="text-muted">Other Info</h5>
                                 <hr>
                                 <ul class="list-group text-sm">
                                   <li class="">
                                     <span class="text-muted">Facebook Account :</span> <a class="float-right text-muted text-capitalize " href="<?php echo $fb?>"><?php echo substr($fb,0,14); ?>...</a>
                                   </li>
                                   <hr>
                                   <li class="">
                                     <span class="text-muted">Twitter Account :</span> <a class="float-right text-muted text-capitalize " href="<?php echo $tw?>"><?php echo substr($tw,0,14); ?>...</a>
                                   </li>
                                   <hr>
                                   <li class="">
                                     <span class="text-muted">Skype ID :</span> <a class="float-right text-muted text-capitalize " href="<?php echo $sk?>"><?php echo substr($sk,0,14); ?>...</a>
                                   </li>
                                   <hr>
                                   <li class="">
                                     <span class="text-muted">Experience :</span> <a class="float-right text-muted text-capitalize "><?php echo $exp; ?></a>
                                   </li>
                                   <hr>
                                 </ul>
                               </div>
                               <!-- /.card-body -->
                             </div>
                             <!-- /.card -->
                           </div>
                           <!-- /.col -->
                           <div class="col-md-9">
                             <?php

                               // delete admin
                                if (isset($_GET['delete'])) {
                                  $id = $_GET['delete'];
                                    $result = $obj->delete($id, 'users');
                                  if ($result) {
                                    echo '
                                    <div class="alert alert-success  alert-dismissible">
                                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                                     <strong> Data Deleted Successfully ! </strong>
                                   </div>
                                   ';
                                   header('Refresh:1,url=userProfile.php');
                                  } else {
                                    echo '
                                     <div class="alert alert-danger  alert-dismissible">
                                       <button type="button" class="close" data-dismiss="alert">&times;</button>
                                      <strong> Sorry Data Not Deleted Try Again ! </strong>
                                    </div>
                                    ';
                                   header('Refresh:1,url=userProfile.php');
                                  }

                                }
                              ?>
                             <div class="card card-outline card-info">
                               <div class="card-header p-2">
                                 <ul class="nav nav-pills">

                                 </ul>
                               </div><!-- /.card-header -->
                               <div class="card-body">
                                 <div class="tab-content">
                                   <table class="table table-bordered table-hover table-responsive "id="sampleTable" >
                                     <thead>
                                       <tr>
                                         <th>Frist Name </th>
                                          <th>Last Name </th>
                                           <th> Email </th>
                                           <th>  Password </th>
                                          <th>   </th>
                                      </tr>
                                   </thead>
                                           <tr>
                                              <td><?php
                                              if (mysqli_num_rows($results) == 1) {
                                                 echo $frist_name;
                                               }else {
                                                echo "Frist Name not Found";
                                              }
                                              ?></td>
                                               <td><?php
                                               if (mysqli_num_rows($results) == 1) {
                                                  echo $last_name;
                                                }else {
                                                 echo "Last Name not Found";
                                               }
                                               ?></td>
                                               <td><?php
                                               if (mysqli_num_rows($results) == 1) {
                                                  echo $u_email;
                                                }else {
                                                 echo "Email not Found";
                                               }
                                               ?></td>
                                               <td><?php
                                               if (mysqli_num_rows($results) == 1) {
                                                  echo $u_password;
                                                }else {
                                                 echo "Password not Found";
                                               }
                                                ?></td>
                                            <td width="2%"><a href="update_users.php?edit=<?php
                                            if (mysqli_num_rows($results) == 1) {
                                               echo $id;
                                             }
                                            ?>">Edit</a></td>
                                           </tr>

                                      </tbody>
                                   </table>
                               </div><!-- /.card-body -->
                             </div>
                             <!-- /.card -->
                           </div>
                           <!-- /.col -->
                           <div class="card-body">
                             <div class="tab-content">
                               <h5 class="text-muted">About You</h5>
                           </div><!-- /.card-body -->
                            <div class="card-body">
                              <p><?php echo $about; ?></p>

                            </div>
                         </div>
                         <!-- /.card -->
                       </div>
                       <!-- /.col -->
                         </div>
                         <!-- /.row -->
                       </div><!-- /.container-fluid -->

                     </section>
                     <!-- /.content -->
                   </div>
                  </div>
                </div>
              </div>
             </div>
           </div>
         </section>
        </div> <!-- contecnt wrapper -->
      </div><!-- /.container-fluid -->

   <?php include 'includes/footer.php'; ?>


</body>
</html>

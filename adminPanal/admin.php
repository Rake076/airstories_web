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
                  <h1 class="m-0 mb-3 text-dark"> Admins  </h1>
                   Total Admins : <kbd class="bg-success rounded-circle"><?php  $obj->count_data('admin'); ?></kbd>
                </div><!-- ol -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Home</li>
                    <li class="breadcrumb-item active">Admin</li>
                  </ol>
                </div><!-- /.col -->
              </div><!-- /.row -->
              <div class="row">
                <div class="col-sm-4 offset-4">
                  <?php
                    // delete code
                     if (isset($_GET['delete'])) {
                       $id = $_GET['delete'];
                         $result = $obj->delete($id, 'admin');
                       if ($result) {
                         echo '
                         <div class="alert alert-success  alert-dismissible">
                           <button type="button" class="close" data-dismiss="alert">&times;</button>
                          <strong> Data Deleted Successfully ! </strong>
                        </div>
                        ';
                        header('Refresh:0,url=admin.php');
                       } else {
                         echo '
                          <div class="alert alert-danger  alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                           <strong> Sorry Data Not Deleted Try Again ! </strong>
                         </div>
                         ';
                        header('Refresh:0,url=admin.php');
                       }

                     }
                   ?>
                </div>
              </div>
              <hr>
            </div><!-- /.container-fluid -->
          </div>
          <!-- /.content-header -->

              <!-- Main content -->
          <section class="content">
            <div class="container">
              <div class="row">
               <div class="col-md-12"> <!-- /.col -->
                <table class="table table-bordered table-hover "id="sampleTable" >
                  <thead>
                    <tr>
                      <th>Frist Name </th>
                       <th>Last Name </th>
                        <th> Email </th>
                        <th>  Password </th>
                       <th>  Image </th>
                     <th>   </th>
                   </tr>
                </thead>
                  <?php
                     $post_data = $obj->select('admin');
                        foreach($post_data as $post){
                          $id = $post["id"];
                           $f_name = $post["f_name"];
                           $l_name = $post["l_name"];
                           $email = $post["email"];
                          $password = $post["password"];
                          $profile_image = $post["profile_image"];
                        ?>
                        <tr>
                              <td><?php echo $f_name; ?></td>
                              <td><?php echo $l_name; ?></td>
                              <td><?php echo $email?></td>
                              <td><?php echo $password; ?></td>
                              <td>
                                <?php
                                    if ($profile_image) {
                                      echo '<img src="../adminprofileImage/'.$profile_image.'" alt='.$profile_image.' height="50px"width="50px">';
                                    } else {
                                      // code...
                                      echo '<img src="../adminprofileImage/profile.png" alt=""height="50px"width="50px">';
                                    }
                                 ?>
                              </td>
                            <td  width="2%"><a class="delete" href="admin.php?delete=<?php echo $post["id"]; ?>">Delete</a></td>
                        </tr>
                        <?php
                        }
                      ?>
                     </tbody>
                   </table>
               </div> <!-- /.col -->
              </div>  <!--col-md-12 -->
            </div>  <!--col-md-12 -->
          </div>   <!--container-->
        </section>
      </div>      <!-- content wrapper -->
    </div> <!-- contecnt wrapper -->

    <?php include '../includes/footer.php'; ?>

  </body>

</html>

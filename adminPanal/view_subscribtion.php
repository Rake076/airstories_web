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
                  <h1 class="m-0 mb-3 text-dark text-muted text-lg"> Subsribtion Requests  </h1>
                   <span class="text-muted text-sm">Total users :</span> <kbd class="bg-success rounded-circle"><?php  $obj->count_data('subscribtion'); ?></kbd>
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Home</li>
                    <li class="breadcrumb-item active">Users</li>
                  </ol>
                </div><!-- /.col -->
              </div><!-- /.row -->
              <div class="row">
                <div class="col-sm-4 offset-4">
                  <?php
                    // delete code
                     if (isset($_GET['delete'])) {
                       $id = $_GET['delete'];
                         $result = $obj->delete($id, 'subscribtion');
                       if ($result) {
                         echo '
                         <div class="alert alert-success  alert-dismissible">
                           <button type="button" class="close" data-dismiss="alert">&times;</button>
                          <strong> Data Deleted Successfully ! </strong>
                        </div>
                        ';
                        header('Refresh:0,url=view_subscribtion.php');
                       } else {
                         echo '
                          <div class="alert alert-danger  alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                           <strong> Sorry Data Not Deleted Try Again ! </strong>
                         </div>
                         ';
                        header('Refresh:0,url=view_subscribtion.php');
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
                <table class="table table-bordered table-hover"id="sampleTable" >
                  <thead>
                    <tr>
                      <th> Email  </th>
                        <th>Requested On </th>
                       <th>   </th>
                   </tr>
                </thead>
                  <?php
                     $post_data = $obj->select('subscribtion');
                        foreach($post_data as $post){
                          $id = $post["id"];
                           $email = $post["sub_email"];
                           $created_at = $post["created_at"];
                        ?>
                        <tr>
                            <td><?php echo $email; ?></td>
                            <td><?php echo date('y/m/Y h:i A',strtotime($created_at)); ?></td>
                            <td  width="2%"><a class="delete" href="view_subscribtion.php?delete=<?php echo $id ?>">Delete</a></td>
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

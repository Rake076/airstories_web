<?php
session_start();
ob_start();
  include '../db.php';
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
                  <h1 class="m-0 text-dark text-muted text-lg">Create Stories </h1>

                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Home</li>
                  </ol>
                </div><!-- /.col -->
              </div><!-- /.row -->
              <a href="create_story.php"class="btn btn-warning btn-sm text-sm">Create New Stories</a>
              <hr>
            </div><!-- /.container-fluid -->
          </div>
          <!-- /.content-header -->

              <!-- Main content -->
          <section class="content">
            <div class="row">
               <div class="col-md-12"> <!-- /.col -->
                 <?php
                   // delete code
                    if (isset($_GET['delete'])) {
                      $id = $_GET['delete'];
                        $result = $obj->delete($id, 'website_info');
                      if ($result) {
                        echo '
                        <div class="alert alert-success  alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert">&times;</button>
                         <strong> Data Deleted Successfully ! </strong>
                       </div>
                       ';
                       header('location:web_info.php');
                      } else {
                        echo '
                         <div class="alert alert-danger  alert-dismissible">
                           <button type="button" class="close" data-dismiss="alert">&times;</button>
                          <strong> Sorry Data Not Deleted Try Again ! </strong>
                        </div>
                        ';
                       header('Refresh:1,url=web_info.php');
                      }

                    }
                  ?>
                 <table class="table table-hover  table-responsive table-sm text-muted"id="sampleTable" >
                   <thead>
                     <tr>
                       <th> Email </th>
                        <th> phone1 </th>
                         <th> Phone2 </th>
                         <th>  Description </th>
                         <th>  Facebook </th>
                         <th> Twitter  </th>
                         <th> LinkedIn  </th>
                        <th>  Website Link </th>
                        <th>   </th>
                        <th>   </th>
                     </tr>
                    </thead>
                     <tbody>
                       <?php
                        $query="select * from website_info";
                         $r = mysqli_query($connection,$query);
                          $count_story = mysqli_num_rows($r);
                          if ($count_story>0) {
                            while ($row=mysqli_fetch_assoc($r)) {
                              $id = $row["id"];
                               $email = $row["email"];
                               $phone1 = $row["phone1"];
                               $phone2 = $row["phone2"];
                               $description = $row["description"];
                               $fb = $row["fb"];
                               $tw = $row["tw"];
                               $linkedin = $row["linkedin"];
                               $website_link = $row["website_link"];
                             ?>
                         <tr>
                              <td> <?php echo $email  ?></td>
                              <td><?php echo $phone1  ?></td>
                              <td><?php echo $phone2  ?></td>
                              <td><?php echo $description  ?></td>
                              <td><?php echo $tw  ?></td>
                              <td><?php echo $fb  ?></td>
                              <td><?php echo $linkedin  ?></td>
                              <td><?php echo $website_link  ?></td>

                              <td> <a class="delete" href="web_info.php?delete=<?php echo $id  ?>">Delete</a> </td>
                              <td> <a href="update_web_info.php?edit=<?php echo $id  ?>">Edit</a> </td>
                         </tr>
                       <?php } } ?>
                    </tbody>
                 </table>
               </div> <!-- /.col -->
            </div>  <!--table 1st row end -->
          </div>      <!-- container-fluid -->
          </section>
      </div> <!-- contecnt wrapper -->

    <?php include '../includes/footer.php'; ?>

  </body>

</html>

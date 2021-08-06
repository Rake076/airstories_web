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
                  <h1 class="m-0 text-dark text-lg">Short Stories </h1>
                  <span class="text-muted text-sm" > Total Stories :</span> <kbd class="bg-success rounded-circle"><?php  $obj->short_story('stories'); ?></kbd>

                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Home</li>
                    <li class="breadcrumb-item active">Short Stories</li>
                  </ol>
                </div><!-- /.col -->
              </div><!-- /.row -->
              <hr>
            </div><!-- /.container-fluid -->
          </div>
          <!-- /.content-header -->

              <!-- Main content -->
          <section class="content">
           <div class="container-fluid">
            <div class="row">
               <div class="col-md-12"> <!-- /.col -->
                <?php
                  // delete code
                   if (isset($_GET['delete'])) {
                     $id = $_GET['delete'];
                       $result = $obj->delete($id, 'stories');
                     if ($result) {
                       echo '
                       <div class="alert alert-success  alert-dismissible">
                         <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong> Data Deleted Successfully ! </strong>
                      </div>
                      ';
                      header('location:short_story.php');
                     } else {
                       echo '
                        <div class="alert alert-danger  alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert">&times;</button>
                         <strong> Sorry Data Not Deleted Try Again ! </strong>
                       </div>
                       ';
                      header('Refresh:1,url=short_story.php');
                     }

                   }
                 ?>
                <table class="table table-bordered table-hover  table-responsive table-sm"id="sampleTable" >
                  <thead>
                    <tr>
                      <th> Tittle </th>
                       <th> Type  </th>
                        <th> Status </th>
                        <th>  Description </th>
                        <th>  Author </th>
                        <th> Cover Photo  </th>
                        <th>   </th>
                       <th>   </th>
                    </tr>
                   </thead>
                    <tbody>
                      <?php
                      $s = "select * from stories where b_status='short_story' ";
                        $r = mysqli_query($connection,$s);
                         $count_story = mysqli_num_rows($r);
                                while ($row=mysqli_fetch_assoc($r)) {
                                  $id = $row["id"];
                                   $b_tittle = $row["b_tittle"];
                                   $b_type = $row["b_type"];
                                   $b_description = $row["b_description"];
                                   $cover_photo = $row["cover_photo"];
                                   $b_author = $row["b_author"];
                                   $b_status = $row["b_status"];
                                   $status = $row["status"];
                            ?>
                        <tr>
                             <td> <a class="text-capitalize font-weight-bold text-success" href="story_details.php?story_details=<?php echo $id  ?>"><?php echo $b_tittle  ?></a> </td>
                             <td><?php echo $b_type  ?></td>
                             <td><?php echo $b_status  ?></td>
                             <td><?php echo $b_description  ?></td>
                             <td><?php echo $b_author  ?></td>
                             <td>
                              <img src='../coverphotos/<?php echo $cover_photo; ?>' alt="<?php echo $cover_photo; ?>"height="50px"width="50px">
                             </td>
                             <?php
                              if ($status == 1) {
                                echo "<td><a class='badge badge-danger'> Un-Published  </a> </td>";
                                }else {
                                 echo "<td><a class='badge badge-success'> Published  </a> </td>";
                               }
                             ?>
                             <td> <a class="delete" href="short_story.php?delete=<?php echo $id  ?>">Delete</a> </td>
                        </tr>
                      <?php } ?>
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

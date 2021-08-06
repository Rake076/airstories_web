<?php
session_start();
ob_start();
  include '../db.php';
       ?>

<!DOCTYPE html>
<html>
<head>
     <?php include 'includes/head.php'; ?>
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
        <?php include 'includes/header.php'; ?>
          <!-- /.navbar -->

       <!-- Main Sidebar start -->
         <?php include 'includes/sidebar.php'; ?>
            <!-- Main Sidebar end -->

      <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <div class="content-header">
            <div class="container-fluid m1">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1 class="m-0 text-dark">Create Stories </h1>

                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Home</li>
                  </ol>
                </div><!-- /.col -->
              </div><!-- /.row -->
              <a href="create_story.php"class="btn btn-warning btn-sm">Create New Stories</a>
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
                       $result = $obj->delete($id, 'stories');
                     if ($result) {
                       echo '
                       <div class="alert alert-success  alert-dismissible">
                         <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong> Data Deleted Successfully ! </strong>
                      </div>
                      ';
                      header('Location:view_stories.php');
                     } else {
                       echo '
                        <div class="alert alert-danger  alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert">&times;</button>
                         <strong> Sorry Data Not Deleted Try Again ! </strong>
                       </div>
                       ';
                      header('Refresh:0,url=view_stories.php');
                     }

                   }
                 ?>
                 <?php
                  // changing status to 0 to publish story
                  if(isset($_GET['story_status1'])){
                   $id=$_GET['story_status1'];
                   $status=$_GET['story_status1'];
                   $query="UPDATE stories set status='0' WHERE id='$id'";
                   $service=mysqli_query($connection,$query);
                   if ($service) {
                    header("Location:view_stories.php");
                  }
                 }
                ?>
                <?php
                // changing status to 1 to publish story
                 if(isset($_GET['story_status2'])){
                  $id=$_GET['story_status2'];
                  $status=$_GET['story_status2'];
                  $query="UPDATE stories set status='1' WHERE id='$id'";
                  $service=mysqli_query($connection,$query);
                  if ($service) {
                   header("Location:view_stories.php");
                  }
                 }
               ?>
                <table class="table table-hover  table-responsive table-sm"id="sampleTable" >
                  <thead>
                    <tr>
                      <th> Tittle </th>
                       <th> Genre  </th>
                        <th> Type </th>
                        <th>  Description </th>
                        <th>  Author </th>
                        <th> Cover Photo  </th>
                        <th>   </th>
                       <th>   </th>
                       <th>   </th>
                    </tr>
                   </thead>
                    <tbody>
                      <?php
                      $u_email = $_SESSION['u_email'];
                       $u_password = $_SESSION['u_password'];
                       $query="select * from stories where user_id='$id' and role='user'";
                        $r = mysqli_query($connection,$query);
                         $count_story = mysqli_num_rows($r);
                         if ($count_story>0) {
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
                             <td><?php echo substr($b_description,0,30);  ?>...</td>
                             <td><?php echo $b_author  ?></td>
                             <td>
                               <img  src="../coverphotos/<?php echo $cover_photo; ?>" height="50px"width="50px">
                             </td>
                             <?php
                              if ($status == 1) {
                                echo "<td><a class='badge badge-danger publish text-danger' href='view_stories.php?story_status1=$id'> Un-Published  </a> </td>";
                                }else {
                                 echo "<td><a class='badge badge-success unpublish text-primary' href='view_stories.php?story_status2=$id'> Published  </a> </td>";
                               }
                             ?>
<!--                              <td> <a class="text-success" href="add_chapters.php?add_chapters=<?php echo $id  ?>">New Chapters</a> </td> -->
                             <?php
                              if ($b_status=='completed_story') {
                                echo "<td><a class='badge badge-danger publish text-success' href='add_chapters.php?add_chapters=$id'> Add Chapter  </a> </td>";
                                }elseif($b_status=='short_story') {
                                 echo "<td><a class='badge badge-danger text-info' >  </a> </td>";
                               }
                             ?>


                             <td> <a class="delete text-danger" href="view_stories.php?delete=<?php echo $id  ?>">Delete</a> </td>
                             <td> <a class="text-warning" href="update_stories.php?edit=<?php echo $id  ?>">Edit</a> </td>
                        </tr>
                      <?php  } } ?>
                   </tbody>
                </table>
               </div> <!-- /.col -->
            </div>  <!--table 1st row end -->
          </div>      <!-- container-fluid -->
          </section>
      </div> <!-- contecnt wrapper -->

    <?php include 'includes/footer.php'; ?>

  </body>

</html>

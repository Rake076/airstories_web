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
                  <h1 class="m-0 text-dark heading text-muted text-lg"> Reading Stories  </h1>
                  <span class="text-muted text-sm">Total Reading List</span>: <kbd class="bg-success rounded-circle">
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
                    <?php
                        $sql = "SELECT count(*) FROM readinglist where user_id='$admin_id'";
                          $result =mysqli_query($connection,$sql);
                            while($row =mysqli_fetch_assoc($result)){
                            $presents= $row['count(*)'];
                         echo $presents;
                        }

                     ?>
                  </kbd>
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Home</li>
                    <li class="breadcrumb-item active">Reading List </li>
                  </ol>
                </div><!-- /.col -->
              </div><!-- /.row -->
              <a href="create_story.php"class="btn btn-danger btn-sm">Create New Stoires </a>
              <a href="all_stories.php"class="btn btn-warning btn-sm">View All Stories </a>
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
                       $result ="DELETE from readinglist where id='$id'";
                        $delete_query=mysqli_query($connection,$result);
                     if ($delete_query){
                       echo '
                       <div class="alert alert-success  alert-dismissible">
                         <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong> Data Deleted Successfully ! </strong>
                      </div>
                      ';
                      header('Refresh:0,url=reading_list.php');
                     } else {
                       echo '
                        <div class="alert alert-danger  alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert">&times;</button>
                         <strong> Sorry Data Not Deleted Try Again ! </strong>
                       </div>
                       ';
                      header('Refresh:0,url=reading_list.php');
                     }

                   }
                 ?>
                <table class="table table-hover table-responsive table-sm text-capitalize"id="sampleTable" >
                  <thead class="text-danger">
                    <tr>
                      <th> Tittle </th>
                       <th> Genre </th>
                        <th> Type </th>
                        <th>  Description </th>
                        <th>  Author </th>
                        <th> Cover Photo  </th>
                       <th> Status  </th>
                       <th>   </th>
                    </tr>
                   </thead>
                    <tbody class="text-sm text-muted">
                    <?php
                      $reading_query = "select * from readinglist where user_id='$admin_id'";
                        $rr = mysqli_query($connection,$reading_query);
                         while ($row=mysqli_fetch_assoc($rr)) {
                            $primaryid = $row["id"]; // reading table id to delete record 
                            $story_id = $row["story_id"]; // story id from reading table then used it to stories table to get all detail of story
                             
                        // getting data from stories table
                        $s = "select * from stories where id='$story_id'";
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
                             <td> <a href="view_one_story.php?read_story=<?php echo $id; ?>" class=" text-capitalizek text-success "> <?php echo $b_tittle; ?></a> </td>
                             <td><?php echo $b_type  ?></td>
                             <td><?php echo $b_status  ?></td>
                             <td><?php echo substr($b_description,0,65).'...';  ?></td>
                             <td><?php echo $b_author  ?></td>
                             <td>
                              <img class="zoom" src='../coverphotos/<?php echo $cover_photo; ?>' alt="<?php echo $cover_photo; ?>"height="50px"width="50px">
                             </td>
                             <?php
                              if ($status == 1) {
                                echo "<td><a class='badge badge-danger'> Un-Published  </a> </td>";
                                }else {
                                 echo "<td><a class='badge badge-success'> Published  </a> </td>";
                               }
                             ?>
                       <td> <a class="delete" href="reading_list.php?delete=<?php echo $primaryid  ?>">Delete</a> </td>
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

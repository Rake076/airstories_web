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
                  <h1 class="m-0 mb-3 text-dark text-lg"> Users  </h1>
                  <span class="text-muted text-sm" > Total Users :</span> <kbd class="bg-success rounded-circle"><?php  $obj->count_data('users'); ?></kbd>
                   <?php
                    // getting current user id
                    $email = $_SESSION['email'];
                     $password = $_SESSION['password'];
                      if($_SESSION["email"] && $_SESSION["password"]==true ){
                           $query = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
                           $results = mysqli_query($connection, $query);
                           if (mysqli_num_rows($results) == 1) {
                               while ($row=mysqli_fetch_assoc($results)) {
                                    $sid =$row['id'];
                             }
                          }
                       }
                    ?>
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
                         $result = $obj->delete($id, 'users');
                       if ($result) {
                         echo '
                         <div class="alert alert-success  alert-dismissible">
                           <button type="button" class="close" data-dismiss="alert">&times;</button>
                          <strong> Data Deleted Successfully ! </strong>
                        </div>
                        ';
                        header('Refresh:0,url=view_users.php');
                       } else {
                         echo '
                          <div class="alert alert-danger  alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                           <strong> Sorry Data Not Deleted Try Again ! </strong>
                         </div>
                         ';
                        header('Refresh:0,url=view_users.php');
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
                 <?php
                  // changing status to 0 to publish story
                  if(isset($_GET['notverified'])){
                   $id=$_GET['notverified'];
                   $query="UPDATE users set status='verified' WHERE id='$id'";
                   $service=mysqli_query($connection,$query);
                   if ($service) {
                   echo '
                   <div class="alert alert-success  alert-dismissible">
                     <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong> Story Published Successfully </strong>
                  </div>
                  ';
                  header("Location:view_users.php");
                  }
                }
                ?>
                <?php
                // changing status to 1 to publish story
                 if(isset($_GET['verified'])){
                  $id=$_GET['verified'];
                  $query="UPDATE users set status='notverified' WHERE id='$id'";
                  $service=mysqli_query($connection,$query);
                  if ($service) {
                  echo '
                  <div class="alert alert-warning  alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                   <strong> Story Un-Published Successfully </strong>
                 </div>
                 ';
                 header("Location:view_users.php");
                 }
                 }
               ?>
                <table class="table table-bordered table-hover table-responsive"id="sampleTable" >
                  <thead>
                    <tr>
                      <th>Frist Name </th>
                        <th>Last Name </th>
                        <th> u_email </th>
                        <th>  u_password </th>
                        <th> Status </th>
                        <th> Code </th>
                       <th>   </th>
                   </tr>
                </thead>
                  <?php
                     $post_data = $obj->select('users');
                        foreach($post_data as $post){
                          $id = $post["id"];
                           $frist_name = $post["frist_name"];
                           $last_name = $post["last_name"];
                           $u_email = $post["u_email"];
                          $u_password = $post["u_password"];
                          $status= $post["status"];
                          $code= $post["code"];
                        ?>
                        <tr>
                            <td><?php echo $frist_name; ?></td>
                              <td><?php echo $last_name; ?></td>
                              <td><?php echo $u_email?></td>
                              <td><?php echo $u_password; ?></td>
                              <?php
                               if ($status== 'notverified') {
                                 echo "<td> <a class='badge badge-danger text-danger' href='view_users.php?notverified=$id'> $status  </a> </td>";
                                 }else {
                                  echo "<td> <a class='badge badge-success text-primary' href='view_users.php?verified=$id'>  $status </a> </td>";
                                }
                              ?>
                              <td><?php echo $code ?></td>
                            <td  width="2%"><a class="delete" href="view_users.php?delete=<?php echo $post["id"]; ?>">Delete</a></td>
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

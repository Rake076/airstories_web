<?php
session_start();
ob_start();
  include '../db.php';
       ?>
<!DOCTYPE html>
<html>
<head>
     <?php include 'includes/head.php'; ?>
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
                  <h1 class="m-0"> Recommended Stories </h1>
                  <?php
                  // getting current user id
                  $u_email = $_SESSION['u_email'];
                   $u_password = $_SESSION['u_password'];
                    if($_SESSION["u_email"] && $_SESSION["u_password"]==true ){
                         $query = "SELECT * FROM users WHERE u_email='$u_email' AND u_password='$u_password'";
                         $results = mysqli_query($connection, $query);
                         if (mysqli_num_rows($results) == 1) {
                             while ($row=mysqli_fetch_assoc($results)) {
                                  $userid =$row['id'];
                            }
                          }
                        }
                   ?>
                  <span class="text-muted">Total Recommendations :</span> <kbd class="bg-success rounded-circle"><?php
                          $sql = "SELECT count(*) FROM story_recommendations where uid='$userid'";
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
                    <li class="breadcrumb-item active"> Recommended Stories </li>
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
               <div class="col-md-12">
                 <?php
                   // changing status to 0 to after clicking on stories because now story is being viewed by user
                    if(isset($_GET['change_status_read'])){
                      $uid=$_GET['change_status_read'];
                        $query="UPDATE story_recommendations set status='0' WHERE uid='$uid'";
                         $service=mysqli_query($connection,$query);
                         if ($service) {
                        header("Location:view_recommended_stories.php");
                       }
                     }
                  ?>
                 <table class="table table-bordered table-hover "id="sampleTable" >
                   <thead>
                     <tr>
                         <th>Sender Name  </th>
                         <th> Story Title </th>
                         <th>   </th>
                    </tr>
                 </thead>
                 <tbody class="text-capitalize text-muted">
                   <?php
                     $sql3 = "SELECT * FROM story_recommendations where uid='$userid' and status='0'";
                        $result3 =mysqli_query($connection,$sql3);
                          while($row =mysqli_fetch_assoc($result3)){
                          $sid= $row['sid'];
                          $bid= $row['bid'];
                          $uid= $row['uid'];
                         ?>
                         <tr>
                          <td><?php
                           $sql1 = "SELECT * FROM users where id=$sid";
                            $result1 =mysqli_query($connection,$sql1);
                              while($row =mysqli_fetch_assoc($result1)){
                             echo   $frist_name= $row['frist_name'];
                             echo " ";
                             echo  $last_name= $row['last_name'];
                               $u_email= $row['u_email'];
                            }
                            ?></td>
                            <td><?php
                               $sql2 = "SELECT * FROM stories where id=$bid";
                                $result2 =mysqli_query($connection,$sql2);
                                  while($row =mysqli_fetch_assoc($result2)){
                                 echo   $b_tittle= $row['b_tittle'];
                                  $b_author= $row['b_author'];
                                }
                             ?></td>
                            <td> <a href="view_one_story.php?read_story=<?php echo $bid; ?>"class="btn btn-sm btn-danger">  <span class="unlike fa fa-eye data-id="></span> Read</a> </td>
                         </tr>
                         <?php
                         }
                       ?>
                      </tbody>
                    </table>
               </div>
            </div>  <!--table 1st row end -->
          </div>      <!-- container-fluid -->
          </section>
      </div> <!-- contecnt wrapper -->

    <?php include 'includes/footer.php'; ?>

  </body>
</html>

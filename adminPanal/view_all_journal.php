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
                  <h1 class="m-0"> Journals </h1>
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
                  <span class="text-muted">Total Journal :</span> <kbd class="bg-success rounded-circle"><?php
                          $sql = "SELECT count(*) FROM journals";
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
                    <li class="breadcrumb-item active">All Journals </li>
                  </ol>
                </div><!-- /.col -->
              </div><!-- /.row -->
              <hr>
              <a href="create_journal.php"class="btn btn-danger btn-outline-success">Create New</a>
              <a href="view_journal.php"class="btn btn-warning btn-outline-danger">View Your journals</a>
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
                   // delete code
                    if (isset($_GET['delete'])) {
                      $id = $_GET['delete'];
                        $query="DELETE FROM journals WHERE id=$id";
                         $result = mysqli_query($connection,$query);
                      if ($result) {
                        echo '
                        <div class="alert alert-success  alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert">&times;</button>
                         <strong> Data Deleted Successfully ! </strong>
                       </div>
                       ';
                       header('Refresh:0,url=view_journal.php');
                      } else {
                        echo '
                         <div class="alert alert-danger  alert-dismissible">
                           <button type="button" class="close" data-dismiss="alert">&times;</button>
                          <strong> Sorry Data Not Deleted Try Again ! </strong>
                        </div>
                        ';
                       header('Refresh:0,url=view_journal.php');
                      }

                    }
                  ?>
                  <?php
                   // changing status to 0 to publish story
                   if(isset($_GET['journal_status1'])){
                    $id=$_GET['journal_status1'];
                    $status=$_GET['story_status1'];
                    $query="UPDATE journals set status='0' WHERE id='$id'";
                    $service=mysqli_query($connection,$query);
                    if ($service) {
                     header("Location:view_journal.php");
                   }
                  }
                  ?>
                  <?php
                  // changing status to 1 to publish story
                  if(isset($_GET['journal_status2'])){
                   $id=$_GET['journal_status2'];
                   $query="UPDATE journals set status='1' WHERE id='$id'";
                   $service=mysqli_query($connection,$query);
                   if ($service) {
                    header("Location:view_journal.php");
                   }
                  }
                  ?>
                  <table class="table  table-hover  table-responsive table-sm"id="sampleTable" >
                    <thead>
                      <tr>
                        <th> Tittle </th>
                        <th>  Date </th>
                         <th> Type  </th>
                          <th>  Description </th>
                          <th>  Author </th>
                          <th> Cover Photo  </th>
                          <th>  </th>
                         <th>   </th>
                      </tr>
                     </thead>
                      <tbody>
                        <?php
                         $query="select * from journals";
                          $r = mysqli_query($connection,$query);
                           $count_story = mysqli_num_rows($r);
                           if ($count_story>0) {
                             while ($row=mysqli_fetch_assoc($r)) {
                               $id = $row["id"];
                                $tittle = $row["tittle"];
                                $type = $row["type"];
                                $detail = $row["detail"];
                                $cover_photo = $row["cover_photo"];
                                $author = $row["author"];
                                $jdate = $row["jdate"];
                                $status = $row["status"];
                         ?>
                          <tr>
                               <td> <a class="text-capitalize font-weight-bold text-success"><?php echo $tittle  ?></a> </td>
                               <td><?php echo $type  ?></td>
                               <td><?php echo $jdate  ?></td>
                               <td><?php echo substr($detail,0,15);  ?>..</td>
                               <td><?php echo $author  ?></td>
                               <td>
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
                               </td>
 <!--                               <?php
                                if ($status == 1) {
                                  echo "<td><a class='badge badge-success publish text-warning' href='view_journal.php?journal_status1=$id'> Un-Published  </a> </td>";
                                  }else {
                                   echo "<td><a class='badge badge-success unpublish' href='view_journal.php?journal_status2=$id'> Published  </a> </td>";
                                 }
                               ?> -->
                               <td> <a class="readj"data-id="<?php echo $id ?>" href="read_journal.php?read_journal=<?php echo $id  ?>">Read</a> </td>
                               <td> <a class="delete" href="view_journal.php?delete=<?php echo $id  ?>">Delete</a> </td>
                          </tr>
                        <?php  } } ?>
                     </tbody>
                  </table>
               </div>
            </div>  <!--table 1st row end -->
          </div>      <!-- container-fluid -->
          </section>
      </div> <!-- contecnt wrapper -->

    <?php include '../includes/footer.php'; ?>

  </body>
</html>

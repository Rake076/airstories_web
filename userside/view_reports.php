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
                  <h1 class="m-0 mb-3 text-dark heading text-muted text-lg"> Reports  </h1>
                   <span class="text-muted text-sm">Total Reports</span>: <kbd class="bg-success rounded-circle">
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
                        $sql = "SELECT count(*) FROM reports where reporti='$userid'";
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
                    <li class="breadcrumb-item active">Reports</li>
                  </ol>
                </div><!-- /.col -->
              </div><!-- /.row -->
              <div class="row">
                <div class="col-sm-4 offset-4">
                  <?php
                    // delete code
                     if (isset($_GET['delete'])) {
                       $id = $_GET['delete'];
                         $result = $obj->delete($id, 'reports');
                       if ($result) {
                         echo '
                         <div class="alert alert-success  alert-dismissible">
                           <button type="button" class="close" data-dismiss="alert">&times;</button>
                          <strong> Data Deleted Successfully ! </strong>
                        </div>
                        ';
                        header('Refresh:0,url=view_reports.php');
                       } else {
                         echo '
                          <div class="alert alert-danger  alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                           <strong> Sorry Data Not Deleted Try Again ! </strong>
                         </div>
                         ';
                        header('Refresh:0,url=view_reports.php');
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
                <table class="table table-bordered table-hover text-muted text-sm"id="sampleTable" >
                  <thead>
                    <tr>
                      <!-- <th> Book ID </th> -->
                       <th> Reporti ID </th>
                        <th> Story Name  </th>
                        <th> Atuhor  </th>
                        <th>  Report Reason </th>
                      <th>   </th>
                    </tr>
                   </thead>
                    <tbody class="text-capitalize">
                      <?php
                         $sql = "SELECT * FROM reports where reporti='$userid'";
                           $result =mysqli_query($connection,$sql);
                              while($row =mysqli_fetch_assoc($result)){
                                 $id = $row["id"];
                                  $book_id = $row["book_id"];
                                $reporti = $row["reporti"];
                              $report_reason = $row["report_reason"];
                           ?>
                       <!--    <?php
                            $s = 'select * from stories where id='.$book_id.'';
                              $r = mysqli_query($connection,$s);
                               while ($row=mysqli_fetch_assoc($r)) {
                                 $story_id = $row['id'];
                                 $b_tittle = $row['b_tittle'];
                                 $b_author = $row['b_author'];
                                 $cover_photo = $row['cover_photo'];
                               }
                           ?> -->

                           <?php
                             $sss = 'select * from users where id='.$reporti.'';
                               $rrr = mysqli_query($connection,$sss);
                                while ($row=mysqli_fetch_assoc($rrr)) {
                                  $reporti = $row['id'];
                                  $frist_name = $row["frist_name"];
                                  $last_name = $row["last_name"];

                              }
                           ?>

                        <tr>
                             <!-- <td> <a class="text-capitalize font-weight-bold text-success" href="story_details.php?story_details=<?php echo $story_id  ?>"><?php echo $book_id  ?></a> </td> -->
                             <td> <a class="" href="#">
                              <?php echo $frist_name.' '.$last_name;  ?></a> </td>
                             <td><?php echo $b_tittle  ?></td>
                             <td><?php echo $b_author  ?></td>
                             <td><?php echo $report_reason  ?></td>
                             <td> <a class="delete" href="view_reports.php?delete=<?php echo $id  ?>">Delete</a> </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                 </table>
               </div> <!-- /.col -->
              </div>  <!--col-md-12 -->
            </div>  <!--col-md-12 -->
          </div>   <!--container-->
        </section>
      </div>      <!-- content wrapper -->
    </div> <!-- contecnt wrapper -->

    <?php include 'includes/footer.php'; ?>

  </body>

</html>

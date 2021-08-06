<?php
session_start();
    ob_start();
      date_default_timezone_set("Asia/Karachi");
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
                  <h1 class="m-0 mb-3"> Comments  </h1>
                  <span class="text-muted text-sm">Total Comments : </span>  <kbd class="bg-success rounded-circle"><?php  $obj->count_data('comments'); ?></kbd>
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Home</li>
                    <li class="breadcrumb-item active">Comments</li>
                  </ol>
                </div><!-- /.col -->
              </div><!-- /.row -->
              <div class="row">
                <div class="col-sm-4 offset-4">
                  <?php
                    // delete code
                     if (isset($_GET['delete'])) {
                       $id = $_GET['delete'];
                         $result = $obj->delete($id, 'comments');
                       if ($result) {
                         echo '
                         <div class="alert alert-success  alert-dismissible">
                           <button type="button" class="close" data-dismiss="alert">&times;</button>
                          <strong> Data Deleted Successfully ! </strong>
                        </div>
                        ';
                        header('Refresh:0,url=view_comments.php');
                       } else {
                         echo '
                          <div class="alert alert-danger  alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                           <strong> Sorry Data Not Deleted Try Again ! </strong>
                         </div>
                         ';
                        header('Refresh:0,url=view_comments.php');
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
            <div class="container-fluid">
              <div class="row">
               <div class="col-md-12"> <!-- /.col -->
                <table class="table table-bordered table-hover table-responsive"id="sampleTable" >
                  <thead>
                    <tr>
                      <!-- <th> Book ID </th>
                       <th> Commenti ID </th> -->
                       <th> Commenti Name </th>
                        <th> Story Name  </th>
                        <th> Atuhor  </th>
                        <th>  Comment </th>
                        <th>  Create_at </th>
                    </tr>
                   </thead>
                    <tbody class="text-capitalize">
                      <?php
                         $post_data = $obj->select('comments');
                            foreach($post_data as $post){
                              $id = $post["id"];
                               $book_id = $post["book_id"];
                               $commenti_id = $post["commenti_id"];
                               $comment = $post["comment"];
                               $created_at = $post["created_at"];
                            ?>
                            <?php
                            $s = 'select * from stories where id='.$book_id.'';
                              $r = mysqli_query($connection,$s);
                               while ($row=mysqli_fetch_assoc($r)) {
                                 $story_id = $row['id'];
                                 $b_tittle = $row['b_tittle'];
                                 $b_author = $row['b_author'];
                                 $cover_photo = $row['cover_photo'];
                               }
                             ?>
                           <?php
                            $sss = 'select * from users where id='.$commenti_id.'';
                               $rrr = mysqli_query($connection,$sss);
                                while ($row=mysqli_fetch_assoc($rrr)) {
                                  $commenti_id = $row['id'];
                                  $frist_name = $row["frist_name"];
                                  $last_name = $row["last_name"];
                                  $u_profile_image = $row["u_profile_image"];
                              }
                           ?>
                        <tr>
                             <!-- <td> <a class="text-capitalize font-weight-bold text-success" href="story_details.php?story_details=<?php echo $story_id  ?>"><?php echo $book_id  ?></a> </td>
                             <td> <a class="text-capitalize font-weight-bold text-success" href="#"><?php echo $commenti_id;  ?></a> </td> -->
                             <td><?php echo $frist_name.' '.$last_name  ?></td>
                             <td><?php echo $b_tittle  ?></td>
                             <td><?php echo $b_author  ?></td>
                             <td><?php echo $comment  ?></td>
                             <td><?php echo date('d-m-y h:i A',strtotime($created_at)) ?></td>
                             <!-- <td> <a class="delete" href="view_comments.php?delete=<?php echo $id  ?>">Delete</a> </td> -->
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

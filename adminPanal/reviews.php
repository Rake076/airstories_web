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
                  <h1 class="m-0 text-dark text-muted text-lg"> Reviews </h1>
                  <span class="text-muted text-sm">Total Reviews : </span> <kbd class="bg-success rounded-circle">
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
                       // $sql = "SELECT count(*) FROM reviews where reviewi_id='$admin_id'";
                       $sql = "SELECT count(*) FROM reviews ";
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
                    <li class="breadcrumb-item active">Reviews</li>
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
               <div class="col-md-8 offset-2 mb-2">
                 <?php require('create_reviews_code.php') ?>
               </div>
             </div>
            <div class="row">
             <div class="col-md-12 text-muted text-sm"> <!-- /.col -->
               <form method="post"enctype='multipart/form-data'>
                 <div class="form-row">
                 <div class="form-group col-md-4">
                   <label for="inputAddress">Choose Story</label>
                     <select id="inputState" class="form-control form-control-sm"name="book_id">
                    <?php
                       $sql = "SELECT * FROM stories where user_id = $id";
                         $result =mysqli_query($connection,$sql);
                          $count = mysqli_num_rows($result);
                           if ($count>0) {
                           while($row =mysqli_fetch_assoc($result)){
                            $id = $row["id"];
                          $b_tittle = $row["b_tittle"];
                        ?>
                       <option class="text-capitalize" value="<?php echo $id ?>"><?php echo $b_tittle ?></option>
                     <?php
                         }
                        }else {
                          ?>
                          <option disabled> No Story Found </option>
                          <?php
                        }
                       ?>
                     </select>
                   </div>
                   <div class="form-group col-md-8">
                     <label for="inputAddress">Description</label>
                     <textarea id="txtTest" runat="server"name="review"placeholder="write here..."><?php echo $review ?></textarea>
                     <script>
                         $(function () {
                             // Set up your summernote instance
                             $("#txtTest").summernote();
                             // When the summernote instance loses focus, update the content of your <textarea>
                             $("#txtTest").on('summernote.blur', function () {
                                 $('#txtTest').html($('#txtTest').summernote('code'));
                             });
                         });
                     </script>
                   </div>
                 </div>
                 <div class="row">
                   <div class="col-md-2 offset-5">
                     <button type="submit"name="save_reviews" class="btn btn-success btn-block btn-sm m-2 float-right">Save</button>
                   </form>
                   </div>
                 </div>
                 </div>

              </div> <!-- /.col -->
              <hr class="hr">
            </div> <!--1srt form row /.col -->

            <div class="row">
               <div class="col-md-12"> <!-- /.col -->
                <?php
                  // delete code
                   if (isset($_GET['delete'])) {
                     $id = $_GET['delete'];
                       $result = $obj->delete($id, 'reviews');
                     if ($result) {
                       echo '
                       <div class="alert alert-success  alert-dismissible">
                         <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong> Data Deleted Successfully ! </strong>
                      </div>
                      ';
                      header('Refresh:0,url=reviews.php');
                     } else {
                       echo '
                        <div class="alert alert-danger  alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert">&times;</button>
                         <strong> Sorry Data Not Deleted Try Again ! </strong>
                       </div>
                       ';
                       header('Refresh:0,url=reviews.php');
                     }

                   }
                 ?>
                <table class="table table-hover table-sm text-muted text-sm"id="sampleTable" >
                  <thead>
                    <tr>
                      <th> Story </th>
                        <th>  Reviews Details </th>
                        <th>   </th>
                       <th>   </th>
                    </tr>
                   </thead>
                    <tbody>
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
                               // $sql = "SELECT * FROM reviews where reviewi_id='$admin_id'";
                               $sql = "SELECT * FROM reviews";
                                $result =mysqli_query($connection,$sql);
                                  while($row =mysqli_fetch_assoc($result)){
                                     $id = $row["id"];
                                     $book_id = $row["book_id"];
                                   $review = $row["review"];
                                 $created_at = $row["created_at"];

                             ?>
                            <?php
                            $s = 'select * from stories where id='.$book_id.'';
                              $r = mysqli_query($connection,$s);
                               while ($row=mysqli_fetch_assoc($r)) {
                                 $rid = $row['id'];
                                 $b_tittle = $row['b_tittle'];
                                 $b_author = $row['b_author'];
                                 $cover_photo = $row['cover_photo'];
                               }
                             ?>
                        <tr>
                             <td> <a class="text-capitalize font-weight-bold text-success" href="story_details.php?story_details=<?php echo $rid  ?>"><?php echo $b_tittle  ?></a> </td>
                             <td><?php echo $review  ?></td>
                             <td> <a class="delete" href="reviews.php?delete=<?php echo $id  ?>">Delete</a> </td>
                             <td> <a href="update_reviews.php?edit=<?php echo $id  ?>">Edit</a> </td>
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

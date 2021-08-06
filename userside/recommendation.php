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
                  <?php
                   // getting current user id
                   $u_email = $_SESSION['u_email'];
                    $u_password = $_SESSION['u_password'];
                     if($_SESSION["u_email"] && $_SESSION["u_password"]==true ){
                        $query = "SELECT * FROM users WHERE u_email='$u_email' AND u_password='$u_password'";
                          $results = mysqli_query($connection, $query);
                          if (mysqli_num_rows($results) == 1) {
                              while ($row=mysqli_fetch_assoc($results)) {
                                   $sid =$row['id'];
                            }
                         }
                      }
                   ?>
                  <h1 class="m-0 mb-3 text-dark"> Story Recommendations </h1>
                    Availble Users : <kbd class="bg-success rounded-circle"><?php
                   $query = "SELECT * FROM users Except SELECT * FROM users WHERE id =$sid";
                     $results = mysqli_query($connection, $query);
                      $count = mysqli_num_rows($results);
                      echo $count;

                     ?></kbd>

                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Home</li>
                    <li class="breadcrumb-item active">Story Recommendations</li>
                  </ol>
                </div><!-- /.col -->
              </div><!-- /.row -->
              <div class="row">
                <div class="col-sm-4 offset-4">
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
                <div class="col-md-6 offset-3">
                  <?php include 'story_recommendations_code.php'; ?>
                </div>
              </div>
              <div class="row">
               <div class="col-md-12"> <!-- /.col -->
               <form class="" method="post">
                 <?php
                  // getting current user id
                  $u_email = $_SESSION['u_email'];
                   $u_password = $_SESSION['u_password'];
                    if($_SESSION["u_email"] && $_SESSION["u_password"]==true ){
                       $query = "SELECT * FROM users WHERE u_email='$u_email' AND u_password='$u_password'";
                         $results = mysqli_query($connection, $query);
                         if (mysqli_num_rows($results) == 1) {
                             while ($row=mysqli_fetch_assoc($results)) {
                                  $sid =$row['id'];
                           }
                        }
                     }
                  ?>
                  <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="inputAddress">Choose Story</label>
                      <select id="inputState" class="form-control form-control-sm"name="bid">
                        <?php
                        $post_data = $obj->select('stories');
                           foreach($post_data as $post){
                             $id = $post["id"];
                             $b_tittle = $post["b_tittle"];
                         ?>
                        <option  value="<?php echo $id ?>"><?php echo $b_tittle ?></option>
                      <?php } ?>
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <input type="hidden"class="form-control form-control-sm" name="sid" value="<?php echo $sid ?>">
                    </div>
                  </div>

                <table class="table table-bordered table-hover table-sm"id="sampleTable" >
                  <thead>
                    <tr>
                      <th> <input type="checkbox" onclick="toggle(this);"> </th>
                        <th>User Name </th>
                        <th>  Email </th>
                        <th> Status </th>
                   </tr>
                </thead>
                  <?php

                    $query = "SELECT * FROM users Except SELECT * FROM users WHERE id =$sid";
                      $results = mysqli_query($connection, $query);
                          while ($row=mysqli_fetch_assoc($results)) {
                               $id =$row['id'];
                               $frist_name =$row['frist_name'];
                               $last_name =$row['last_name'];
                               $u_email =$row['u_email'];
                               $status =$row['status'];
                        ?>
                        <tr>
                            <td><input type="checkbox" id="checkItem" name="uid[]" value="<?php echo $id; ?>"></td>
                              <td><?php echo $frist_name .' '.$last_name; ?></td>
                              <td><?php echo $u_email?></td>
                              <?php
                               if ($status== 'verified') {
                                 echo "<td> <a class='badge badge-success '> $status </a> </td>";
                                 }else {
                                  echo "<td> <a class='badge badge-danger'> Not-verified </a> </td>";
                                }
                              ?>
                        </tr>
                        <?php
                        }
                      ?>
                     </tbody>
                   </table>
                   <div class="row mb-2">
                    <div class="col-3">
                      <input type="submit" name="save" value="send"class="btn btn-success btn-sm "/>
                    </div>
                  </div>
                 </form>

               </div> <!-- /.col -->
              </div>  <!--col-md-12 -->
            </div>  <!--col-md-12 -->
          </div>   <!--container-->
        </section>
      </div>      <!-- content wrapper -->
    </div> <!-- contecnt wrapper -->

      <script type="text/javascript">
      function toggle(source) {
          var checkboxes = document.querySelectorAll('input[type="checkbox"]');
          for (var i = 0; i < checkboxes.length; i++) {
             if (checkboxes[i] != source)
                 checkboxes[i].checked = source.checked;
          }
          }
      </script>
    <?php include 'includes/footer.php'; ?>

  </body>

</html>

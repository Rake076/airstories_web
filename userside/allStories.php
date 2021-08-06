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
                  <h1 class="m-0 text-dark heading text-muted text-lg"> All Stories  </h1>
                  <span class="text-muted text-sm">Total Stories</span>: <kbd class="bg-success rounded-circle">
                    <?php
                        $sql = "SELECT count(*) FROM stories";
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
                    <li class="breadcrumb-item active">All Stories </li>
                  </ol>
                </div><!-- /.col -->
              </div><!-- /.row -->
              <a href="create_story.php"class="btn btn-danger btn-sm">Create New Stoires </a>
              <a href="reading_list.php"class="btn btn-warning btn-sm">View Reading List </a>
              <hr>
            </div><!-- /.container-fluid -->
          </div>
          <!-- /.content-header -->

              <!-- Main content -->
          <section class="content">
           <div class="container-fluid">
            <div class="row">
               <div class="col-md-12"> <!-- /.col -->
                <form method="post">
                <table class="table table-hover table-responsive table-sm"id="sampleTable" >
                  <thead class="text-danger">
                    <tr>
                      <th> <input type="checkbox" class="myCheckBox" onclick="toggle(this);"> </th>
                      <th> Title </th>
                       <th> Genre </th>
                        <th> Type </th>
                        <th>  Description </th>
                        <th>  Author </th>
                        <th> Cover Photo  </th>
                       <th> Status  </th>
                    </tr>
                   </thead>
                    <tbody class="text-sm text-muted">
                      <?php
                      $s = "select * from stories";
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
                          
                       <?php
                           if($_SESSION["u_email"] && $_SESSION["u_password"]==true ){
                                $email= $_SESSION['u_email'];
                                $password= $_SESSION['u_password'];
                                $query = "SELECT * FROM users WHERE u_email='$email' AND u_password='$password'";
                                $results = mysqli_query($connection, $query);
                                if (mysqli_num_rows($results) == 1) {
                                    while ($row=mysqli_fetch_assoc($results)) {
                                        $userid =$row['id'];
                                    }
                                 }
                              } 
                            ?>
                          <input type="hidden" class="form-control"value="<?php echo $userid ?>"  name="user_id">
                            <td>
                              <input type="checkbox" id="checkItem" class="myCheckBox" name="story_id[]" value="<?php echo $id; ?>">
                          
                              </td>
                             <td> <a href="view_one_story.php?read_story=<?php echo $id; ?>" class=" text-capitalizek text-success "> <?php echo $b_tittle; ?></a> </td>
                             <td><?php echo $b_type  ?></td>
                             <td><?php echo $b_status  ?></td>
                             <td><?php echo substr($b_description,0,60).'...';  ?></td>
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
                        </tr>
                      <?php } ?>
                   </tbody>
                </table>
                <div class="form-group mb-3">
                  <button type="submit" name="save_multiple_checkbox"id="confirmButton" class="btn btn-danger btn-sm ">Add Reading list</button>
                </div>
              </form>
              <?php 
                 if(isset($_POST['save_multiple_checkbox']))
                   {
                     $user_id = $_POST['user_id'];
                     $story_id = $_POST['story_id'];

                      for($i=0;$i<count($story_id);$i++){
                         $check_value = $story_id[$i];

                        // validating story already exist or not 
                        $user_check_query = "SELECT * FROM readinglist WHERE story_id='$check_value' and user_id='$user_id'";
                        $result = mysqli_query($connection, $user_check_query);
                        $user = mysqli_fetch_assoc($result);
                        $countuser = mysqli_num_rows($result);
                          
                        if($countuser==1) {
                           echo '
                             <script type="text/javascript"> alert("Story Already Exist"); </script>
                              ';
                               exit();
                             } else {
                            $query_run= mysqli_query($connection,"insert into readinglist (story_id,user_id)values ('".$check_value."','".$user_id."')") or die(mysqli_error());
                          }
                        }
                      if($query_run)
                      {
                        echo '
                     <script type="text/javascript"> alert("Story Added to Reading List Successfully"); </script>
                        ';
                      }
                      else
                      {
                      echo '
                     <script type="text/javascript"> alert("Query Failed Try Again ! "); </script>
                        ';  
                      }
                  }
              ?>
            <script type="text/javascript">
              function toggle(source) {
                  var checkboxes = document.querySelectorAll('input[type="checkbox"]');
                  for (var i = 0; i < checkboxes.length; i++) {
                     if (checkboxes[i] != source)
                         checkboxes[i].checked = source.checked;
                    }
                 }
              </script> 

              <script type="text/javascript">
                var checkBoxes = $('table .myCheckBox');
                checkBoxes.change(function () {
                    $('#confirmButton').prop('disabled', checkBoxes.filter(':checked').length < 1);
                });
                $('table .myCheckBox').change();

              </script>

               </div> <!-- /.col -->
            </div>  <!--table 1st row end -->
          </div>      <!-- container-fluid -->
          </section>
      </div> <!-- contecnt wrapper -->

    <?php include 'includes/footer.php'; ?>

  </body>

</html>

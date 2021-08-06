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

  .text-primary{
    font-size: large;
    font-family: fangsong;
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
          <!-- Content Header (Page header) -->
          <div class="content-header">
            <div class="container-fluid m1">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1 class="m-0 text-dark"> </h1>
                  <a href="all_stories.php"class="btn btn-sm btn-outline-warning mt-2 ">All Stories</a>
                  <a href="reading_list.php"class="btn btn-sm btn-outline-info mt-2 ">Reading List</a>
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Home</li>
                    <li class="breadcrumb-item active">All Stories </li>
                  </ol>
                </div><!-- /.col -->
              </div><!-- /.row -->
              <hr>
            </div><!-- /.container-fluid -->
          </div>
          <!-- /.content-header -->
           <?php
             if (isset($_GET['read_story'])) {
                $id = $_GET['read_story'];
                  $s = 'select * from stories where id='.$id.'';
                    $r = mysqli_query($connection,$s);
                    $check_status = mysqli_num_rows($r);
                        $r = mysqli_query($connection,$s);
                          $check_status = mysqli_num_rows($r);
                           while ($row=mysqli_fetch_assoc($r)) {
                             $id = $row['id'];
                             $story_id = $row['id'];
                             $b_author = $row['b_author'];
                           $b_tittle = $row['b_tittle'];
                         $cover_photo = $row['cover_photo'];
                         $readings = $row['readings'];
                         $likes = $row['likes'];
                       } // story while loop

                      // getting data from chapters table
                      $s = 'select * from storychapters where s_id='.$id.'';
                        $r = mysqli_query($connection,$s);
                          $check_status = mysqli_num_rows($r);
                           while ($row=mysqli_fetch_assoc($r)) {
                           $id = $row["id"];  // orignal id of this table
                           $likeid = $row["id"];  // orignal id of this table
                           $back_id = $row["id"]; // foreign key value
                            $s_id = $row["s_id"];  // this is same but it is using at mutiple places so value is changes
                           $chapter_name = $row["chapter_name"];
                          $chapter_text = $row["chapter_text"];
                       $status = $row["status"];
                     }  // chapters while loop

                   } // isset story read
                ?>
              <!-- Main content -->
         <section class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-6 offset-3">
                  <?php
                  // sending to datbase
                  if (isset($_POST['save_comment'])) {
                    // receive all input values from the form
                      $book_id = mysqli_real_escape_string($connection, $_POST['book_id']);
                       $commenti_id = mysqli_real_escape_string($connection, $_POST['commenti_id']);
                       $comment = mysqli_real_escape_string($connection, $_POST['comment']);
                        $query = "INSERT INTO comments (book_id,commenti_id,comment)VALUES('$book_id','$commenti_id','$comment') limit 1";
                         $success = mysqli_query($connection, $query);
                        if ($success) {
                            echo '
                            <div class="alert alert-success  alert-dismissible">
                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                             <strong> Comment is Published ! </strong>
                           </div>
                           ';
                            echo '
                            <div class="text-center">
                              <div class="spinner-grow" role="status">
                                <span class="sr-only">Loading...</span>
                              </div>
                            </div>
                            ';
                            header("Refresh:0,url=read_story.php?read_story=$story_id");
                         }else{
                           echo '
                           <div class="alert alert-danger  alert-dismissible">
                             <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Query Failed ! </strong>
                          </div>
                          ';
                        }
                     }
                  ?>
                </div>
              </div>
             <div class="row">
               <div class="col-md-12">
                 <div class="card text-center">
                   <div class="card-body">
                     <!--1st row haaving picture and books information -->
                     <div class="row">
                       <?php
                        $s = 'select * from reviews where book_id='.$story_id.'';
                         $r = mysqli_query($connection,$s);
                           $check_review =mysqli_num_rows($r);
                           while ($row=mysqli_fetch_assoc($r)) {
                             $id = $row["id"];
                              $book_id = $row["book_id"];
                             $review = $row["review"];
                            $created_at = $row["created_at"];
                          }
                          ?>
                       <div class="col-md-4 text-center">
                         <div class="card p-3 h-100">
                             <div class="">
                               <img src='../coverphotos/<?php echo $cover_photo; ?>' alt="<?php echo $cover_photo; ?>"height="200px"width="50%">
                             </div>
                          </div>
                        </div>
                        <div class="col-md-8 text-capitalize">
                          <div class="card p-3 h-100">
                              <div class="d-flex justify-content-between align-items-center mb-2">
                                  <div class="user d-flex flex-row align-items-center"><span><small class="font-weight-bold text-primary">BooK Name : </small> <small class="font-weight-bold"> <?php echo $b_tittle ?></small></span> </div>
                                  <div class="user d-flex flex-row align-items-center"><span><small class="font-weight-bold text-primary">Author Name : </small> <small class="font-weight-bold"> <?php echo $b_author ?> </small></span> </div>
                              </div>
                              <div class="d-flex justify-content-between align-items-center">
                                  <div class="user d-flex flex-row align-items-center"><span><small class="font-weight-bold text-primary">No of  Chapters: </small>
                                    <small class="font-weight-bold">
                                      <?php
                                        $sql = "SELECT * FROM storychapters where s_id='$story_id' and status='0'";
                                          $result =mysqli_query($connection,$sql);
                                            echo  $count = mysqli_num_rows($result);
                                             while($row =mysqli_fetch_assoc($result)){
                                            $id= $row['id'];
                                            $chapter_name= $row['chapter_name'];
                                          $chapter_text= $row['chapter_text'];
                                       ?>
                                       <div class="chapter_name">
                                         <ul class="list">
                                           <li  style="list-style-type: circle;"> <a href="read_story.php?read_story=<?php echo $id ?>" class="font-weight-bold text-capitalize text-success"> <?php echo $chapter_name ?></li>
                                         </ul>
                                       </div>
                                     <?php } ?>
                                    </small>
                                  </span>
                                </div>
                              </div>
                              <div class="d-flex justify-content-between align-items-center">
                                <div class="user d-flex flex-row align-items-center mt-3"><span><small class="font-weight-bold text-primary">Reviews : </small>
                                    <small class="">
                                      <?php
                                         if ($check_review>0) {
                                           echo $review;
                                         } else {
                                           echo "not exists";
                                         }
                                     ?>
                                   </small></span>
                                </div>
                              </div>
                              <div class="action d-flex justify-content-between mt-2 align-items-center">
                                  <div class="reply px-4"> <small> </small>  </div>
                                  <div class="icons align-items-center"> <i class="fa fa-star text-danger"></i> <i class="fa fa-check-circle-o check-icon"></i> </div>
                              </div>
                           </div>
                         </div> <!--main row -->
                      </div> <!--row -->
                      <!--1st row haaving picture and books information -->
                       <hr>
                       <div class="row">
                         <div class="col-md-3">
                            <p class="text-secondary font-weight-bold">
                              <a href="#"class="p-1 badge-primary rounded-pill">Likes:</a>
                              <kbd class="bg-success rounded-circle ml-2"> <?php echo $likes ?></kbd>
                            </p>
                          </div> <!--main row -->
                          <div class="col-md-3">
                             <p class="text-secondary font-weight-bold"> <span class="p-1 badge-primary rounded-pill m-2">Views</span>
                               <kbd class="bg-success rounded-circle"> <?php echo $readings ?> </kbd>
                             </p>
                           </div> <!--main row -->
                           <div class="col-md-3">
                              <p class="text-secondary font-weight-bold"> <span class="p-1 badge-primary rounded-pill m-2"> Comments </span>
                                <?php
                                  $sql = "SELECT count('book_id') FROM comments where book_id='$story_id'";
                                     $result =mysqli_query($connection,$sql);
                                       while($row =mysqli_fetch_assoc($result)){
                                       $count_comments= $row["count('book_id')"];
                                   }
                                 ?>
                                 <kbd class="bg-success rounded-circle"><?php echo $count_comments; ?></kbd>
                               </p>
                            </div> <!--main row -->
                            <div class="col-md-2">
                               <p class="text-secondary font-weight-bold">
                                 <button class="btn btn-sm p-1 badge-warning">
                                   <i class="fa fa-users" aria-hidden="true"data-toggle="modal" data-target="#recommendstory" data-whatever="@mdo"data-backdrop="static" data-keyboard="false"> Recommend Story </i>
                                 </button>
                                </p>
                             </div> <!--main row -->
                        </div> <!--row -->
                   </div> <!--main card body -->
                   </div>
                 </div>
               </div>
             </div>  <!--table 1st row end -->
           </div>      <!-- container-fluid -->
        </section>
      </div> <!-- contecnt wrapper -->


      <!-- model for story Recommendation  -->
      <div class="modal fade" id="recommendstory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
      <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Story Recommendation</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <div class="modal-body">
      <div class="container">
      <?php
         // saving incentive to incentives table
        if(isset($_POST['send_recommendation'])){
          $bid = $_POST['bid'];
          $sid = $_POST['sid'];
          $uid = $_POST['uid'];

            // form validation: ensure that the form is correctly filled ...
            // by adding (array_push()) corresponding error unto $errors array
            if (empty($bid)) { array_push($errors, "Book ID is missing"); }
            if (empty($sid)) { array_push($errors, "Sender ID is missing"); }
            if (empty($uid)) { array_push($errors, "Please Select User"); }

            // Finally, register user if there are no errors in the form
            if (count($errors) == 0) {
              $uid = $_POST['uid'];
                   for($i=0;$i<count($uid);$i++){
                   $check_value = $uid[$i];
                   mysqli_query($connection,"insert into story_recommendations (bid,sid,uid) values ('".$bid."','".$sid."','".$check_value."')") or die(mysqli_error());
                  }
              echo '
              <div class="alert alert-success  alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
               <strong class="text-sm"> Story Recommendation Sent Successfully ! </strong>
             </div>
             ';
             header("Refresh:0,url=view_one_story.php?read_story=$story_id");
           }


        }  // save if isset save_incentives
      ?>
      <form class="" method="post"enctype="multipart/form-data">
         <div class="row">
            <div class="col-md-12">
              <div class="form-row">
                <div class="form-group col-md-12">
                  <input type="hidden" class="form-control form-control-sm"name="bid"value="<?php echo $story_id; ?>"  placeholder="">
                </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <input type="hidden" class="form-control form-control-sm"name="sid"value="<?php echo $admin_id; ?>"  placeholder="">
                  </div>
                </div>
                <div class="form-row">
                <div class="form-group col-md-12">
                  <label for=""class="text-secondary text-sm">Choose Users  <span class="text-danger mb-5">*</span></label>
                  <br>
                   <?php
                    $query = "SELECT * FROM users Except SELECT * FROM users WHERE id =$admin_id";
                      $results = mysqli_query($connection, $query);
                          while ($row=mysqli_fetch_assoc($results)) {
                               $id =$row['id'];
                               $frist_name =$row['frist_name'];
                               $last_name =$row['last_name'];
                               $u_email =$row['u_email'];
                               $status =$row['status'];
                     ?>
                    <input type="checkbox" id="checkItem" name="uid[]" value="<?php echo $id; ?>"> <span class="text-muted text-capitalize"><?php echo $frist_name.' '.$last_name ?> <span class="line"> | </span> </span>
                  <?php } ?>
                  </div>
                </div>
              </div>
             <div class="modal-footer">
               <div style="margin-top:10px" class="form-group">
                 <div class="col-sm-12 controls">
                 <button id="btn-login" href="#" class="btn btn-success btn-block btn-sm float-right"name="send_recommendation" type="submit"> Send </button>
               </div>
             </div>
            </div>
           </div> <!--row -->
          </form>
        </div>
      </div>
      </div>
      </div>
      </div>
      <!-- Large modal end for story Recommendation  -->

    <?php include '../includes/footer.php'; ?>
  </body>
</html>

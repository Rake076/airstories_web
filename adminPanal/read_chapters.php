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
              <!-- Main content -->
          <section class="content">
            <div class="container-fluid">

                <div class="row">
                  <div class="col-md-10 offset-1">
                    <div class="card">
                      <?php
                      if($_SESSION["email"] && $_SESSION["password"]==true ){
                           $email= $_SESSION['email'];
                           $password= $_SESSION['password'];
                           $query = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
                           $results = mysqli_query($connection, $query);
                           if (mysqli_num_rows($results) == 1) {
                               while ($row=mysqli_fetch_assoc($results)) {
                                   $commenti_id =$row['id'];
                                   $f_name =$row['f_name'];
                                   $l_name =$row['l_name'];
                                   $email =$row['email'];
                                $profile =$row['profile_image'];
                             }
                          }
                        }
                       ?>
                        <div class="card-body">
                            <?php
                               $status = "";
                                 if (isset($_GET['read_chapter'])) {
                                   $id = $_GET['read_chapter'];
                                      $s = 'select * from storychapters where id='.$id.'';
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
                                      }
                                    if ($status==0) {
                                  ?>
                               <?php
                                 $s = 'select * from stories where id='.$s_id.'';
                                   $r = mysqli_query($connection,$s);
                                    while ($row=mysqli_fetch_assoc($r)) {
                                      $id = $row['id'];
                                      $story_id = $row['id'];
                                      $b_author = $row['b_author'];
                                      $b_tittle = $row['b_tittle'];
                                      $cover_photo = $row['cover_photo'];
                                    }
                                 ?>
                                  <div class="container ">
                                    <div class="row">
                                      <div class="col-md-6 offset-3">
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
                                                  header("Refresh:0,url=read_chapters.php?read_chapter=$back_id");
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
                                         <div class="container-fluid">
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

                                             <div class="col-md-6 text-center">
                                               <div class="card p-3 h-100">
                                                   <div class="">
                                                     <img src='../coverphotos/<?php echo $cover_photo; ?>' alt="<?php echo $cover_photo; ?>"height="200px"width="50%">
                                                   </div>
                                                </div>
                                              </div>
                                              <div class="col-md-6 text-capitalize">
                                                <div class="card p-3 h-100">
                                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                                        <div class="user d-flex flex-row align-items-center"><span><small class="font-weight-bold text-primary">BooK Name : </small> <small class="font-weight-bold"> <?php echo $b_tittle ?></small></span> </div>
                                                        <div class="user d-flex flex-row align-items-center"><span><small class="font-weight-bold text-primary">Author Name : </small> <small class="font-weight-bold"> <?php echo $b_author ?> </small></span> </div>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="user d-flex flex-row align-items-center"><span><small class="font-weight-bold text-primary">No of  Chapters: </small>
                                                          <small class="font-weight-bold">
                                                            <?php
                                                               $sql = "SELECT count(*) FROM storychapters where s_id='$s_id'";
                                                                 $result =mysqli_query($connection,$sql);
                                                                   while($row =mysqli_fetch_assoc($result)){
                                                                   $presents= $row['count(*)'];
                                                                echo $presents;
                                                               }
                                                             ?>
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
                                                                 echo "not found";
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
                                            <hr>
                                            <div class="row">
                                              <div class="col-md-4 offset-4 text-capitalize">
                                                 <h4 class="font-weight-bold text-primary"> <?php echo $chapter_name; ?> </h4>
                                               </div> <!--main row -->
                                             </div> <!--row -->
                                            <div class="row">
                                              <div class="col-md-6 offset-3">
                                                 <hr>
                                               </div> <!--main row -->
                                             </div> <!--row -->
                                            <div class="row mb-5">
                                              <div class="col-md-10 offset-1">
                                                 <p class="text-secondary chapter_text"> <?php echo $chapter_text; ?> </p>
                                               </div> <!--main row -->
                                             </div> <!--row -->
                                             <hr>
                                             <div class="row">
                                               <div class="col-md-3">
                                                  <p class="text-secondary font-weight-bold">
                                                    <a href="read_chapters.php?read_chapters=<?php echo $likeid ?>"class="p-1 badge-danger">Likes:</a>
                                                    <?php
                                                       $sql = "SELECT count('book_id') FROM comments where book_id='$s_id'";
                                                         $result =mysqli_query($connection,$sql);
                                                           while($row =mysqli_fetch_assoc($result)){
                                                           $count_like= $row["count('book_id')"];
                                                       }
                                                     ?>
                                                    <kbd class="bg-success rounded-circle ml-2"><?php echo $count_like; ?></kbd>

                                                  </p>
                                                </div> <!--main row -->
                                                <div class="col-md-3">
                                                   <p class="text-secondary font-weight-bold">Views:
                                                     <?php
                                                        $sql = "SELECT count('book_id') FROM comments where book_id='$s_id'";
                                                          $result =mysqli_query($connection,$sql);
                                                            while($row =mysqli_fetch_assoc($result)){
                                                            $count_views= $row["count('book_id')"];
                                                        }
                                                      ?>
                                                     <kbd class="bg-success rounded-circle"><?php echo $count_views; ?></kbd>
                                                   </p>
                                                 </div> <!--main row -->
                                                 <div class="col-md-3">
                                                    <p class="text-secondary font-weight-bold">Comments:
                                                      <?php
                                                         $sql = "SELECT count('book_id') FROM comments where book_id='$s_id'";
                                                           $result =mysqli_query($connection,$sql);
                                                             while($row =mysqli_fetch_assoc($result)){
                                                             $count_comments= $row["count('book_id')"];
                                                         }
                                                       ?>
                                                       <kbd class="bg-success rounded-circle"><?php echo $count_comments; ?></kbd>
                                                     </p>
                                                  </div> <!--main row -->
                                                  <div class="col-md-3">
                                                     <p class="text-secondary font-weight-bold">
                                                       <button class="btn btn-sm p-1 badge-danger">
                                                         <i class="fa fa-plus" aria-hidden="true"data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"data-backdrop="static" data-keyboard="false"> Report The Story </i>
                                                       </button>
                                                      </p>
                                                   </div> <!--main row -->
                                              </div> <!--row -->
                                          </div> <!--modal body -->
                                          <!--comment section start here -->
                                        <hr>
                                        <!-- displaying the comment start here -->
                                        <div class="container mt-5">
                                            <div class="row d-flex justify-content-center">
                                                <div class="col-md-12">
                                                  <?php
                                                       $s = 'select * from comments where book_id='.$story_id.'';
                                                         $r = mysqli_query($connection,$s);
                                                          while ($row=mysqli_fetch_assoc($r)) {
                                                            $id = $row["id"];
                                                             $book_id = $row["book_id"];
                                                             $comment = $row["comment"];
                                                           $created_at = $row["created_at"];
                                                        ?>
                                                    <div class="card p-3">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div class="user d-flex flex-row align-items-center"> <img src="adminprofileImage/<?php echo $profile; ?>" width="30" class="user-img rounded-circle mr-2"> <span><small class="font-weight-bold text-primary"><?php echo $f_name.' '.$l_name;?></small> <small class="font-weight-bold"></small></span> </div>
                                                            <small>  <?php echo date("F j, Y, g:i a", strtotime($created_at)) ?> </small>
                                                        </div>
                                                        <div class="action d-flex justify-content-between mt-2 align-items-center">
                                                            <div class="reply px-4"> <small> <?php echo $comment; ?></small>  </div>
                                                            <div class="icons align-items-center"> <i class="fa fa-star text-danger"></i> <i class="fa fa-check-circle-o check-icon"></i> </div>
                                                        </div>
                                                    </div>
                                                  <?php } // while loop ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- displaying the comment end here-->
                                        <hr>
                                          <div class="container-fluid mt-2">
                                            <div class="row">
                                              <div class="col-md-12">
                                                <form method="post"enctype='multipart/form-data'>
                                                  <div class="form-row">
                                                    <div class="form-group col-md-12">
                                                      <input type="hidden" class="form-control form-control-sm"name="book_id"value="<?php echo $s_id; ?>"  placeholder="">
                                                    </div>
                                                    </div>
                                                    <div class="form-row">
                                                      <div class="form-group col-md-12">
                                                        <input type="hidden" class="form-control form-control-sm"name="commenti_id"value="<?php echo $commenti_id; ?>"  placeholder="">
                                                      </div>
                                                      </div>
                                                    <div class="form-row">
                                                    <div class="form-group col-md-12">
                                                      <label for="inputPassword4">Comment</label>
                                                      <textarea name="comment"class="form-control form-control-sm" rows="4" cols="40"placeholder="Your Comment ..."> </textarea>
                                                    </div>
                                                  </div>
                                                  <div class="row">
                                                    <div class="col-md-2 offset-5">
                                                      <button type="submit"name="save_comment" class="btn btn-success btn-block btn-sm m-2 float-right">Post Comment</button>
                                                    </form>
                                                 <hr>
                                               </div> <!--main row -->
                                             </div> <!--row -->
                                           </div> <!--modal body -->
                                          <!--comment section start end -->
                                         </div>
                                      </div>
                                    </div>
                              </div>
                            </div>
                               <?php
                               } else {
                                 $s = 'select * from stories where id='.$s_id.'';
                                   $r = mysqli_query($connection,$s);
                                    while ($row=mysqli_fetch_assoc($r)) {
                                      $story_id = $row['id'];
                                    }
                                 ?>
                                 <a href="add_chapters.php?add_chapters=<?php echo $story_id ?>"class="btn btn-sm btn-outline-warning ">Back</a>
                                   <p class="text-danger font-weight-bold display-4">Story is not Published</p>
                                 <?php
                               }
                            }
                          ?>
                      </div>
                    </div>
                 </div>
             </div>

            </div>  <!-- container-fluid -->
          </section>
                    <!-- Large modal start inserting form -->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Reporting Story</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                   <div class="container">
                    <?php
                       // saving incentive to incentives table
                      if(isset($_POST['save_report'])){
                          $book_id = $_POST['book_id'];
                              $reporti = $_POST['reporti'];
                               $report_reason = $_POST['report_reason'];
                                    // inserting data to database
                                      $s =  $obj->insert('reports',['book_id'=>$book_id,'reporti'=>$reporti ,'report_reason'=>$report_reason]);
                                       if ($s) {
                                       echo '
                                        <div class="alert alert-success  alert-dismissible">
                                          <button type="button" class="close" data-dismiss="alert">&times;</button>
                                         <strong> Data Saved Successfully ! </strong>
                                         </div>
                                        ';
                                        header("Refresh:0,url=read_chapters.php?read_chapter=$back_id");
                                    }else{
                                  echo '
                                  <div class="alert alert-danger  alert-dismissible">
                                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                                 <strong> Sorry Data Not Saved Try Again ! </strong>
                              </div>
                            ';
                            header("Refresh:0,url=read_chapters.php?read_chapter=$back_id");
                         }

                      }  // save if isset save_incentives
                   ?>
                    <form class="" method="post"enctype="multipart/form-data">
                       <div class="row">
                          <div class="col-md-12">
                            <div class="form-row">
                              <div class="form-group col-md-12">
                                <input type="hidden" class="form-control form-control-sm"name="book_id"value="<?php echo $s_id; ?>"  placeholder="">
                              </div>
                              </div>
                              <div class="form-row">
                                <div class="form-group col-md-12">
                                  <input type="hidden" class="form-control form-control-sm"name="reporti"value="<?php echo $commenti_id; ?>"  placeholder="">
                                </div>
                                </div>
                              <div class="form-row">
                              <div class="form-group col-md-12">
                                <label for=""class="text-secondary text-sm">Choose Report Reason  <span class="text-danger mb-5">*</span></label>
                                  <select class="form-control form-control-sm m-1" name="report_reason">
                                    <option value="Choose Report Reason">-----</option>
                                     <optgroup label="">
                                       <option value='irrelaivant content'> Irrelaivant Content</option>
                                       <option value='grammer mistakes'> Grammer Mistakes </option>
                                       <option value='spelling mistakes'>Spelling Mistakes </option>
                                       <option value='lengty written'> Very Lengty Written </option>
                                     </optgroup>
                                 </select>

                              </div>
                            </div>
                           </div>
                           <div class="modal-footer">
                             <div style="margin-top:10px" class="form-group">
                               <div class="col-sm-12 controls">
                               <button id="btn-login" href="#" class="btn btn-success btn-block btn-sm float-right"name="save_report" type="submit"> Save </button>
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
            <!-- Large modal end  -->

      </div> <!-- contecnt wrapper -->
    <?php include '../includes/footer.php'; ?>
  </body>
</html>

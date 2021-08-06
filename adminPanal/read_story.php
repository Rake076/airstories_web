<?php
session_start();
ob_start();
include '../db.php';
?>
<!DOCTYPE html>
<html>
<head>
     <?php include '../includes/head.php'; ?>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

<style media="screen">
body{
    margin: 0px;
    padding: 0px;
}
  .hr{
    margin-top: 1rem;
    margin-bottom: 2rem;
    border: 0;
    border-top: 5px solid rgba(25,15,3,.1);
    background-color: darkturquoise;
  }
  .chapter_name{
      margin-left: 2rem!important;
      display: block;
  }
  .list{
    list-style-type: circle;
    margin: inherit;
    color: red;
}
.text-primary{
  font-size: large;
  font-family: fangsong;
}
/* .fa-thumbs-up:before {
    content: "\f164";
    font-size: xx-large;
    color: green;
}
.fa-thumbs-o-up:before {
    content: "\f087";
    font-size: xx-large;
    color: crimson;
} */
.likes{
  color: black;
    font-size: x-large;
    font-style: oblique;
    font-family: em
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
.badge {
    display: contents;
}

input[type=checkbox], input[type=radio] {
    margin: 8px 8px 0px;
    margin-top: 1px\9;
    line-height: normal;
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
                  <h1 class="m-0 text-dark">  </h1>
                  <a href="all_stories.php"class="btn btn-sm btn-outline-warning mt-2 backbtn">Back</a>
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

                // getting data from chapters table
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
               }  // chapters while loop

                  $s = 'select * from stories where id='.$s_id.'';
                    $r = mysqli_query($connection,$s);
                    $check_status = mysqli_num_rows($r);
                        $r = mysqli_query($connection,$s);
                          $check_status = mysqli_num_rows($r);
                           while ($row=mysqli_fetch_assoc($r)) {
                             $id = $row['id'];
                             $story_id = $row['id'];
                             $bookid = $row['id'];
                             $b_author = $row['b_author'];
                            $b_tittle = $row['b_tittle'];
                           $cover_photo = $row['cover_photo'];
                          $likes = $row['likes'];
                        $readings = $row['readings'];
                      } // story while loop
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
                            header("Refresh:0,url=read_story.php?read_story=$back_id");
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
                        <div class="col-md-7 text-capitalize">
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
                                             $chapter_id= $row['id'];
                                            $chapter_name= $row['chapter_name'];
                                          $chapter_text= $row['chapter_text'];
                                       ?>
                                       <div class="chapter_name">
                                         <a href="read_story.php?read_story=<?php echo $id ?>"> <?php echo $chapter_name ?></a>
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
                                           echo "Review not exist";
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
                      <!--1st row haaving picture and books information -->

                      <?php
                           if (isset($_GET['read_story'])) {
                             $id = $_GET['read_story'];
                                $s = 'select * from storychapters where id='.$id.'';
                                 $r = mysqli_query($connection,$s);
                                   $check_status = mysqli_num_rows($r);
                                    while ($row=mysqli_fetch_assoc($r)) {
                                    $id = $row["id"];  // orignal id of this table
                                    $chapter_name = $row["chapter_name"];
                                   $chapter_text = $row["chapter_text"];
                                $status = $row["status"];
                                }
                              if ($status==0) {
                            ?>

                      <div class="row"> <!--Chapters name  -->
                        <div class="col-md-4 offset-4 text-capitalize">
                           <h4 class="font-weight-bold text-primary"> <?php echo $chapter_name; ?> </h4>
                         </div> <!--main row -->
                       </div> <!--Chapter name-->
                      <div class="row">
                        <div class="col-md-6 offset-3">
                           <hr>
                         </div> <!--main row -->
                       </div> <!--row -->
                      <div class="row mb-5"><!--chapter_text-->
                        <div class="col-md-10 offset-1">
                           <p class="text-secondary chapter_text"> <?php echo $chapter_text; ?> </p>
                         </div> <!--main row -->
                       </div> <!--chapter_text-->
                     <?php } } ?>
                       <hr>
                       <div class="row">
                         <div class="col-md-2">
                            <p class="text-secondary font-weight-bold">
                          			<div class="post">
                          				<div style="padding: 2px; margin-top: 5px;">
                                    Likes :
                                    <?php
                                     $sql = "SELECT * FROM likeunlike where bookid=$bookid";
                                        $resultt =mysqli_query($connection,$sql);
                                          $results = mysqli_num_rows($resultt);
                                            if ($results == 1){
                                              echo '
                                              <span class="unlike fa fa-thumbs-up" data-id="'.$bookid.'"></span>
                                              <span class="like hide fa fa-thumbs-o-up" data-id="'.$bookid.'"></span>
                                              ';
                                             }else {
                                            echo '
                                            <span class="like fa fa-thumbs-o-up" data-id="'.$bookid.'"></span>
                                            <span class="unlike hide fa fa-thumbs-up" data-id="'.$bookid.'"></span>
                                            ';
                                          }
                                      ?>
                      				    	<span class="likes_count text-secondary font-weight-bold"> <span class=" badg rounded-circle p-1 ml-2"> <?php echo $likes; ?> </span> </span>
                      			   	</div>
                      		  	</div>
                            </p>
                          </div> <!--main row -->
                          <div class="col-md-2">
                             <p class="text-secondary font-weight-bold">
                               Views :
                               <span class="unlike fa fa-eye data-id="></span>
                                <span class="read_count"> <span class=" p-1 ml-2"> <?php echo $readings; ?> </span> </span>
                             </p>
                           </div> <!--main row -->
                           <div class="col-md-3">
                              <p class="text-secondary font-weight-bold">
                                Comments :
                                <span class="unlike fa fa-comment data-id="></span>
                                <?php
                                   $sql = "SELECT count('book_id') FROM comments where book_id='$s_id'";
                                     $result =mysqli_query($connection,$sql);
                                       while($row =mysqli_fetch_assoc($result)){
                                       $count_comments= $row["count('book_id')"];
                                   }
                                 ?>
                                 <span class="likes_count"> <span class=" p-1 ml-2"> <?php echo $count_comments; ?> </span> </span>
                               </p>
                            </div> <!--main row -->
                            <div class="col-md-2">
                               <p class="text-secondary font-weight-bold">
                                 <button class="btn btn-sm p-1 badge-danger">
                                   <i class="fa fa-plus" aria-hidden="true"data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"data-backdrop="static" data-keyboard="false"> Report The Story </i>
                                 </button>
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
                        <div class="row">
                          <div class="col-md-4 offset-4">
                            <!-- social media-->
                            <?php include '../sharerbuttons.php'; ?>
                            <?php
                             $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                               $actual_link = 'http://localhost/library/frontend/';  // redirecting to frontend of rather than user dashboard
                            echo showSharer("$actual_link", "A nice page is here check it out..!");
                            ?>
                             <!-- social media-->
                          </div>
                        </div>
                        <hr>
                     </div> <!--main card body -->

                   <!-- displaying the comment start here -->
                       <div class="row">
                           <div class="col-md-10 offset-1">
                             <?php
                         $s = "select * from comments where book_id='$story_id' and commenti_id='$admin_id'";
                                    $r = mysqli_query($connection,$s);
                                     while ($row=mysqli_fetch_assoc($r)) {
                                       $id = $row["id"];
                                        $book_id = $row["book_id"];
                                        $commenti_id = $row["commenti_id"];
                                        $comment = $row["comment"];
                                      $created_at = $row["created_at"];
                                   ?>
                               <div class="card p-3">
                                   <div class="d-flex justify-content-between align-items-center">
                                     <?php
                                     $query = "SELECT * FROM admin WHERE id='$commenti_id'";
                                     $results = mysqli_query($connection, $query);
                                     if (mysqli_num_rows($results) == 1) {
                                         while ($row=mysqli_fetch_assoc($results)) {
                                             $commenti_id =$row['id'];
                                              $frist_name =$row['f_name'];
                                             $last_name =$row['l_name'];
                                              $u_email =$row['email'];
                                             $u_password =$row['password'];
                                             $profile =$row['profile_image'];
                                         }
                                      }
                                      ?>
                                       <div class="user d-flex flex-row align-items-center">
                                             <?php
                                                if ($profile) {
                                                  ?>
                                                  <img src="../userProfileImage/<?php echo $profile; ?>" width="30" class="user-img rounded-circle mr-2">
                                                  <?php
                                                }else {
                                                  ?>
                                                  <img src="../userProfileImage/profile.png" width="30" class="user-img rounded-circle mr-2">
                                                  <?php
                                                }
                                              ?>
                                            <span><small class="font-weight-bold text-primary"><?php echo $frist_name.' '.$last_name;?></small>
                                             <small class="font-weight-bold"></small></span>
                                         </div>
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
                   <!-- displaying the comment end here-->
                    <div class="card-footer text-muted">
                      <div class="row">
                        <div class="col-md-8 offset-2">
                          <form method="post"enctype='multipart/form-data'>
                            <div class="form-row">
                              <div class="form-group col-md-12">
                                <input type="hidden" class="form-control form-control-sm"name="book_id"value="<?php echo $story_id; ?>"  placeholder="">
                              </div>
                              </div>
                              <div class="form-row">
                                <div class="form-group col-md-12">
                                  <input type="hidden" class="form-control form-control-sm"name="commenti_id"value="<?php echo $admin_id; ?>"  placeholder="">
                                </div>
                                </div>
                              <div class="form-row">
                              <div class="form-group col-md-12">
                                <label for="inputPassword4">Comments</label>
                                <textarea name="comment"class="form-control form-control-sm" rows="4" cols="40"placeholder="Your Comment ..."> </textarea>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-3 offset-4">
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
             </div>  <!--table 1st row end -->
           </div>      <!-- container-fluid -->
        </section>
      </div> <!-- contecnt wrapper -->

      <!-- model for reporting table -->
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
                          header("Refresh:0,url=read_story.php?read_story=$chapter_id");
                      }else{
                    echo '
                    <div class="alert alert-danger  alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                   <strong> Sorry Data Not Saved Try Again ! </strong>
                </div>
              ';
              header("Refresh:0,url=read_story.php?read_story=$chapter_id");
           }

        }  // save if isset save_incentives
     ?>
      <form class="" method="post"enctype="multipart/form-data">
         <div class="row">
            <div class="col-md-12">
              <div class="form-row">
                <div class="form-group col-md-4">
                  <input type="hidden" class="form-control form-control-sm"name="book_id"value="<?php echo $s_id; ?>"  placeholder="">
                </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <input type="hidden" class="form-control form-control-sm"name="reporti"value="<?php echo $admin_id; ?>"  placeholder="">
                  </div>
                  </div>
                <div class="form-row">
                <div class="form-group col-md-4">
                  <label for=""class="text-secondary text-sm">Choose Report Reason  <span class="text-danger mb-5">*</span></label>
                    <select class="form-control form-control-sm m-1" name="report_reason"required>
                       <optgroup label="">
                         <option value=""></option>
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
<!-- Large modal end for Reporting  -->

<!-- model for story Recommendation -->
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
       header("Refresh:0,url=read_story.php?read_story=$chapter_id");
     }


  }  // save if isset save_incentives
?>
<form class="" method="post"enctype="multipart/form-data">
   <div class="row">
      <div class="col-md-12">
        <div class="form-row">
          <div class="form-group col-md-4">
            <input type="hidden" class="form-control form-control-sm"name="bid"value="<?php echo $story_id; ?>"  placeholder="">
          </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <input type="hidden" class="form-control form-control-sm"name="sid"value="<?php echo $admin_id; ?>"  placeholder="">
            </div>
          </div>
          <div class="form-row">
          <div class="form-group col-md-4">
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
<script>
	$(document).ready(function(){
		// when the user clicks on like
		$('.like').on('click', function(){
			var bookid = $(this).data('id');
			    $post = $(this);

			$.ajax({
				url: 'like_unlike_code.php',
				type: 'post',
				data: {
					'liked': 1,
					'bookid': bookid
				},
				success: function(response){
					$post.parent().find('span.likes_count').text(response);
					$post.addClass('hide');
					$post.siblings().removeClass('hide');
				}
			});
		});

		// when the user clicks on unlike
		$('.unlike').on('click', function(){
			var bookid = $(this).data('id');
		    $post = $(this);

			$.ajax({
				url: 'like_unlike_code.php',
				type: 'post',
				data: {
					'unliked': 1,
					'bookid': bookid
				},
				success: function(response){
					$post.parent().find('span.likes_count').text(response);
					$post.addClass('hide');
					$post.siblings().removeClass('hide');
				}
			});
		});
	});
</script>

    <?php include '../includes/footer.php'; ?>
  </body>
</html>

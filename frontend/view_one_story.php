<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
<!-- Meta Tags -->
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<meta name="description" content="StudyPress | Education & Courses HTML Template" />
<meta name="keywords" content="academy, course, education, education html theme, elearning, learning," />
<meta name="author" content="ThemeMascot" />
<!-- Page Title -->
<title> Story Detail </title>
<?php include 'includes/head.php'; ?>
</head>
  <body class="boxed-layout pt-40 pb-40 pt-sm-0" data-bg-img="images/pattern/p13.png">

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
                     $bookid = $row['id'];
                     $b_author = $row['b_author'];
                    $b_tittle = $row['b_tittle'];
                    $b_description= $row['b_description'];
                   $cover_photo = $row['cover_photo'];
                  $likes = $row['likes'];
                $readings = $row['readings'];
              $posted_by = $row['role'];
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
          $chapter_created_date = $row["created_at"];
         }  // chapters while loop


       } // isset story read
     ?>
    <div id="wrapper" class="clearfix">
       <!-- Header -->
         <?php include 'includes/header.php'; ?>
            <!-- Start main-content -->
               <div class="main-content">
                <!-- Story Details start here -->
                      <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="images/bg/bg3.jpg">
                        <div class="container pt-70 pb-20">
                          <!-- Section Content -->
                          <div class="section-content">
                            <div class="row">
                              <div class="col-md-12">
                                <h2 class="title text-white">Story Details</h2>
                                <ol class="breadcrumb text-left text-black mt-10">
                                  <li><a href="index.php">Home</a></li>
                                  <li class="active text-gray-silver">Story Details</li>
                                </ol>
                              </div>
                            </div>
                          </div>
                        </div>
                      </section>
                      <!-- Section: Blog -->
                      <section>
                        <div class="container">
                          <div class="row">
                            <div class="col-md-8 blog-pull-right">
                              <div class="blog-posts single-post">
                                <article class="post clearfix mb-0">
                                  <div class="entry-header">
                                    <div class="post-thumb thumb"> <img src="../coverphotos/<?php echo $cover_photo ?>" alt="" class="img-responsive img-fullwidth"> </div>
                                  </div>
                                  <div class="entry-title pt-10 pl-15">
                                    <h4><a class="text-uppercase" href="#"> <?php echo $b_tittle ?>: <?php echo $chapter_name ?>  </a></h4>
                                  </div>
                                  <div class="entry-meta pl-15">
                                    <ul class="list-inline">
                                      <li>Posted: <span class="text-theme-color-2"><?php echo  date('d/m/Y',strtotime($chapter_created_date)); ?></span></li>
                                      <li>By: <span class="text-theme-color-2 text-capitalize"> <?php echo $posted_by; ?> </span></li>
                                      <li><i class="fa fa-comments-o ml-5 mr-5"></i>
                                       <?php
                                       $sql = "SELECT count('book_id') FROM comments where book_id='$story_id'";
                                          $result =mysqli_query($connection,$sql);
                                            while($row =mysqli_fetch_assoc($result)){
                                            echo $count_comments= $row["count('book_id')"];
                                        }
                                        ?>
                                       </li>
                                      <li><i class="fa fa-eye ml-5"></i> <span class="text-danger"><?php echo $readings; ?></span>  Views</li>
                                      <li>
                                      <?php
                                        $sql = "SELECT * FROM likeunlike where bookid='.$bookid.' and type='story'";
                                          $resultt =mysqli_query($connection,$sql);
                                            $results = mysqli_num_rows($resultt);
                                              if ($results == 1){
                                                echo '
                                                <span class="sunlike fa fa-thumbs-up ml-5" data-id="'.$bookid.'"> Likes </span>
                                                <span class="slike hide fa fa-thumbs-o-up ml-5" data-id="'.$bookid.'"> Likes </span>
                                                ';
                                               }else {
                                              echo '
                                              <span class="slike fa fa-thumbs-o-up ml-5" data-id="'.$bookid.'"> Likes </span>
                                              <span class="sunlike hide fa fa-thumbs-up ml-5 " data-id="'.$bookid.'"> Likes </span>
                                              ';
                                            }
                                        ?>
                                        <span class="likes_count text-danger"><?php echo $likes; ?>  </span>
                                     </li>
                                    </ul>
                                  </div>
                                  <div class="entry-content mt-10">
                                    <blockquote class="theme-colored pt-20 pb-20">
                                      <p  class="text-primary"> <?php echo $b_tittle; ?></p>
                                    </blockquote>
                                      <p><?php echo $b_description; ?></p>
                                    <div class="mt-30 mb-0">
                                      <h5 class="pull-left mt-10 mr-20 text-theme-color-2">Share:</h5>
                                      <ul class="styled-icons icon-circled m-0">
                                        <?php include '../sharerbuttons.php'; ?>
                                        <?php
                                        $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                                        echo showSharer("$actual_link", "A nice page is here check it out..!");
                                        ?>
                                      </ul>
                                    </div>
                                  </div>
                                  
                                </article>
                                <div class="tagline p-0 pt-20 mt-5">
                                  <div class="row">
                                    <div class="col-md-8">
                                      <div class="tags">
                                        <p class="mb-0"><i class="fa fa-tags text-theme-color-2"></i> <span>Tags:</span>
                                          <?php
                                             $s = "SELECT * FROM storychapters where s_id='$story_id' and status='0'";
                                                $r = mysqli_query($connection,$s);
                                                  $check_chapters=mysqli_num_rows($r);
                                                  if ($check_chapters>0) {
                                                    while ($row=mysqli_fetch_assoc($r)) {
                                                    $id = $row['id'];
                                                    $post_id = $row['id'];
                                                    $chapter_name = $row['chapter_name'];
                                                    $chapter_text = $row['chapter_text'];
                                                    $status = $row['status'];
                                                  ?>
                                                   <a class='badge badge-success'href=""> <?php echo $chapter_name ?> </a>
                                               <?php } // while loop  ?>
                                             <?php } // if loop ?>
                                         </p>
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="share text-right">
                                        <p><i class="fa fa-share-alt text-theme-color-2"></i> Share</p>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="comments-area">
                                  <h5 class="comments-title">Comments</h5>
                                  <ul class="comment-list">
                                    <?php
                                         $com = 'select * from public_comments where book_id='.$story_id.' and post_id=0 limit 1';
                                           $rr = mysqli_query($connection,$com);
                                            $count_public_comment=mysqli_num_rows($rr);
                                             if ($count_public_comment>0) {
                                              while ($row=mysqli_fetch_assoc($rr)) {
                                                $id = $row["id"];
                                                 $book_id = $row["book_id"];
                                                 $post_id = $row["post_id"];
                                                  $message = $row["message"];
                                                 $name = $row["name"];
                                               $email = $row["email"];
                                             $created_at = $row["created_at"];
                                          ?>
                                    <li>
                                      <div class="media comment-author"> <a class="media-left pull-left flip" href="#"><img class="img-thumbnail" src="images/blog/comment3.jpg" alt=""></a>
                                        <div class="media-body">
                                          <h5 class="media-heading comment-heading text-capitalize"><?php echo $name ?></h5>
                                          <div class="comment-date text-danger"><?php echo date('d/m/Y h:i A',strtotime($created_at)); ?></div>
                                          <p><?php echo $message; ?></p>
                                      </div>
                                    </li>
                                    <hr>
                                     <?php
                                      } // comment table while loop
                                    } // comment table while loop
                                   else {
                                       ?>
                                       <li>
                                         <div class="media comment-author"> <a class="media-left pull-left flip" href="#"><img class="img-thumbnail" src="images/blog/comment3.jpg" alt=""></a>
                                           <div class="media-body">
                                             <h5 class="media-heading comment-heading text-capitalize">Admin</h5>
                                             <div class="comment-date text-danger"> 17/4/2021</div>
                                             <p> The Awsome story i have read all time because its gonna explain life style and its rules and regulation which are so helpful for better life.</p>
                                         </div>
                                       </li>
                                      <?php
                                     }// else
                                   ?>
                                  </ul>

                                </div>
                                <div class="comment-box">
                                  <?php
                                  // // sending to datbase
                                  // if (isset($_POST['save_comment'])) {
                                  //   // receive all input values from the form
                                  //     $name =$_POST['name'];
                                  //     $email =$_POST['email'];
                                  //     $book_id =$_POST['book_id'];
                                  //      $post_id =$_POST['post_id'];
                                  //      $message =$_POST['message'];
                                  //       $query = "INSERT INTO public_comments (name,email,book_id,post_id,message)VALUES('$name','$email','$book_id','$post_id','$message') limit 1";
                                  //        $success = mysqli_query($connection, $query);
                                  //       if ($success) {
                                  //           echo '
                                  //           <div class="alert alert-success  alert-dismissible">
                                  //             <button type="button" class="close" data-dismiss="alert">&times;</button>
                                  //            <strong> Comment is Published ! </strong>
                                  //          </div>
                                  //          ';
                                  //           header("Refresh:0,url=view_one_story.php?read_story=$bookid");
                                  //        }else{
                                  //          echo '
                                  //          <div class="alert alert-danger  alert-dismissible">
                                  //            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                  //           <strong>Query Failed ! </strong>
                                  //         </div>
                                  //         ';
                                  //       }
                                  //    }
                                  ?>
                                  <div class="row">
                                    <div class="col-sm-12">
                                      <h5 class="text-danger font-weight-bold">Leave a Comment</h5>
                                      <div class="row">
                                        <div class="alert alert-success alert-dismissible" id="successs" style="display:none;">
                                          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                        </div>
                                        <form id="fupForm1" name="form1" method="post">
                                          <div class="col-sm-6 pt-0 pb-0">
                                            <div class="form-group">
                                              <input type="text" class="form-control" required name="name"autocomplete="off" id="name" placeholder="Enter Name">
                                            </div>
                                            <div class="form-group">
                                              <input type="email" required class="form-control" name="email"autocomplete="off" id="email" placeholder="Enter Email">
                                            </div>
                                            <div class="form-group">
                                              <input type="hidden" placeholder="Story ID" required id="book_id" class="form-control"value="<?php echo $bookid; ?>" name="book_id">
                                            </div>
                                            <div class="form-group">
                                              <input type="hidden" placeholder="Story ID"id="post_id" required class="form-control"value="0" name="post_id">
                                            </div>
                                          </div>
                                          <div class="col-sm-6">
                                            <div class="form-group">
                                              <textarea class="form-control" required name="message" id="message"  placeholder="Enter Message" rows="5"></textarea>
                                            </div>
                                            <div class="form-group">
                                              <button type="button"name="save"id="commentid" class="btn btn-dark btn-flat pull-right m-0" data-loading-text="Please wait...">Submit</button>
                                            </div>
                                          </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-12 col-md-4">
                              <div class="sidebar sidebar-left mt-sm-30 ml-40">
                                <div class="widget">
                                  <h4 class="widget-title line-bottom"> <a href="index.php#books"class="text-theme-color-2">Back</a> </h4>
                                  <h4 class="widget-title line-bottom">Chapters <span class="text-theme-color-2">List</span></h4>
                                  <div class="services-list">
                                    <ul class="list list-border angle-double-right">
                                       <?php
                                       $s = "SELECT * FROM storychapters where s_id='$story_id' and status='0'";
                                          $r = mysqli_query($connection,$s);
                                            $check_chapters=mysqli_num_rows($r);
                                            if ($check_chapters>0) {
                                              while ($row=mysqli_fetch_assoc($r)) {
                                              $id = $row['id'];
                                              $chapter_name = $row['chapter_name'];
                                              $chapter_text = $row['chapter_text'];
                                              $status = $row['status'];
                                            ?>
                                            <li class="active"><a href="read_story.php?read_story=<?php echo $id; ?>"> <?php echo $chapter_name ?></a></li>
                                            <?php
                                            }
                                          }else {
                                            echo "<li class='bg-danger'><span class='text-danger'> No Chapters Exists </span> </li>";
                                          }
                                        ?>
                                    </ul>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </section>
                    <!-- Story Details end here  -->
                    <section class="bg-theme-color-2"id="sub">
                      <?php include 'includes/subscribe.php'; ?>
                   </section>
                 <!-- end main-content -->
               </div>
             <!-- Footer -->
             <!-- saving comment -->
             <script>
               $(document).ready(function() {
                 $('#commentid').on('click', function() {
                   $("#commentid").attr("disabled", "disabled");
                   var name = $('#name').val();
                   var email = $('#email').val();
                   var book_id = $('#book_id').val();
                   var post_id = $('#post_id').val();
                   var message = $('#message').val();
                     $.ajax({
                       url: "save_comment_code.php",
                       type: "POST",
                       data: {
                         name: name,
                         email: email,
                         book_id: book_id,
                         post_id: post_id,
                         message: message,
                       },
                       cache: false,
                       success: function(dataResult){
                         var dataResult = JSON.parse(dataResult);
                         if(dataResult.statusCode==200){
                           $("#commentid").removeAttr("disabled");
                           $('#fupForm1').find('input:text').val('');
                           $("#successs").show();
                           $('#successs').html('Your Comment Will be Published Soon!');
                           $("#fupForm1").get(0).reset();
                           setTimeout(function() {
                                $("#successs").hide(); //or fadeOut
                              }, 3000);
                         }
                         else if(dataResult.statusCode==201){
                            alert("Error occured !");
                         }
                       }
                     });
                 });
               });
            </script>
             <!-- saving comment -->
          <?php include 'includes/footer.php'; ?>
        <a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
     </div>
   <!-- end wrapper -->
 </body>
</html>

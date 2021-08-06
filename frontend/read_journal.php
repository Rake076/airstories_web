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
<title> Journals Detail </title>
<?php include 'includes/head.php'; ?>
</head>
  <body class="boxed-layout pt-40 pb-40 pt-sm-0" data-bg-img="images/pattern/p13.png">

     <?php
       if (isset($_GET['read_journal'])) {
          $id = $_GET['read_journal'];
          $s = 'select * from journals where id='.$id.'';
            $r = mysqli_query($connection,$s);
            $check_status = mysqli_num_rows($r);
                $r = mysqli_query($connection,$s);
                  $check_status = mysqli_num_rows($r);
                   while ($row=mysqli_fetch_assoc($r)) {
                     $id = $row["id"];
                     $j_id = $row["id"];
                      $tittle = $row["tittle"];
                       $type = $row["type"];
                        $detail = $row["detail"];
                       $cover_photo = $row["cover_photo"];
                      $posted_by = $row["author"];
                     $jdate = $row["jdate"];
                   $status = $row["status"];
                  $readings = $row["readings"];
                 $likes = $row["likes"];
               $comments= $row["comments"];
             $created_at = $row["created_at"];
              } // story while loop


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
                                <h2 class="title text-white">Journals Details</h2>
                                <ol class="breadcrumb text-left text-black mt-10">
                                  <li><a href="index.php">Home</a></li>
                                  <li class="active text-gray-silver">Journals Details</li>
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
                                    <div class="post-thumb thumb"> <img src="../journalsImages/<?php echo $cover_photo ?>" alt="" class="img-responsive img-fullwidth"> </div>
                                  </div>
                                  <div class="entry-title pt-10 pl-15">
                                    <h4><a class="text-uppercase" href="#"> <?php echo $tittle ?> </a></h4>
                                  </div>
                                  <div class="entry-meta pl-15">
                                    <ul class="list-inline">
                                      <li>Posted: <span class="text-theme-color-2 text-danger"><?php echo  date('d/m/Y',strtotime($created_at)); ?></span></li>
                                      <li>By: <span class="text-theme-color-2 text-capitalize text-danger"> <?php echo $posted_by; ?> </span></li>
                                      <li><i class="fa fa-comments-o ml-5"></i> <span class="text-danger"><?php echo $comments; ?></span> comments</li>
                                      <li><i class="fa fa-eye ml-5"></i> <span class="text-danger"><?php echo $readings; ?></span>  Views</li>
                                      <li>
                                      <?php
                                        $sql = "SELECT * FROM likeunlike where bookid='.$j_id.' and type='journals'";
                                          $resultt =mysqli_query($connection,$sql);
                                            $results = mysqli_num_rows($resultt);
                                              if ($results == 1){
                                                echo '
                                                <span class="unlike fa fa-thumbs-up ml-5" data-id="'.$j_id.'"> Likes </span>
                                                <span class="like hide fa fa-thumbs-o-up ml-5" data-id="'.$j_id.'"> Likes </span>
                                                ';
                                               }else {
                                              echo '
                                              <span class="like fa fa-thumbs-o-up ml-5" data-id="'.$j_id.'"> Likes </span>
                                              <span class="unlike hide fa fa-thumbs-up ml-5 " data-id="'.$j_id.'"> Likes </span>
                                              ';
                                            }
                                        ?>
                                        <span class="likes_count text-danger"><?php echo $likes; ?>  </span>
                                     </li>
                                    </ul>
                                  </div>
                                  <div class="entry-content mt-10">
                                    <blockquote class="theme-colored pt-20 pb-20">
                                      <p  class="text-primary"> <?php echo $tittle; ?></p>
                                    </blockquote>
                                      <p class="border"><?php echo $detail; ?></p>
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
                                             $s = "SELECT * FROM journals where status='0' and id='$id'";
                                                $r = mysqli_query($connection,$s);
                                                  $check_chapters=mysqli_num_rows($r);
                                                  if ($check_chapters>0) {
                                                    while ($row=mysqli_fetch_assoc($r)) {
                                                    $id = $row['id'];
                                                    $tittle = $row['tittle'];
                                                  ?>
                                                   <a class='badge badge-success'href=""> <?php echo $tittle ?> </a>
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
                                       $com = 'select * from public_comments where book_id='.$j_id.' and post_id=0 and type="journals"';
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
                                      <div class="media comment-author"> <a class="media-left pull-left flip" href="#"><img class="img-thumbnail" src="../adminprofileImage/comment.jpg" alt=""></a>
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
                                         <div class="media comment-author"> <a class="media-left pull-left flip" href="#"><img class="img-thumbnail" src="../adminprofileImage/comment.jpg" alt=""></a>
                                           <div class="media-body">
                                             <h5 class="media-heading comment-heading text-capitalize">Admin</h5>
                                             <div class="comment-date text-danger"> 17/4/2021</div>
                                             <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum quia, eaque tempora eligendi facere excepturi facilis earum
                                               inventore harum dolores. Maxime, aspernatur. Voluptatum, sit.</p>
                                         </div>
                                       </li>
                                      <?php
                                     }// else
                                   ?>
                                  </ul>
                                </div>
                                <hr>
                                <div class="comment-box">
                                  <?php
                                  // sending to datbase
                                  if (isset($_POST['save_comment'])) {
                                      $name =$_POST['name'];
                                        $email =$_POST['email'];
                                          $book_id =$_POST['book_id'];
                                            $post_id =$_POST['post_id'];
                                              $message =$_POST['message'];
                                                $type =$_POST['type'];
                                                  $query = "INSERT INTO public_comments (name,email,book_id,post_id,message,type)VALUES('$name','$email','$book_id','$post_id','$message','$type') limit 1";
                                                   $success = mysqli_query($connection, $query);
                                               if ($success) {
                                                 $sql = "SELECT count(*) FROM public_comments where book_id='$j_id'";
                                                 $result =mysqli_query($connection,$sql);
                                                   while($row =mysqli_fetch_assoc($result)){
                                                   $count_comments= $row['count(*)'];
                                                  }
                                                 $sum = $count_comments;
                                               mysqli_query($connection, "UPDATE journals SET comments=$sum WHERE id=".$j_id);
                                              echo '
                                              <div class="alert alert-success  alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                               <strong> Comment is Published ! </strong>
                                             </div>
                                            ';
                                            header("Refresh:0,url=read_journal.php?read_journal=$j_id");
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
                                  <div class="row ">
                                    <div class="col-sm-12">
                                      <h5>Leave a Comment</h5>
                                      <div class="row formrow">
                                        <form method="post" id="comment-form">
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <input type="text" class="form-control" required name="name"autocomplete="off" id="contact_name" placeholder="Enter Name">
                                            </div>
                                            <div class="form-group">
                                              <input type="email" required class="form-control" name="email"autocomplete="off" id="contact_email2" placeholder="Enter Email">
                                            </div>
                                            <div class="form-group">
                                              <input type="hidden" placeholder="Story ID" required class="form-control"value="<?php echo $j_id; ?>" name="book_id">
                                            </div>
                                            <div class="form-group">
                                              <input type="hidden" placeholder="Story ID" required class="form-control"value="0" name="post_id">
                                            </div>
                                            <div class="form-group">
                                              <input type="hidden" placeholder="Story ID" required class="form-control"value="journals" name="type">
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <textarea class="form-control" required name="message" id="contact_message2"  placeholder="Enter Message" rows="5"></textarea>
                                            </div>
                                            <div class="form-group">
                                              <button type="submit"name="save_comment" class="btn btn-dark btn-flat pull-right mb-2" data-loading-text="Please wait...">Submit</button>
                                            </div>
                                          </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div> <!--comment div-->

                              </div>
                            </div>

                            <div class="col-sm-12 col-md-4">
                              <div class="sidebar sidebar-left mt-sm-30 ml-40">
                                <div class="widget">
                                  <h4 class="widget-title line-bottom text-muted">Related <span class="text-theme-color-2 text-danger">Journals</span></h4>
                                  <?php
                                   $query = "SELECT * FROM journals Except SELECT * FROM journals WHERE id =$j_id";
                                        $r = mysqli_query($connection,$query);
                                          $count_story = mysqli_num_rows($r);
                                             while ($row=mysqli_fetch_assoc($r)) {
                                               $id = $row["id"];
                                               $j_id = $row["id"];
                                                $tittle = $row["tittle"];
                                              $type = $row["type"];
                                             $detail = $row["detail"];
                                            $cover_photo = $row["cover_photo"];
                                           $posted_by = $row["author"];
                                           $readings = $row["readings"];
                                          $likes = $row["likes"];
                                        $jdate = $row["jdate"];
                                      $status = $row["status"];
                                    $created_at = $row["created_at"];
                                  ?>
                                  <div class="single-blog-post small-featured-post d-flex">
                                      <div class="post-thumb">
                                          <a href="#">
                                            <?php
                                              if (!$cover_photo) {
                                                ?>
                                                <img class="" src="../journalsImages/placeholder1.jpg" alt="">
                                               <?php
                                               }else{
                                               ?>
                                               <img class="m-3" src="../journalsImages/<?php echo $cover_photo ?>" alt=""height="100px"width="100%">
                                               <?php
                                              }
                                            ?>

                                          </a>
                                      </div>
                                      <div class="post-data">
                                          <a href="read_journal.php?read_journal=<?php echo $id; ?>"data-id="<?php echo $id ?>" class="readj post-catagory text-capitalize text-primary"><?php echo $tittle ?></a>
                                          <div class="post-meta">
                                              <a href="#" class="post-title">
                                                <?php $string = $detail;
                                                  if (strlen($string) > 45) {
                                                    ?>
                                                     <p class="small font-italic"> <?php echo   $trimstring = substr($string, 0, 120). '...'; ?> </p>
                                                    <?php
                                                    }else {
                                                    ?>
                                                    <p class="small text-primary font-italic">This is about user paragraph and if you want to know more about me click  ...</p>
                                                    <?php
                                                    }
                                                  ?>
                                              </a>
                                              <p class="post-date"><span><?php echo date('h:i A',strtotime($created_at ))?></span> | <span><?php echo date('F j,Y',strtotime($created_at ))?></span></p>
                                          </div>
                                      </div>
                                   </div>
                                  <?php } ?>
                                  <hr>
                                </div> <!--related journals-->
                                <div class="widget">
                                  <h4 class="widget-title line-bottom text-muted">Related <span class="text-theme-color-2 text-danger">STORIES</span></h4>
                                  <?php
                                   $query = "SELECT * FROM stories";
                                        $r = mysqli_query($connection,$query);
                                          $count_story = mysqli_num_rows($r);
                                             while ($row=mysqli_fetch_assoc($r)) {
                                               $id = $row["id"];
                                              $b_tittle = $row["b_tittle"];
                                             $b_type = $row["b_type"];
                                          $b_description = $row["b_description"];
                                        $cover_photo = $row["cover_photo"];
                                      $b_author = $row["b_author"];
                                    $current_date = $row["current_date"];
                                  ?>
                                  <div class="single-blog-post small-featured-post d-flex">
                                      <div class="post-thumb">
                                          <a href="#">
                                            <?php
                                              if (!$cover_photo) {
                                                ?>
                                                <img class="" src="../coverphotos/placeholder1.jpg" alt="">
                                               <?php
                                               }else{
                                               ?>
                                               <img class="m-3" src="../coverphotos/<?php echo $cover_photo ?>" alt=""height="100px"width="100%">
                                               <?php
                                              }
                                            ?>
                                          </a>
                                      </div>
                                      <div class="post-data">
                                          <a href="view_one_story.php?read_story=<?php echo $id; ?>" class="post-catagory text-capitalize text-primary"><?php echo $b_tittle ?></a>
                                          <div class="post-meta">
                                              <a href="#" class="post-title">
                                                <?php $string = $b_description;
                                                  if (strlen($string) > 45) {
                                                    ?>
                                                     <p class="small font-italic"> <?php echo   $trimstring = substr($string, 0, 120). '...'; ?> </p>
                                                    <?php
                                                    }else {
                                                    ?>
                                                    <p class="small text-primary font-italic">This is about user paragraph and if you want to know more about me click  ...</p>
                                                    <?php
                                                    }
                                                  ?>
                                              </a>
                                              <p class="post-date text-capitalize"><span><?php echo $b_author?></span> | <span><?php echo date('F j,Y',strtotime($current_date ))?></span></p>
                                          </div>
                                       </div>
                                    </div>
                                 <?php } ?>
                               </div>  <!--related STORIES-->
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
          <?php include 'includes/footer.php'; ?>
        <a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
     </div>
   <!-- end wrapper -->
 </body>
</html>

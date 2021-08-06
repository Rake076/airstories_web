<?php
session_start();
ob_start();
include '../db.php';

date_default_timezone_set('Asia/karachi');
 ?>
<!DOCTYPE html>
<html>
<head>
  <title>User-Journal</title>
     <?php include '../includes/head.php'; ?>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

<style media="screen">
  .hr{
    margin-top: 1rem;
    margin-bottom: 2rem;
    border: 0;
    border-top: 5px solid rgba(25,15,3,.1);
    background-color: darkturquoise;
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

.noti_style{
    border-radius: 10px;
    margin: -9px;
    padding: 5px;
}
.dropdown-item-title {
    font-size: initial;
    margin: 0;
}
.dropdown-menu-lg .dropdown-item {
    padding: 0.5rem;
    font-size: medium;
}
.formrow{
margin-right: -15px !important;
margin-left: -15px !important;
display: contents !important;
}
.styled-icons{

}
.styled-icons.icon-circled a {
  border-radius: 50%;
}
.styled-icons.icon-circled a {
  border-radius: 50%;
background-color: cadetblue;
margin-left: 32px;
margin-bottom: 15px;
}
.styled-icons a {
  color: #333333;
  font-size: 18px;
  height: 32px;
  line-height: 32px;
  width: 32px;
  float: left;
  margin: 5px 7px 5px 0;
  text-align: center;
  -webkit-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
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
                  <h1 class="m-0">Reading Journal </h1>
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
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Home</li>
                    <li class="breadcrumb-item active">Read Journalism </li>
                  </ol>
                </div><!-- /.col -->
              </div><!-- /.row -->
              <hr>
              <a href="create_journal.php"class="btn btn-danger btn-outline-success">Create New</a>
              <a href="view_journal.php"class="btn btn-primary btn-outline-primary">View </a>
              <hr>
            </div><!-- /.container-fluid -->
          </div>
          <!-- /.content-header -->
       <?php
       // getting admin's table for update
             if (isset($_GET['read_journal'])) {
               $id = $_GET['read_journal'];
                 $query="select * from journals where id='$id'";
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
                   $jdate = $row["jdate"];
                  $status = $row["status"];
                 $readings = $row["readings"];
                $likes = $row["likes"];
                $comments= $row["comments"];
               $created_at = $row["created_at"];
             } // while loop
        ?>

         <?php
           //if ($status==0) {
           ?>
           <section class="content">
               <div class="container-fluid">
                 <div class="row">
                   <div class="col-md-8 blog-pull-right">
                     <div class="blog-posts single-post">
                       <article class="post clearfix mb-0">
                         <div class="entry-header">
                           <div class="post-thumb thumb">
                              <?php
                                if ($cover_photo) {
                                  ?>
                                  <img src="../journalsImages/<?php echo $cover_photo ?>" alt="" class=" img-fullwidth"width="100%"height="400px">
                                 <?php
                                 }else{
                                 ?>
                                 <img src="../journalsImages/placeholder1.jgp" alt="" class="img-responsive img-fullwidth">
                                 <?php
                                }
                              ?>
                           </div>
                         </div>
                         <div class="entry-title pt-10 pl-15">
                           <h4><a class="text-uppercase" href="#"> <?php echo $tittle ?>  </a></h4>
                         </div>
                         <div class="entry-meta pl-15">
                           <ul class="list-inline">
                             <li>Posted: <span class="text-theme-color-2 text-danger"><?php echo  date('d/m/Y',strtotime($created_at)); ?></span></li>
                             <li>By: <span class="text-theme-color-2 text-capitalize text-danger"> <?php echo $posted_by; ?> </span></li>
                             <!-- <li><i class="fa fa-comments-o ml-5"></i> <span class="text-danger"><?php echo $comments; ?></span> comments</li> -->
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
                         <div class="">
                            <span class="text-secondary ">Description</span>
                           <blockquote class="theme-colored pt-20 pb-20">
                             <p  class="text-primary m-5"> <?php echo $detail; ?></p>
                           </blockquote>
                        
                           <div class="mt-30 mb-0">
                             <h5 class="pull-left mt-10 mr-20 text-theme-color-2 text-danger">Share:</h5>
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
<!--                        <div class="tagline p-0 pt-20 mt-5">
                         <div class="row">
                           <div class="col-md-8">
                             <div class="tags">
                               <p class="mb-0"><i class="fa fa-tags text-theme-color-2"></i> <span>Tags:</span>
                                 <?php
                                    $s = "SELECT * FROM journals where status='1' and id='$id'";
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
                               <p><i class="fa fa-share-alt text-theme-color-2 text-danger"></i> Share</p>
                             </div>
                           </div>
                         </div>
                       </div> -->
<!--                        <div class="comments-area">
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

                       </div> -->
<!--                        <hr>
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
                       </div> -->
                     </div>
                   </div>
                   <div class="col-md-4">
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
                                      <img class="m-3" src="../journalsImages/<?php echo $cover_photo ?>" alt=""height="100px"width="100px">
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
                       </div> <!--related journals-->
                    </div> <!-- Realated Sidebar-->
                   </div>
                 </div>
               </div>
             </section>

             <?php
               
            } // if journal_read
          ?>
        <!-- Story Details end here  -->
      </div> <!-- contecnt wrapper -->
    <?php include '../includes/footer.php'; ?>

    <script>
    	$(document).ready(function(){
    		// when the user clicks on like
    		$('.like').on('click', function(){
    			var jid = $(this).data('id');
    			    $post = $(this);

    			$.ajax({
    				url: 'like_unlike_code.php',
    				type: 'post',
    				data: {
    					'likedj': 1,
    					'jid': jid
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
    			var jid = $(this).data('id');
    		    $post = $(this);

    			$.ajax({
    				url: 'like_unlike_code.php',
    				type: 'post',
    				data: {
    					'unlikedj': 1,
    					'jid': jid
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

  </body>
</html>

<?php
session_start();  // to start session
    ob_start();  // for  header already sent error
  ?>
<!DOCTYPE html>
<html>
<head>
     <!--to view gallery images -->
     <link rel="stylesheet" href="includes/ekko-lightbox/ekko-lightbox.css">
     <?php include 'includes/head.php'; ?>
<style media="screen">

table {
    color: #333;
    font-family: Helvetica, Arial, sans-serif;
    width: 640px;
    border-collapse: collapse;
    border-spacing: 0;
}
td, th {
    border: 1px solid transparent; /* No more visible border */
    height: 30px;
    font-size: 11px;
}
th {
    background: #DFDFDF;  /* Darken header a bit */
    font-weight: bold;
}
td {
    background: #FAFAFA;
    text-align: center;
}
.pro_item{
  color: #333;
  font-family: Helvetica, Arial, sans-serif;
  font-size: 14px;
}
.pro_item li a{
  color: #333;
  font-family: Helvetica, Arial, sans-serif;
  font-size: 14px;
}

</style>
<style>

.image {
  opacity: 1;
  display: block;
  width: 100%;
  height: auto;
  transition: .5s ease;
  backface-visibility: hidden;
}

.middle {
  transition: .5s ease;
  opacity: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
}


.container:hover .middle {
  opacity: 1;

  color: red;
  font-size: 52px !important;
  padding: 16px 3px;
  margin-bottom: 140px;
  font-weight: bolder;
}
.btn-primary {
  font-family: Raleway-SemiBold;
  font-size: 13px;
  color: rgba(58, 133, 191, 0.75);
  letter-spacing: 1px;
  line-height: 15px;
  border: 2px solid rgba(58, 133, 191, 0.75);
  border-radius: 40px;
  background: transparent;
  transition: all 0.3s ease 0s;
}

.btn-primary:hover {
  color: #FFF;
  background: rgba(58, 133, 191, 0.75);
  border: 2px solid rgba(58, 133, 191, 0.75);
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
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Story Details: </h1>
            <?php
            $u_email = $_SESSION['u_email'];
             $u_password = $_SESSION['u_password'];
              if (isset($_GET['story_details'])) {
                 $id = $_GET['story_details'];
                 $s = 'select * from stories where id='.$id.'';
                   $r = mysqli_query($connection,$s);
                   $check_story_detail = mysqli_num_rows($r);
                    while ($row=mysqli_fetch_assoc($r)) {
                      $id = $row["id"];
                      $storyid = $row["id"];
                      $b_tittle = $row["b_tittle"];
                      $b_type = $row["b_type"];
                      $b_description = $row["b_description"];
                      $cover_photo = $row["cover_photo"];
                      $b_author = $row["b_author"];
                      $b_status = $row["b_status"];
                    }
                 }
             ?>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active ">Story Details </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <hr>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->

    <!-- Large modal start inserting form -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-center" id="exampleModalLabel"> Tittle : <?php echo $b_tittle; ?> </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <?php
            $ss = 'select * from storychapters where s_id='.$id.'';
              $rr = mysqli_query($connection,$ss);
               while ($row=mysqli_fetch_assoc($rr)) {
                 $id = $row['id'];
                 $chapter_name = $row['chapter_name'];
                  $chapter_text = $row['chapter_text'];
               }
             ?>
            <div class="container ">
              <div class="row">
                <div class="col-md-12">
                   <div class="container-fluid">
                     <div class="row">
                       <div class="col-md-4">
                         <img class="profile-user-img img-fluid "src="../coverphotos/<?php echo $cover_photo; ?>"height="100px">
                          <hr>
                        </div> <!--main row -->
                        <div class="col-md-4 offset-2">
                          <h6 class="float-right text-muted font-weight-bold p-2">Author Name : <span class="text-secondary"> <?php echo $b_author; ?> </span> </h6>
                        </div>
                      </div> <!--row -->
                      <div class="row">
                        <div class="col-md-6">
                           <h4> <?php echo $chapter_name; ?> </h4>
                         </div> <!--main row -->
                         <div class="col-md-6">
                          </div> <!--main row -->
                       </div> <!--row -->
                      <div class="row">
                        <div class="col-md-6 offset-3">
                           <hr>
                         </div> <!--main row -->
                       </div> <!--row -->
                      <div class="row">
                        <div class="col-md-10 offset-1 text-muted">
                             <div class="chapter_text">
                               <p class="chapter_text"> <?php echo $chapter_text; ?> </p>
                             </div>

                         </div> <!--main row -->
                       </div> <!--row -->
                       <hr>
                       <div class="row">
                         <div class="col-md-3">
                            <p class="text-secondary">Likes: </p>
                          </div> <!--main row -->
                          <div class="col-md-3">
                             <p class="text-secondary">Views: </p>
                           </div> <!--main row -->
                           <div class="col-md-3">
                              <p class="text-secondary">comments: </p>
                            </div> <!--main row -->
                        </div> <!--row -->
                    </div> <!--modal body -->

                    <!--comment section start here -->
                  <hr>
                    <div class="container-fluid mt-2">
                      <div class="row">
                        <div class="col-md-12">
                          <form method="post"enctype='multipart/form-data'>
                            <div class="form-row">
                              <div class="form-group col-md-12">
                                <label for="inputEmail4">Name</label>
                                <input type="text" class="form-control form-control-sm"name="name"value=""  placeholder="">
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
                                <button type="submit"name="save_comment" class="btn btn-success btn-block btn-sm m-2 float-right">Send</button>
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

              </div>
          </div>
        </div>
      </div>
      <!-- Large modal end  -->


    <section class="content">
      <div class="contact1">
         <div class="container-contact1">
           <div class="container">
             <button class=" btn m-1 btn-xs btn-outline-info "><i class="fa fa-plus" aria-hidden="true"> <a href="create_story.php">Back</a> </i></button>
             <span class="contact1-form-title text-center">
                 Story Details

                 <!-- <button class=" btn m-1 btn-xs btn-outline-warning float-right p-2 mb-1">
                <i class="fa fa-plus" aria-hidden="true"data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"data-backdrop="static" data-keyboard="false">Read Story </i>
              </button> -->

              </span> <hr>
                <div class="row justify-content-around">
                   <div class="col-12">
                     <!-- Main content -->
                     <section class="content">
                       <div class="container-fluid">
                         <div class="row">
                           <div class="col-md-3">
                             <!-- Profile Image -->
                             <div class="card card-info card-outline">
                               <div class="card-body box-profile">
                                 <div class="text-center">
                                   <?php
                                     if($cover_photo) {
                                        echo '<img class="profile-user-img img-fluid "src="../coverphotos/'.$cover_photo.'"height="100px">';
                                        }else{
                                       echo'
                                       <div class="middle">
                                         <a href="#" class="text-danger">Story Not Exist</a>
                                       </div>
                                       ';
                                       echo '<img class="profile-user-img img-fluid "src="../coverphotos/placeholder.jpg"height="100px">';

                                     }
                                    ?>
                                 </div>
                                 <h3 class="profile-username text-center text-capitalize">
                                  <?php
                                   if ($b_tittle) {
                                      echo '<a  class="font-weight-bold text-capitalize text-success"> '.$b_tittle.' </a>';
                                    }else {
                                     echo "Book tittle not Found";
                                   }
                                  ?>
                                 </h3>
                               </div>
                               <!-- social media-->
                               <!-- <div class=" share-btn-container styled-icons icon-circled m-0">
                                 <a class=""data-bg-color="#3A5795" href="https://facebook.com/sharer/sharer.php?u=<?php echo urlencode($url) ?>" target="_blank">
                                    <i class="fa fa-facebook text-white"></i>
                                 </a>
                                 <a data-bg-color="#55ACEE" href="https://twitter.com/intent/tweet/?text=<?php echo urlencode($message) ?>&amp;url=<?php echo urlencode($url) ?>" target="_blank">
                                    <i class="fa fa-twitter text-white"></i>
                                 </a>
                                 <a data-bg-color="#A11312"  href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo urlencode($url) ?>&amp;title=<?php echo urlencode($message) ?>&amp;summary=<?php echo urlencode($message) ?>&amp;source=<?php echo urlencode($url) ?>" target="_blank">
                                    <i class="fa fa-linkedin text-white"></i>
                                 </a>
                               </div> -->
                               <!-- /.card-body -->
                             </div> <!-- /.card tittle and image -->
                             <div class="card ">
                               <div class="card-body box-profile">
                                 <h6 class="text-muted m-2">Chapters </h6>
                                  <hr>
                                 <?php
                                    $story_chapter_query = 'select * from storychapters where s_id='.$storyid.'';
                                       $story_chapter_query_check = mysqli_query($connection,$story_chapter_query);
                                         while ($row=mysqli_fetch_assoc($story_chapter_query_check)) {
                                         $id = $row['id'];
                                         $chapter_name = $row['chapter_name'];
                                         $chapter_text = $row['chapter_text'];
                                         $status = $row['status'];
                                         ?>
                                        <ul class="text-primary">
                                          <li style="list-style-type: circle;"> <?php echo $chapter_name ?></li>
                                        </ul>
                                      <?php
                                      if ($status == 1) {
                                        echo "<a class='badge badge-danger float-right'> Un-Published  </a> ";
                                        echo "<hr class='m-4'>";
                                        }else {
                                         echo " <a class='badge badge-success float-right'> Published  </a> ";
                                         echo "<hr class='m-4'>";
                                       }
                                     }
                                   ?>
                               </div>
                             </div><!-- /.card chapter list -->

                           </div> <!-- /.col-md-3-->
                           <div class="col-md-9">
                             <div class="card card-outline card-info">
                               <div class="card-header p-2">
                                 <ul class="nav nav-pills">
                                 </ul>
                               </div><!-- /.card-header -->
                               <div class="card-body">
                                 <h5 class="text-muted m-2">Story Information </h5>
                                  <hr>
                                 <div class="tab-content">
                                   <?php
                                     // delete code
                                      if (isset($_GET['delete'])) {
                                        $id = $_GET['delete'];
                                          $result = $obj->delete($id, 'stories');
                                        if ($result) {
                                          echo '
                                          <div class="alert alert-success  alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                           <strong> Data Deleted Successfully ! </strong>
                                         </div>
                                         ';
                                         header('location:story_details.php');
                                        } else {
                                          echo '
                                           <div class="alert alert-danger  alert-dismissible">
                                             <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <strong> Sorry Data Not Deleted Try Again ! </strong>
                                          </div>
                                          ';
                                         header('Refresh:1,url=story_details.php');
                                        }

                                      }
                                    ?>
                                   <table class="table table-bordered table-hover"id="commentTable" >
                                     <thead>
                                       <tr>
                                         <th> Tittle </th>
                                           <th> Type  </th>
                                            <th> Status </th>
                                           <th>  Description </th>
                                         <th>  Author </th>
                                       </tr>
                                      </thead>
                                       <tbody>
                                           <tr>
                                            <?php
                                              if ($check_story_detail>0) {
                                                // code...
                                                ?>
                                                <td class="text-capitalize"><?php echo $b_tittle  ?></td>
                                                <td><?php echo $b_type  ?></td>
                                                <td><?php echo $b_status  ?></td>
                                                <td><?php echo $b_description  ?></td>
                                                <td><?php echo $b_author  ?></td>
                                                <?php
                                                }
                                                else {
                                                  echo "data not found";
                                                }
                                               ?>
                                           </tr>
                                         </tbody>
                                      </table>
                                   </div><!-- /.card-body -->
                                 </div>
                                <!-- /.card -->
                              </div>
                           <!-- /.comment section start here  -->
                             <div class="row card">
                               <h5 class="text-muted m-2">Story Comments </h5>
                                <hr>
                                 <div class="col-md-12">
                                   <table class="table table-bordered table-hover "id="reviewTable" >
                                     <thead>
                                       <tr>
                                          <th> Story Name  </th>
                                           <th> Atuhor  </th>
                                           <th>  Comment </th>
                                           <th>  Create_at </th>
                                       </tr>
                                      </thead>
                                       <tbody>
                                         <?php
                                            $comments_query = 'select * from comments where book_id='.$storyid.'';
                                              $comments_query_check = mysqli_query($connection,$comments_query);
                                                while ($row=mysqli_fetch_assoc($comments_query_check)) {
                                                  $id = $row["id"];
                                                   $book_id = $row["book_id"];
                                                  $comment = $row["comment"];
                                                 $created_at = $row["created_at"];
                                               ?>
                                           <tr>
                                                <td class="text-capitalize"><?php echo $b_tittle  ?></td>
                                                <td><?php echo $b_author  ?></td>
                                                <td><?php echo $comment  ?></td>
                                                <td><?php echo $created_at  ?></td>
                                           </tr>
                                         <?php } ?>
                                       </tbody>
                                    </table>
                                 </div>
                               </div>
                           <!-- /.comment section end here  -->

                           <!-- /.Revew section start here  -->
                             <div class="row card">
                               <h5 class="text-muted m-2">Story Reviews </h5>
                                <hr>
                                 <div class="col-md-12">
                                   <table class="table table-bordered table-hover table-sm"id="sampleTable" >
                                     <thead>
                                       <tr>
                                         <th> BOOK/Story </th>
                                         <th>  Reviews Details </th>
                                       </tr>
                                      </thead>
                                       <tbody>
                                         <?php
                                            $review_query = 'select * from reviews where book_id='.$storyid.'';
                                              $review_query_check = mysqli_query($connection,$review_query);
                                                while ($row=mysqli_fetch_assoc($review_query_check)) {
                                                  $id = $row["id"];
                                                   $book_id = $row["book_id"];
                                                  $review = $row["review"];
                                                 $created_at = $row["created_at"];
                                               ?>
                                               <?php
                                               $story_query = 'select * from stories where id='.$book_id.'';
                                                 $story_query_check = mysqli_query($connection,$story_query);
                                                  while ($row=mysqli_fetch_assoc($story_query_check)) {
                                                    $id = $row['id'];
                                                    $b_tittle = $row['b_tittle'];
                                                    $b_author = $row['b_author'];
                                                    $cover_photo = $row['cover_photo'];
                                                  }
                                                ?>
                                           <tr>
                                                <td class="text-capitalize"> <?php echo $b_tittle  ?> </td>
                                                <td><?php echo $review  ?></td>
                                           </tr>
                                         <?php } ?>
                                      </tbody>
                                   </table>
                                 </div>
                               </div>
                           <!-- /.review section end here  -->

                           <!-- /.Reports section start here  -->
                             <div class="row card">
                               <h5 class="text-muted m-2">Reporting Reason </h5>
                                <hr>
                                 <div class="col-md-12">
                                   <table class="table table-bordered table-hover table-sm"id="reportTable" >
                                     <thead>
                                       <tr>
                                         <th> BOOK/Story </th>
                                         <th> Report Reason </th>
                                       </tr>
                                      </thead>
                                       <tbody>
                                         <?php
                                            $report_query = 'select * from reports where book_id='.$storyid.'';
                                              $report_query_check = mysqli_query($connection,$report_query);
                                                while ($row=mysqli_fetch_assoc($report_query_check)) {
                                                  $id = $row["id"];
                                                   $book_id = $row["book_id"];
                                                  $report_reason = $row["report_reason"];
                                               ?>
                                           <tr>
                                                <td class="text-capitalize"> <?php echo $b_tittle  ?> </td>
                                                <td><?php echo $report_reason  ?></td>
                                           </tr>
                                         <?php } ?>
                                      </tbody>
                                   </table>
                                 </div>
                               </div>
                           <!-- /.Report section end here  -->

                          </div>
                         <!-- col-md-9 -->
                       </div><!-- /.container-fluid -->
                     </section>
                     <!-- /.content -->
                   </div>
                  </div>
                </div>
              </div>
             </div>
           </div>
         </section>
        </div> <!-- contecnt wrapper -->
      </div><!-- /.container-fluid -->

   <?php include 'includes/footer.php'; ?>


</body>
</html>

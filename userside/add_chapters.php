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
  .note-editor .note-editing-area .note-editable {
    outline: none;
    height: 121px;
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
                  <h1 class="m-0 text-dark text-md text-muted">Create Chapters </h1>
                  <a href="view_stories.php"class="btn btn-sm btn-outline-danger ">Back</a>
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Home</li>
                    <li class="breadcrumb-item active">story Chapters</li>
                  </ol>
                </div><!-- /.col -->
              </div><!-- /.row -->
              <hr>
            </div><!-- /.container-fluid -->
          </div>
          <!-- /.content-header -->
        <?php
           if (isset($_GET['add_chapters'])) {
             $id = $_GET['add_chapters'];
                 $s = 'select * from stories where id='.$id.'';
                  $r = mysqli_query($connection,$s);
                   while ($row=mysqli_fetch_assoc($r)) {
                     $id = $row["id"];
                     $story = $row["id"];
                     $b_tittle = $row["b_tittle"];
                     $b_type = $row["b_type"];
                     $b_description = $row["b_description"];
                     $cover_photo = $row["cover_photo"];
                     $b_author = $row["b_author"];
                     $b_status = $row["b_status"];
                }
             }
           ?>

           <?php
             // delete code
              if (isset($_GET['delete'])) {
                $id = $_GET['delete'];
                  $result = $obj->delete($id, 'storychapters');
                if ($result) {
                 header("Location:all_stories.php");
                } else {
                  echo '
                   <div class="alert alert-danger  alert-dismissible">
                     <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong> Sorry Data Not Deleted Try Again ! </strong>
                  </div>
                  ';
                  // header('Refresh:0,url=add_chapters.php?add_chapters='.$id.'');
                }

              }
            ?>
              <!-- Main content -->
          <section class="content">
           <div class="container-fluid">
             <div class="row">
               <div class="col-md-8 offset-2 mb-2">
                 <?php require 'create_chapters_code.php'; ?>
               </div>
             </div>
            <div class="row">
             <div class="col-md-12"> <!-- /.col -->
               <form method="post"enctype='multipart/form-data'>
                 <div class="form-group col-md-4">
                   <input type="hidden" class="form-control form-control-sm"name="s_id"value="<?php echo $id ?>"  placeholder="">
                 </div>
                 <div class="form-row">
                   <div class="form-group col-md-4">
                     <label for="inputEmail4"class="text-muted">Chapter Title</label>
                     <input type="text" class="form-control form-control-sm"name="chapter_name"value="<?php echo $chapter_name ?>"placeholder="Chapter Tittle" autocomplete="off">
                   </div>
                   <div class="form-group col-md-8">
                     <label for="inputEmail4"class="text-muted">Chapter Description</label>
                     <textarea id="txtTest" runat="server"name="chapter_text"placeholder="write here..."></textarea>
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
                     <button type="submit"name="save_chapter" class="btn btn-success btn-block btn-sm float-right">Save</button>
                   </form>
                   </div>
                 </div>
                 </div>

              </div> <!-- /.col -->
              <hr class="hr">
            </div> <!--1srt form row /.col -->

            <div class="row">
              <div class="col-sm-4">
                <?php
                 // changing status to 0 to publish story
                 if(isset($_GET['story_status1'])){
                  $id=$_GET['story_status1'];
                  $status=$_GET['story_status1'];
                  $query="UPDATE storychapters set status='0' WHERE id='$id'";
                  $service=mysqli_query($connection,$query);
                  if ($service) {
                   $s = 'select * from storychapters where id='.$id.'';
                     $r = mysqli_query($connection,$s);
                      while ($row=mysqli_fetch_assoc($r)) {
                        $s_id = $row["s_id"];
                   }

                  echo '
                  <div class="alert alert-success  alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                   <strong> Story Published Successfully </strong>
                 </div>
                 ';
                 header("Location:add_chapters.php?add_chapters=$s_id ");
                 }
               }
               ?>
               <?php
               // changing status to 1 to publish story
                if(isset($_GET['story_status2'])){
                 $id=$_GET['story_status2'];
                 $status=$_GET['story_status2'];
                 $query="UPDATE storychapters set status='1' WHERE id='$id'";
                 $service=mysqli_query($connection,$query);
                 if ($service) {
                  $s = 'select * from storychapters where id='.$id.'';
                    $r = mysqli_query($connection,$s);
                     while ($row=mysqli_fetch_assoc($r)) {
                       $s_id = $row["s_id"];
                  }
                 echo '
                 <div class="alert alert-warning  alert-dismissible">
                   <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong> Story Un-Published Successfully </strong>
                </div>
                ';
                header("Location:add_chapters.php?add_chapters=$s_id ");
                }
                }
              ?>
              </div>
               <div class="col-md-12"> <!-- /.col -->
              <table class="table table-bordered  table-sm text-muted"id="" >
                <thead>
                  <tr>
                    <th> Story Title </th>
                     <th> Chapter Name </th>
                 </tr>
              </thead>
                 <tbody>
                      <tr>
                        <td>
                          <span class="badge badge-primary badge-pill">
                           <?php
                              echo '<a href="story_details.php?story_details='.$id.' "class="font-weight-bold text-capitalize text-primary">'.$b_tittle.'</a>';
                              ?>
                            </span>
                          </td>
                          <td>
                        <?php
                            $s = 'select * from storychapters where s_id='.$id.'';
                              $r = mysqli_query($connection,$s);
                                while ($row=mysqli_fetch_assoc($r)) {
                                $id = $row['id'];
                                $chapter_name = $row['chapter_name'];
                                $chapter_text = $row['chapter_text'];
                                $status = $row['status'];
                                echo '
                                <ul class="a">
                                <a href="read_chapters.php?read_chapter='.$id.'"target="_blank" class="font-weight-bold text-capitalize text-success">
                                    <li class="">
                                     '.$chapter_name.'<sub class="ml-2 text-primary">'.substr($chapter_text, 0,25).'... </sub>
                                  </li>
                                 </a>
                               </ul>
                             ';
                          ?>
                          |
                           <?php
                            if ($status == 1) {
                               echo '<a href="#"></a>';
                              echo "<a class='badge badge-danger publish text-danger' href='add_chapters.php?story_status1=$id'> Un-Published  </a> ";
                              }else {
                                echo '<a href="#"></a>';
                               echo " <a class='badge badge-success unpublish text-primary' href='add_chapters.php?story_status2=$id'> Published  </a> ";
                             }
                           ?>
                           |
                            <a href="#"></a>
                           <a class="delete float-right mb-2" href="add_chapters.php?delete=<?php echo $id; ?>"><span class="bg-muted">|</span> Delete <span class="bg-muted">|</span> </a>
                           <a class="float-right mr-5" href="update_chapters.php?edit=<?php echo $id; ?>"> <span class="bg-muted">|</span> Edit <span class="bg-muted">|</span> </a>
                           <hr>
                          <?php
                          } // while loop
                          ?>
                        </td>
                     </tr>
                   </tbody>
                 </table>
               </div> <!-- /.col -->
            </div>  <!--table 1st row end -->
          </div>      <!-- container-fluid -->
        </section>
      </div> <!-- contecnt wrapper -->

    <?php include 'includes/footer.php'; ?>

  </body>

</html>

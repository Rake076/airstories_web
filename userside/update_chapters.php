<?php
session_start();
ob_start();
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Update Story Data </title>
    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="assets/css/style.css">

    <style media="screen">

    @media (min-width: 300px) and (max-width: 500px) {

    .container {
       width: 93%;
        padding-right: 5px;
          padding-left: 0;
            margin-right: auto;
          margin-left: auto;
        display: inline-block;
      }
    }
    </style>

  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-10 offset-1">
          <div class="card">
            <div class="card-header text-success font-weight-bold">
              Update Story Data
            </div>
                  <div class="card-body">
                   <?php
                      include '../includes/head.php';
                        include '../db.php';
                     ?>
                     <?php
               // getting admin's table for update
                     if (isset($_GET['edit'])) {
                       $id = $_GET['edit'];
                         $data = $obj->edit($id, 'storychapters');
                          foreach($data as $post){
                             $id = $post["id"];
                             $s_id = $post["s_id"];
                             $chapter_name = $post["chapter_name"];
                             $chapter_text = $post["chapter_text"];

                               // updating admin table
                              if(isset($_POST['update'])){
                                 $chapter_name = $_POST["chapter_name"];
                                  $chapter_text = $_POST["chapter_text"];

                                 $ss="update storychapters set chapter_name='$chapter_name',chapter_text='$chapter_text' where id='$id'";
                                   $s=mysqli_query($connection,$ss);


                                      if($s){
                                        $s = 'select * from stories where id='.$s_id.'';
                                          $r = mysqli_query($connection,$s);
                                           while ($row=mysqli_fetch_assoc($r)) {
                                             $story_id = $row['id'];
                                           }
                                       echo '
                                         <div class="alert alert-success  alert-dismissible">
                                           <button type="button" class="close" data-dismiss="alert">&times;</button>
                                          <strong> Data Updated  Successfully ! </strong>
                                        </div>
                                        ';
                                        header('Refresh:1,url=add_chapters.php?add_chapters='.$story_id.'');
                                      } else {
                                        echo '
                                         <div class="alert alert-warning  alert-dismissible">
                                           <button type="button" class="close" data-dismiss="alert">&times;</button>
                                          <strong> Sorry Data Not Updated Try Again ! </strong>
                                        </div>
                                        ';
                                        // header('Refresh:1,url=add_chapters.php?add_chapters='.$id.'');
                                      }

                                  }
                               }
                            }
                          ?>

                        <div class="container ">
                          <div class="row">
                            <div class="col-md-12">
                               <div class="container-fluid mt-5">
                                 <div class="row">
                                   <div class="col-sm-12">
                                       <div class="col-md-12">

                                         <form method="post"enctype="multipart/form-data">

                                           <div class="form-row">
                                             <div class="form-group col-md-4">
                                               <label for="inputEmail4"class="text-muted">Story Tittle</label>
                                               <input type="text" class="form-control form-control-sm"name="chapter_name"value="<?php if(isset($chapter_name)){ echo $chapter_name; } ?>"  placeholder="Chapter Tittle">
                                             </div>
                                             <div class="form-group col-md-8">
                                               <label for="inputEmail4"class="text-muted">Story Description</label>
                                               <textarea id="txtTest" runat="server"name="chapter_text"placeholder="write here..."><?php if(isset($chapter_text)){ echo $chapter_text; } ?></textarea>
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

                                       </div> <!--1st col-md-4  -->
                                  </div> <!--col-12-->
                                </div> <!--main row -->
                              </div> <!--container fluid -->
                            </div> <!--modal body -->


                         </div>
                         <div class="modal-footer justify-content-between float-right">
                          <button type="submit"name="update" class="btn btn-sm btn-outline-danger ">Save changes</button>
                        </div>
                        <div class="modal-footer justify-content-between float-left">
                          <?php
                          $s = 'select * from stories where id='.$s_id.'';
                            $r = mysqli_query($connection,$s);
                             while ($row=mysqli_fetch_assoc($r)) {
                                $story_id = $row['id'];
                             }
                           ?>
                         <a href="add_chapters.php?add_chapters=<?php echo $story_id ?>"class="btn btn-sm btn-outline-warning ">Back</a>
                       </div>
                      </form>
                      </div>
                    </div>

                 </div>
               </div>
            </div>
          </div>

              <?php include '../includes/footer.php'; ?>

          </body>
        </html>

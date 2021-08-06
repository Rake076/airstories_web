<?php
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
    .note-editor .note-editing-area .note-editable {
        outline: none;
        height: 171px;
    }
    </style>

  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-10 offset-1">
          <div class="card">
            <div class="card-header text-success font-weight-bold">
              Update Story Reviews
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
                         $data = $obj->edit($id, 'reviews');
                          foreach($data as $post){
                            $id = $post["id"];
                             $book_id = $post["book_id"];
                              $review = $post["review"];

                               // updating admin table
                              if(isset($_POST['update'])){
                                 $book_id = $_POST["book_id"];
                                  $review = $_POST["review"];

                                    $s =  $obj->update('reviews',['book_id'=>$book_id,'review'=>$review],'id='.$id.'');

                                      if($s){
                                       echo '
                                         <div class="alert alert-success  alert-dismissible">
                                           <button type="button" class="close" data-dismiss="alert">&times;</button>
                                          <strong> Data Updated  Successfully ! </strong>
                                        </div>
                                        ';
                                        header('Refresh:1,url=reviews.php');
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
                                       <div class="col-md-12 text-muted text-sm">
                                         <form method="post"enctype="multipart/form-data">
                                           <div class="form-row">
                                             <div class="form-group col-md-4">
                                               <label for="inputEmail4"class="text-muted">Story Tittle</label>
                                               <select id="inputState" class="form-control form-control-sm"name="book_id">
                                                  <?php
                                                  $s = 'select * from stories where id='.$book_id.'';
                                                    $r = mysqli_query($connection,$s);
                                                     while ($row=mysqli_fetch_assoc($r)) {
                                                       $rid = $row['id'];
                                                       $b_tittle = $row['b_tittle'];
                                                     }

                                                   ?>
                                                 <option value="<?php if(isset($rid)){echo $rid;} ?>"><?php if(isset($b_tittle)){echo $b_tittle;} ?></option>
                                                 <optgroup label="New Value"></optgroup>
                                                 <?php
                                                 $post_data = $obj->select('stories');
                                                    foreach($post_data as $post){
                                                      $id = $post["id"];
                                                      $b_tittle = $post["b_tittle"];
                                                  ?>
                                                 <option  value="<?php echo $id ?>"><?php echo $b_tittle ?></option>
                                               <?php } ?>
                                               </select>
                                             </div>
                                             <div class="form-group col-md-8">
                                               <label for="inputEmail4"class="text-muted">Story Description</label>
                                               <textarea id="txtTest" runat="server"name="review"placeholder="write here..."><?php echo $review ?></textarea>
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
                         <a href="reviews.php"class="btn btn-sm btn-outline-warning ">Back</a>
                       </div>
                      </form>
                      </div>
                    </div>

                 </div>
               </div>
               <?php include '../includes/footer.php'; ?>
            </div>
          </div>

          </body>
        </html>

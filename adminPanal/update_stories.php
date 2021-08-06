<?php
session_start();
ob_start();
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>AdminSide-Update Story Data </title>
    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="assets/css/style.css">

    <!--image uploading validExtensions--->
    <SCRIPT type="text/javascript">
    function show(input) {
            debugger;
            var validExtensions = ['jpg','png','jpeg']; //array of valid extensions
            var fileName = input.files[0].name;
            var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
            if ($.inArray(fileNameExt, validExtensions) == -1) {
                input.type = ''
                input.type = 'file'
                $('#user_img').attr('src',"");
                alert("Only these file types are accepted : "+validExtensions.join(', '));
            }
            else
            {
            if (input.files && input.files[0]) {
                var filerdr = new FileReader();
                filerdr.onload = function (e) {
                    $('#user_img').attr('src', e.target.result);
                }
                filerdr.readAsDataURL(input.files[0]);
            }
            }
        }
    </SCRIPT>

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
                   $data = $obj->edit($id, 'stories');
                    foreach($data as $post){
                       $id = $post["id"];
                       $b_tittle = $post["b_tittle"];
                       $b_type = $post["b_type"];
                       $b_description = $post["b_description"];
                       $cover_photo = $post["cover_photo"];
                       $b_author = $post["b_author"];
                       $b_status = $post["b_status"];

                         // updating admin table
                        if(isset($_POST['update'])){
                          $b_tittle = $_POST["b_tittle"];
                          $b_type = $_POST["b_type"];
                          $b_description = $_POST["b_description"];
                          $b_author = $_POST["b_author"];
                          $b_status = $_POST["b_status"];
                              $s =  $obj->update('stories',['b_tittle'=>$b_tittle,'b_type'=>$b_type,'b_author'=>$b_author,'b_description'=>$b_description,'b_status'=>$b_status],'id='.$id.'');

                                if($s){

                                  $cover_photo = $_FILES['cover_photo']['name'];
                                  $target_dirr = "../coverphotos/";
                                  $target_file = $target_dirr . basename($_FILES["cover_photo"]["name"]);
                                  move_uploaded_file($_FILES['cover_photo']['tmp_name'],$target_dirr.$cover_photo);

                                  // updating only cover_photo
                                  if (empty($cover_photo)) {
                                    // getting data from empdocuments tabel
                                      $query = "SELECT * FROM stories where id=$id";
                                        $result = $connection->query($query);
                                          if($result->num_rows > 0){
                                          while($row = $result->fetch_assoc()){
                                          $cover_photo = $row['cover_photo'];
                                          }
                                        }
                                       $cover_photo = $cover_photo;
                                      $s =  $obj->update('stories',['cover_photo'=>$cover_photo],'id='.$id.'' );
                                    }else{
                                   $s =  $obj->update('stories',['cover_photo'=>$cover_photo],'id='.$id.'' );
                                  }

                                 echo '
                                   <div class="alert alert-success  alert-dismissible">
                                     <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong> Data Updated  Successfully ! </strong>
                                  </div>
                                  ';
                                  header('Refresh:1,url=view_stories.php?get='.$id.'');
                                } else {
                                  echo '
                                   <div class="alert alert-warning  alert-dismissible">
                                     <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong> Sorry Data Not Updated Try Again ! </strong>
                                  </div>
                                  ';
                               // header('Refresh:1,url=view_company_data.php');
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
                             <div class="col-sm-12 text-muted text-sm">
                                   <form method="post"enctype="multipart/form-data">
                                     <div class="form-row">
                                       <div class="form-group col-md-4">
                                         <label for="inputb_author4">Tittle</label>
                                         <input type="text" class="form-control form-control-sm"name="b_tittle"value="<?php if(isset($b_tittle)){ echo $b_tittle; }?>"  placeholder="Title of Story or Tittle of Book"required>
                                       </div>
                                       <div class="form-group col-md-4">
                                         <label for="inputb_description4">Type</label>
                                         <input type="text" class="form-control form-control-sm"name="b_type"value="<?php if(isset($b_type)){ echo $b_type; } ?>" placeholder="Story Type e.g Lover Story "required>
                                       </div>
                                       <div class="form-group col-md-4">
                                         <label for="inputAddress2">Author Name</label>
                                         <input type="text" class="form-control form-control-sm"name="b_author"value="<?php if(isset($b_author)){ echo $b_author; }?>"placeholder="Author Name" required>
                                       </div>
                                     </div>
                                     <div class="form-row">
                                     <div class="form-group col-md-8">
                                       <label for="inputAddress">Description</label>
                                       <textarea id="txtTest" name="b_description"class="form-control form-control-sm" rows="4" cols="100"><?php echo $b_description ?></textarea>
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
                                     <div class="form-group col-md-4">
                                       <label for="inputState">Status</label>
                                       <select id="inputState" class="form-control form-control-sm"name="b_status"required>
                                         <optgroup label="Old Values">
                                         <option  value="<?php echo $b_status ?>"><?php if(isset($b_status)){ echo $b_status; } ?></option>
                                       </optgroup>
                                         <optgroup label="New Values">
                                           <option value="short_story">Short Story</option>
                                           <option value="completed_story">Completed Story</option>
                                         </optgroup>
                                       </select>
                                   </div>
                                   </div>
                                     <div class="form-row">
                                     <div class="form-group col-md-4">
                                       <img src='../coverphotos/<?php echo $cover_photo; ?>' alt="<?php echo $cover_photo; ?>"height="50px"width="50px">
                                       <label for="inputAddress2">Cover Photo </label>
                                       <input type="file" title="search image" id="file" name="cover_photo" onchange="show(this)" />
                                     </div>
                                   </div>

                            </div> <!--col-12-->
                          </div> <!--main row -->
                        </div> <!--container fluid -->
                      </div> <!--modal body -->


                       </div>
                       <div class="modal-footer justify-content-between float-right">
                        <button type="submit"name="update" class="btn btn-sm btn-outline-danger ">Save changes</button>
                      </div>
                      <div class="modal-footer justify-content-between float-left">
                       <a href="view_stories.php?get=<?php echo $id ?>"class="btn btn-sm btn-outline-warning ">Back</a>
                     </div>
                    </form>
                    </div>
                  </div>
                 <?php include '../includes/footer.php'; ?>
               </div>
              </div>
            </div>
          </div>
          </body>
        </html>

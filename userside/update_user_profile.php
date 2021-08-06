<?php
session_start();
ob_start();
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Update users Profile Image </title>
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
        <div class="col-md-8 offset-2">
          <div class="card">
            <div class="card-header text-success font-weight-bold">
              Update users Data
            </div>
            <div class="card-body">
             <?php
                include 'includes/head.php';
                  include '../db.php';
               ?>
               <?php
         // getting users's table for update
               if (isset($_GET['edit'])) {
                 $id = $_GET['edit'];
                   $data = $obj->edit($id, 'users');
                    foreach($data as $post){
                       $id = $post["id"];
                           $u_profile_image = $post["u_profile_image"];
                           // updating admin table
                          if(isset($_POST['update'])){
                                   $u_profile_image = $_FILES['u_profile_image']['name'];
                                   $target_dir = "../userProfileImage/";
                                   $target_file = $target_dir . basename($_FILES["u_profile_image"]["name"]);
                                   move_uploaded_file($_FILES['u_profile_image']['tmp_name'],$target_dir.$u_profile_image);

                                  $s =  $obj->update('users',['u_profile_image'=>$u_profile_image],'id='.$id.'');

                                  if($s){
                                   echo '
                                     <div class="alert alert-success  alert-dismissible">
                                       <button type="button" class="close" data-dismiss="alert">&times;</button>
                                      <strong> Profile Image Updated  Successfully ! </strong>
                                    </div>
                                    ';
                                    header('Refresh:1,url=userProfile.php?get='.$id.'');
                                  } else {
                                    echo '
                                     <div class="alert alert-warning  alert-dismissible">
                                       <button type="button" class="close" data-dismiss="alert">&times;</button>
                                      <strong> Sorry Profile Image Not Updated Try Again ! </strong>
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
                             <div class="col-sm-12">
                                 <div class="col-md-12">
                                   <form method="post"enctype='multipart/form-data'>
                                     <div class="form-group row">
                                       <div class="col-sm">
                                         <?php
                                         if($u_profile_image) {
                                            echo '<img class="profile-user-img img-fluid"src="../userprofileImage/'.$u_profile_image.'"height="100px">';
                                            }else{
                                           echo '<img src="profileImage/profile.png"width="100px"height="100px">';

                                         }
                                          ?>
                                       </div>
                                     </div>
                                     <div class="form-group row">
                                       <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Choose New </label>
                                       <div class="col-sm">
                                       </div>
                                       <input type="file"name="u_profile_image" class="form-control form-control-sm" id="colFormLabelSm" placeholder="">
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
                   <a href="userProfile.php?get=<?php echo $id ?>"class="btn btn-sm btn-outline-warning ">Back</a>
                 </div>
                </form>
                </div>
              </div>
          </body>
        </html>

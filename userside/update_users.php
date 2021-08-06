<?php
session_start();
ob_start();
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Update users Data </title>
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="assets/css/style.css">

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
              Update User Data
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
                          $frist_name = $post["frist_name"];
                            $last_name = $post["last_name"];
                            $u_email = $post["u_email"];
                            $u_password = $post["u_password"];
                              $fb = $post["fb"];
                              $tw = $post["tw"];
                              $exp = $post["exp"];
                              $sk = $post["sk"];
                              $pno = $post["pno"];
                              $about = $post["about"];

                         // updating users table
                        if(isset($_POST['update'])){
                             $frist_name = $_POST["frist_name"];
                               $last_name = $_POST["last_name"];
                                $u_email = $_POST["u_email"];
                                 $fb = $_POST["fb"];
                                 $tw = $_POST["tw"];
                                 $exp = $_POST["exp"];
                                 $sk = $_POST["sk"];
                                 $pno = $_POST["pno"];
                                 $about = $_POST["about"];
                                $s =  $obj->update('users',['frist_name'=>$frist_name,'last_name'=>$last_name,'u_email'=>$u_email,'fb'=>$fb,'tw'=>$tw,'exp'=>$exp,'sk'=>$sk,'pno'=>$pno,'about'=>$about],'id='.$id.'');

                                if($s){
                                 echo '
                                   <div class="alert alert-success  alert-dismissible">
                                     <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong> Data Updated  Successfully ! </strong>
                                  </div>
                                  ';
                                  $u_password = $_POST["u_password"];
                                  if (empty($u_password)) {
                                    // getting old picture from company table
                                         $query = "SELECT * FROM users where id=$id";
                                           $result = $connection->query($query);
                                             if($result->num_rows > 0){
                                                while($row = $result->fetch_assoc()){
                                                 $u_password = $row['u_password'];
                                                 }
                                               }
                                              $u_password = $u_password;
                                            $s =  $obj->update('users',['u_password'=>$u_password],'id='.$id.'' );
                                         }else{
                                           $u_password = md5($u_password);
                                       $s =  $obj->update('users',['u_password'=>$u_password],'id='.$id.'' );
                                     }
                                  header('Refresh:0,url=userProfile.php');
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
                       <form class="" method="post">
                         <div class="container-fluid mt-5">
                           <div class="row">
                             <div class="col-sm-12">
                                 <div class="col-md-12">

                                   <form>
                                     <div class="form-group row">
                                       <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Frist Name</label>
                                       <div class="col-sm">
                                         <input type="frist_name"name="frist_name"value="<?php if(isset($frist_name)){echo $frist_name;} ?>" class="form-control form-control-sm" id="colFormLabelSm" placeholder="" required>
                                       </div>
                                     </div>
                                     <div class="form-group row">
                                       <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Last Name</label>
                                       <div class="col-sm">
                                         <input type="text"name="last_name"value="<?php if(isset($last_name)){echo $last_name;} ?>" class="form-control form-control-sm" id="colFormLabelSm" placeholder="" required>
                                       </div>
                                     </div>
                                     <div class="form-group row">
                                       <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">u_email</label>
                                       <div class="col-sm">
                                         <input type="email"name="u_email"value="<?php if(isset($u_email)){echo $u_email;} ?>" class="form-control form-control-sm" id="colFormLabelSm" placeholder="" required>
                                       </div>
                                     </div>
                                     <div class="form-group row">
                                       <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">New Password</label>
                                       <div class="col-sm">
                                         <input type="password"name="u_password"value="" class="form-control form-control-sm" id="colFormLabelSm" placeholder="">
                                       </div>
                                     </div>
                                     <div class="form-group row">
                                       <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Phone no</label>
                                       <div class="col-sm">
                                         <input type="number"name="pno"value="<?php if(isset($pno)){echo $pno;} ?>" class="form-control form-control-sm" id="colFormLabelSm" placeholder="" required>
                                       </div>
                                     </div>
                                     <div class="form-group row">
                                       <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Facebook Link</label>
                                       <div class="col-sm">
                                         <input type="url"name="fb"value="<?php if(isset($fb)){echo $fb;} ?>" class="form-control form-control-sm" id="colFormLabelSm" placeholder="" >
                                       </div>
                                     </div>
                                     <div class="form-group row">
                                       <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Twitter Link</label>
                                       <div class="col-sm">
                                         <input type="url"name="tw"value="<?php if(isset($tw)){echo $tw;} ?>" class="form-control form-control-sm" id="colFormLabelSm" placeholder="" >
                                       </div>
                                     </div>
                                     <div class="form-group row">
                                       <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Skype ID</label>
                                       <div class="col-sm">
                                         <input type="url"name="sk"value="<?php if(isset($sk)){echo $sk;} ?>" class="form-control form-control-sm" id="colFormLabelSm" placeholder="" >
                                       </div>
                                     </div>
                                     <div class="form-group row">
                                       <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Quaification/profession</label>
                                       <div class="col-sm">
                                         <input type="text"name="exp"value="<?php if(isset($exp)){echo $exp;} ?>" class="form-control form-control-sm" id="colFormLabelSm" placeholder="Chemistry (BSc), Computer Science (BSc)">
                                       </div>
                                     </div>
                                     <div class="form-group row">
                                       <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">About Your Self</label>
                                       <div class="col-sm">
                                         <textarea name="about"placeholder="write here..."cols=""rows="6"class="form-control"><?php if(isset($about)){echo $about;} ?></textarea>
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
                   <a href="userProfile.php?get=<?php echo $id ?>"class="btn btn-sm btn-outline-warning ">Back</a>
                 </div>
                </form>
                </div>
              </div>

              <?php include 'includes/footer.php'; ?>
            </div>
           </div>
         </div>
       </div>


          </body>
        </html>

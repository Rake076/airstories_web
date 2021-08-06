<?php
ob_start();
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Update Admin Data </title>
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
              Update Admin Data
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
                   $data = $obj->edit($id, 'admin');
                    foreach($data as $post){
                       $id = $post["id"];
                          $f_name = $post["f_name"];
                            $l_name = $post["l_name"];
                            $email = $post["email"];
                            $password = $post["password"];

                         // updating admin table
                        if(isset($_POST['update'])){
                             $f_name = $_POST["f_name"];
                               $l_name = $_POST["l_name"];
                                $email = $_POST["email"];
                                $s =  $obj->update('admin',['f_name'=>$f_name,'l_name'=>$l_name,'email'=>$email],'id='.$id.'');

                                if($s){
                                 echo '
                                   <div class="alert alert-success  alert-dismissible">
                                     <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong> Data Updated  Successfully ! </strong>
                                  </div>
                                  ';
                                  $password = $_POST["password"];

                                  if (empty($password)) {
                                    // getting old picture from company table
                                        $query = "SELECT * FROM admin where id=$id";
                                           $result = $connection->query($query);
                                             if($result->num_rows > 0){
                                                while($row = $result->fetch_assoc()){
                                                 $password = $row['password'];
                                                 }
                                               }
                                              $password = $password;
                                            $s =  $obj->update('admin',['password'=>$password],'id='.$id.'' );
                                         }else{
                                           $password = md5($password);
                                       $s =  $obj->update('admin',['password'=>$password],'id='.$id.'' );
                                     }
                                  header('Refresh:1,url=admin_profile.php?get='.$id.'');
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
                                         <input type="f_name"name="f_name"value="<?php if(isset($f_name)){echo $f_name;} ?>" class="form-control form-control-sm" id="colFormLabelSm" placeholder="">
                                       </div>
                                     </div>
                                     <div class="form-group row">
                                       <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Last Name</label>
                                       <div class="col-sm">
                                         <input type="text"name="l_name"value="<?php if(isset($l_name)){echo $l_name;} ?>" class="form-control form-control-sm" id="colFormLabelSm" placeholder="">
                                       </div>
                                     </div>
                                     <div class="form-group row">
                                       <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Email</label>
                                       <div class="col-sm">
                                         <input type="email"name="email"value="<?php if(isset($email)){echo $email;} ?>" class="form-control form-control-sm" id="colFormLabelSm" placeholder="">
                                       </div>
                                     </div>
                                     <div class="form-group row">
                                       <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Password</label>
                                       <div class="col-sm">
                                         <input type="password"name="password"value="" class="form-control form-control-sm" id="colFormLabelSm" placeholder="">
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
                   <a href="admin_profile.php?get=<?php echo $id ?>"class="btn btn-sm btn-outline-warning ">Back</a>
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

<?php
ob_start();
$errors = array();
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Update Website Information</title>
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
    <style media="screen">
    * {
      margin: 0px;
      padding: 0px;
    }

    .error {
      width: 92%;
      margin: 0px auto;
      padding: 10px;
      border: 1px solid #a94442;
      color: #a94442;
      background: #f2dede;
      border-radius: 5px;
      text-align: left;
    }
    .success {
      color: #3c763d;
      background: #dff0d8;
      border: 1px solid #3c763d;
      margin-bottom: 20px;
    }

    </style>

  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-10 offset-1">
          <div class="card">
            <div class="card-header text-success font-weight-bold">
              Update Website Basic Information
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
                   $data = $obj->edit($id, 'website_info');
                    foreach($data as $post){
                      $id = $post["id"];
                       $email = $post["email"];
                       $phone1 = $post["phone1"];
                       $phone2 = $post["phone2"];
                       $description = $post["description"];
                       $fb = $post["fb"];
                       $tw = $post["tw"];
                       $linkedin = $post["linkedin"];
                       $website_link = $post["website_link"];
                         // updating admin table
                        if(isset($_POST['update'])){
                          $email = $_POST["email"];
                          $phone1 = $_POST["phone1"];
                          $phone2 = $_POST["phone2"];
                          $description = $_POST["description"];
                          $fb = $_POST["fb"];
                          $tw = $_POST["tw"];
                          $linkedin = $_POST["linkedin"];
                          $website_link = $_POST["website_link"];


                          // form validation: ensure that the form is correctly filled ...
                          // by adding (array_push()) corresponding error unto $errors array
                          if (empty($linkedin)) { array_push($errors, "LinkedIn Field is missing"); }
                          if (empty($website_link)) { array_push($errors, "website_link is required"); }
                          if (empty($email)) { array_push($errors, "Email is required"); }
                          if (empty($phone1)) { array_push($errors, "phone1 is required"); }
                          if (empty($phone2)) { array_push($errors, "phone2 is required"); }
                          if (empty($description)) { array_push($errors, "description is required"); }
                          if (empty($fb)) { array_push($errors, "Facebook Link is required"); }
                          if (empty($tw)) { array_push($errors, "Twitter Link is required"); }

                            if(strlen($phone1) !==11 ){
                              $errors['phone1'] = "Phone1 no is not Correct";
                            }
                            if(strlen($phone2) !==11 ){
                              $errors['phone2'] = "Phone2 no is not Correct";
                            }

                            if (count($errors) == 0) {
                              $s =  $obj->update('website_info',['email'=>$email,'phone1'=>$phone1,'phone2'=>$phone2,'description'=>$description,'fb'=>$fb,'tw'=>$tw,'linkedin'=>$linkedin,'website_link'=>$website_link],'id='.$id.'');
                                if($s){
                                 echo '
                                   <div class="alert alert-success  alert-dismissible">
                                     <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong> Data Updated  Successfully ! </strong>
                                  </div>
                                  ';
                                  header('Refresh:0,url=web_info.php?get='.$id.'');
                                }
                                } else {
                                  echo '
                                   <div class="alert alert-warning  alert-dismissible">
                                     <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong> Sorry Data Not Updated Try Again ! </strong>
                                  </div>
                                  ';
                                }
                            }
                         }
                      }
                    ?>

                    <?php  if (count($errors) > 0) : ?>
                      <div class="error">
                        <?php foreach ($errors as $error) : ?>
                          <p class="text-danger font-weight-bold"><?php echo $error ?></p>
                        <?php endforeach ?>
                      </div>
                    <?php  endif ?>

                  <div class="container ">
                    <div class="row">
                      <div class="col-md-12">
                         <div class="container-fluid mt-5">
                           <div class="row">
                             <div class="col-sm-12">
                                 <div class="col-md-12 text-muted text-sm">
                                   <form method="post"enctype="multipart/form-data"class="text-muted">
                                     <div class="form-row">
                                       <div class="form-group col-md-4">
                                         <label for="inputphone24">Email</label>
                                         <input type="email" class="form-control"name="email"value="<?php if(isset($email)){ echo $email; }?>"  placeholder="">
                                       </div>
                                       <div class="form-group col-md-4">
                                         <label for="inputdescription4">Phone1</label>
                                         <input type="number" class="form-control"name="phone1"value="<?php if(isset($phone1)){ echo $phone1; } ?>" placeholder="">
                                       </div>
                                       <div class="form-group col-md-4">
                                         <label for="inputAddress2">Phone2</label>
                                         <input type="number" class="form-control"name="phone2"value="<?php if(isset($phone2)){ echo $phone2; }?>"placeholder="">
                                       </div>
                                     </div>
                                     <div class="form-row">
                                       <div class="form-group col-md-4">
                                         <label for="inputAddress2">Facebook Link</label>
                                         <input type="url" class="form-control"name="fb"value="<?php if(isset($fb)){ echo $fb; }?>"placeholder="">
                                       </div>
                                       <div class="form-group col-md-4">
                                         <label for="inputAddress2">Twitter Link </label>
                                         <input type="url" class="form-control"name="tw"value="<?php if(isset($tw)){ echo $tw; }?>"placeholder="">
                                       </div>
                                       <div class="form-group col-md-4">
                                         <label for="inputAddress2">LinkedIn </label>
                                         <input type="url" class="form-control"name="linkedin"value="<?php if(isset($linkedin)){ echo $linkedin; }?>"placeholder="">
                                       </div>
                                     </div>
                                     <div class="form-row">
                                       <div class="form-group col-md-4">
                                         <label for="inputAddress2">Website Link </label>
                                         <input type="url" class="form-control"name="website_link"value="<?php if(isset($website_link)){ echo $website_link; }?>"placeholder="">
                                       </div>
                                       <div class="form-group col-md-8">
                                         <label for="inputAddress">Description</label>
                                         <textarea  id="txtTest" name="description"class="form-control" rows="5" cols="40"><?php if(isset($description)){ echo $description; } ?></textarea>
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
                       <a href="web_info.php?get=<?php echo $id ?>"class="btn btn-sm btn-outline-warning ">Back</a>
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

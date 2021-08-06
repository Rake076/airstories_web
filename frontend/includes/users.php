<?php
 include '../db.php';
 $s = "select * from users where status='verified' and code='0'";
  $r = mysqli_query($connection,$s);
   $count_story = mysqli_num_rows($r);
    if ($count_story>0) {
      while ($row=mysqli_fetch_assoc($r)) {
        $id = $row["id"];
         $u_profile_image= $row["u_profile_image"];
          $frist_name = $row["frist_name"];
           $last_name = $row["last_name"];
            $u_email = $row["u_email"];
            $u_password = $row["u_password"];
           $status= $row["status"];
          $code= $row["code"];
        $fb = $row["fb"];
       $tw = $row["tw"];
      $exp = $row["exp"];
    $sk = $row["sk"];
  $pno = $row["pno"];
  $about = $row["about"];

 ?>
    <div class="col-sm-6 col-md-3 mb-sm-30 sm-text-center">
      <div class="team maxwidth400">
        <div class="thumb">
          <?php
            if ($u_profile_image) {
              ?>
               <img class="img-fullwidth" src="../userProfileImage/<?php echo $u_profile_image; ?>" alt=""height="200px">
              <?php
              }else {
              ?>
              <img class="img-fullwidth" src="../userProfileImage/placeholder.jpg" alt=""height="200px">
              <?php
              }
            ?>

        </div>
        <div class="content border-1px p-15 bg-light clearfix">
          <h4 class="name text-theme-color-2 mt-0 text-capitalize"> <?php echo $frist_name; ?> - <small></small></h4>
          <?php $string = $about;
            if (strlen($string) > 25) {
              ?>
               <p> <?php echo   $trimstring = substr($string, 0, 120). '...'; ?> </p>
              <?php
              }else {
              ?>
              <p>This is about user paragraph and if you want to know more about me click on  detail button...</p>
              <?php
              }
            ?>
          <ul class="styled-icons icon-dark icon-circled icon-theme-colored icon-sm pull-left flip">
            <li><a href="<?php echo $fb ?>"><i class="fa fa-facebook"></i></a></li>
            <li><a href="<?php echo $tw ?>"><i class="fa fa-twitter"></i></a></li>
            <li><a href="<?php echo $sk ?>"><i class="fa fa-google-plus"></i></a></li>
          </ul>
          <a class="btn btn-theme-colored btn-sm pull-right flip" href="user_details.php?user_details=<?php echo $id; ?>">view details</a>
        </div>
      </div>
    </div>

   <?php
    }
 ?>
 <?php
  // if data exist
 }else {
   echo '<span class="text-theme-color-2 font-weight-400 u"> Users Not Found </span>';
 }
 ?>

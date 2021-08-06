
<?php
$query="select * from website_info";
 $r = mysqli_query($connection,$query);
  $count_story = mysqli_num_rows($r);
  if ($count_story>0) {
    while ($row=mysqli_fetch_assoc($r)) {
      $id = $row["id"];
       $email = $row["email"];
       $phone1 = $row["phone1"];
       $phone2 = $row["phone2"];
       $description = $row["description"];
       $fb = $row["fb"];
       $tw = $row["tw"];
       $linkedin = $row["linkedin"];
       $website_link = $row["website_link"];
    }
  }
 ?>

 <style media="screen">
 .list-inlinee {
  display: inline-grid;
}
 </style>
<footer id="footer" class="footer divider layer-overlay overlay-dark-9" data-bg-img="images/bg/bg2.jpg">
  <div class="container">
    <div class="row border-bottom">
      <div class="col-sm-6 col-md-3">
        <div class="widget dark">
          <img class="mt-5 mb-20" alt="" src="images/logo-white-footer.png">
          <p class="text-capitalize">
            <?php
               if ($count_story>0) {
                echo $description;
               } else {
                 echo '<span class="text-danger"> Data not Found </span>';
               }
             ?>
          </p>
          <ul class="list-inlinee mt-5">
            <li class="m-0 pl-10 pr-10"> <i class="fa fa-phone text-theme-color-2 mr-5"></i> <a class="text-gray" href="#">
              <?php
                 if ($count_story>0) {
                  echo $phone1;
                 } else {
                   echo '<span class="text-danger"> phone1 not Found </span>';
                 }
               ?>
            </a> </li>
            <li class="m-0 pl-10 pr-10"> <i class="fa fa-envelope-o text-theme-color-2 mr-5"></i> <a class="text-gray" href="#">
              <?php
                 if ($count_story>0) {
                  echo $email;
                 } else {
                   echo '<span class="text-danger"> Email not Found </span>';
                 }
               ?>
            </a> </li>
            <li class="m-0 pl-10 pr-10"> <i class="fa fa-globe text-theme-color-2 mr-5"></i> <a class="text-gray" href="#">
              <?php
                 if ($count_story>0) {
                  echo $website_link;
                 } else {
                   echo '<span class="text-danger"> Website link not Found </span>';
                 }
               ?>
            </a> </li>
          </ul>
        </div>
      </div>
      <div class="col-sm-6 col-md-3">
        <div class="widget dark">
          <h4 class="widget-title">Useful Links</h4>
          <ul class="list angle-double-right list-border">
            <li><a href="#home">Home</a></li>
            <li><a href="#about">About Us</a></li>
            <li><a href="#books">Our Stories</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="#gallery">Gallery</a></li>
          </ul>
        </div>
      </div>
      <div class="col-sm-6 col-md-3">
        <div class="widget dark">
          <h4 class="widget-title">Top Stories</h4>
          <ul class="list angle-double-right list-border">
            <?php
              $s = "select * from stories where status='0' limit 5";
                $r = mysqli_query($connection,$s);
                  $count_story = mysqli_num_rows($r);
                   if ($count_story>0) {
                  while ($row=mysqli_fetch_assoc($r)) {
                 $id = $row["id"];
               $b_tittle = $row["b_tittle"];
             ?>
            <li><a href="#books"><?php echo $b_tittle; ?></a></li>
            <?php
                }  // while loop
              }  // if
             ?>
          </ul>
        </div>
      </div>
      <div class="col-sm-6 col-md-3">
        <div class="widget dark">
          <h4 class="widget-title line-bottom-theme-colored-2">Others</h4>
          <div class="opening-hours">
            <ul class="list-border">
              <li class="clearfix"> <span> <a href="../userside/user_login.php"> Login</a>  </span>
                <div class="value pull-right"> <a href="../userside/user_login.php">New Account</a> </div>
              </li>
              <li class="clearfix"> <span> Subscribtion </span>
                <div class="value pull-right"> <?php  $obj->count_data('subscribtion'); ?> </div>
              </li>
              <li class="clearfix"> <span> Users </span>
                <div class="value pull-right"> <?php $obj->count_data('users'); ?> </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-30">
      <div class="col-md-2">
        <div class="widget dark">
          <h5 class="widget-title mb-10">Call Us Now</h5>
          <div class="text-gray">
            <?php
            $query="select * from website_info";
             $r = mysqli_query($connection,$query);
              $count_story = mysqli_num_rows($r);
              if ($count_story>0) {
                while ($row=mysqli_fetch_assoc($r)) {
                   $phone1 = $row["phone1"];
                   $phone2 = $row["phone2"];
                }
              }
               if($count_story>0){
                echo $phone1;
               }else{
                 echo '<span class="text-danger"> Phone not Found </span>';
               }
             ?>
            <br>
            <?php
               if ($count_story>0) {
                echo $phone2;
               } else {
                 echo '<span class="text-danger"> Phone not Found </span>';
               }
             ?>
           </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="widget dark">
          <h5 class="widget-title mb-10">Connect With Us</h5>
          <ul class="styled-icons icon-bordered icon-sm">
            <li><a href="<?php echo $fb ?>"><i class="fa fa-facebook "></i></a></li>
            <li><a href="<?php echo $tw ?>"><i class="fa fa-twitter "></i></a></li>
            <li><a href="<?php echo $email ?>"><i class="fa fa-google-plus "></i></a></li>
            <li><a href="<?php echo $linkedin ?>"><i class="fa fa-linkedin "></i></a></li>
          </ul>
        </div>
      </div>
      <div class="col-md-5 col-md-offset-2">
        <div class="widget dark">
          <h5 class="widget-title mb-10">Subscribe Us</h5>
          <!-- Mailchimp Subscription Form Starts Here -->
          <div id="alertSuccess" class="alert alert-success" role="alert"style="display:none;">
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <span id="success"></span>
          </div>

          <div id="alertError" class="alert alert-danger" role="alert"style="display:none;">
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <span id="error"></span>
          </div>

          <form id="fupForm" class="newsletter-form">
            <div class="input-group">
              <input type="email" value="" name="sub_email" placeholder="Your Email"autocomplete="" class="form-control input-lg font-16"required data-height="45px" id="sub_email">
              <span class="input-group-btn">
                <button data-height="45px" class="btn topnavbarColor text-white btn-xs m-0 font-14"name="save"id="butsave" type="submit">Subscribe</button>
              </span>
            </div>
          </form>

      <script>
        $(document).ready(function() {
          $('#butsave').on('click', function() {
            $("#butsave").attr("disabled", "disabled");
            var sub_email = $('#sub_email').val();
            if(sub_email!=""){
              $.ajax({
                url: "sub_code.php",
                type: "POST",
                data: {
                  sub_email: sub_email,
                },
                cache: false,
                success: function(dataResult){
                  var dataResult = JSON.parse(dataResult);
                  if(dataResult.statusCode==200){
                    $("#butsave").removeAttr("disabled");
                    $('#fupForm').find('input:text').val('');
                    $("#success").show();
                    $('#success').html('Thanks For Subscribtion !');
                    $("#fupForm").get(0).reset();
                    $("#alertSuccess").show();
                    setTimeout(function() {
        								 $("#alertSuccess").hide(); //or fadeOut
        							 }, 3000);
                  }
                  else if(dataResult.statusCode==201){
                    $("#butsave").removeAttr("disabled");
                    $("#error").show();
                    $('#error').html('Email ID already exists !');
                    $("#alertError").show();
                    $("#fupForm").get(0).reset();
                    setTimeout(function() {
                         $("#alertError").hide(); //or fadeOut
                       }, 5000);
                  }
                }
              });
            }
            else{
              alert('Please fill all the field !');
            }
          });
        });
      </script>
          <!-- Mailchimp Subscription Form Ends Here -->
        </div>
      </div>
    </div>
  </div>
  <div class="footer-bottom bg-black-333">
    <div class="container pt-20 pb-20">
      <div class="row">
        <div class="col-md-6">
          <p class="font-11 text-black-777 m-0">Copyright &copy;2021 abdullah@gmail.com. All Rights Reserved</p>
        </div>
        <div class="col-md-6 text-right">
          <div class="widget no-border m-0">
            <ul class="list-inline sm-text-center mt-5 font-12">
              <li>
                <a href="#faq">FAQ</a>
              </li>
              <li>|</li>
              <li>
                <a href="#faq">Help Desk</a>
              </li>
              <li>|</li>
              <li>
                <a href="#contact">Support</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>

<!-- Footer Scripts -->
<!-- JS | Custom script for all pages -->
<script src="js/custom.js"></script>

<!-- SLIDER REVOLUTION 5.0 EXTENSIONS
      (Load Extensions only on Local File Systems !
       The following part can be removed on Server for On Demand Loading) -->
<script type="text/javascript" src="js/revolution-slider/js/extensions/revolution.extension.actions.min.js"></script>
<script type="text/javascript" src="js/revolution-slider/js/extensions/revolution.extension.carousel.min.js"></script>
<script type="text/javascript" src="js/revolution-slider/js/extensions/revolution.extension.kenburn.min.js"></script>
<script type="text/javascript" src="js/revolution-slider/js/extensions/revolution.extension.layeranimation.min.js"></script>
<script type="text/javascript" src="js/revolution-slider/js/extensions/revolution.extension.migration.min.js"></script>
<script type="text/javascript" src="js/revolution-slider/js/extensions/revolution.extension.navigation.min.js"></script>
<script type="text/javascript" src="js/revolution-slider/js/extensions/revolution.extension.parallax.min.js"></script>
<script type="text/javascript" src="js/revolution-slider/js/extensions/revolution.extension.slideanims.min.js"></script>
<script type="text/javascript" src="js/revolution-slider/js/extensions/revolution.extension.video.min.js"></script>

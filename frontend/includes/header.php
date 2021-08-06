
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
<header id="header" class="header">
  <div class="header-top topnavbarColor sm-text-center p-0">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="widget no-border m-0">
            <ul class="list-inline font-13 sm-text-center mt-5">
              <li>
                <a class="text-white" href="#faq">FAQ</a>
              </li>
              <li class="text-white">|</li>
              <li>
                <a class="text-white" href="#faq">Help Desk</a>
              </li>
              <li class="text-white">|</li>
              <li>
                <a class="text-white" href="../userside/user_login.php">Login</a>
              </li>
              <li class="text-white">|</li>
              <li>
                <a class="text-white" href="../userside/register.php">Register</a>
              </li>
              <li class="text-white">|</li>
              <li>
                <a class="text-white" href="../adminPanal/login.php">Admin Login</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-4">
          <div class="widget m-0 pull-right sm-pull-none sm-text-center">
            <ul class="list-inline pull-right">

            </ul>
          </div>
          <div class="widget no-border m-0 mr-15 pull-right flip sm-pull-none sm-text-center">
            <ul class="styled-icons icon-circled icon-sm pull-right flip sm-pull-none sm-text-center mt-sm-15">
              <li><a href="<?php echo $fb ?>"><i class="fa fa-facebook text-white"></i></a></li>
              <li><a href="<?php echo $tw ?>"><i class="fa fa-twitter text-white"></i></a></li>
              <li><a href="<?php echo $email ?>"><i class="fa fa-google-plus text-white"></i></a></li>
              <li><a href="<?php echo $linkedin ?>"><i class="fa fa-linkedin text-white"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="header-middle p-0 bg-lightest xs-text-center">
    <div class="container pt-0 pb-0">
      <div class="row">
        <div class="col-xs-12 col-sm-4 col-md-5">
          <div class="widget no-border m-0">
            <a class="menuzord-brand pull-left flip xs-pull-center mb-15" href="index.php"> 🅰🅸🆁 🆂🆃🅾🆁🅸🅴🆂</a>
          </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4">
          <div class="widget no-border pull-right sm-pull-none sm-text-center mt-10 mb-10 m-0">
            <ul class="list-inline">
              <li><i class="fa fa-phone-square text-theme-colored font-36 mt-5 sm-display-block"></i></li>
              <li>
                <a href="#" class="font-12 text-gray text-uppercase">Call us today!</a>
                <h5 class="font-14 m-0">
                  <?php
                  if ($count_story>0) {
                        echo $phone1;
                    } else {
                      echo "Data Not Found";
                    }
                  ?>
                </h5>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-3">
          <div class="widget no-border pull-right sm-pull-none sm-text-center mt-10 mb-10 m-0">
            <ul class="list-inline">
              <li><i class="fa fa-clock-o text-theme-colored font-36 mt-5 sm-display-block"></i></li>
              <li>
                <a href="#" class="font-12 text-gray text-uppercase">Today!</a>
                <h5 class="font-13 text-black m-0">
                  <?php
                   date_default_timezone_set('Asia/karachi');
                    echo $today = date("F j, Y, g:i a");
                   ?>
                </h5>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="header-nav">
    <div class="header-nav-wrapper navbar-scrolltofixed navbarColor border-bottom-theme-color-2-1px">
      <div class="container">
        <nav id="menuzord" class="menuzord navbarColor  pull-left flip menuzord-responsive">
          <ul class="menuzord-menu onepage-nav">
            <li class="active"><a href="#home">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#books">Stories</a></li>
            <li><a href="#users">Users</a></li>
            <li><a href="#gallery">Gallery</a></li>
            <li><a href="#blog">Publications</a></li>
            <li><a href="#faq">FAQ</a></li>
            <li><a href="#sub">Subscribtion</a></li>
            <!-- <li><a href="#jor">Journals</a></li> -->
            <li><a href="#contact">Contact</a></li>
          </ul>
          <ul class="pull-right flip hidden-sm hidden-xs">
            <li>
              <!-- Modal: Book Now Starts -->
              <!-- <a class="btn btn-colored btn-flat bg-theme-color-2 text-white font-14 bs-modal-ajax-load mt-0 p-25 pr-15 pl-15" data-toggle="modal" data-target="#BSParentModal" href="ajax-load/form-login-register.php"> Login / Register </a> -->
              <a class="btn btn-colored btn-flat topnavbarColor text-white font-14 bs-modal-ajax-load mt-0 p-25 pr-15 pl-15" data-toggle="modal" data-target="#exampleModal" > Login / Register </a>
              <!-- Modal: Book Now End -->
            </li>
          </ul>
          <?php include 'login.php'; ?>
          <div id="top-search-bar" class="collapse">
            <div class="container">
              <form role="search" action="#" class="search_form_top" method="get">
                <input type="text" placeholder="Type text and press Enter..." name="s" class="form-control" autocomplete="off">
                <span class="search-close"><i class="fa fa-search"></i></span>
              </form>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </div>
</header>
<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header navbarColor">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true text-white">&times;</span></button>
        <h4 class="modal-title text-white" id="exampleModal">Login Form</h4>
      </div>
      <div class="modal-body">
        <div class="p-40">
          <!-- Reservation Form Start-->
            <form method="post" >
              <h3 class="mt-0 line-bottom text-theme-colored mb-40">Get A Free Account<span class="text-theme-colored font-weight-600"> Now!</span></h3>
              <div class="row">
                <input type="hidden" name="status"value="verified"autocomplete="off" class="input-text" placeholder="">
                <input type="hidden" name="code"value="0"autocomplete="off" class="input-text" placeholder="">
                <div class="col-sm-12">
                  <div class="form-group mb-30">
                    <input placeholder="Enter Email Address"autocomplete="off" type="email" name="u_email" required="" class="form-control">
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group mb-30">
                    <input placeholder="Enter Password" autocomplete="off"type="password" name="u_password" required="" class="form-control">
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group mb-0 mt-0">
                    <button data-height="35px" class=""name="login_user" class="float-right"style="height: 36px;width: 90px;float: initial;color: blue;" type="submit">Login</button>
                    <p class="m-5"><a href="../userside/forgot_password.php"target="_blank" class="thembo text-primary"> Forgott Password</a></p>
                    <p>Don't have an account? <a href="../userside/register.php"target="_blank" class="thembo text-primary"> Register here</a></p>
                  </div>
                </div>
              </div>
            </form>
            <!-- Reservation Form End-->
            <!-- Reservation Form Validation Start -->
        </div>
      </div>
    </div>
  </div>
</div>

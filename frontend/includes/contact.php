<?php
$connection =mysqli_connect('localhost','root','','library');

// sending to datbase
if (isset($_POST['save_contacts'])) {
  // receive all input values from the form
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $subject = mysqli_real_escape_string($connection, $_POST['subject']);
     $phone = mysqli_real_escape_string($connection, $_POST['phone']);
     $msg = mysqli_real_escape_string($connection, $_POST['msg']);
      $query = "INSERT INTO contacts(name,email,subject,phone,msg)VALUES('$name','$email','$subject','$phone','$msg') limit 1";
       $success = mysqli_query($connection, $query);
      if ($success) {
          echo '
          <script type="text/javascript">
            alert("Your MESSAGE is sent Successfully");
          </script>
          ';
       }else{
         echo '
         <script type="text/javascript">
           alert("Query Failed Try Agian !");
         </script>
        ';
      }
   }
?>

<section id="contact" class="bg-lighter">
  <div class="container pb-60">
    <div class="section-title mb-10">
      <div class="row">
        <div class="col-md-12">
          <h2 class="text-uppercase text-theme-colored title line-bottom line-height-1 mt-0">Contact <span class="text-theme-color-2 font-weight-400">Us</span></h2>
        </div>
      </div>
    </div>
    <div class="section-content">
      <div class="row">
        <div class="col-md-5">
          <!-- Google Map HTML Codes -->
          <iframe src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d2994.550727127673!2d71.4680381146414!3d30.208592017755468!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x393b33f6d4065651%3A0x6d8cfefedaba6206!2sChungi%20No%209%20Flyover%2C%20Multan%2C%20Punjab%2C%20Pakistan!3m2!1d30.2082752!2d71.47147199999999!5e1!3m2!1sen!2s!4v1625919853296!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
        <div class="col-md-7">
          <h4 class="line-bottom mt-0 mb-30 mt-sm-20">SEND US A MESSAGE</h4>
          <!-- Contact Form -->
          <form id="contact_form"method="post">
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group mb-30">
                  <input name="name" class="form-control" type="text" placeholder="Enter Name" required="">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group mb-30">
                  <input name="email" class="form-control required email" type="email" placeholder="Enter Email">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group mb-30">
                  <input name="subject" class="form-control required" type="text" placeholder="Enter Subject">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group mb-30">
                  <input name="phone" class="form-control" type="text" placeholder="Enter Phone">
                </div>
              </div>
            </div>
                <div class="form-group">
              <textarea name="msg" class="form-control required" rows="5" placeholder="Enter Message"></textarea>
            </div>
                <div class="form-group">
              <input name="form_botcheck" class="form-control" type="hidden" value="" />
              <button type="submit"name="save_contacts" class="btn btn-flat btn-theme-colored text-uppercase mt-20 mb-sm-30 border-left-theme-color-2-4px " data-loading-text="Please wait...">Send your message</button>
              <button type="reset" class="btn btn-flat btn-theme-colored text-uppercase mt-20 mb-sm-30 border-left-theme-color-2-4px">Reset</button>
            </div>
          </form>
          <!-- Contact Form Validation-->
          <!-- <script type="text/javascript">
            $("#contact_form").validate({
              submitHandler: function(form) {
                var form_btn = $(form).find('button[type="submit"]');
                var form_result_div = '#form-result';
                $(form_result_div).remove();
                form_btn.before('<div id="form-result" class="alert alert-success" role="alert" style="display: none;"></div>');
                var form_btn_old_msg = form_btn.html();
                form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
                $(form).ajaxSubmit({
                  dataType:  'json',
                  success: function(data) {
                    if( data.status == 'true' ) {
                      $(form).find('.form-control').val('');
                    }
                    form_btn.prop('disabled', false).html(form_btn_old_msg);
                    $(form_result_div).html(data.message).fadeIn('slow');
                    setTimeout(function(){ $(form_result_div).fadeOut('slow') }, 6000);
                  }
                });
              }
            });
          </script> -->


        </div>
      </div>
    </div>
  </div>
</section>

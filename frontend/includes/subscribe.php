<div class="container pt-10 pb-20 topnavbarColor">
  <div class="row">
    <div class="call-to-action">
      <div class="col-md-6">
        <h3 class="mt-5 mb-5 text-white vertical-align-middle"><i class="pe-7s-mail mr-10 font-48 vertical-align-middle"></i> SUBSCRIBE TO OUR NEWSLETTER</h3>
      </div>
      <div class="col-md-6">
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
            <input type="email" value="" name="sub_email" placeholder="Your Email"autocomplete="off"required class="form-control input-lg font-16"required data-height="45px" id="sub_email">
            <span class="input-group-btn">
              <button data-height="45px" class="btn btn-flat btn-theme-colored text-uppercase  mb-sm-30 border-left-theme-color-2-4px"name="save"id="butsave" type="submit">Subscribe</button>
            </span>
          </div>
        </form>
        <!-- Mailchimp Subscription Form Validation-->
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

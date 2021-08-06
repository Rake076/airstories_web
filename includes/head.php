<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Air Stories Web Application</title>
      <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
          <!-- Font Awesome -->
          <?php
          // object in database class or connection to Database
           require '../crud_oop.php';
           $obj = new Database();
           ?>


             <!-- Ionicons -->  <meta charset="utf-8">
              <meta http-equiv="X-UA-Compatible" content="IE=edge">
               <title> </title>
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
                 <!-- Tell the browser to be responsive to screen width -->
                <meta name="viewport" content="width=device-width, initial-scale=1">
                 <!-- Theme style -->
                <link rel="stylesheet" href="../css/adminlte.min.css">
               <!-- overlayScrollbars -->
             <link rel="stylesheet" href="../css/OverlayScrollbars.min.css">
            <!-- fontawesome cdn  -->
          <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <!--Patient filling form for request -->
    <link rel="stylesheet" href="../css/main.css">
<!-- <link rel="stylesheet" href="style.css"> -->

<link rel="stylesheet" href="../media_query.css">


<!--For Model -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

   <!--asking before delete data  -->
<script language="JavaScript" type="text/javascript">
$(document).ready(function(){
    $("a.delete").click(function(e){
        if(!confirm('Are you Sure To Delete Record')){
            e.preventDefault();
            return false;
        }
        return true;
    });
});
</script>

<!--asking before publishing story -->
<script language="JavaScript" type="text/javascript">
$(document).ready(function(){
 $("a.publish").click(function(e){
     if(!confirm('Are you Sure to Publish ')){
         e.preventDefault();
         return false;
     }
     return true;
 });
});
</script>

<!--asking before unpublishling story  -->
<script language="JavaScript" type="text/javascript">
$(document).ready(function(){
 $("a.unpublish").click(function(e){
     if(!confirm('Are you Sure Un-Publish ')){
         e.preventDefault();
         return false;
     }
     return true;
 });
});
</script>

<!--auto remove alert-->
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
          window.setTimeout(function() {
           $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
             $(this).remove();
           });
         }, 3000);
       });
    </script> -->

  <style media="screen">
  .zoom {
  -webkit-transition: all 0.35s ease-in-out;
  -moz-transition: all 0.35s ease-in-out;
  transition: all 0.35s ease-in-out;
  cursor: -webkit-zoom-in;
  cursor: -moz-zoom-in;
  cursor: zoom-in;
  }
  .zoom:hover,
  .zoom:active,
  .zoom:focus {
  -ms-transform: scale(1.1);
  -moz-transform: scale(1.1);
  -webkit-transform: scale(1.1);
  -o-transform: scale(3.20);
  transform: scale(3.20);
  position:relative;
  z-index:100 !important;
  }
  </style>
  <style>
  div.chapter_text{
    background-color: lightblue;
    height: 200px;
    overflow: scroll !important;
  }
  .chapter_text{
    font-family: -webkit-pictograph;
      font-size: medium;
      color: black;
  }
  </style>
  <style media="screen">
  .time{
    color: gray;
    font-family: monospace;
    font-size: medium;
    float: right;
    margin-right: 39px;
  }
  .users {
      color: cadetblue;
        background-color: ghostwhite;
      font-family: monospace;
      font-size: initial;
      text-align: center;
      border-bottom: 1px solid;
  }
  .seeallmsg{
      color: #090415!important;
      background-color: ghostwhite;
  }
  .hr{
      margin: 2rem!important;
  }
  .line{
    color: orangered;
    font-size: smaller;
    margin: 0 0 0 3px;
}
.ml-1, .mx-1 {
    margin-left: 1.25rem!important;
    font-size: x-large;
}
.navbar {
    border-radius: 0px !important;
}
.badge {
    display: contents;
}
.fa-navicon:before, .fa-reorder:before, .fa-bars:before {
    content: "\f0c9";
    color: white;
}
.navbar-expand .navbar-nav .dropdown-menu {
    position: absolute;
}

table{
  font-size: small;
}
table tbody{
  color: #696969;
}
.adminsidebarColor{
  background-color: #e65100;
}

  </style>

  <script>
    $(document).ready(function(){
      // when the user clicks on like
      $('.readj').on('click', function(){
        var jid = $(this).data('id');
            $post = $(this);
          $.ajax({
          url: 'count_readings.php',
          type: 'post',
          data: {
            'read_j': 1,
            'jid': jid
          },
          success: function(response){
            $post.parent().find('span.read_count').text(response);
            $post.addClass('hide');
            $post.siblings().removeClass('hide');
          }
        });
      });

    });
  </script>

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

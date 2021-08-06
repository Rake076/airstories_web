
<?php
 include '../db.php';
  session_start();
  ob_start();

 ?>
<!-- Favicon and Touch Icons -->
<link href="images/favicon.png" rel="shortcut icon" type="image/png">
<link href="images/apple-touch-icon.png" rel="apple-touch-icon">
<link href="images/apple-touch-icon-72x72.png" rel="apple-touch-icon" sizes="72x72">
<link href="images/apple-touch-icon-114x114.png" rel="apple-touch-icon" sizes="114x114">
<link href="images/apple-touch-icon-144x144.png" rel="apple-touch-icon" sizes="144x144">

<!-- Stylesheet -->
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="css/jquery-ui.min.css" rel="stylesheet" type="text/css">
<link href="css/animate.css" rel="stylesheet" type="text/css">
<link href="css/css-plugin-collections.css" rel="stylesheet"/>
<!-- CSS | menuzord megamenu skins -->
<link id="menuzord-menu-skins" href="css/menuzord-skins/menuzord-rounded-boxed.css" rel="stylesheet"/>
<!-- CSS | Main style file -->
<link href="css/style-main.css" rel="stylesheet" type="text/css">
<!-- CSS | Preloader Styles -->
<link href="css/preloader.css" rel="stylesheet" type="text/css">
<!-- CSS | Custom Margin Padding Collection -->
<link href="css/custom-bootstrap-margin-padding.css" rel="stylesheet" type="text/css">
<!-- CSS | Responsive media queries -->
<link href="css/responsive.css" rel="stylesheet" type="text/css">
<!-- CSS | Style css. This is the file where you can place your own custom css code. Just uncomment it and use it. -->
<!-- <link href="css/style.css" rel="stylesheet" type="text/css"> -->

<!-- Revolution Slider 5.x CSS settings -->
<link  href="js/revolution-slider/css/settings.css" rel="stylesheet" type="text/css"/>
<link  href="js/revolution-slider/css/layers.css" rel="stylesheet" type="text/css"/>
<link  href="js/revolution-slider/css/navigation.css" rel="stylesheet" type="text/css"/>

<!-- CSS | Theme Color -->
<link href="css/colors/theme-skin-color-set-1.css" rel="stylesheet" type="text/css">

<!-- external javascripts -->
<script src="js/jquery-2.2.4.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- JS | jquery plugin collection for this theme -->
<script src="js/jquery-plugin-collection.js"></script>

<!-- Revolution Slider 5.x SCRIPTS -->
<script src="js/revolution-slider/js/jquery.themepunch.tools.min.js"></script>
<script src="js/revolution-slider/js/jquery.themepunch.revolution.min.js"></script>


<?php
// object in database class or connection to Database
 require '../crud_oop.php';
 $obj = new Database();
 ?>

 <!--Story section like and count readings-->
 <script>
 	$(document).ready(function(){
 		// when the user clicks on like
 		$('.slike').on('click', function(){
 			var bookid = $(this).data('id');
 			    $post = $(this);

 			$.ajax({
 				url: 'like_unlike_code.php',
 				type: 'post',
 				data: {
 					'liked': 1,
 					'bookid': bookid
 				},
 				success: function(response){
 					$post.parent().find('span.likes_count').text(response);
 					$post.addClass('hide');
 					$post.siblings().removeClass('hide');
 				}
 			});
 		});

 		// when the user clicks on unlike
 		$('.sunlike').on('click', function(){
 			var bookid = $(this).data('id');
 		    $post = $(this);

 			$.ajax({
 				url: 'like_unlike_code.php',
 				type: 'post',
 				data: {
 					'unliked': 1,
 					'bookid': bookid
 				},
 				success: function(response){
 					$post.parent().find('span.likes_count').text(response);
 					$post.addClass('hide');
 					$post.siblings().removeClass('hide');
 				}
 			});
 		});
 	});
 </script>

    <script>
      $(document).ready(function(){
        // when the user clicks on like
        $('.read').on('click', function(){
          var bookid = $(this).data('id');
              $post = $(this);

          $.ajax({
            url: 'count_reads.php',
            type: 'post',
            data: {
              'read': 1,
              'bookid': bookid
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

<!--journal section like and count readings-->
    <script>
     $(document).ready(function(){
       // when the user clicks on like
       $('.like').on('click', function(){
         var jid = $(this).data('id');
             $post = $(this);
         $.ajax({
           url: 'like_unlike_code.php',
           type: 'post',
           data: {
             'likedj': 1,
             'jid': jid
           },
           success: function(response){
             $post.parent().find('span.likes_count').text(response);
             $post.addClass('hide');
             $post.siblings().removeClass('hide');
           }
         });
       });

       // when the user clicks on unlike
       $('.unlike').on('click', function(){
         var jid = $(this).data('id');
           $post = $(this);

         $.ajax({
           url: 'like_unlike_code.php',
           type: 'post',
           data: {
             'unlikedj': 1,
             'jid': jid
           },
           success: function(response){
             $post.parent().find('span.likes_count').text(response);
             $post.addClass('hide');
             $post.siblings().removeClass('hide');
           }
         });
       });
     });
    </script>

    <script>
      $(document).ready(function(){
        // when the user clicks on like
        $('.readj').on('click', function(){
          var jid = $(this).data('id');
              $post = $(this);
            $.ajax({
            url: 'count_reads.php',
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
  .scrollToTop i {
  color: red !important;
  font-size: 42px;
  }
  </style>

  <style type="text/css">
  .navbarColor{
    background-color: #e65100;
  }
  .topnavbarColor{
    background-color: #ef6c00;
  }
</style>

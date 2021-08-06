<?php
session_start();
ob_start();
include '../db.php';
?>
<!DOCTYPE html>
<html>
<head>
     <?php include 'includes/head.php'; ?>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

<style media="screen">
  .hr{
    margin-top: 1rem;
    margin-bottom: 2rem;
    border: 0;
    border-top: 5px solid rgba(25,15,3,.1);
    background-color: darkturquoise;
  }

  .navbar {
       margin-bottom: 0px;
  }
  .backbtnz{
    display: inline;
    border: 1px solid green;
  }
  .main-header .nav-link {
      height: auto;
      position: relative;
  }

  .navbar-expand .navbar-nav .nav-link {
      padding-right: 1rem;
      padding-left: 1rem;
      display: unset;
  }

.noti_style{
    border-radius: 10px;
    margin: -9px;
    padding: 5px;
}
.dropdown-item-title {
    font-size: initial;
    margin: 0;
}
.dropdown-menu-lg .dropdown-item {
    padding: 0.5rem;
    font-size: medium;
}

/* small image  */
.img-fluid {
    max-width: 100%;
    height: 103PX !important;
}
/* seach box css */
.input{

    line-height: inherit;
    height: 35px;
    margin-left: 17px;
    border: 2px solid #dadcdedb;
    position: relative;
    font-size: revert;
    font-family: -webkit-pictograph;
    border-radius: 24px;
 }
 input::placeholder {
   color: black;
 }
</style>

</head>
 <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
       <!--Top Navbar  -->
        <?php include 'includes/header.php'; ?>
          <!-- /.navbar -->

       <!-- Main Sidebar start -->
         <?php include 'includes/sidebar.php'; ?>
            <!-- Main Sidebar end -->

      <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <div class="content-header">
            <div class="container-fluid m1">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1 class="m-0 text-dark heading">All Stories Published On Website  </h1>
                  <span class="">Total Stories</span>:
                  <kbd class="bg-success rounded-circle">
                <?php
                  $s = "select * from stories where status='0'";
                    $r = mysqli_query($connection,$s);
                  echo  $count_story = mysqli_num_rows($r);
                  ?>
                  </kbd>
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Home</li>
                    <li class="breadcrumb-item active">All Stories </li>
                  </ol>
                </div><!-- /.col -->
              </div><!-- /.row -->
              <a href="create_story.php"class="btn btn-danger btn-sm">Create New Stoires </a>
              <a href="your_stories.php"class="btn btn-warning btn-sm">View Your Stories </a>
              <a href="allStories.php"class="btn btn-info btn-sm">Create Reading list </a>
              <hr>
            </div><!-- /.container-fluid -->
          </div>
          <!-- /.content-header -->

              <!-- Main content -->
          <section class="content">
            <div class="container-fluid">
             <div class="row">
             <div class="col-md-12">
               <div class="post-search-panel ">
                   <input type="text"class="input" id="keywords" placeholder="Enter Story Name..." onkeyup="searchFilter();"/>
                   <select id="sortBy" onchange="searchFilter();"class="input ">
                       <option value="">Sort by Title</option>
                       <option value="asc">Ascending</option>
                       <option value="desc">Descending</option>
                   </select>
                   <hr>
               </div>
             <div class="post-wrapper">
                <!-- Post list container -->
                  <div id="postContent">
                       <?php
                         // Include database configuration file
                         // Set some useful configuration
                         $baseURL = 'getData.php';
                         $limit = 5;
                         // Count of all records
                         $query   = $connection->query("SELECT COUNT(*) as rowNum FROM stories");
                         $result  = $query->fetch_assoc();
                         $rowCount= $result['rowNum'];
                         // Fetch records based on the limit
                         $query = $connection->query("SELECT * FROM stories where status='0' ORDER BY id DESC LIMIT $limit");
                         if($query->num_rows > 0){
                         ?>
                             <!-- Display posts list -->
                             <div class="post-list">
                             <?php while($row = $query->fetch_assoc()){
                                         $id = $row["id"];
                                         $b_tittle = $row["b_tittle"];
                                         $b_type = $row["b_type"];
                                         $b_description = $row["b_description"];
                                         $cover_photo = $row["cover_photo"];
                                         $b_author = $row["b_author"];
                                         $b_status = $row["b_status"];
                                         $readings = $row["readings"];
                                ?>
                                 <div class="col-sm-3 d-flex align-items-stretch">
                                       <!-- Card-->
                                       <div class="card rounded shadow-sm border-0">
                                           <div class="card-body p-4"><img src="../coverphotos/<?php echo $cover_photo; ?>" alt="<?php echo $cover_photo; ?>"  class="img-fluid d-block mx-auto mb-3 zoom"height="200px">
                                               <h5 class="text-capitalize"> <a href="view_one_story.php?read_story=<?php echo $id; ?>" class=" text-capitalizek"><?php echo $b_tittle ?></a></h5>
                                               <?php $string = $b_description;
                                                 if (strlen($string) > 45) {
                                                   ?>
                                                    <p class="small text-muted font-italic"> <?php echo   $trimstring = substr($string, 0, 120). '...'; ?> </p>
                                                   <?php
                                                   }else {
                                                   ?>
                                                   <p class="small text-muted font-italic">This is about user paragraph and if you want to know more about me click on
                                                      detail buttonabout me click on  detail button about me click on  detail button  ...</p>
                                                   <?php
                                                   }
                                                 ?>
                                               <span class="float-right text-muted">Chapters :
                                                 <?php
                                                      $sql = "SELECT count(*) FROM storychapters where s_id='$id' and status='0'";
                                                      $result =mysqli_query($connection,$sql);
                                                        while($row =mysqli_fetch_assoc($result)){
                                                        $presents= $row['count(*)'];
                                                     echo $presents;
                                                    }
                                                  ?>
                                               </span>
                                               <ul class="list-inline small text-muted">
                                                   <li class="list-inline-item m-0"><i class="fa fa-user text-success"> </i> <?php echo $b_author; ?></li>
                                                   <li class="list-inline-item m-0"><i class="fa fa-eye text-success"> </i> <?php echo $readings; ?></li>
                                               </ul>
                                           </div>
                                           <a href="view_one_story.php?read_story=<?php echo $id; ?>"  title="Read this Story"data-id="<?php echo $id ?>" class="read btn btn-outline-danger rounded-pill mb-2">Read</a>
                                       </div>
                                   </div>
                               <?php } ?>
                             </div>
                             <!-- Display pagination links -->
                           <?php
                          }else{
                             echo '<p class="text-danger font-weight-bold">Story(s) not found...</p>';
                          }
                        ?>
                     </div>
                 </div> <!--post wrapper -->

            </div>  <!--table 1st row end -->
            </div>  <!--table 1st row end -->
           </div>      <!-- container-fluid -->
        </section>
      </div> <!-- contecnt wrapper -->
    <?php include 'includes/footer.php'; ?>

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


     <script>
       function searchFilter(page_num) {
         page_num = page_num?page_num:0;
         var keywords = $('#keywords').val();
         var sortBy = $('#sortBy').val();
         $.ajax({
             type: 'POST',
             url: 'getData.php',
             data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy,
             beforeSend: function () {
                 $('.loading-overlay').show();
             },
             success: function (html) {
                 $('#postContent').html(html);
                 $('.loading-overlay').fadeOut("slow");
             }
         });
       }
    </script>

  </body>
</html>

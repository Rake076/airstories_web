<?php
session_start();
ob_start();
   ?>
<!DOCTYPE html>
<html>
<head>
     <?php include '../includes/head.php'; ?>
<style media="screen">
  .hr{
    margin-top: 1rem;
    margin-bottom: 2rem;
    border: 0;
    border-top: 5px solid rgba(25,15,3,.1);
    background-color: darkturquoise;
  }
</style>
</head>
 <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
       <!--Top Navbar  -->
        <?php include '../includes/header.php'; ?>
          <!-- /.navbar -->

       <!-- Main Sidebar start -->
         <?php include '../includes/sidebar.php'; ?>
            <!-- Main Sidebar end -->

      <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <div class="content-header">
            <div class="container-fluid m1">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1 class="m-0 text-dark text-muted text-lg"> Gallery </h1>
                  <span class="text-muted text-sm">Total Gallery  :</span> <kbd class="bg-success rounded-circle">
                    <?php
                       $sql = "SELECT count(*) FROM gallery ";
                        $result =mysqli_query($connection,$sql);
                          while($row =mysqli_fetch_assoc($result)){
                          $presents= $row['count(*)'];
                       echo $presents;
                      }
                     ?>
                  </kbd>

                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Home</li>
                    <li class="breadcrumb-item active">Gallery</li>
                  </ol>
                </div><!-- /.col -->
              </div><!-- /.row -->
              <hr>
            </div><!-- /.container-fluid -->
          </div>
          <!-- /.content-header -->

              <!-- Main content -->
          <section class="content">
           <div class="container-fluid">
             <div class="row">
               <div class="col-md-6 offset-2 mb-3">
                 <?php include 'gallery_code.php'; ?>
               </div>
             </div>
            <div class="row">
              <div class="col-md-4 offset-4"> <!-- /.col -->
                <form method="post"enctype='multipart/form-data'>
                  <div class="form-row">
                    <div class="form-group text-muted">
                      <label for="inputAddress">Choose Image</label>
                      <input type="file" title="search image" id="file" name="gname" onchange="show(this)" required/>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3 offset-3">
                      <button type="submit"name="save_gallery" class="btn btn-success btn-block btn-sm m-2 float-right">Save</button>
                    </form>
                    </div>
                  </div>
                  </div>

              </div> <!-- /.col -->
              <hr class="hr">
            </div> <!--1srt form row /.col -->

            <div class="row">
               <div class="col-md-12"> <!-- /.col -->
                <?php
                  // delete code
                   if (isset($_GET['delete'])) {
                     $id = $_GET['delete'];
                       $result = $obj->delete($id, 'gallery');
                     if ($result) {
                       echo '
                       <div class="alert alert-success  alert-dismissible">
                         <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong> Data Deleted Successfully ! </strong>
                      </div>
                      ';
                      header('Refresh:0,url=gallery.php');
                     } else {
                       echo '
                        <div class="alert alert-danger  alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert">&times;</button>
                         <strong> Sorry Data Not Deleted Try Again ! </strong>
                       </div>
                       ';
                       header('Refresh:0,url=gallery.php');
                     }

                   }
                 ?>
                <table class="table table-hover table-sm text-sm"id="sampleTable" >
                  <thead>
                    <tr>
                      <th> Gallery </th>
                        <th>   </th>
                       <th>   </th>
                    </tr>
                   </thead>
                    <tbody>
                      <?php
                           $sql = "SELECT * FROM gallery";
                            $result =mysqli_query($connection,$sql);
                              while($row =mysqli_fetch_assoc($result)){
                                 $id = $row["id"];
                                $name = $row["gname"];
                             $created_at = $row["created_at"];
                            ?>
                          <tr>
                              <td>
                                <img class="zoom" src='../gallery/<?php echo $name; ?>' alt="<?php echo $name; ?>"height="50px"width="50px">

                              </td>
                             <td> <a class="delete" href="gallery.php?delete=<?php echo $id  ?>">Delete</a> </td>
                             <td> <a href="update_gallery.php?edit=<?php echo $id  ?>">Edit</a> </td>
                        </tr>
                      <?php } ?>
                   </tbody>
                </table>
               </div> <!-- /.col -->
            </div>  <!--table 1st row end -->
          </div>      <!-- container-fluid -->
          </section>
      </div> <!-- contecnt wrapper -->


    <?php include '../includes/footer.php'; ?>

  </body>

</html>

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
<?php
if(isset($_POST['page'])){
    // Include pagination library file
    include_once 'Pagination.class.php';
    // Include database configuration file
    require_once '../db.php';
    // Set some useful configuration
    $baseURL = 'getData.php';
    $offset = !empty($_POST['page'])?$_POST['page']:0;
    $limit = 5;
    // Set conditions for search
    $whereSQL = $orderSQL = '';
    if(!empty($_POST['keywords'])){
        $whereSQL = "WHERE b_tittle LIKE '%".$_POST['keywords']."%'";
    }
    if(!empty($_POST['sortBy'])){
        $orderSQL = " ORDER BY b_tittle ".$_POST['sortBy'];
    }else{
        $orderSQL = " ORDER BY b_tittle DESC ";
    }
    // Count of all records
    $query   = $connection->query("SELECT COUNT(*) as rowNum FROM stories ".$whereSQL.$orderSQL);
    $result  = $query->fetch_assoc();
    $rowCount= $result['rowNum'];

    // Initialize pagination class
    $pagConfig = array(
        'baseURL' => $baseURL,
        'totalRows' => $rowCount,
        'perPage' => $limit,
        'currentPage' => $offset,
        'contentDiv' => 'postContent',
        'link_func' => 'searchFilter'
    );
    $pagination =  new Pagination($pagConfig);

    // Fetch records based on the offset and limit
    $query = $connection->query("SELECT * FROM stories $whereSQL $orderSQL LIMIT $offset,$limit");

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
 }
?>

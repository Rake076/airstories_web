<?php
$s = "select * from journals where status='0'";
  $r = mysqli_query($connection,$s);
   $count_story = mysqli_num_rows($r);
    if ($count_story>0) {
      while ($row=mysqli_fetch_assoc($r)) {
        $id = $row["id"];
        $j_id = $row["id"];
         $tittle = $row["tittle"];
          $type = $row["type"];
           $detail = $row["detail"];
          $cover_photo = $row["cover_photo"];
         $posted_by = $row["author"];
        $jdate = $row["jdate"];
      $status = $row["status"];
     $readings = $row["readings"];
    $likes = $row["likes"];
  $comments= $row["comments"];
$created_at = $row["created_at"];
?>

<div class="container pt-40">
  <div class="section-content">
    <div class="row">
      <div class="col-md-12">
        <h3 class="text-uppercase text-theme-colored title line-bottom"> <span class="text-theme-color-2 font-weight-400">JOURNALS</span></h3>
        <div class="owl-carousel-3col owl-nav-top" data-nav="true">
              <div class="item">
                <article class="post clearfix bg-lighter">
                  <div class="entry-header">
                    <div class="post-thumb thumb">
                      <img src="../journalsImages/<?php echo $cover_photo; ?>" alt="<?php echo $cover_photo; ?>" class="img-fullwidth"height="200px">
                    </div>
                    <div class="entry-date media-left text-center flip bg-theme-colored border-top-theme-color-2-3px pt-5 pr-15 pb-5 pl-15">
                      <ul>
                        <li class="font-16 text-white font-weight-600"><?php echo date('d',strtotime($created_at)); ?></li>
                        <li class="font-12 text-white text-uppercase"><?php echo date('M',strtotime($created_at)); ?></li>
                      </ul>
                    </div>
                  </div>
                  <div class="entry-content p-15 pt-10 pb-10">
                    <div class="entry-meta media no-bg no-border mt-0 mb-10">
                      <div class="media-body pl-0">
                        <div class="event-content pull-left flip">
                          <h4 class="entry-title text-white text-uppercase font-weight-600 m-0 mt-5"><a href="read_journal.php?read_journal=<?php echo $id ?>"data-id="<?php echo $id ?>"class="readj"><?php echo $tittle; ?></a></h4>
                          <span class="mb-10 text-gray-darkgray mr-10 font-13"><i class="fa fa-commenting-o mr-5 text-theme-colored"></i> <?php echo $comments.' Comments ' ?></span>
                          <span class="mb-10 text-gray-darkgray mr-10 font-13"><i class="fa fa-heart-o mr-5 text-theme-colored"></i>
                             <?php echo $likes.' Likes'; ?>
                           </span>
                           <span class="mb-10 text-gray-darkgray mr-10 font-13"><i class="fa fa-eye mr-5 text-theme-colored"></i>
                              <?php echo $readings.' Views'; ?>
                            </span>
                        </div>
                      </div>
                    </div>
                    <p class="mt-5">
                      <?php $string = $detail;
                        if (strlen($string) > 45) {
                          ?>
                           <p class="small font-italic"> <?php echo   $trimstring = substr($string, 0, 120). '...'; ?> </p>
                          <?php
                          }else {
                          ?>
                          <p class="small text-primary font-italic">This is about user paragraph and if you want to know more about me click  ...</p>
                          <?php
                          }
                        ?>
                       <a class="text-theme-color-2 font-12 ml-5 readj"data-id="<?php echo $id ?>"href="read_journal.php?read_journal=<?php echo $id ?>"> View Details</a>
                    </p>
                  </div>
                </article>
              </div>
              <?php
                 }
            ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
 // if data exist
}else {
  echo '<span class="text-theme-color-2 font-weight-400 u"> There is No Lates Publication</span>';
}
?>

<?php
$s = "select * from stories where status='0'";
  $r = mysqli_query($connection,$s);
   $count_story = mysqli_num_rows($r);
    if ($count_story>0) {
      while ($row=mysqli_fetch_assoc($r)) {
         $id = $row["id"];
         $b_tittle = $row["b_tittle"];
         $b_type = $row["b_type"];
         $b_description = $row["b_description"];
         $cover_photo = $row["cover_photo"];
         $b_author = $row["b_author"];
         $b_status = $row["b_status"];
?>
<div class="item ">
  <div class="service-block bg-white">
    <div class="thumb">
      <img src="../coverphotos/<?php echo $cover_photo; ?>" alt="<?php echo $cover_photo; ?>" class="img-fullwidth"height="200px">
    <!-- <h4 class="text-white mt-0 mb-0"><span class="price">$125</span></h4> -->
    </div>
    <div class="content text-left flip p-25 pt-0">
      <h4 class="line-bottom mb-10"><?php echo $b_tittle ?></h4>
      <?php $string = $b_description;
        if (strlen($string) >20) {
          ?>
           <p> <?php echo   $trimstring = substr($string, 0,30). '...'; ?> </p>
          <?php
          }else {
          ?>
          <p>This is about user paragraph and if you want to know more This is about user paragraph and if you want to know more about me click on  detail button...</p>
          <?php
          }
        ?>
     <a class="btn btn-danger  btn-sm text-uppercase mt-10 read"data-id="<?php echo $id ?>" href="view_one_story.php?read_story=<?php echo $id; ?>"  title="Read this Story">Read More</a>
    </div>
  </div>
</div>

<?php } // while loop  ?>
<?php
 // if data exist
}else {
  echo '<span class="text-theme-color-2 font-weight-400 u"> Stoies Not Found </span>';
}

?>

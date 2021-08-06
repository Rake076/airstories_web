<style media="screen">
.share-btn-container .fa-facebook {
color: #3b5998;
}

.share-btn-container .fa-twitter {
color: #1da1f2;
}

.share-btn-container .fa-linkedin {
color: #1da1f2;
}

</style>
<?php
  function showSharer($url, $message){
      ?>
          <li class="share-btn-container styled-icons icon-circled m-0">
            <!-- Sharingbutton Facebook -->
            <a class=""data-bg-color="#3A5795" href="https://facebook.com/sharer/sharer.php?u=<?php echo urlencode($url) ?>" target="_blank">
               <i class="fa fa-facebook text-white"></i>
              </a>
          </li>
        <li class="share-btn-container styled-icons icon-circled m-0">
          <!-- Sharingbutton twitter -->
          <a data-bg-color="#55ACEE" href="https://twitter.com/intent/tweet/?text=<?php echo urlencode($message) ?>&amp;url=<?php echo urlencode($url) ?>" target="_blank">
             <i class="fa fa-twitter text-white"></i>
            </a>
        </li>
           <li class="share-btn-container styled-icons icon-circled m-0">
             <a data-bg-color="#A11312"  href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo urlencode($url) ?>&amp;title=<?php echo urlencode($message) ?>&amp;summary=<?php echo urlencode($message) ?>&amp;source=<?php echo urlencode($url) ?>" target="_blank">
                <i class="fa fa-linkedin text-white"></i>
               </a>
           </li>
      <?php
     }
  ?>

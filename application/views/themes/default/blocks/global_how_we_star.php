<div class="portfolio-item">
   <?php if ($block_image) { ?>
  <div class="block_banner">
   
    <img src="<?php echo $img_url; ?>" alt="<?php echo $block_title; ?>" class="img-responsive"/>
</div>
<?php } ?>

  <div class="article-content">
<?php echo $block_contents;?>
     <a href="<?php echo $block_link;?>"><p class="linkto"></p></a>
</div>
</div>
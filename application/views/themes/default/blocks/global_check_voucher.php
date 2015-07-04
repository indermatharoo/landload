<div class="portfolio-item">
   <?php if ($block_image) { ?>
  <div class="block_banner">
   
    <img src="<?php echo $img_url; ?>" alt="<?php echo $block_title; ?>" class="img-responsive"/>
</div>
<?php } ?>

  <div class="article-content-diff-bloc">
  <h2><?php echo  $block_title;?></h2>

<div class="min-hight">
<?php echo $block_contents;?>
    </div>
    <p> <a class="more" href="<?php echo  $block_link;?>" >Discover more</a> </p>
</div>
</div>
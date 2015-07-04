<div class="portfolio-item">
   <?php if ($block_image) { ?>
  <div class="block_banner">
    <img src="<?php echo $img_url; ?>" alt="<?php echo $block_title; ?>" class="img-responsive"/>
</div>
<?php } ?>
  <h1><?php echo  $block_title;?></h1>
<?php echo $block_contents;?>
</div>
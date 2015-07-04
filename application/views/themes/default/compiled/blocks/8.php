<?php if ($block_image) { ?><img src="<?php echo resize($this->config->item('BLOCK_IMAGE_URL').$block_image, 174, 317, 'block_images'); ?>" alt="<?php echo $alt;?>" class="left" /><?php } ?>
      <h2><?php echo $block_title;?></h2>
      <?php echo $block_contents;?>
	<?php if($link != '') { ?>
		<div class="readmore"><a href="<?php echo $link;?>" <?php if($new_window == 1){ echo ' target="_blank"';} ?>>Read the full article here&gt;</a></div>
	<?php } ?>
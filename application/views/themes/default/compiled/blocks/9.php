<div class="services">
	<h3><?php echo $block_title;?></h3>
	<?php if ($block_image) { ?><div class="services_img"><img src="<?php echo resize($this->config->item('BLOCK_IMAGE_URL').$block_image, 288, 181, 'block_images'); ?>" alt="<?php echo $alt;?>" /></div><?php } ?>
	<?php echo $block_contents;?>
	<?php if($link != '') { ?>
		<div class="readmore"><a href="<?php echo $link;?>" <?php if($new_window == 1){ echo ' target="_blank"';} ?>>Read the full article here&gt;</a></div>
	<?php } ?>
</div>
<div class="block_layout1 cf">
<?php if ($block_image) { ?>
<div class="left">
	<div class="block_img">
    <?php if ($link != '') { ?>
        <a href="<?php echo $link; ?>"<?php if ($new_window == 1) { echo ' target="_blank"'; }?>><img src="<?php echo resize($this->config->item('BLOCK_IMAGE_URL').$block_image, 217,190, 'block_images'); ?>" alt="<?php echo $alt;?>"/></a>
    <?php } else {?>
        <img src="<?php echo resize($this->config->item('BLOCK_IMAGE_URL').$block_image, 217,190, 'block_images'); ?>" alt="<?php echo $alt;?>"  />
    <?php } ?>
	</div>
</div>
<?php } ?>
	<div class="block_text right">
		<h2><?php echo $block_title;?></h2>
		<?php echo $block_contents;?>
		<?php $href_txt = ($readmore_txt != '')?$readmore_txt:'Read more &gt;';?>
		<?php if ($link != '') { ?>
			<div class="readmore">
				<a href="<?php echo $link; ?>" <?php if ($new_window == 1) { echo ' target="_blank"'; }?>><?php echo $href_txt;?></a>
			</div>
		<?php } ?>
	</div>
</div>
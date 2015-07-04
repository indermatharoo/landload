<div class="block_layout2 cf">
<h2><?php echo $block_title;?></h2>
<?php if ($block_image) { ?>
<div class="block_banner">
    <?php if ($link != '') { ?>
    <a href="<?php echo $link;?>"<?php if ($new_window == 1) { echo ' target="_blank"'; } ?>>
        <img src="<?php echo resize($this->config->item('BLOCK_IMAGE_URL') . $block_image, 430, 430, 'block_images'); ?>" alt="<?php echo $alt; ?>" />
    </a><?php } else {?>
    <img src="<?php echo resize($this->config->item('BLOCK_IMAGE_URL') . $block_image, 430, 430, 'block_images'); ?>" alt="<?php echo $alt; ?>" />
    <?php } ?>
</div>
<?php } ?>

<?php echo $block_contents;?>
<?php $href_txt = ($readmore_txt != '')?$readmore_txt:'Read more &gt;';?>
<?php if ($link != '') { ?>
	<div class="readmore">
		<a href="<?php echo $link; ?>" <?php if ($new_window == 1) { echo ' target="_blank"'; }?>><?php echo $href_txt;?></a>
	</div>
<?php } ?>
</div>
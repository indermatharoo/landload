<div class="block_layout3 cf">
    <?php if ($block_image) { ?><div class="block_img right"><img src="<?php echo resize($this->config->item('BLOCK_IMAGE_URL') . $block_image, 217, 190, 'block_images'); ?>" alt="<?php echo $alt; ?>"/></div><?php } ?>
    <div class="block_text left"<?php
    if (!$block_image) {
        echo ' style="width: 100%"';
    }
    ?>>
        <h3><?php echo $block_title; ?></h3>
        <?php echo $block_contents; ?>
        <?php if ($link != '') { ?>
            <div class="readmore"><a href="<?php echo $link; ?>" <?php if ($new_window == 1) {
            echo ' target="_blank"';
        } ?>>Read the full article here&gt;</a></div>
<?php } ?>
    </div>
</div>
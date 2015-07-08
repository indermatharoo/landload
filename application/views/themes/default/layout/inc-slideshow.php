<div id="carousel-example" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <?php
        $c = '';
        foreach ($slides as $slide) {
            ++$c;
            ?>
            <div class="item <?php echo $c == 1 ? 'active' : ''; ?> ">
                <?php if ($slide['link'] !== '') { ?>
                    <a href="<?php echo $slide['link']; ?>" <?php
                    if ($slide['new_window'] == 1) {
                        echo ' target="_blank"';
                    }
                    ?>>
                        <img src="<?php echo $this->config->item('SLIDESHOW_IMAGE_URL') . $slide['slideshow_image']; ?>"  alt="<?php echo $slide['alt']; ?>" />
                    </a>
                <?php } else { ?>
                    <img src="<?php echo $this->config->item('SLIDESHOW_IMAGE_URL') . $slide['slideshow_image']; ?>"  alt="<?php echo $slide['alt']; ?>" />
                <?php } ?>
            </div>
        <?php } ?>
    </div>

    <a class="left carousel-control" href="#carousel-example" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    <a class="right carousel-control" href="#carousel-example" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
    </a>
</div>
<div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <div class="logo_container">
        <div class="logo">
            <a href="<?php echo base_url(); ?>">
                <img src="imgs/logo.png" class="img-responsive"/>
            </a>
        </div>
    </div>
</div>
<div id="navbar" class="navbar-collapse collapse top_mymenu">
    <?php
    $params = array(
        'menu_alias' => 'header_menu',
        'ul_format' => '<ul class="nav navbar-nav navbar-right">{MENU}</ul>',
        'level_1_format' => '<a href="{HREF}"{ADDITIONAL}><span>{LINK_NAME}</span></a>',
        'level_2_format' => '<a href="{HREF}"{ADDITIONAL}><span>{LINK_NAME}</span></a>'
    );

    echo $CI->html->menu($params);
    ?>
</div><!--/.nav-collapse -->

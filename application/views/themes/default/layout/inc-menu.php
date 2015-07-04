<nav class="navbar ">
    <div class="container-fluid padding-0">
        <div class="navbar-header">
            <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed pull-right" type="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="fa fa-bars fa-2x"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar">
            <?php
            $params = array(
                'menu_alias' => 'main_menu',
                'ul_format' => '<ul class="nav navbar-nav navbar-right">{MENU}</ul>',
                'level_1_format' => '<a href="{HREF}"{ADDITIONAL}><span>{LINK_NAME}</span></a>',
                'level_2_format' => '<a href="{HREF}"{ADDITIONAL}><span>{LINK_NAME}</span></a>'
            );
            
            echo $CI->html->menu($params);
            ?>
        </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
</nav>

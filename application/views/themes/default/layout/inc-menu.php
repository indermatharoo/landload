
<div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
         
    <!--a class="navbar-brand" href="#">Project name</a-->
</div>



<div id="navbar" class="navbar-collapse collapse">
          <?php
            $params = array(
                'menu_alias' => 'header_menu',
                'ul_format' => '<ul class="nav navbar-nav"><li class="active"><a href="'.$_SERVER['PHP_SELF'].'"><i class="fa fa-home"></i></a></li>{MENU}</ul>',
                'level_1_format' => '<a href="{HREF}"{ADDITIONAL}><span>{LINK_NAME}</span></a>',
                'level_2_format' => '<a href="{HREF}"{ADDITIONAL}><span>{LINK_NAME}</span></a>'
            );

            echo $CI->html->menu($params);
    ?>
</div><!--/.nav-collapse -->


<header class="panel-heading">
    <div class="row">
        <div class="col-sm-1">
            <a href="cms/menu"><h3 style="margin: 0; cursor: pointer; color: #fff"><i class="fa fa-home" title="Manage Menu"></i></h3></a>
        </div>
        <div class="col-sm-10" style="text-align: center">
            <h3 style="margin: 0;"><?php echo $menu_detail['menu_name']; ?></h3>
        </div>
        <div class="col-sm-1" style="text-align: right">
            <a href="cms/menu_item/add/<?php echo $menu_detail['menu_id']; ?>"><h3 style="cursor: pointer; margin: 0; color: #fff;"><i class="fa fa-plus-square" title="Add Menu Item"></i></h3></a>
        </div>
    </div>
</header>
<div class="col-sm-12 padding-0">
    <?php $this->load->view(THEME . 'messages/inc-messages'); ?>
    <?php
    if (count($menu_items) == 0) {
        $this->load->view(THEME . 'messages/inc-norecords');
        return;
    }
    ?>

    <div class="tableWrapper">
        <?php echo $menutree; ?>
    </div>
</div>
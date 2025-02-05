<header class="panel-heading">
    <div class="row">
        <div class="col-sm-1" style="text-align: right">
            <a href="cms/menu_item/index/<?php echo $menu_item['menu_id']; ?>"><h3 style="cursor: pointer; margin: 0; color: #fff"><i class="fa fa-arrow-left" title="Manage Menu Items"></i></h3></a>
        </div>
        <div class="col-sm-10">
            <h3 style="margin: 0; text-align: center">Edit Menu Item</h3>
        </div>
        <div class="col-sm-1">
            <a href="cms/menu"><h3 style="margin: 0; cursor: pointer; color: #fff"><i class="fa fa-home" title="Manage Menu"></i></h3></a>
        </div>
    </div>
</header>
<div class="col-sm-12 padding-0" style="margin-top: 15px">
    <div id="cms">
        <?php $this->load->view(THEME . 'messages/inc-messages'); ?>
        <form action="cms/menu_item/edit/<?php echo $menu_item['menu_item_id']; ?>" method="post" enctype="multipart/form-data" name="regFrm" id="regFrm">
            <div class="form-group">
                <label class="control-label">Parent</label>
                <?php echo form_dropdown('parent_id', $parent_menu, set_value('parent_id', $menu_item['parent_id']), ' class="form-control"'); ?>
            </div>
            <div class="form-group">
                <label class="control-label">Menu Item Type <span class="error">*</span></label>
                <?php echo form_dropdown('menu_item_type', $menu_item_types, set_value('menu_item_type', $menu_item['menu_item_type']), ' id="menu_item_type" class="form-control"'); ?>
            </div>
            <div class="form-group">
                <label class="control-label">Menu Item Name <span class="error">*</span></label>
                <input  maxlength="100" type="text" class="form-control" name="menu_item_name" id="menu_item_name" value="<?php echo set_value('menu_item_name', $menu_item['menu_item_name']); ?>"/>
            </div>
            <div class="form-group">
                <label class="control-label">Page <span class="error">*</span></label>
                <?php echo form_dropdown('page_id', $pages, set_value('page_id', $menu_item['menu_item']), ' class="form-control"'); ?>
            </div>
            <div class="form-group">
                <label class="control-label">URL <span class="error">*</span></label>
                <input  maxlength="100" type="text" class="form-control" name="url" id="url" value="<?php echo set_value('url', $menu_item['menu_item']); ?>"/>
            </div>
            <div class="form-group">
                <label class="control-label">Open in New Window <span class="error">*</span></label><br>
                <input type="radio" name="new_window" value="1" <?php echo set_radio('new_window', '1', ($menu_item['new_window'] == 1)); ?> />Yes 
                <input type="radio" name="new_window" value="0" <?php echo set_radio('new_window', '0', ($menu_item['new_window'] == 0)); ?> />No
            </div>
            <p style="text-align:center"><input class="btn btn-primary" type="submit" name="button" id="button" value="Submit"></p>
        </form>
    </div>
</div>
<header class="panel-heading">
    <div class="row">
        <div class="col-sm-10">
            <h3 style="margin: 0;">Add Menu</h3>
        </div>
        <div class="col-sm-2" style="text-align: right">
            <a href="cms/menu"><h3 style="cursor: pointer; margin: 0; color: #fff"><i class="fa fa-home" title="Manage Menus"></i></h3></a>
        </div>
    </div>
</header>
<div class="col-sm-12 padding-0 mar-top15">
    <?php $this->load->view(THEME . 'messages/inc-messages'); ?>
    <form action="cms/menu/add/" method="post" enctype="multipart/form-data" name="addcatform" id="addcatform">
        <div class="form-group">
            <label class="control-label">Menu Name <span class="error">*</span></label>
            <input  maxlength="100" type="text" class="form-control" name="menu_name" id="menu_name" value="<?php echo set_value('menu_name'); ?>"/>
        </div>
        <div class="form-group">
            <label class="control-label">Menu Alias</label>
            <input  maxlength="100" type="text" class="form-control" name="menu_alias" id="menu_alias" value="<?php echo set_value('menu_alias'); ?>"/>
        </div>
        <p style="text-align:center">Fields marked with <span class="error">*</span> are required.</p>
        <p style="text-align:center"><input type="submit" name="button" id="button" value="Submit" class="btn btn-primary"></p>
    </form>
</div>
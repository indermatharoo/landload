<header class="panel-heading">
    <div class="row">
         <div class="col-sm-1">
            <i class="fa fa-bars fa-2x"></i>
        </div>
        <div class="col-sm-10">
            <h3 style="margin: 0; text-align: center">Menus</h3>
        </div>
        <div class="col-sm-1" style="text-align: right">
            <a href="cms/menu/add"><h3 style="cursor: pointer; margin: 0; color: #fff;"><i class="fa fa-plus-square" title="Add Menu"></i></h3></a>
        </div>
    </div>
</header>
<div class="col-sm-12 padding-0 mar-top15">
    <?php
    if (count($menu) == 0) {
        $this->load->view(THEME . 'messages/inc-norecords');
    } else {
        $this->load->view(THEME . 'messages/inc-messages');
        ?>
        <div class="tableWrapper">
            <table width="100%" border="0" cellpadding="2" cellspacing="0" class="grid">
                <tr style="background: #EAEAEA">
                    <th width="75%">Menu Alias</th>
                    <th width="25%">Action</th>
                </tr>
                <?php foreach ($menu as $item) { ?>
                    <tr  class="<?php echo alternator('', 'alt'); ?>">
                        <td><?php echo $item['menu_alias']; ?></td>
                        <td><a href="cms/menu_item/index/<?php echo $item['menu_id']; ?>">Menu Items</a> | <a href="cms/menu/edit/<?php echo $item['menu_id']; ?>">Edit</a> | <a href="cms/menu/delete/<?php echo $item['menu_id'] ?>" onclick="return confirm('Are you sure you want to Delete this Menu ?');">Delete</a></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    <?php } ?>
</div>
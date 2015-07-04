<h1>Add Global Block</h1>

<div id="ctxmenu"><a href="cms/globalblock">Manage Global Block</a></div>
<?php $this->load->view(THEME.'messages/inc-messages'); ?>
<div style="float: left; width: 100%">
    <div id="tabs">
        <ul class="nav" id="tabs-nav">
            <li><a href="#tabs-1">Main</a></li>
            <li><a href="#tabs-2">Template </a>
        </ul>
        <form action="cms/globalblock/add/" method="post" enctype="multipart/form-data" name="add_frm" id="add_frm">
            <div id="tabs-1" class="tab">
                <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0" class="formtable">
                    <tr>
                        <th>Block Title <span class="error">*</span></th>
                        <td><input type="text" name="block_title" id="block_title" class="textfield" size="40" value="<?php echo set_value('block_title'); ?>" /></td>
                    </tr>
                    <tr>
                        <th>Block Alias <span class="error">*</span></th>
                        <td><input type="text" name="block_alias" id="block_alias" class="textfield" size="40" value="<?php echo set_value('block_alias'); ?>" /></td>
                    </tr>
                    <tr>
                        <th>Block Content</th>
                        <td><textarea name="block_contents" class="textfield" id="block_contents" cols="25" rows="5"><?php echo set_value('block_alias'); ?></textarea></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Fields marked with <span class="error">*</span> are required.</td>
                    </tr>
                </table>
            </div>
            <div id="tabs-2" class="tab">
                <table width="100%" border="0" cellspacing="0" cellpadding="4" class="formtable">
                    <tr>
                        <td colspan="2"><textarea name="block_template" cols="0" rows="25" style="width:99%" class="textfield" id="block_template"><?php echo set_value('block_template'); ?></textarea></td>
                    </tr>

                </table>
            </div>
            <p style="text-align:center"><input name="v_image" type="hidden" id="v_image" value="1" /><input type="submit" name="button" id="button" value="Submit"></p>
        </form>
    </div>
</div>
<h1>Add Template</h1>
<div id="ctxmenu"><a href="cms/template/">Manage Template</a></div>
<?php $this->load->view(THEME.'messages/inc-messages'); ?>
<div style="float: left; width: 100%">
			<form action="cms/template/add/" method="post" enctype="multipart/form-data" name="add_frm" id="add_frm">
					<table width="100%" border="0" align="center" cellpadding="2" cellspacing="0" class="formtable">
						<tr>
							<th width="15%">Template Name <span class="error">*</span></th>
							<td width="85%"><input type="text" name="template_name" id="template_name" class="textfield" size="40" value="<?php echo set_value('template_name'); ?>" /></td>
						</tr>
						<tr>
							<th>Template Alias</th>
							<td><input type="text" name="template_alias" id="template_alias" class="textfield" size="40" value="<?php echo set_value('template_alias'); ?>" />
								&nbsp;(Will be auto-generated if left blank)</td>
						</tr>
						<tr>
							<th>Template <span class="error">*</span></th>
							<td><textarea name="template_contents" cols="0" rows="50" style="width:90%" class="textfield" id="template_contents"><?php echo set_value('template_contents'); ?></textarea></td>
						</tr>
						<tr>
							<td>Fields marked with <span class="error">*</span> are required.</td>
							<td><input type="submit" name="button" id="button" value="Submit"></td>
						</tr>
					</table>
			</form>
	</div>
</div>
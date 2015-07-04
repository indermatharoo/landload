<h1>Add SMS Template</h1>
<div id="ctxmenu"><a href=" sms_template/index/">Manage SMS Template</a></div>
<?php $this->load->view(THEME.'messages/inc-messages'); ?>
<form action="sms_template/add/" method="post" enctype="multipart/form-data" name="editemlform" id="editemlform">
	<table width="100%" border="0" align="center" cellpadding="2" cellspacing="0" class="formtable">

		<tr>
			<th>Name <span class="error">*</span></th>
			<td><input name="name" type="text" class="textfield" size="40" id="name" value="<?php echo set_value('name'); ?>" style="width: 80%" /></td>
		</tr>
		<tr>
			<th></th>
			<td></td>
		</tr>
		<tr>
			<th width="15%">Message <span class="error">*</span></th>
			<td width="85%"><textarea name="message" type="text" class="textfield" style="width: 90%" id="message" rows="20" cols="100"><?php echo set_value('message'); ?></textarea></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>Fields marked with <span class="error">*</span> are required.</td>
		</tr>
	</table>
	<p style="text-align:center"><input type="submit" name="button" id="button" value="Submit"></p>
</form>
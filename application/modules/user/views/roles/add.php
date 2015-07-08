<h1>Add Role</h1>
<div id="ctxmenu"><a href="user/role">Manage Roles</a></div>
<?php $this->load->view(THEME.'messages/inc-messages'); ?>
<form action="user/role/add/" method="post" enctype="multipart/form-data" name="form1" id="form1">
	<table width="100%" border="0" cellspacing="0" cellpadding="2">
		<tr>
			<th width="20%">Role <span class="error">*</span></th>
			<td width="80%"><input name="role" type="text" id="role" size="40" class="inputfield" value="<?= set_value('role'); ?>"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>Fields mark with <span class="error">*</span> required</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" name="button" id="button" value="Submit"></td>
		</tr>
	</table>
</form>

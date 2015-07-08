<h1>Edit <?= $role['role']; ?> Role</h1>
<div id="ctxmenu"><a href="user/role">Manage Roles</a></div>
<?php $this->load->view(THEME.'messages/inc-messages'); ?>


<form action="user/role/edit/<?php echo $role['role_id']; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
    <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
            <th width="20%">Role <span class="error">*</span></th>
            <td width="80%"><input name="role" type="text" id="role" size="40" class="textfield" value="<?= set_value('role', $role['role']); ?>"></td>
        </tr>
		<?php if ($role['role_id'] != 1) { ?>
			<tr>
				<th>Permissions</th>
				<td>
					<table width="100%" border="0" cellspacing="0" cellpadding="2">
						<tr>
							<?php
							$total_permission = count($resources);
							$counter = 0;
							$columns = 5;
							$per_colum = ceil($total_permission / $columns);

							for ($i = 1; $i <= $columns; $i++) {
								?>
								<td style="vertical-align:top">
									<?php
									for ($j = 1; $j <= $per_colum; $j++) {
										if ($counter >= $total_permission)
											continue;
										$tmp = each($resources);
										$key = $tmp['key'];
										$val = $tmp['value'];
										echo form_checkbox('protected_resource_id[]', $key, in_array($key, $current_permissions) ? true : false) . ' ' . $val . '<br />';
										$counter++;
									}
									?>
								</td>
								<?php } ?>
						</tr>
					</table>
				</td>
			</tr>
		 <?php } ?>
        <tr>
            <td>&nbsp;</td>
            <td><small>Fields mark with <span class="error">*</span> required</small></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="button" id="button" value="Submit"></td>
        </tr>
    </table>
    <input type="hidden" name="user_id" id="user_id" value="<?php echo $role['role_id']; ?>">
</form>

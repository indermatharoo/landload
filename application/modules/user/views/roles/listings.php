<h1>Manage Roles</h1>
<div id="ctxmenu"><a href="user/role/add/">Add New Role</a></div>
<?php $this->load->view(THEME.'messages/inc-messages'); ?>
<?php
if (count($roles) == 0) {
	$this->load->view(THEME.'messages/inc-norecords');
}
?>

<div class="tableWrapper">
	<table width="100%" border="0" cellpadding="2" cellspacing="0">
		<tr>
			<th width="70%" class="border">Role</th>
			<th width="30%" class="border">Action</th>
		</tr>
		<?php foreach ($roles as $role) { ?>
		<tr class="<?php echo alternator('', 'alt'); ?>">
			<td><?= $role['role']; ?></td>
			<td><a href="user/role/edit/<?php echo $role['role-']; ?>">Edit</a><?php if ($role['role_id'] > 1) { ?>  | <a href="user/role/delete/<?php echo $role['role_id']; ?>" onclick="return confirm('Are you sure you want to delete this role?');">Delete</a><?php } ?> </td>
		</tr>
		<?php } ?>
	</table>
</div>
<p style="text-align:center"><?= $pagination; ?></p>
<h1>Manage SMS Templates </h1>

<div id="ctxmenu"><a href="sms_template/add">Add SMS Template</a></div>
<?php
$this->load->view(THEME.'messages/inc-messages');
if (count($sms_templates) == 0) {
	$this->load->view(THEME.'messages/inc-norecords');
} else {

	?>
	<div class="tableWrapper">
		<table width="100%" border="0" cellpadding="2" cellspacing="0" class="grid">
			<tr>
				<th width="80%">Name</th>
				<th width="20%">Action</th>
			</tr>
	<?php foreach ($sms_templates as $item) { ?>
				<tr  class="<?php echo alternator('', 'alt'); ?>">
					<td><?php echo $item['sms_name']; ?></td>
					<td><a href="sms_template/edit/<?php echo $item['sms_template_id']; ?>">Edit</a> | <a href="sms_template/delete/<?php echo $item['sms_template_id'] ?>"  onclick="return confirm('Are you sure you want to Delete this SMS Template?');">Delete</a></td>
				</tr>
	<?php } ?>
		</table>
	</div>
<?php } ?>
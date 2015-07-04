<h1>Manage Pending Customers</h1>
<?php $this->load->view(THEME.'messages/inc-messages'); ?>
<?php
if (count($customers) == 0) {
    $this->load->view(THEME.'messages/inc-norecords');
} else {
    ?>

<div style="padding: 4px; border: 1px solid #f4f4f4; margin-bottom: 20px; border-radius: 5px; background-color: #CFCFCF">
	<div class="row collapse">
		<div class="small-6 columns">
		</div>
		<div class="small-6 columns" style="text-align: right">
			<input class="uibutton" type="button" name="approve_all" id="approve_all" value="Approve Selected">
		</div>
	</div>
</div>

    <div class="tableWrapper">
		<form action="customer/customer/pending" method="post" name="list_frm" id="list_frm" style="margin-bottom: 0px;">
        <table width="100%" border="0" cellpadding="2" cellspacing="0" class="grid">
            <tr class="border">
				<th width="2%"><input type="checkbox" name="select_all" value="1" /></th>
                <th width="78%">Email</th>
                <th width="20%">Action</th>
            </tr>
            <?php
            foreach ($customers as $row) {
                ?>
                <tr class="<?php echo alternator('', 'alt') ?>">
                    <td><input type="checkbox" name="ids[]" class="ids" value="<?php echo $row['customer_id']; ?>" /></td>
					<td><?php echo $row['email']; ?></td>
                    <td><a href="customer/type/<?php echo $row['customer_id']; ?>">Approve</a> | <a href="customer/confirm/<?php echo $row['customer_id']; ?>">Resend Email</a> | <a href="customer/reject/<?php echo $row['customer_id'] ?>" onclick="return confirm('Are you sure you want to Reject this Customer Profile?');">Reject</a></td>
                </tr>
            <?php } ?>
        </table>
		</form>
    </div>
    <p style="text-align:center"><?php echo $pagination; ?></p>
<?php } ?>
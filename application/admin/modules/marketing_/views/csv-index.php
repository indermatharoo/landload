<h1>Export CSV</h1>
<?php $this->load->view(THEME.'messages/inc-messages'); ?>
<form action="marketing/csv" method="post" enctype="multipart/form-data" name="filter_frm" id="filter_frm">
	<div class="row">
		<div class="small-6 columns">
			<table>
				<tr>
					<th style="vertical-align: top">Select Customers: <span class="error">*</span></th>
					<td>
						<table width="100%"  border="0" cellpadding="2" cellspacing="0" style="width: 320px">
							<tr>
								<td width="20"><input type="radio" name="campaign_option" value="-1" <?php echo set_radio('campaign_option', '-1'); ?>  /></td>
								<td width="300">All Customers</td>
							</tr>
							<tr>
								<td><input type="radio" name="campaign_option" value="-2" <?php echo set_radio('campaign_option', '-2'); ?>  /></td>
								<td>Guardian Only</td>
							</tr>
							<tr>
								<td><input type="radio" name="campaign_option" value="0" <?php echo set_radio('campaign_option', '0'); ?>  /></td>
								<td>Customers haven't ordered ever</td>
							</tr>
							<tr>
								<td><input type="radio" name="campaign_option" value="7" <?php echo set_radio('campaign_option', '7'); ?> /></td>
								<td>Customers haven't ordered in the the last 7 days</td>
							</tr>
							<tr>
								<td><input type="radio" name="campaign_option" value="14" <?php echo set_radio('campaign_option', '14'); ?> /></td>
								<td>Customers haven't ordered in the the last 14 days</td>
							</tr>
							<tr>
								<td><input type="radio" name="campaign_option" value="21" <?php echo set_radio('campaign_option', '21'); ?> /></td>
								<td>Customers haven't ordered in the the last 21 days</td>
							</tr>
						</table>
					</td>
				</tr>

				<?php if ($this->user_type == 'ADMIN') { ?>
					<tr>
						<th style="vertical-align: top;">Branches</th>
						<td>
							<div style="margin-bottom: 5px;"><input type="checkbox" name="select_all" id="select_all" value="all"> <label for="select_all"> All</label></div>
							<?php
							foreach ($branches as $key => $val) {
								$field_id = "branch_$key";
								$checked = ($this->input->post('branches', TRUE) && in_array($key, $this->input->post('branches', TRUE))) ? true : false;
								?>
								<div style="margin-bottom: 5px;"><?php echo form_checkbox('branches[]', $key, $checked, ' id="' . $field_id . '" class="branches"') . ' <label for="' . $field_id . '"> ' . $val . "</label>"; ?></div>
							<?php } ?>
						</td>
					</tr>
				<?php } ?>

				<tr>
					<th>&nbsp;</th>
					<td><p><input type="submit" name="button" value="Export as CSV "></p></td>
				</tr>

			</table>
		</div>

	</div>
	<div style="clear:both;">
	</div>		
</form>
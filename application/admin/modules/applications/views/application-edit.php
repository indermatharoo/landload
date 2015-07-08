<?php
// echo "<pre>";
//print_r($details);
?>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<link href="css/smoothness/jquery-ui.css" rel="stylesheet"/>
<header class="panel-heading">
    <div class="row">
        <div class="col-sm-1">
            <i class="fa fa-user fa-2x"></i>
        </div>
        <div class="col-sm-10">
            <h3 style="margin: 0; text-align: center">Add Applications / Lease Management</h3>
        </div>
        <div class="col-sm-1" style="text-align: right">
            <a href="applications"><h3 style="cursor: pointer; margin: 0; color: #fff"><i class="fa fa-home" title="Manage Applications / Lease Management"></i></h3></a>
        </div>
    </div>
</header>
<div class="col-lg-12 padding-0 mar-top15">
    <?php $this->load->view(THEME . 'messages/inc-messages'); ?>
  
    <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" class="add-user">
        <div class="form-group">
            <div class="col-sm-6">
                <label>Applicant/Tenant</label>
                <select class="form-control" name="applicant_id">
                    <option></option>
                    <?php foreach ($allApplicants as $applicant) { ?>
                        <option value="<?php echo $applicant['applicant_id'] ?>" <?php echo ($applicant['applicant_id'] == $details['applicant_id']) ? 'selected' : '' ?>><?php echo $applicant['fname'] . ' ' . $applicant['lname'] ?></option>
                    <?php } ?>
                </select>
            </div>
            
            <div class="col-sm-6">
                <label>Property </label>
                <select class="form-control" name="property_id">
                    <option></option>
                    <?php foreach ($propertiesList as $property) { ?>
                        <option value="<?php echo $property['id'] ?>" <?php echo ($property['id'] == $details['property_id']) ? 'selected' : '' ?>><?php echo $property['pname'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-sm-6">
                <label>Unit Applied For </label>
                <?php
                $ci = &get_instance();
                $ci->load->model('units/Unitsmodel');
                $res = $ci->Unitsmodel->getUnitsByPropertyId($details['property_id']);
                ?>
                <select class="form-control" name="unit_id">
                    <option></option>
                    <?php foreach ($res as $unit) { ?>
                        <option value="<?php echo $unit['id'] ?>" <?php echo ($unit['id'] == $details['unit_id'] ) ? 'selected' : ''; ?>><?php echo $unit['unit_number'] ?></option>
                    <?php } ?>
                </select>
            </div>            
            
            <div class="col-sm-6">
                <label>Total number of occupants</label>
                <input type="text" class="form-control" name="occupants" placeholder="Occupants *" value="<?php echo $details['occupants']; ?>">
            </div>
            <div class="col-sm-6">
                <label>Lease period from </label>
                <input type="text" class="form-control datepicker" name="lease_from"  placeholder="Lease From *" value="<?php echo $details['lease_from']; ?>">
                <label>Lease period to </label>
                <input type="text" class="form-control datepicker" name="lease_to"  placeholder="Lease To *" value="<?php echo $details['lease_to']; ?>">
            </div>   
            <div class="col-sm-6">
                <label>Recurring Charges frequency </label>
                <select name="charges_frequence" class="form-control" >
                    <option></option>
                    <option value="0" <?php echo ($details['charges_frequency'] = "0") ? 'selected' : '' ?>>Month</option>
                    <option value="1" <?php echo ($details['charges_frequency'] = "1") ? 'selected' : '' ?>>Year</option>
                </select>
            </div>   
            <div class="col-sm-6">
                <label>Next Due Date </label>
                <input type="text" class="form-control datepicker" name="next_due" value="<?php echo $details['next_due']; ?>" placeholder="Next Due Date *">
            </div>   
            <div class="col-sm-6">
                <label>Rental Amount </label>
                <input type="text" class="form-control " name="rental_amount" value="<?php echo $details['rent_amount']; ?>"   placeholder="Rental Amount *">
            </div>
            <div class="col-sm-6">
                <label>Security Deposit </label>
                <input type="text" class="form-control " name="security_amount" value="<?php echo $details['security_amount']; ?>" placeholder="Security Deposit *">
            </div>         
            <div class="col-sm-6">
                <label>Security Deposit Date </label>
                <input type="text" class="form-control datepicker" name="security_deposit_date" value="<?php echo $details['security_date']; ?>" placeholder="Security Deposit Date*">
            </div>  
            <div class="col-sm-6">
                <label>Application Status</label><br>
                <?php foreach ($applicationType as $atype) { ?>
                    <input type="radio" name="application_status" <?php echo ($atype['code'] == $details['application_status']) ? 'checked' : '' ?> value="<?php echo $atype['code'] ?>"><?php echo $atype['status']; ?><br>
                <?php } ?>
            </div>
            <div class="col-sm-6">
                <label>Lease Type</label><br>
                <?php foreach ($leaseTypes as $leasetype) { ?>
                    <input type="radio" name="lease_type" <?php echo ($leasetype['code'] == $details['lease_type']) ? 'checked' : '' ?> value="<?php echo $leasetype['code'] ?>"><?php echo $leasetype['type']; ?><br>
                <?php } ?>
            </div>
            <div class="col-sm-6">
                <label>Emergency Contact </label>
                <textarea class="form-control " name="emeregency_contact"><?php echo $details['emergency_contact']; ?></textarea>
            </div> 
            <div class="col-sm-6">
                <label>Co-signer Details </label>
                <textarea class="form-control " name="cosigner"><?php echo $details['co_signer']; ?></textarea>
            </div>
            <div class="col-sm-6">
                <label>Notes </label>
                <textarea class="form-control " name="notes"><?php echo $details['notes']; ?></textarea>
            </div>  
        </div>

        <div class="form-group">
            <div class="col-sm-12 text-center">
                Fields mark with <span class="error">*</span> required
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12 center">
                <button type="submit" name="button" id="button" class="btn btn-primary preview-add-button btn-fix-width">Add</button>
            </div>
        </div>
    </form>
</div> 
<script>
    $(document).ready(function () {
        $('.datepicker').datepicker({dateFormat: 'yy-mm-dd'});
        $('select[name="property_id"]').on("change", function () {
            var ths = $(this).val();
            $.ajax({
                url: 'units/getunits',
                type: 'post',
                data: {unit_id: ths}
            }).done(function (data) {
                $('select[name="unit_id"]').html(data);
            })
        })

    })
</script>
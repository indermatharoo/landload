<script type="text/javascript" src="js/jquery-ui.js"></script>
<link href="css/smoothness/jquery-ui.css" rel="stylesheet"/>
<header class="panel-heading">
    <div class="row">
        <div class="col-sm-1">
            <i class="fa fa-user fa-2x"></i>
        </div>
        <div class="col-sm-10">
            <h3 style="margin: 0; text-align: center">Add Applicants and tenants</h3>
        </div>
        <div class="col-sm-1" style="text-align: right">
            <a href="applicants"><h3 style="cursor: pointer; margin: 0; color: #fff"><i class="fa fa-home" title="Manage Applicants/Tenants"></i></h3></a>
        </div>
    </div>
</header>
<div class="col-lg-12 padding-0 mar-top15">
    <?php $this->load->view(THEME . 'messages/inc-messages'); ?>
    <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" class="add-user">
        <div class="form-group">
            <div class="col-sm-6">
                <label>First name<span class="red">*</span></label>
                <input type="text" class="form-control" name="fname"  placeholder="First name *" value="<?php echo arrIndex($postdata, 'fname') ?>">
            </div>
            <div class="col-sm-6">
                <label>Last name<span class="red">*</span></label>
                <input type="text" class="form-control" name="lname"  placeholder="Last name *" value="<?php echo arrIndex($postdata, 'lname') ?>">
            </div>
            <div class="col-sm-6">
                <label>Email <span class="red">*</span></label>
                <input type="text" class="form-control" name="email"  placeholder="Email *" value="<?php echo arrIndex($postdata, 'email') ?>">
            </div>
            <div class="col-sm-6">
                <label>password <span class="red">*</span></label>
                <input type="password" class="form-control" name="passwd"  placeholder="password *">
            </div>            
            <div class="col-sm-6">
                <label>Confirm password <span class="red">*</span></label>
                <input type="password" class="form-control" name="conpasswd"  placeholder="password *">
            </div>            
            <div class="col-sm-6">
                <label>Address <span class="red">*</span></label>
                <input type="text" class="form-control" name="address"  placeholder="Address *"  value="<?php echo arrIndex($postdata, 'address') ?>">
            </div>   
            <div class="col-sm-6">
                <label>Phone <span class="red">*</span></label>
                <input type="text" class="form-control" name="phone"  placeholder="Phone *" value="<?php echo arrIndex($postdata, 'phone') ?>">
            </div>
            <div class="col-sm-6">
                <label>Birth date <span class="red">*</span></label>
                <input type="text" class="form-control" name="birth_date" id="datepicker" placeholder="Birth date *" value="<?php echo arrIndex($postdata, 'birth_date') ?>">
            </div>   
            <div class="col-sm-6">
                <label>Passport Number </label>
                <input type="text" class="form-control" name="license"  placeholder="Driver License Number *" value="<?php echo arrIndex($postdata, 'license') ?>">
            </div>
            <div class="col-sm-6">
                <label>Monthly Income </label>
                <input type="text" class="form-control" name="monthly_gross"  placeholder="Monthly Income *" value="<?php echo arrIndex($postdata, 'monthly_gross') ?>">
            </div>
            <div class="col-sm-6">
                <label>Additional Income </label>
                <input type="text" class="form-control" name="additional_income"  placeholder="Additional Income *" value="<?php echo arrIndex($postdata, 'additional_income') ?>">
            </div>      
<!--            <div class="col-sm-6">
                <label>Assets </label>
                <input type="text" class="form-control" name="assets"  placeholder="Assets *" value="<?php echo arrIndex($postdata, 'assets') ?>">
            </div> -->
            <div class="col-sm-6">
                <label> Status <span class="red">*</span></label><br>
                <?php foreach ($applicantsType as $type) { ?>
                    <input type="radio" name="status" value="<?php echo $type['code'] ?>" <?php if($type['code']==$offset){echo "checked";} ?> ><?php echo $type['type'] ?><br>
                <?php } ?>
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
        $('#datepicker').datepicker({});
    })
</script>
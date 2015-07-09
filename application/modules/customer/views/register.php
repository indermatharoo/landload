<div style='text-align: center'><h1 style="display: none">Registration Form</h1>
    <?php $this->load->view('inc-messages'); ?>
</div>
<form id="form1" name="form1" method="post" action="register">
    <h1>Register Here</h1>
    <div class="form-group required-field-block">
        <input type="text" placeholder="First Name" name="fname" class="form-control" >
        <div class="required-icon">
            <div class="text">*</div>
        </div>
    </div>
    <div class="form-group required-field-block">
        <input type="text" placeholder="Last Name" name="lname" class="form-control" >
        <div class="required-icon">
            <div class="text">*</div>
        </div>
    </div>

    <div class="form-group required-field-block">
        <input type="text" placeholder="Email" name="email" class="form-control" >
        <div class="required-icon">
            <div class="text">*</div>
        </div>
    </div>

    <div class="form-group required-field-block">
        <input type="text" placeholder="Phone" name="phone" class="form-control" >
        <div class="required-icon">
            <div class="text">*</div>
        </div>
    </div>

    <div class="form-group required-field-block">
        <input type="password" placeholder="Password" name="password" class="form-control" >
        <div class="required-icon">
            <div class="text">*</div>
        </div>
    </div>

    <div class="form-group required-field-block">
        <input type="password" placeholder="Confirm Password" name="cpassword" class="form-control" >
        <div class="required-icon">
            <div class="text">*</div>
        </div>
    </div>

    <div class="form-group required-field-block">
        <textarea rows="3" class="form-control" name="address" placeholder="Address"></textarea>
        <div class="required-icon">
            <div class="text">*</div>
        </div>
    </div>

    <button class="btn btn-primary">Register Now</button>
</form>
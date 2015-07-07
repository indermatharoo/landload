<script type="text/javascript">
    $(document).ready(function () {
        $("select").change(function () {
            $(this).find("option:selected").each(function () {
                if ($(this).attr("value") == "M") {
                    $(".ftry").not(".month").hide();
                    $(".month").show();
                }
                else if ($(this).attr("value") == "W") {
                    $(".ftry").not(".week").hide();
                    $(".week").show();
                }
                else {
                    $(".ftry").hide();
                }
            });
        }).change();
    });
</script>
<header class="panel-heading">
    <div class="row">
        <div class="col-sm-12" style="text-align: center">
            <h3 style="margin: 0">Applications / Lease Management</h3>
        </div>
    </div>
</header>
<div class="nav-tabs-custom">
    <form name='applicant' action="" method="post">
        <ul class="nav nav-tabs">
            <li data-id="1" class="active"><a href="#tabs-1" data-toggle="tab">User Information</a></li>
            <li data-id="2"><a href="#tabs-2" data-toggle="tab">Job Information</a></li>
            <li data-id="3"><a href="#tabs-3" data-toggle="tab">Properties</a></li>
            <li data-id="4"><a href="#tabs-4" data-toggle="tab">Agreement</a></li>
            <li data-id="5"><a href="#tabs-5" data-toggle="tab">Upload Documents</a></li>
        </ul>
        <div class="tab-content clearfix">
            <div class="tab-pane active" id="tabs-1">
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>First Name</label>
                        <input type="text" class="form-control" id="fname" name="fname" value="<?= $details['fname']; ?>" placeholder="">
                    </div>
                    <div class="col-sm-6">
                        <label>Last Name</label>
                        <input type="text" class="form-control" id="lname" name="lname" value="<?= $details['lname']; ?>" placeholder="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?= $details['email']; ?>" placeholder="">
                    </div>
                    <div class="col-sm-6">
                        <label>Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="<?= $details['phone']; ?>" placeholder="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="<?= $details['address']; ?>" placeholder="">
                    </div>
                    <!--                        <div class="col-sm-6">
                                                <label>City</label>
                                                <input type="text" class="form-control" id="city" name="city" value="<?php echo set_value('city', $user['city']); ?>" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-6">
                                                <label>State</label>
                                                <input type="text" class="form-control" id="state" name="state" value="<?php echo set_value('state', $user['state']); ?>" placeholder="">
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Company</label>
                                                <input type="text" class="form-control" id="company" name="company" value="<?php echo set_value('company', $user['company']); ?>" placeholder="">
                                            </div>-->
                </div>
            </div>
            <div class="tab-pane" id="tabs-2">
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Current Job</label>
                        <input type="text" class="form-control" id="current_job" name="current_job" value="" placeholder="">
                    </div>
                    <div class="col-sm-6">
                        <label>Previous Job</label>
                        <input type="text" class="form-control" id="previous_job" name="previous_job" value="" placeholder="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Experience</label>
                        <input type="text" class="form-control" id="experience" name="experience" value="" placeholder="">
                    </div>

                </div>
            </div>     
            <div class="tab-pane" id="tabs-3">
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Property</label>
                        <input type="text" class="form-control" id="current_job" name="property" value="<?= $details['pname']; ?>" placeholder="">
                    </div>
                    <div class="col-sm-6">
                        <label>Applied Date</label>
                        <input type="text" class="form-control" id="previous_job" name="lease_from" value="<?= $details['lease_from']; ?>" placeholder="">
                    </div>
                </div>
            </div>     
            <div class="tab-pane" id="tabs-4">
                <div class="form-group">
                    <div class="col-sm-12">
                        <label>Agree to Agreement</label>
                        &nbsp;<input type="checkbox" id="checkbox" name="checkbox" value="1" placeholder="" style="vertical-align: sub"> &nbsp;<a href='' class="html5lightbox"><span>click here to view</span></a>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Amount</label>
                        <input type="text" class="form-control" id="rent_amount" name="rent_amount" value="<?= $details['rent_amount']; ?>" placeholder="">
                    </div>
                    <div class="col-sm-6">
                        <label>Security Amount</label>
                        <input type="text" class="form-control" id="security_amount" name="security_amount" value="<?= $details['security_amount']; ?>" placeholder="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Payment Type</label>
                        <select class="form-control" id="ptype" name="ptype" value="" placeholder="">
                            <option value="0">--Choose--</option>
                            <option value="W">WEEK</option>
                            <option value="M">MONTH</option>
                        </select>
                    </div>
                    <div class="col-sm-6 week ftry" style="display: none">
                        <label>Day Of Week</label>
                        <input type="text" class="form-control" id="security_amount" name="day_of_week" value="<?= $details['day_of_week']; ?>" placeholder="">
                    </div>
                    <div class="col-sm-6 month ftry" style="display: none">
                        <label>Date Of Month</label>
                        <input type="text" class="form-control" id="security_amount" name="date_of_month" value="<?= $details['date_of_month']; ?>" placeholder="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label>Refundable</label>
                        &nbsp;&nbsp;&nbsp;<input type="radio" name="refund" value="yes" style="vertical-align: sub">&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;<input type="radio" name="refund" value="no" style="vertical-align: sub">&nbsp;&nbsp;No
                    </div>
                </div>
            </div>     
            <div class="tab-pane" id="tabs-5">
                <div class="form-group">
                    <div class="col-sm-12">
                        <label>Upload Documents</label>
                        <input type="file" name="document" id="document">
                    </div>
                </div>
            </div>     
        </div>
        <p style="text-align: center; padding-bottom: 10px;"><button class="btn btn-primary">Submit</button></p>
    </form>
</div>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<link href="css/smoothness/jquery-ui.css" rel="stylesheet"/>
                        <?php 
//                        echo "<pre>";
//                        print_r($details);
//                        echo "</pre>";
                        ?>
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

            });
        }).change();
    });
</script>
<script type="text/javascript" >
function showLayer(id)
{
    
    $('.tab-pane').removeClass('active');
    $('#'+id).addClass('active');
    
    $(".nav-tabs li").removeClass('active')
    $('.nav-tabs li a[href="'+'#'+id+'"]').parent().addClass('active');
    
    return false;
    
}

function saveDetails(ajxurl,formdata)
{
    $('.errormsg , .successmsg').hide();
    $.ajax({
        url:ajxurl,
        type:'post',
        data:formdata,
        dataType:'JSON'
        
    }).done(function(data){
        
       if(data.response=="true")
       {
           console.log(data.tab);
           $('.successmsg').html(data.msg).show();
           showLayer('tabs-'+data.tab+'');
       }
       else
       {
           $('.errormsg').html(data.msg).show();
       }
    })
}
$(document).ready(function(){
    $('.datepicker').datepicker({dateFormat: 'yy-mm-dd'});
    $('.saveUserDetails').on('click',function(){
        saveDetails('applications/user_details/<?php echo arrIndex($details, 'applicant_id') ?>',$('#userDetails').serialize());
    })
    $('.jobDet').on('click',function(){
         saveDetails('applications/job_details/<?php echo arrIndex($details, 'applicant_id') ?>',$('#jobDetails').serialize());
    })
    $('.propertiesDetail').on('click',function(){
         saveDetails('applications/properties_details/<?php echo  arrIndex($details, 'id') ?>',$('#propDetails').serialize());
    })
    $('.agreement').on('click',function(){
         saveDetails('applications/agree_details/<?php echo  arrIndex($details, 'id') ?>',$('#agreeDetails').serialize());
    })    
})
</script>

<header class="panel-heading">
    <div class="row">
        <div class="col-sm-12" style="text-align: center">
            <h3 style="margin: 0">Applications / Lease Management</h3>
        </div>
    </div>
</header>
<?php $this->load->view(THEME . 'messages/inc-messages'); ?>
<div class="errormsg alert alert-danger " style="display:none;">
</div>
<div class="successmsg alert alert-success " style="display:none;">
</div>

<div class="nav-tabs-custom">
    
        <ul class="nav nav-tabs">
            <li data-id="1" class="active"><a href="#tabs-1" data-toggle="tab">User Information</a></li>
            <li data-id="2"><a href="#tabs-2" data-toggle="tab">Job Information</a></li>
            <li data-id="3"><a href="#tabs-3" data-toggle="tab">Properties</a></li>
            <li data-id="4"><a href="#tabs-4" data-toggle="tab">Agreement</a></li>
            <li data-id="5"><a href="#tabs-5" data-toggle="tab">Upload Documents</a></li>
        </ul>
        <div class="tab-content clearfix">
            <div class="tab-pane active" id="tabs-1">
                <form name="userDetails" id="userDetails" action="applications" method="post" >
                <div class="form-group">
                    <div class="col-sm-6">
                        <label> Status </label><br>
                        <select name="status" class="form-control">
                        <?php foreach($applicantsType as $type){ ?>
                        <option   value="<?php echo $type['code'] ?>" <?php echo ($details['type']==$type['code'])?'selected':'' ?> ><?php echo $type['type'] ?></option>
                        <?php } ?>
                        </select>
                    </div>    
                    <div class="col-sm-6">
                        <label>First Name</label>
                        <input type="text" class="form-control" id="fname" name="fname" value="<?= arrIndex($details, 'fname'); ?>" placeholder="">
                    </div>
                    <div class="col-sm-6">
                        <label>Last Name</label>
                        <input type="text" class="form-control" id="lname" name="lname" value="<?= arrIndex($details, 'lname'); ?>" placeholder="">
                        <input type="hidden" name="offset" value="<?php echo $offset ?>" >
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?= arrIndex($details, 'email'); ?>" placeholder="">
                    </div>
                    <div class="col-sm-6">
                        <label>Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="<?= arrIndex($details,'phone'); ?>" placeholder="">
                    </div>
                </div>
   
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="<?= arrIndex($details,  'address'); ?>" placeholder="">
                    </div>
                    <div class="col-sm-6">
                        
                        <input type="button" class="btn btn-primary pull-right saveUserDetails" style="margin-top: 23px"  value="Submit">
                    </div>
                </div>
                    
                </form>
            </div>
            <div class="tab-pane" id="tabs-2">
                <form name="jobDetails" id="jobDetails" action="applications" method="post" >
                <div class="form-group">
                    <div class="col-sm-6">

                        <label>Current Job</label>
                        <input type="text" class="form-control" id="current_job" name="current_job" value="<?php echo arrIndex($details, 'current_job') ?>" placeholder="">
                    </div>
                    <div class="col-sm-6">
                        <label>Previous Job</label>
                        <input type="text" class="form-control" id="previous_job" name="previous_job" value="<?php echo arrIndex($details, 'previous_job') ?>" placeholder="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Experience</label>
                        <input type="text" class="form-control" id="experience" name="experience" value="<?php echo arrIndex($details, 'experience') ?>" placeholder="Experience">
                    </div>
                    <div class="col-sm-6">
                        
                        <input type="button" class="btn btn-primary pull-right jobDet " style="margin-top: 23px"  value="Submit">
                    </div>
                </div>
                </form>
            </div>     
            <div class="tab-pane" id="tabs-3">
                <form name="propDetails" id="propDetails" action="applications" method="post" >
                <div class="form-group">
<!--                    <div class="col-sm-6">
                <label>Property </label>
                <select class="form-control" name="property_id">
                    <option></option>
                    <?php foreach ($propertiesList as $property) { ?>
                        <option value="<?php echo $property['id'] ?>" <?php echo ($property['id'] == arrIndex($details, 'property_id')) ? 'selected' : '' ?>><?php echo $property['pname'] ?></option>
                    <?php } ?>
                </select>
                    </div>-->
                    <div class="col-sm-6">
                <label>Unit Applied For </label>
                <?php
                $ci = &get_instance();
                $ci->load->model('units/Unitsmodel');
                $res = $ci->Unitsmodel->getUnitsByPropertyId(arrIndex($details,'property_id'));
                ?>
                <select class="form-control" name="unit_id">
                    <option></option>
                    <?php foreach ($res as $unit) { ?>
                        <option value="<?php echo $unit['id'] ?>" <?php echo ($unit['id'] == arrIndex($details, 'unit_id') ) ? 'selected' : ''; ?>><?php echo $unit['unit_number'] ?></option>
                    <?php } ?>
                </select>
                    </div>                    
                    <div class="col-sm-6">
                        <label>Applied Date</label>
                        <input type="text" class="form-control" id="previous_job" disabled="" name="lease_from" value="<?= arrIndex($details, 'applied_date'); ?>" placeholder="">
                    </div>
                    <div class="col-sm-6">
                        
                        <input type="button" class="btn btn-primary pull-right propertiesDetail" style="margin-top: 23px"   value="Submit">
                    </div>  
                    
                </div>
                </form>
            </div>     
            <div class="tab-pane" id="tabs-4">
                 <form name="agreeDetails" id="agreeDetails" action="applications" method="post" >
                <div class="form-group">
                    <div class="col-sm-12">
                        <label>Agree to Agreement</label>
                        &nbsp;<input type="checkbox" id="checkbox" name="agree" value="1" placeholder="" style="vertical-align: sub"> &nbsp;<a href='' class="html5lightbox"><span>click here to view</span></a>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Amount</label>
                        <input type="text" class="form-control" id="rent_amount" name="rent_amount" value="<?= arrIndex($details, 'invoice_amount'); ?>" placeholder="">
                    </div>
                    <div class="col-sm-6">
                        <label>Security Amount</label>
                        <input type="text" class="form-control" id="security_amount" name="security_amount" value="<?= arrIndex($details, 'security_amount'); ?>" placeholder="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Payment Type</label>
                        <select class="form-control" id="ptype" name="ptype" value="" placeholder="">
                            <option value="">--Choose--</option>
                            <option value="W" <?php echo (arrIndex($details, 'invoice_type')=="W")?'selected':'' ?> >WEEK</option>
                            <option value="M" <?php echo (arrIndex($details, 'invoice_type')=="M")?'selected':'' ?>>MONTH</option>
                        </select>
                    </div>
                    
                    <div class="col-sm-6 week ftry" style="display: <?php echo (arrIndex($details, 'invoice_type')=='W')?'block':'none' ?>">
                        <label>Day Of Week</label>

                        <select name="day_of_week" class="form-control" >
                           <?php foreach($days as $key=>$val){ ?>
                            <option value="<?php echo $val ?>" <?php echo (strtolower(arrIndex($details, 'day_of_week'))==$key)?'selected':'' ?>><?php echo $val; ?></option>
                           <?php } ?>
                        </select>
                    </div>
                    <div class="col-sm-6 month ftry" style="display: <?php echo (arrIndex($details, 'invoice_type')=='M')?'block':'none' ?>">
                        <label>Date Of Month</label>
                        <input type="text" class="form-control datepicker" name="date_of_month"  placeholder="Date Of Month *" value="<?php echo arrIndex($details, 'date_of_month') ?>" >
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label>Refundable</label>
                        &nbsp;&nbsp;&nbsp;<input type="radio" name="refund" value="1" style="vertical-align: sub" <?php echo (arrIndex($details, 'refundable')==1)?'checked':'' ?>>&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;<input type="radio" name="refund" value="0" <?php echo (arrIndex($details, 'refundable')==0)?'checked':'' ?> style="vertical-align: sub">&nbsp;&nbsp;No
                    </div>
                    <div class="col-sm-6">
                        <input type="button" class="btn btn-primary pull-right agreement "  style="margin-top: 23px"  value="Submit">
                    </div>                      
                </div>
                 </form>
            </div>     
            <div class="tab-pane" id="tabs-5">
                <form name="requiredDocument" id="requiredDocument" enctype="multipart/form-data" action="applications/upload_document/<?php echo  arrIndex($details, 'applicant_id') ?>/<?php echo  arrIndex($details, 'id') ?>" method="post" >
                <div class="form-group">
                    <div class="col-sm-12">
                        <label>Upload Documents</label>
                        <input type="file" name="document[]" multiple="" id="document">
                        <input type="hidden" name="documents" >
                    </div>
                    <div class="col-sm-12">
                        <label>Deal Start</label><br>
                        Yes <input type="radio" name="deal" <?php echo  ( arrIndex($details, 'is_deal_start')==1 )?"checked":'' ?> class="deal" value="1">
                        No <input type="radio" name="deal" <?php echo ( arrIndex($details, 'is_deal_start')==0)?"checked":'' ?> class="deal" value="0" >
                    </div>
                </div>
                    <div class="col-sm-6">
                        <input type="submit" class="btn btn-primary pull-right" style="margin-top: 23px"  value="Submit">
                    </div>  
                </form>
                <div>
                    <?php if($uploadedDocuments['num_rows'] > 0){ ?>
                        <?php 
                        foreach($uploadedDocuments['result'] as $document)
                        {
                            ?>
                                <a href="<?php echo $this->config->item('UPLOAD_URL_VIRCAB_IMG').$document['visible_name']; ?>" target="_blank"> <img  height="150px" width="150px" src="<?php echo $this->config->item('UPLOAD_URL_VIRCAB_IMG').$document['visible_name']; ?>" ></a>
                             <?php
                        }
                         ?>
                    <?php }else{ ?>
                        <h1>No Records Found</h1>
                    <?php } ?>
                </div>
                
            </div>     
        </div>
        <p style="text-align: center; padding-bottom: 10px;"></p>
    
</div>

<script type="text/javascript" >
    $(document).ready(function(){
        $('.popup').bPopup();
    })
</script>
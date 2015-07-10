<?php $this->load->view(THEME . 'messages/inc-messages'); ?>
<link href="<?php echo base_url() ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<header class="panel-heading">
    <div class="row">
        <div class="col-sm-1">
            <i class="fa fa-user fa-2x"></i>
        </div>
        <div class="col-sm-10">
            <h3 style="margin: 0; text-align: center"> Applications / Lease Management</h3>
        </div>
        <div class="col-sm-1" style="text-align: right">
<!--            <a href="applications/add"><h3 style="cursor: pointer; margin: 0; color: #fff"><i class="fa fa-plus-square" title="Add New Applications / Lease"></i></h3></a>-->
        </div>
    </div>
</header>
<div class="col-lg-12 padding-0" style="padding-top: 15px;">
    <a href="reports/property">Property</a>
    <a href="reports/account">Account</a>
</div>
<p align="center"><?php //echo $pagination; ?></p>


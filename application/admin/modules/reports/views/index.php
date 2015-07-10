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
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li data-id="1" class="active"><a href="#tabs-1" data-toggle="tab">Property</a></li>
        <li data-id="2"><a href="#tabs-2" data-toggle="tab">Accounts</a></li>
    </ul>
    <div class="tab-content clearfix">
        <div class="tab-pane active" id="tabs-1">
            <?php $page['content'] = $this->load->view('property'); ?>
        </div>
        <div class="tab-pane" id="tabs-2">
            <?php $page['content'] = $this->load->view('accounts'); ?>
        </div>
    </div>
</div>
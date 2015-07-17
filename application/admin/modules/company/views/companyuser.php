<link href="<?php echo base_url() ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<header class="panel-heading">
    <div class="row">
        <div class="col-sm-1">
            <a style="color:white" href="<?php echo createUrl('user/dashboard') ?>"><i class="fa fa-arrow-left fa-2x"></i></a>
        </div>
        <div class="col-sm-10">
            <h3 style="margin: 0; text-align: center">User Management</h3>
        </div>
        <div class="col-sm-1" style="text-align: right">
            <!--<a href="company/add"><h3 style="cursor: pointer; margin: 0; color: #fff"><i class="fa fa-plus-square" title="Add New user"></i></h3></a>-->
        </div>
    </div>
</header>
<div class="col-lg-12 padding-0" style="padding-top: 15px;">
    <?php $this->load->view(THEME . 'messages/inc-messages'); ?>
    <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" class="add-user">
        <div class="form-group">
            <div class="col-sm-6">
                <label>First Name</label>
                <input type="text" class="form-control" id="username" name="name" value="<?= arrIndex($user, 'name'); ?>" placeholder="First Name *">
            </div>
            <div class="col-sm-6">
                <label>Email</label>
                <input type="text" class="form-control" id="email" name="email" value="<?= arrIndex($user, 'email'); ?>" placeholder="Email *">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-6">
                <label>Password</label>
                <input type="password" class="form-control" id="passwd" name="pass" value="" placeholder="Password *">
            </div>
            <div class="col-sm-6">
                <label>Confirm Password</label>
                <input type="password" class="form-control" id="passwd1" name="pass1" value="" placeholder="Confirm Password *">
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
<?php $this->load->view('headers/user_index', array('base_url' => base_url())); ?>

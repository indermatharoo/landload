<?php
//echo "<pre>";
//print_r($Listing);
//die();
?> 

<?php $this->load->view(THEME . 'messages/inc-messages'); ?>

<header class="panel-heading">
    <div class="row">
        <div class="col-sm-1">
            <i class="fa fa-user fa-2x"></i>
        </div>
        <div class="col-sm-10">
            <h3 style="margin: 0; text-align: center"> Message Management</h3>
        </div>
        <div class="col-sm-1" style="text-align: right">
<!--            <a href="applications/add"><h3 style="cursor: pointer; margin: 0; color: #fff"><i class="fa fa-plus-square" title="Add New Applications / Lease"></i></h3></a>-->
        </div>
    </div>
</header>
<div class="col-lg-12 padding-0" style="padding-top: 15px;">
    <form name="message_form" method="post" action="">
    <table id="table" class="table table-bordered table-striped">
        <?php /* ?>
        <thead>
            <tr>                        
                <?php foreach ($labels as $label): ?>
                    <th><?php echo $label ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <?php */ ?>
        <tbody>
            <tr>
                <td>Company:</td>
                <td>
                    <select name="company_id" class="form-control">
                        <option></option>
                    <?php if($appliedCompany['num_rows'] > 0){ ?>
                    <?php foreach($appliedCompany['result'] as $result){ ?>
                    <option value="<?php echo $result['id'] ?>"><?php echo $result['name'] ?></option>
                    <?php }} ?>
                    </select>
                </td>
            </tr> 
            <tr>
                <td>Message:</td>
                <td>
                    <textarea name="message" style="width:100%">
                    
                    </textarea>
                </td>                
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit"  value="send"></td>
            </tr>
        </tbody>
        <tfoot>
            <?php /* ?>
              <tr>
              <?php foreach ($labels as $label): ?>
              <th><?php echo $label ?></th>
              <?php endforeach; ?>
              </tr>
              <?php */ ?>
        </tfoot>
    </table>
    </form>
<header class="panel-heading">
    <div class="row">
        <div class="col-sm-1">
            <i class="fa fa-user fa-2x"></i>
        </div>
        <div class="col-sm-10">
            <h3 style="margin: 0; text-align: center"> Recent Messages</h3>
        </div>
        <div class="col-sm-1" style="text-align: right">
<!--            <a href="applications/add"><h3 style="cursor: pointer; margin: 0; color: #fff"><i class="fa fa-plus-square" title="Add New Applications / Lease"></i></h3></a>-->
        </div>
    </div>
</header>  
    <table id="table" class="table table-bordered table-striped">
        
        <?php if($converstaion['num_rows'] > 0){ ?>
        <?php  foreach($converstaion['result'] as  $conv){ ?>
        <tr>
                    <td><?= trim(arrIndex($conv, 'fname').' '.arrIndex($conv, 'lname')); ?></td>
                    <td><?= arrIndex($conv, 'email'); ?></td>
                    <td><?= arrIndex($conv, 'phone'); ?></td>
                    <td><?= arrIndex($conv, 'email'); ?></td>
                    <td><a href="applicants/reply/<?= arrIndex($conv, 'company_id'); ?>">Reply</a></td>

        </tr>    
        <?php } ?>
        <?php } ?>
    </table>
</div>
<p align="center"><?php //echo $pagination; ?></p>


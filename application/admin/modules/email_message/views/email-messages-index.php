<?php
$tab2 = 'active';
if ($market_email) {
    $tab1 = '';
    $tab2 = 'active';
}
?>
<header class="panel-heading">
    <div class="row">
        <div class="col-sm-12">
            <h3 style="margin: 0; text-align: center">Marketing Email</h3>
        </div>
    </div>
</header>
<div class="col-sm-12">
    <?php
    $this->load->view(THEME . 'messages/inc-messages');
    if (count($messages) == 0) {
        $this->load->view('messages/inc-norecords');
    }
    ?>
</div>
<ul class="nav nav-tabs">
    <li class="<?= $tab2 ?>"><a href="#tab_2" data-toggle="tab">Template</a></li>    
</ul>
<div class="tab-content">
    <div class="tab-pane <?= $tab2 ?>" id="tab_2" style="padding-top: 10px">
        <div class="">
            <div class="mar-bot10" style="text-align: right;">
                <a href="email_message/add"><button class="btn btn-primary" style="font-weight: 700">Add New Template&nbsp;<i class="fa fa-plus-square"></i></button></a>
            </div>
            <div class="col-sm-12 padding-0">      
                <table width="100%" border="0" cellpadding="2" cellspacing="0" class="grid">
                    <tr>
                        <th width="80%">Email Name</th>
                        <th width="20%">Action</th>
                    </tr>
                    <?php foreach ($messages['template'] as $item) { ?>
                        <tr  class="<?php echo alternator('', 'alt'); ?>">
                            <td><?php echo $item['email_name']; ?></td>
                            <td>
                                <a href="<?php echo createUrl("email_message/edit/" . $item['email_content_id']); ?>">Edit</a>
                                <?php if ($market_email == 1) { ?> 
                                    | <a href="<?php echo createUrl('email_message/delete/' . $item['email_content_id']); ?>"
                                         onclick="return confirm('Are you sure you want to Delete this Email Template?');">Delete</a>
                                     <?php } ?>
                                | <a href="<?php echo createUrl('marketing/index/email/' . $item['email_content_id']); ?>">Send Mail</a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>    
</div>
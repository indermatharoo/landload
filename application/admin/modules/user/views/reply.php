<?php $this->load->view(THEME . 'messages/inc-messages'); ?>
<style>
    .block-update-card {
        /*height: 100%;*/
        border: 1px #FFFFFF solid;
        width: 100%;
        float: left;
        /*margin-left: 10px;*/
        margin-top: 0;
        padding: 0;
        box-shadow: 1px 1px 8px #d8d8d8;
        background-color: #FFFFFF;
        padding-left: 10px;
    }
    .block-update-card .update-card-body h4 {
        color: #737373;
        font-size: 13px;
        font-weight: bold;
    }
    .block-update-card .update-card-body p {
        color: #737373;
        font-size: 12px;
    }



</style>
<header class="panel-heading">
    <div class="row">
        <div class="col-sm-1">
            <i class="fa fa-user fa-2x"></i>
        </div>
        <div class="col-sm-10">
            <!--            <h3 style="margin: 0; text-align: center"> Applicants Management</h3>-->
        </div>
        <div class="col-sm-1" style="text-align: right">
            <a href="applicants/add/app"><h3 style="cursor: pointer; margin: 0; color: #fff"><i class="fa fa-plus-square" title="Add New Applicants / tenants"></i></h3></a>
        </div>
    </div>
</header>
<div class="col-lg-12 padding-0" style="padding-top: 15px;">
    <?php // e($allMessages); ?>
    <?php foreach($allMessages['result'] as $chat){ ?>
    <div class="block-update-card">
        <div class="update-card-body">
            <h4>
                <?php if(arrIndex($chat, 'reply')==1){ ?>
                <?php echo trim(arrIndex($chat, 'company_name')) ?>
                <?php }else
                { ?>
                <?php echo trim(arrIndex($chat, 'fname').' '.arrIndex($chat, 'lname')) ?>
                <?php } ?>
            </h4>
            <p><?php echo arrIndex($chat, 'message') ?></p>
        </div>
    </div>
    <?php } ?>
    <div class="block-update-card">
        Message:
        <form name="chat" method="post" action="">
            <table width="100%">
                <tr>
                    <td><textarea name="message" style="width:100%"></textarea></td>
                </tr>
                <tr>
                    <td><input type="submit" value="Reply"></td>
                </tr>
            </table>
        </form>
    </div>
</div>
<p align="center"><?php //echo $pagination;   ?></p>


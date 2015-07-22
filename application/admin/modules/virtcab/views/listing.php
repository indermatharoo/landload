<div class="form-group col-sm-12">
    <?php $this->load->view(THEME . 'messages/inc-messages'); ?>
</div>
<header class="panel-heading">
    <div class="row">
        <div class="col-sm-12" style="text-align: center">
            <h3 style="margin: 0">Companies Virtual Cabinet</h3>
        </div>
    </div>
</header>
<div class='col-lg-12'>
    <?php foreach ($models as $model) : ?>
        <div class='col-lg-2'>
            <br/>
            <img src='<?php echo base_url(); ?>/images/folder.png' class='img-responsive'/>
            <center title='<?php echo arrIndex($model, 'email') ?>'>
                <a style="text-decoration:none;color:#000" href='<?php echo createUrl('virtcab/index/' . arrIndex($model, 'id')) ?>'>
                    <?php echo ucfirst(arrIndex($model, 'name')); ?>
                </a>
            </center>
        </div>
        <?php
//        e($model);
        ?>

    <?php endforeach; ?>
</div>
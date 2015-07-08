<?php
//e($property);
?>
<div class="col-lg-6">
    <?php if (!empty($property)) { ?>
        <h1><?= $property['pname']; ?></h1>
        <?php echo $property['unit_number']; ?>

        <?php
        if ($this->session->userdata('applicant_id') != '') {
            $attributes = array('class' => 'appy', 'id' => 'myform', 'name' => '');
            echo form_open('email/send', $attributes);
            ?>

            <button name="" type="submit" class="btn btn-primary subbmint">Apply</button>
            <?php
        } else {
            ?>
            <button name="" onclick="window.location = '<?php echo base_url(); ?>customer/login'" type="button" class="btn btn-primary subbmint">Apply</button>
            <?php
        }
        ?>

    <?php } ?>
</div>


<h1><?php echo $page['title']; ?></h1>
<div id="form_address">
    <?php $this->load->view('inc-messages'); ?>
    <div id="address">
        <div>
            <?php echo $this->cmscore->block('block_main'); ?>
        </div>
        <div style="clear: both"></div>
    </div>
    <div id="contact_form">
        <form name="form2" method="post" action="contact-us">
            <div class="con-left">
                <div class="">
                    <label>Name <span class="error">*</span></label>
                    <input name="name" type="text" class="textfield" id="textfield2" value="<?php echo set_value('name'); ?>">
                </div>
                <div class="">
                    <label>Phone <span class="error">*</span></label>
                    <input name="phone" type="text" class="textfield" id="textfield3" value="<?php echo set_value('phone'); ?>">
                </div>
                <div class="">
                    <label>Email <span class="error">*</span></label>
                    <input name="email" type="text" class="textfield" id="textfield4" value="<?php echo set_value('email'); ?>">
                </div>
            </div>
            <div class="con-right">
                <div class="">
                    <label>Message <span class="error">*</span></label>
                    <textarea name="message" cols="45" rows="5" class="textfield" id="textarea" style="height:126px;"></textarea>
                </div>
            </div>
            <div class="div-submit">
                <input type="submit" name="button" value="Submit" class="btn-sub">
            </div>
        </form>
    </div>
</div>
<div id="contact_map"><?php echo $this->cmscore->block('contact_map'); ?></div>
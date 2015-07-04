<h1>Edit FAQs</h1>
<div id="ctxmenu"><a href="<?php echo site_url('faqs'); ?>">Manage FAQs</a></div>
<?php $this->load->view(THEME.'messages/inc-messages'); ?>

<form action="<?php echo site_url('faqs/edit'); ?>/<?php echo $faq['faq_id']; ?>" method="post"  enctype="multipart/form-data">

    <table width='100%' border='0' cellspacing='0' cellpadding='2'>

         <tr>
            <td width="30%"><label for="question">Question<span class='error'>*</span></label></td>
            <td width="70%"><input type="texfield" name="question" class="textfield" size="40" value="<?php echo $faq['question']; ?>"></td>

        </tr>

        <tr>
            <td><label for="answer">Answer<span class='error'>*</span></label></td>
            <td><textarea name="answer" rows="12" cols="42" class="textfield" style="width: 95%"><?php echo $faq['answer']; ?></textarea></td>

        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><small>Fields marked with <span class="error">*</span> are required</small></td>
        </tr>
        <tr>

         <td>&nbsp;</td>
            <td><input type="submit" name="submit" value="submit"/></td>
        </tr>


    </table>

</form>
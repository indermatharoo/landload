<div class="container">
    <div class="row">
        <?php
        $this->load->view(THEME.'messages/inc-messages');
        if (count($forum) == 0) {
            $this->load->view('messages/inc-norecords');
        }
//            echo '<pre>';
//                print_r($forum);
//            echo '</pre>';
        ?>
    </div>
    <div class="row">
        <section class="panel panel-info">
            <header class="panel-heading">
                Add Forum
            </header>
            <section class="row panel-body">
                <section class="col-md-6">                   
                    <h3><a href="<?php echo site_url('forum/add'); ?>">You can add new forum from here</a></h3>
                    <hr>
                    <section class="row">
                        <ul class="col-md-12">                                       
                        </ul>
                    </section>
                </section>                
            </section>
            <form action="faqs/faqs/add" method="post" enctype="multipart/form-data" name="form1" id="form1">
                <table width="100%" border="0" cellspacing="0" cellpadding="2">
                    <tr>
                        <td width="30%"><label for="question">Question <span class='error'>*</span></label></td>
                        <td width="70%"><input type="texfield"  name="question"   id='question' class='textfield' size="50" 
                                               value="<?php echo set_value('question'); ?>"/></td>

                    </tr>
                    <tr>
                        <td><label for="answer">Answer<span class='error'>*</span></label></td>
                        <td><textarea name="answer" id="answer" class='textfield' rows="12" cols="42" 
                                      style="width: 95%"><?php echo set_value('answer'); ?></textarea></td>

                    </tr>
                    <tr>
                        <td>&nbsp</td>
                        <td>Fields marked with <span class="error">*</span> are required</td>
                    </tr>
                    <tr>
                        <td>&nbsp</td>
                        <td><input type="submit" name="submit" id='submit' value="Add"></td>
                    </tr>
                </table>
            </form>

        </section>

    </div>
</div>

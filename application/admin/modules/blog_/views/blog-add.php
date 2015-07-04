<?php $this->load->view('headers/news_add'); ?>
<h1>Add News</h1>
<div id="ctxmenu"><a href="news/">Manage News</a></div>
<?php $this->load->view(THEME . 'messages/inc-messages'); ?>
<form action="news/add" method="post" enctype="multipart/form-data" name="add_frm" id="add_frm">
    <div class="form-group">
        <label class="control-label">News Title <span class="error">*</span></label>
        <input  maxlength="100" type="text" required="required" class="form-control"  name="news_title" id="news_title" value="<?php echo set_value('news_title'); ?>"/>
    </div>
    <div class="form-group">
        <label class="control-label">URL</label>&nbsp;(Will be auto-generated if left blank)
        <input  maxlength="100" type="text" class="form-control"  name="url_alias" id="url_alias" value="<?php echo set_value('url_alias'); ?>"/>
    </div>
    <div class="form-group">
        <label class="control-label">News Date <span class="error">*</span></label>
        <input  maxlength="100" type="text" required="required" class="form-control"  name="date" id="date" value="<?php echo set_value('date'); ?>"/>
    </div>
    <div class="form-group">
        <label class="control-label">Description <span class="error">*</span></label>
        <textarea  maxlength="100" style="height: 500px;" type="text" class="form-control editor" name="contents" id="contents" ><?php echo set_value('contents'); ?></textarea>
    </div>
    <p align="center">Fields marked with <span class="error">*</span> are required.</p>
    <p align="center"><input type="submit" name="button" id="button" value="Submit" class="btn btn-primary"></p>
</form>
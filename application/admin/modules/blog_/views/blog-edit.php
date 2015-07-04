<?php $this->load->view('headers/news_add'); ?>
<header class="panel-heading">
    <div class="row">
        <div class="col-sm-10">
            <h3 style="margin: 0;">News</h3>
        </div>
        <div class="col-sm-2" style="text-align: right">
            <a href="news"><h3 style="cursor: pointer; margin: 0; color: #fff"><i class="fa fa-home" title="Manage News"></i></h3></a>
        </div>
    </div>
</header>
<div class="col-lg-12 padding-0">
    <?php $this->load->view(THEME . 'messages/inc-messages'); ?>
</div>
<div class="col-lg-12 padding-0" style="padding-top: 15px;">
    <form action="news/edit/<?php echo $news['news_id']; ?>" method="post" enctype="multipart/form-data" name="add_frm" id="add_frm">
        <div class="form-group">
            <label class="control-label">News Title <span class="error">*</span></label>
            <input  maxlength="100" type="text" required="required" class="form-control"  name="news_title" id="news_title" value="<?php echo set_value('news_title', $news['news_title']); ?>"/>
        </div>
        <div class="form-group">
            <label class="control-label">URL</label>&nbsp;(Will be auto-generated if left blank)
            <input  maxlength="100" type="text" class="form-control"  name="url_alias" id="url_alias" value="<?php echo set_value('url_alias', $news['url_alias']); ?>"/>
        </div>
        <div class="form-group">
            <label class="control-label">News Date <span class="error">*</span></label>
            <input  maxlength="100" type="text" required="required" class="form-control"  name="date" id="date" value="<?= set_value('date', $news['news_date']); ?>"/>
        </div>
        <div class="form-group">
            <label class="control-label">Description <span class="error">*</span></label>
            <textarea  maxlength="100" style="height: 500px" type="text" class="form-control editor" name="contents" id="contents" ><?php echo set_value('contents', $news['contents']); ?></textarea>
        </div>
        <p align="center">Fields marked with <span class="error">*</span> are required.</p>
        <p align="center"><input type="hidden" name="news_id" id="button" value="<?php echo $news['news_id']; ?>"></p>
        <p align="center"><input type="submit" name="button" id="button" value="Submit" class="btn btn-primary"></p>
    </form>
</div>
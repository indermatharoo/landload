<?php $this->load->view('headers/news_add'); ?>
<div class="col-lg-12">
    <?php
    if (count($news) == 0) {
        $this->load->view(THEME . 'messages/inc-norecords');
        return;
    }
    ?>
</div>
<div class="col-lg-12">
    <?php $this->load->view(THEME . 'messages/inc-messages'); ?>
</div>
<header class="panel-heading">
    <div class="row">
        <div class="col-sm-1">
            <i class="fa fa-newspaper-o fa-2x"></i>
        </div>
        <div class="col-sm-10">
            <h3 style="margin: 0; text-align: center">News</h3>
        </div>
        <div class="col-sm-1" style="text-align: right">
            <h3 onclick="openAddNews()" style="cursor: pointer; margin: 0;"><i class="fa fa-plus-square" title="Add New News"></i></h3>
        </div>
    </div>
</header>
<div class="nav-tabs-custom ">        
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab">Manage</a></li>
        <li><a href="#tab_2" data-toggle="tab">Add</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
            <div class="tableWrapper" >
                <table width="100%" border="0" cellpadding="2" cellspacing="0">
                    <tr>
                        <th width="80%"> Title</th>
                        <th width="20%">Action</th>
                    </tr>
                    <?php foreach ($news as $item) { ?>
                        <tr class="tr-border <?php echo alternator('', ''); ?>">
                            <td><?php echo $item['news_title']; ?></td>
                            <td><a href="news/edit/<?php echo $item['news_id']; ?>">Edit</a> | <a href="news/delete/<?php echo $item['news_id']; ?>" onclick="return confirm('Are you sure you want to delete this News?');">Delete</a></td>
                        <?php } ?>
                </table>
            </div>
            <p align="center"><?php echo $pagination; ?></p>
        </div>
        <div class="tab-pane " id="tab_2">
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
                    <textarea  maxlength="100" type="text" class="form-control editor" name="contents" id="contents" ><?php echo set_value('contents'); ?></textarea>
                </div>
                <p align="center">Fields marked with <span class="error">*</span> are required.</p>
                <p align="center"><input type="submit" name="button" id="button" value="Submit" class="btn btn-primary"></p>
            </form>
        </div>
    </div>
</div>
<script>
    function openAddNews() {    
        $(".nav-tabs li").each(function (index) {
            $(this).removeClass('active');
            if(index == 1){
                $(this).addClass('active');
            }
        });
        $('#tab_1').removeClass('active');
        $('#tab_2').removeClass('active');
        $('#tab_2').addClass('active');
        
    }
</script>
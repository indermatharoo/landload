<header class="panel-heading">
    <div class="row">
        <div class="col-sm-6">
            <h3 style="margin: 0">Add Template</h3>
        </div>
        <div style="text-align: right" class="col-sm-6">
            <a href="<?php echo createUrl('template/manage') ?>"><h3 style="cursor: pointer; margin: 0; color: #fff"><i title="Manage Template" class="fa fa-home"></i></h3></a>
        </div>
    </div>
</header>
<div class="col-lg-12 padding-0 mar-top15">
    <form class=""  name="form" enctype="multipart/form-data" method="post" action="">
        <div class="form-group">
            <?php if ($this->aauth->isFranshisee() || $this->aauth->isUser()): ?>
                <div class="col-lg-12 padding-0">
                    <select name="template" class="col-lg-12">
                        <option value="0">Select Template</option>
                        <?php foreach ($templates as $temp): ?>
                            <option value="<?php echo arrIndex($temp, 'email_content_id') ?>"><?php echo arrIndex($temp, 'email_name') ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php endif; ?>
            <div class="col-lg-12 padding-0">
                <input type="text" placeholder="Template Name *" value="<?php echo arrIndex($model, 'email_name') ?>" name="email_name" class="form-control require">
            </div>
            <div class="col-lg-12 mar-top10 padding-0">
                <input type="text" placeholder="Template Alias *" value="<?php echo arrIndex($model, 'email_alias') ?>" name="email_alias" class="form-control require">
            </div>
            <div class="col-lg-12 mar-top10 padding-0">
                <input type="text" placeholder="Email Subject *" value="<?php echo arrIndex($model, 'email_subject') ?>" name="email_subject" class="form-control require">
            </div>
            <div class="col-lg-12 mar-top10 padding-0">
                <textarea class="form-control texteditor" placeholder="Email Content *" name="email_content"><?php echo arrIndex($model, 'email_content') ?></textarea>
            </div>
            <input type="hidden"  value="<?php echo curUsrId() ?>" name="created_by" class="form-control require">
        </div>        
        <div class="form-group">
            <div class="col-sm-12 text-center padding-0">
                Fields mark with <span class="error">*</span> required
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12 center ">
                <button class="btn btn-primary preview-add-button btn-fix-width" id="button" name="button" type="submit">Add</button>
            </div>
        </div>
    </form>
</div>
<script>
    $(document).ready(function () {
        $('#button').on('click', function () {
            var submit = true;
            $('.require').each(function () {
//                console.log(this.value);
                if (!this.value) {
                    alert($(this).attr('placeholder') + ' is required');
                    submit = false;
                    return submit;
                }
            });
            return submit;
        });
<?php if ($this->aauth->isFranshisee() || $this->aauth->isUser()): ?>
            var template = [];
    <?php foreach ($templates as $temp): ?>
                var temp = {
                    email_name: '<?php echo arrIndex($temp, 'email_name') ?>',
                    email_alias: '<?php echo arrIndex($temp, 'email_alias') ?>',
                    email_subject: '<?php echo arrIndex($temp, 'email_subject') ?>'
                };
                template[<?php echo arrIndex($temp, 'email_content_id') ?>] = temp;
    <?php endforeach; ?>
            $('select[name="template"]').on('change', function () {
                if (this.value == 0) {
                    $('input[name="email_name"]').val('');
                    $('input[name="email_alias"]').val('');
                    $('input[name="email_subject"]').val('');
                    tinymce.activeEditor.setContent('');
                    return false;
                }
                var url = "<?php echo createUrl('marketing/detail/') ?>" + this.value;
                $('input[name="email_name"]').val(template[this.value].email_name);
                $('input[name="email_alias"]').val(template[this.value].email_alias);
                $('input[name="email_subject"]').val(template[this.value].email_subject);
                $.get(url, function (response) {
                    tinymce.activeEditor.setContent(response);
                });
            });
<?php endif; ?>
    });
</script>
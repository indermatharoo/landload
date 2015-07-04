<?php $this->load->view('calender/header/type_add'); ?>
<div class="">
    <div class="dashboard_message content-bg" style="min-width:200px;left: 207.5px; position: absolute; top: 152px; z-index: 9999; opacity: 1; display: none; padding: 10px;">
        <div class="cls" style="text-align: right; cursor: pointer">X</div>
        <div class="content" style="padding: 0; text-align: center; text-transform: capitalize"></div>
    </div>
    <div class="col-lg-12 padding-0">
        <header class="panel-heading">
            <div class="row">
                <div class="col-sm-1">
                    <a href="<?php echo createUrl('frontend/sideEventsLinks') ?>" style="color:white"><i class="fa fa-arrow-left fa-2x"></i></a>
                </div>
                <div class="col-sm-10">
                    <h3 style="margin: 0; text-align: center">Add Side Links</h3>
                </div>
            </div>
        </header>
        <div class="row">
            <form action="" method="post" enctype="multipart/form-data">
                <br/>
                <div class="form-group col-lg-12">
                    <label class="col-lg-12">Content</label>
                    <br/>
                    <input type="textarea" value="<?php echo arrIndex($model, 'content') ?>" name="content" class="form-control texteditor">
                </div>
                <br/>
                <div class="form-group col-lg-12">
                    <label class="col-lg-12">Pic</label>
                    <br/>
                    <input type="file" name="image" value='123' class="form-control">
                </div>
                <br/>
                <div class="form-group col-lg-12">
                    <label class="col-lg-12">Color</label>
                    <br/>
                    <input type="text" name="color" value="<?php echo arrIndex($model, 'color') ?>" class="form-control my-colorpicker">
                </div>
                <div class="form-group col-lg-12">
                    <label class="col-lg-12">Link</label>
                    <br/>
                    <input type="text" name="link" value="<?php echo arrIndex($model,'link')?>" class="form-control">
                </div>
                <div class="form-group col-lg-12">
                    <input type="submit" value="Add" class="submit btn btn-primary"/>
                </div>
            </form>
        </div>
    </div>

</div>
<script>
//    texteditor('.texteditor');
    function test() {
    }
    $(document).ready(function () {
        $('.submit').on('click', function () {
            var str = tinymce.activeEditor.getContent();
            var pattern = /<body>([\s\S]*?)<\/body>/g;
            var result = str.match(pattern);
            result = result[0];
            if (result.length < 17) {
                alert('Content Is Compulsary Field');
                return false;
            }
            var color = $('input[name="color"]').val();
            if (!color) {
                alert('Color is Compulsary field')
                return false;
            }
        });
    });
</script>

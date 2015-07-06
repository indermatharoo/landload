<div class="col-lg-12">
    <div class="">
        <div class="box-header">
            <h3 class="box-title"><a href="calender/category">Manage Categories</a></h3>
        </div><!-- /.box-header -->
        <form action="calender/category/edit/<?php echo $current_category['category_id']; ?>" method="post" enctype="multipart/form-data" name="addcatform" id="addcatform">
            <div class="box-body">
                <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0" class="table-responsive">
                    <tr>
                        <td><b>Category Name <span class="error"> *</span></b></td>
                        <td><input name="category" type="text" class="form-control" id="category" value="<?php echo set_value('category', $current_category['category']); ?>" size="40"></td>
                    </tr>
                    <tr>
                        <td><input type="hidden" name="category_id" class="form-control" id="category_id" value="<?php echo $current_category['category_id']; ?>" />
                    </tr>
                </table>
            </div>
            <div class="box-footer clearfix">
                <input type="submit" name="button" class="btn btn-primary pull-right" value="Submit">
            </div>
        </form>
    </div>
</div>
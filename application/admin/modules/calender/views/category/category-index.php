<div class="col-lg-12">
    <div class="">
        <div class="box-header ui-sortable-handle" style="cursor: move;">
            <h3 class="box-title"><a href="calender/category/add">Add Category</a></h3>
            <?php $this->load->view(THEME . 'messages/inc-messages'); ?>
        </div><!-- /.box-header -->
        <?php if (!empty($categories)) { ?>
            <div class="box-body">
                <ul class="todo-list ui-sortable">
                    <?php
                    foreach ($categories as $row) {
                        //edit
                        $edit_href = 'calender/category/edit/' . $row['category_id'];
                        //enable disable
                        $var = $row['status'] == 1 ? 'disable' : 'enable';
                        $ed_href = 'calender/category/' . $var . '/' . $row['category_id'];
                        //delete
                        $del_href = 'calender/category/delete/' . $row['category_id'];
                        ?>
                        <li>
                            <span class="text"><?= $row['category'] ?></span>
                            <div class="tools">
                                <a href="<?= $ed_href ?>"><?= ucfirst($var) ?></a> 
                                <a href="<?= $edit_href ?>"><i class="fa fa-edit"></i></a>
                                <a href="<?= $del_href ?>" onclick="return confirm('Are you sure you want to Delete this Category ?');"><i class="fa fa-trash-o"></i></a>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div><!-- /.box-body -->
            <div class="box-footer clearfix no-border">
                <div class="box-tools pull-right">
                    <ul class="pagination pagination-sm inline">
                        <li><a href="#">«</a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">»</a></li>
                    </ul>
                </div>
                <!--<button class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item</button>-->
            </div>
        <?php } ?>
    </div>
</div>

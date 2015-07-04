<form name="addSurveyCategory"  id="addSurveyCategory" action="<?= createUrl("survey/addCategory"); ?>" method="POST">
    <span class="help-block" id="form-msg"></span>
    <div class="form-group" id="categName">
        <label class="col-xs-2 control-label" for="category_name">Category Name</label>
        <div class="col-xs-10">
            <input type="text" id="category_name" name="category_name" class="form-control" placeholder="Category name">
            <span class="help-block" id="categName-msg"></span>
        </div>
    </div>
    <div class="form-group" id="categDesc">
        <label class="col-xs-2 control-label" for="category_description">Description</label>
        <div class="col-xs-10">
            <input type="text" id="category_description" name="category_description" class="form-control" placeholder="Add description">
            <span class="help-block" id="categDesc-msg"></span>
        </div>
    </div>
    <div class="form-group" id="categParent">
        <label class="col-xs-2 control-label" for="parent_id">Parent</label>
        <div class="col-xs-10">
            <?php
            $parent = '<select name="parent_id" >'
                    . '<option value="">Select Parent</option>';
            if ($categorylist) {
                foreach ($categorylist as $categ) {
                    $parent .='<option value="' . $categ['id'] . '">' . $categ['category_name'] . '</option>';
                }
            }
            $parent .= '</select>';
            echo $parent;
            ?>
            <span class="help-block" id="categParent-msg"></span>
        </div>
    </div>
    <div class="form-group" id="categAssign">
        <label class="col-xs-2 control-label" for="assign_group">Groups to Assign</label>
        <div class="col-xs-10">
            <?php            
            $assignList = '<select name="assign_group" >'
                    . '<option value="">Select Group</option>';
            if ($assigns) {
                foreach ($assigns as $assigngrp) {
                    $assignList .='<option value="' . $assigngrp->id . '">' . $assigngrp->name . '</option>';
                }
            }
            $assignList .= '</select>';
            echo $assignList;
            ?>
            <span class="help-block" id="categAssign-msg"></span>
        </div>
    </div>    
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-5">
            <button type="submit" class="btn btn-default">Submit</button>
        </div>
    </div>
</form>
<script>
    $(document).ready(
            function(){
            $("#addSurveyCategory").submit(function(event) {
            var formCheck = true;
            if ($('#category_name').val() == '') {
                $('#categName').addClass('has-error');
                $('#categName-msg').text('Name required');
                formCheck = false;
            }
            if ($('#category_description').val() == '') {
                $('#categDesc').addClass('has-error');
                $('#categDesc-msg').text('Description required');
                formCheck = false;
            }
            if (formCheck == false) {
                return false;
            }
            var postData = $(this).serializeArray();
            var formURL = $(this).attr("action");
            
            $.ajax(
                    {
                        url: formURL,
                        type: "POST",
                        data: postData,
                        success: function(data, textStatus, jqXHR)
                        {
                            var data = jQuery.parseJSON(data);
                            if (data.success == 1) {
                                $('#form-msg').addClass('has-success');
                                $('#form-msg').text(data.msg);
                                $('#name').val('');
                                $('#description').val('');
                                $('#addForum').slideToggle("slow");
                                window.location.reload();
                            } else if (data.success == 0) {
                                $('#form-msg').addClass('has-error');
                                $('#form-msg').text(data.msg);
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown)
                        {
                            $('#form-msg').addClass('has-error');
                            $('#form-msg').text('Some error occured at server end.');
                            console.log(jqXHR);
                            console.log(textStatus);
                            console.log(errorThrown);
                        }
                    });                    
                    $( "#categFormcancel").trigger("click");
                    event.preventDefault();                    
                });
            });
</script>
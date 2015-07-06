<form name="addSurveyCategory"  id="addSurveyCategory" action="<?= createUrl("survey/addSurvey"); ?>" method="POST">
    <div class="box-body padding-0">
        <span class="help-block" id="form-msg"></span>
        <div class="row" id="surveyName">
            <div class="col-sm-12">
                <input type="text" id="name" name="name" class="form-control" placeholder="Survey name" 
                       value="<?php echo ($surveyDetail ? $surveyDetail['name'] : '' ); ?>"
                       required>
                <span class="help-block" id="surveyName-msg"></span>
            </div>
        </div>
        <div class="row mar-top10" id="surveyDesc">
            <div class="col-sm-12">
                <input type="text" id="description" name="description" class="form-control" placeholder="Add description"
                       value="<?php echo ($surveyDetail ? $surveyDetail['description'] : '' ); ?>"
                       required>
                <span class="help-block" id="surveyDesc-msg"></span>
            </div>
        </div>
        <?php if (1 == 0) { // it is exluded from view part temp. ?>
            <div class="row" id="surveyActive">
                <div class="col-sm-12">
                    <select required name="is_active" class="form-control">
                        <option value="1" <?php echo $surveyDetail && $surveyDetail['is_active'] == 1 ? 'selected' : ''; ?> >Active</option>
                        <option value="0" <?php echo $surveyDetail && $surveyDetail['is_active'] == 0 ? 'selected' : ''; ?> >De-active</option>
                    </select>
                    <span class="help-block" id="surveyActive-msg"></span>
                </div>
            </div>
        <?php } ?>
        <div id="dateError" class="row">
            <div class="dateMsg"></div> 
            <input type="hidden" name="survey_posted" value="1" />
            <?php
            if ($surveyDetail):
                echo '<input type="hidden" name="editsurvey" value="' . $surveyDetail['id'] . '" />';
            endif;
            ?>
        </div>    
        <div class="row mar-top10" id="surveyAssign">
            <div class="col-sm-4">
                <?php
                $assignList = '<select name="assigne_grp" id="assigne_grp" class="form-control">'
                        . '<option value="">Select Group</option>';
                if ($assigns) {
                    foreach ($assigns as $assigngrp) {
                        if($assigngrp->id == 2 || $assigngrp->id == 5){
                            continue;
                        }
                        if ($survey_id) {
                            $assignList .='<option ' . ($assigngrp->id == $surveyDetail['assigne_grp'] ? 'selected="selected"' : '') . ' value="' . $assigngrp->id . '">' . $assigngrp->name . '</option>';
                        } else {
                            $assignList .='<option value="' . $assigngrp->id . '">' . $assigngrp->name . '</option>';
                        }
                    }
                }
                $assignList .= '</select>';
                echo $assignList;
                ?>
                <span class="help-block" id="categAssign-msg"></span>
            </div>
            <div class="col-sm-4" id="grpSelect">
                <?php
                if ($surveyDetail):
                    echo $surveyAssignedTo;
                endif;
                ?>
            </div>
            <div class="col-sm-4">
                <input placeholder="<?= $place_start_date_str . ' - ' . $place_expired_date_str; ?>" type="text" 
                       id="survey_range" name="survey_range" class="form-control" 
                       value ="<?= $place_start_date_str . ' - ' . $place_expired_date_str; ?>"
                       readonly required>
                <span class="help-block" id="surveyRange-msg"></span>
            </div>
        </div>                        
        <div class="row mar-top10">
            <div class="col-sm-10">
                <?php
                $relatedJs = 'id="availableelements", class="form-control"';
                $default = '';
                echo form_dropdown('availableelements', $availableElement, $default, $relatedJs);
                ?>
            </div>
            <div class="col-md-2">
                <?php
                $data = array(
                    'name' => 'addElement',
                    'id' => 'addElement',
                    'class' => 'btn btn-primary pull-right btn-fix-width',
                );
                $ajaxUrl = base_url() . "index.php/survey/getDynamicElement?element=";
                $js = "";
                echo form_button($data, 'Add', $js);
                ?>
            </div>

        </div>
        <div class="row pad-bot15">
            <?php
            $attributes = array('class' => 'form-horizontal', 'id' => 'surveyAddEditForm', 'method' => 'POST');
            //echo form_open(createUrl('survey/addEditSurvey') , $attributes);
            //echo form_hidden('survey_id', $survey['id']);
            echo form_hidden('add-field', '1');
            if (isset($survey_id)) {
                echo form_hidden('edit-field', '1');
            }
            ?>

        </div>
    </div>
    <!--<div class="clearfix"></div>-->
    <div class="box-body padding-0" id="accordion">
        <?= $availableQuestionElement; ?>
    </div>
    <div class="box-body padding-0 clearfix">
        <button type="submit" class="btn btn-primary pull-right btn-fix-width">Complete Survey</button>
    </div>
</form>
<script>
    $('document').ready(
            function () {
                $('#addElement').on('click',
                        function (e) {
                            var selectedElement = $('#availableelements').val();
                            if (selectedElement == 0) {
                                $('#availableelements').focus();
                                alert('Please choose any element first');
                            }
                            $.ajax(
                                    {url: '<?= $ajaxUrl ?>' + selectedElement,
                                        type: 'GET',
                                        success: function (data, textStatus, jqXHR)
                                        {
                                            var data = jQuery.parseJSON(data);
                                            if (data.success == 1) {
                                                $("#accordion").append(data.html);
                                            } else if (data.success == 0) {
                                                alert('error');
                                            }
                                        },
                                        error: function (jqXHR, textStatus, errorThrown)
                                        {
                                            alert('Error occour at server end');
                                            console.log(jqXHR);
                                            console.log(textStatus);
                                            console.log(errorThrown);
                                        }
                                    });
                        });
            }
    );
</script>

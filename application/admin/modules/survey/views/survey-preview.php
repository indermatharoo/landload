<header class="panel-heading">
    <div class="row">
        <div class="col-sm-4">
            <a href="survey"><h3 style="margin: 0; cursor: pointer; color: #fff"><i class="fa fa-home"></i></h3></a>
        </div>
        <div class="col-sm-8">
            <h3 style="margin: 0"><?= $survey['name'] ?></h3>
        </div>
    </div>
</header>
<?php
if (!$ispreview) {
    $attributes = array('class' => 'form-horizontal', 'name' => 'surveyAns', 'id' => 'surveyAns', 'method' => 'POST');
    echo form_open(createUrl('survey/saveSurveyAns'), $attributes);
    echo form_hidden('survey_id', $survey['id']);
    echo form_hidden('saveSurvey', '1');
}
?>
<div class="col-md-12">
    <?= $questionHtml; ?>
</div>
<div class="col-md-12">
    <?php
    if (!$ispreview) {
        echo form_submit('surveysubmit', 'Submit Survey!', 'class="btn btn-primary pull-right"');
        echo form_close();
    }
    ?>
</div>
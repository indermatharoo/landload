<div class="row col-md-12" style="margin-bottom: 50px;">
            <div class="row col-md-12" >
                <div class="row col-md-5" >
                    <?php
                        $relatedJs =  'id="availableelements"';
                        $default = '';
                        echo form_dropdown('availableelements', $availableElement, $default ,  $relatedJs);                        
                    ?>
                </div>
                <div class="row col-md-5" >
                    <?php
                        $data = array(
                                    'name' => 'addElement',
                                    'id' => 'addElement',                                                                        
                                );
                        $ajaxUrl = base_url(). "index.php/survey/getDynamicElement?element=";
                        $js = "";
                        echo form_button($data, 'Add Element', $js);
                    ?>
                </div>
            </div>
</div>
<div class="row col-md-12">
            <?php
                $attributes = array('class' => 'form-horizontal', 'id' => 'surveyAddEditForm' , 'method' => 'POST');                
                //echo form_open(createUrl('survey/addEditSurvey') , $attributes);
                //echo form_hidden('survey_id', $survey['id']);
                echo form_hidden('add-field', '1');
                echo form_hidden('edit-field', '1');
            ?>
                <div class="row col-md-12" id="accordion">
                    <?= $availableQuestionElement; ?>
                </div>                
            <?php
                //echo form_close();
            ?>
</div>
<script>
    $('document').ready(
        function() {
            $('#addElement').on('click',
                function(e) {
                    var selectedElement = $('#availableelements').val();
                    if(selectedElement == 0){
                        $('#availableelements').focus();
                        alert('Please choose any element first');
                    }
                    $.ajax(
                        {   url: '<?= $ajaxUrl ?>'+ selectedElement,
                            type: 'GET',
                                success: function(data, textStatus, jqXHR)
                                {
                                    var data = jQuery.parseJSON(data);
                                    if (data.success == 1) {
                                        $("#accordion").append(data.html);
                                    } else if (data.success == 0) {
                                        alert('error');
                                    }
                                },
                                error: function(jqXHR, textStatus, errorThrown)
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

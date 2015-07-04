<script>
    $(document).ready(
            function () {
                $("#assigne_grp").multiselect({
                    onChange: function (option, checked, select) {
                        var grp_id = $('#assigne_grp').val();
                        $('#grpLabel').html('');
                        $('#grpSelect').html('');
                        var req_url = '<?= createUrl('survey/getGrpOpt/'); ?>' + grp_id;
                        $.ajax({
                            url: req_url,
                            type: "GET",
                            success: function (data, textStatus, jqXHR)
                            {
                                var data = jQuery.parseJSON(data);
                                $('#grpLabel').append("Choose Option");
                                $('#grpSelect').append(data.msg);
                            }
                        });
                    }
                });
                var datecheck = false;
                $('#survey_range').daterangepicker({
                    timePicker: false,
                    format: 'DD/MM/YYYY',
                    timePickerIncrement: 5,
                    timePicker12Hour: false,
                    timePickerSeconds: false
                });
                $("#addSurveyCategory").submit(function (event) {
                    var formCheck = true;
                    if ($('#name').val() == '') {
                        $('#surveyName').addClass('has-error');
                        $('#surveyName-msg').text('Name required');
                        formCheck = false;
                    }
                    if ($('#survey_range').val() != '') {
                        datecheck = true;
                    }

                    if ($('#description').val() == '') {
                        $('#surveyDesc').addClass('has-error');
                        $('#surveyDesc-msg').text('Description required');
                        formCheck = false;
                    }
                    if (datecheck == false) {
                        $('.dateMsg').html('Please select appropriate date');
                        $('.dateMsg').css('color', '#c65942');
                        $('.dateMsg').show();
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
                                success: function (data, textStatus, jqXHR)
                                {
                                    var data = jQuery.parseJSON(data);
                                    if (data.success == 1) {
                                        $('#form-msg').addClass('has-success');
                                        $('#form-msg').text(data.msg);
                                        $('#name').val('');
                                        $('#description').val('');
                                        $('#addForum').slideToggle("slow");
                                        window.location.href = "<?php echo createUrl("survey") ?>";
                                    } else if (data.success == 0) {
                                        $('#form-msg').addClass('has-error');
                                        $('#form-msg').text(data.msg);
                                    }
                                },
                                error: function (jqXHR, textStatus, errorThrown)
                                {
                                    $('#form-msg').addClass('has-error');
                                    $('#form-msg').text('Some error occured at server end.');
                                    console.log(jqXHR);
                                    console.log(textStatus);
                                    console.log(errorThrown);
                                }
                            });
                    $("#categFormcancel").trigger("click");
                    event.preventDefault();
                });
                $(".showsurvey").on('click',
                        function () {
                            var surveyId = $(this).attr('data-id');
                            window.open('<?= createUrl('survey/showSurvey?preview=1&surveyId='); ?>' + surveyId);
                        });
                $(".partSurvey").on('click',
                        function () {
                            var surveyId = $(this).attr('data-id');
                            window.open('<?= createUrl('survey/showSurvey?surveyId='); ?>' + surveyId);
                        });
                $('.editsurvey').click(function () {
                    var $elemt = $(this);
                    var surveyId = $elemt.attr('data-id');
                    $('#surveyForm').load('<?= createUrl('survey/addSurvey'); ?>?surveyid=' + surveyId + '', function (result) {
                        $('#surveyOuter').css("dispaly", "block");
                    });
                });

                $('#addSurvey').click(function () {
                    var categoryID = $("#survey_category").val();
                    $('#surveyForm').load('<?= createUrl('survey/addSurvey'); ?>?catid=' + categoryID, function (result) {
//$('#surveyOuter').css("dispaly", "block");
                        $('#surveyForm').bPopup();
                    });
                });
            }
    );
    function openAddSurvey() {
        $(".nav-tabs li").each(function (index) {
            $(this).removeClass('active');
            if (index == 1) {
                $(this).addClass('active');
            }
        });
        $('#tab_1').removeClass('active');
        $('#tab_2').removeClass('active');
        $('#tab_3').removeClass('active');
        $('#tab_2').addClass('active');

    }


</script>
<script>
    $(document).ready(
        function () {
            $(".partSurvey").on('click',
                function () {
                    var surveyId = $(this).attr('data-id');
                    window.open('<?= createUrl('survey/showSurvey?surveyId='); ?>' + surveyId);
            });
    });
</script>
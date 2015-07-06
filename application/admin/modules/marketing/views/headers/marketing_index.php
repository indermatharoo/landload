<script>
    $(document).ready(function () {
        $('#select_all').change(function () {
            if ($("#select_all").is(':checked')) {
                $('.branches').prop('checked', true);
            } else {
                $('.branches').prop('checked', false);
            }
        });


        function templateTrigger() {
            var $elem = $('.template_type');
            var type = $elem.data('type');
            showTemplateView($elem.val(), type);
        }

        $('select[name=email]').change(function () {
            templateTrigger();
        });

        $('select[name=sms]').change(function () {
            templateTrigger();
        });

        templateTrigger();

        function showTemplateView(template_id, type) {
            if (template_id == "") {
                $('.template_view').contents().html("");
                return false;
            }
            var url = DWS_BASE_URL + 'marketing/showTemplate/' + template_id + '/' + type;
            l(url);
            $('.template_view').attr('src',url);
        }


        $("#group").multiselect({
            onChange: function (option, checked, select, value) {                
                var grp_id = $(option).val();
                if(grp_id == 0){
                    $('#assignArea').html("");
                }
                var req_url = '<?= createUrl('survey/getGrpOpt/'); ?>' + grp_id;
                $.ajax({
                    url: req_url,
                    type: "GET",
                    success: function (data, textStatus, jqXHR)
                    {
                        var data = jQuery.parseJSON(data);
                        if (data.success == 0) {
                            bootbox.alert(data.msg);
                        }
                        var assignDD = $('#assignArea');
                        assignDD.html(data.msg);
                    }
                });
            }
        });
    });
    function l(v){
        console.log(v);
    }
</script>
<script>
    $(document).ready(
        function () {
        $(".grp").multiselect({            
            onChange: function (option, checked, select, value) {
                
                var elementId   =   $(this)[0]['options']['id'];                
                var grp_id = $(option).val();                
                var req_url = '<?= createUrl('notificationpanel/getGrpOpt/'); ?>'+elementId+'/'+grp_id;
                $.ajax({
                    url: req_url,
                    type: "GET",
                    success: function (data, textStatus, jqXHR)
                    {
                        var data = jQuery.parseJSON(data);
                        if(data.success == 0){
                            bootbox.alert(data.msg);
                        }
                        var assignDD = $('#assignArea'+'-'+elementId);
                        assignDD.html(data.msg);
                    }
                });
            }
        });
        $(".assigne").multiselect();
    });
</script>
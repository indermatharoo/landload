<script src="<?php echo $base_url ?>js/datatables/jquery.dataTables.js"></script>
<script src="<?php echo $base_url ?>js/datatables/dataTables.bootstrap.js"></script>
<script type="text/javascript">
    $(function() {
        $("#table").dataTable();
//        $('#example2').dataTable({
//            "bPaginate": true,
//            "bLengthChange": false,
//            "bFilter": false,
//            "bSort": true,
//            "bInfo": true,
//            "bAutoWidth": false
//        });
    });

    function l(v) {
        console.log(v);
    }

    $(document).ready(function() {
        $('tr.franchise').click(function() {
            var franchiseid = $(this).attr('franchise-id');
            var url = '<?php echo createUrl('user/franchise/stat/') ?>' + franchiseid;
            window.location = url;
        });
        $('.targetsetting').click(function() {
            var form = $(this).closest('form'),
                    data = form.serialize();
            $.ajax({
                url: '<?php echo createUrl('user/franchise/saveTargetColor') ?>',
                type: 'post',
                data: data,
                result: function(response) {
                    l(response);
                },
            });
            return false;
        });
    });

</script>

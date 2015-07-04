<script type="text/javascript">

    $(function () {
        $('#booking_status').change(function () {
            var type = $(this).find(":selected").text();
            if (type === 'Confirmed') {
                $('.payment_method').show();
            } else {
                $('.payment_method').hide();
            }
        });
        window.onload = function () {
            var cid = $('.event-category').attr('ecid');
            if (cid == 0) {
                $('.event-category').hide();
            }
        };
    });
    texteditor('.texteditor');
</script>

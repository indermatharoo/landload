<script>
    function l(v) {
        console.log(v);
    }
    function checkIntFloat(element, casee) {
        var val = $(element).val(), result, type;
        switch (casee) {
            case 1:
                result = isInteger(val, 0);
                type = 'numberic';
                break;
            case 2:
                result = isFloat(val);
                type = 'decimal';
                break;
            case 3:
                result = isInteger(val, 1);
                type = 'integer';
                break;
        }
        $(element).css('border-color', 'rgb(210, 214, 222)');
        if (!result) {
            alert('Only ' + type + ' is allowed in this field');
            $(element).css('border-color', 'red');
        }
        return result;
    }
    function isFloat(n) {
        if (isInteger(n)) {
            var val = parseFloat(n);
            return val % 1 != 0;
        }
        return false;
    }
    function isInteger(n, h) {
        if (!h)
            return n == +n;
        else
            return (n == +n) && (n % 1 == 0);
    }
    $(document).ready(function () {
        $('.save').click(function () {
            var save = true;
            $('.num-int').each(function (index) {
                var value = $(this).val();
                if (value) {
                    var response = checkIntFloat(this, 3);
                    if (!response) {
                        save = false;
                        return false;
                    }
                }
            });
            $('.num-float').each(function (index) {
                var value = $(this).val();
                if (value) {
                    var response = checkIntFloat(this, 1);
                    if (!response) {
                        save = false;
                        return false;
                    }
                }
            });
            if (!save)
                return false;
            $.ajax({
                type: 'POST',
                url: '<?= createUrl('calender/ajax/index/complete') ?>',
                data: $('#event-complete').serialize(),
                success: function (response) {
                    var result = JSON.parse(response);
                    window.location.replace("<?php echo createUrl('calender') ?>");
                }
            });
            return false;
        });
    });
</script>
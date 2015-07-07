<script>
    $(document).ready(function () {
        showExtraFields();
        $('#type').on('change', function () {
            showExtraFields();
        });
        var daily, monthly, weekly, yearly;
        $('.targets input').on('keyup', function (event) {
            setTarget(this);
        });
        $('.checkBOX').on('click', function (evt) {
            var form = $(this).closest('form'), val = 0;
            if (this.checked)
                val = 1;
            $('input[name="exclude_weekends"]', form).val(val);
        });
        $(document).on('click', '.applyBtn', function () {
            var data = $('input[name="targerdate"]').val();
            $('input[name="franchise_target"]').val(data);
        });
        $('#button').on('click', function () {
            var usertype = $('#type').val();
            if (usertype == 'User Type *') {
                alert('Select User Type First');
                return false;
            }
            if (usertype == 3) {
                var region = $('select[name="region"]').val();
                if (region == 'Select') {
                    alert('Select Region First');
                    return false;
                }
            }
        });
    });
    function reloadValues(f) {
        var form = $(f),
                eventid = form.attr('eventid')
                ;
        l(form.serialize());
    }
    function l(v) {
        console.log(v);
    }
    function setTarget1(t) {
        var form = $(t).closest('form');
        $('input[name="daily_event"]', form).val('');
        $('input[name="weekly_event"]', form).val('');
        $('input[name="monthly_event"]', form).val('');
        $('input[name="yearly_event"]', form).val('');
        $('input[name="daily_customer"]', form).val('');
        $('input[name="weekly_customer"]', form).val('');
        $('input[name="monthly_customer"]', form).val('');
        $('input[name="yearly_customer"]', form).val('');
    }
    function setTarget(t) {
        var form = $(t).closest('form'),
                eventid = form.attr('event-id'),
                val = $("[name='" + t.name + "']", form).val(),
                regex = /^[0-9]+$/,
                result = regex.test(val),
                exclude_week_end = $('input[name="exclude_weekends"]', form).is(':checked');

        if (!val) {
            return false;
        }
        if (!result) {
            alert('only numerical values are allowed');
            val = val.replace(/\D/g, '');
            $(t).val(val);
            return false;
        }
        var monthly, yearly;
        if (exclude_week_end) {
            monthly = 21.75;
            yearly = 261;
            weekly = 5;
        } else {
            monthly = 30.42;
            yearly = 365;
            weekly = 7;
        }
        switch (t.name) {
            case 'daily_event':
                $('input[name="monthly_event"]', form).val(Math.round(monthly * val));
                $('input[name="weekly_event"]', form).val(Math.round(weekly * val));
                $('input[name="yearly_event"]', form).val(Math.round(yearly * val));
                break;
            case 'weekly_event':
                $('input[name="daily_event"]', form).val(Math.round(val / weekly));
                $('input[name="monthly_event"]', form).val(Math.round((val / weekly) * monthly));
                $('input[name="yearly_event"]', form).val(Math.round((val / weekly) * monthly * 12));
                break;
            case 'monthly_event':
                $('input[name="daily_event"]', form).val(Math.round(val / monthly));
                $('input[name="weekly_event"]', form).val(Math.round((val / monthly) * weekly));
                $('input[name="yearly_event"]', form).val(Math.round(12 * val));
                break;
            case 'yearly_event':
                $('input[name="monthly_event"]', form).val(Math.round(val / 12));
                $('input[name="weekly_event"]', form).val(Math.round(val / yearly) * weekly);
                $('input[name="daily_event"]', form).val(Math.round(val / yearly));
                break;
            case 'daily_customer':
                $('input[name="monthly_customer"]', form).val(Math.round(monthly * val));
                $('input[name="weekly_customer"]', form).val(Math.round(weekly * val));
                $('input[name="yearly_customer"]', form).val(Math.round(yearly * val));
                break;
            case 'weekly_customer':
                $('input[name="daily_customer"]', form).val(Math.round(val / weekly));
                $('input[name="monthly_customer"]', form).val(Math.round((val / weekly) * monthly));
                $('input[name="yearly_customer"]', form).val(Math.round((val / weekly) * monthly * 12));
                break;
            case 'monthly_customer':
                $('input[name="daily_customer"]', form).val(Math.round(val / monthly));
                $('input[name="weekly_customer"]', form).val(Math.round((val / monthly) * weekly));
                $('input[name="yearly_customer"]', form).val(Math.round(12 * val));
                break;
            case 'yearly_customer':
                $('input[name="monthly_customer"]', form).val(Math.round(val / 12));
                $('input[name="weekly_customer"]', form).val(Math.round(val / yearly) * weekly);
                $('input[name="daily_customer"]', form).val(Math.round(val / yearly));
                break;
        }
        $("#franchise_targets" + eventid).val(form.serialize());
    }
    function showExtraFields() {
        var res = returnTrueFalse($('#type').val());
        showTargets($('#type').val());
        console.log(res);
        $('.extrafield').hide();
        if ($('.extrafield').is(":visible") && !res) {
            $('.extrafield').hide();
        } else {
            $('.extrafield').show();
        }
    }

    function showTargets(arr) {
        if (arr.indexOf("3") != -1) {
            if (!$('.franchisee-targets').is(":visible"))
                $('.franchisee-targets').show();
        }
        else
            $('.franchisee-targets').hide();
    }

    function returnTrueFalse(arr) {
        try {
            if (arr.indexOf("3") != -1)
                return true;
            else
                return false;

        } catch (e) {
            $('.extrafield').hide();
        }
    }

    $(function () {
        $('input[name="targerdate"]').daterangepicker({
            timePicker: true,
            format: 'DD/MM/YYYY',
            timePickerIncrement: 5,
            timePicker12Hour: false,
            timePickerSeconds: false
        });
    });

</script>
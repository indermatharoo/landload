<script>
    $(document).ready(function() {
        setTotal();
        $('.year_range').change(function() {
            var val = $(this).val()
            temp = val.split('-'),
                    syear = eyear = null
                    ;
            if (temp.length == 2) {
                syear = temp[0];
                eyear = temp[1];
            }
            if (syear && eyear) {
                var loc = "<?php echo createUrl('user/dashboard/') ?>" + syear + '/' + eyear;
                window.location.replace(loc);
            }
        });
        $(document).on('click', '.tab th', function() {
            var range = $(this).attr('range');
            if (!range)
                return false;
            var url = '<?php echo createUrl('user/ajax/dashboard/filter/') ?>' + range;
            $.post(url, function(response) {
                $('.table_cont').html(response);
                setTotal();
            });
        });
        $(document).on('click', '.back', function() {
            var url = '<?php echo createUrl('user/ajax/dashboard/back') ?>';
            $.post(url, function(response) {
                $('.table_cont').html(response);
                setTotal();
            });
        });
//        $('.tab td').click(function() {
//            var tr = $(this).closest('tr').index();
//            var td = $(this).closest('td').index();
//            var range = $('.tab tr').eq(0).find('th').eq(td).attr('range');
//            var type = $(this).closest('tr').find('td').eq(0).attr('type');
//            if (!range || !type)
//                return false;
//            shopBpopup(range, type);
//        });
        $(document).on('click', '.tab td', function() {
            var tr = $(this).closest('tr').index();
            var td = $(this).closest('td').index();
            var range = $('.tab tr').eq(0).find('th').eq(td).attr('range');
            var type = $(this).closest('tr').find('td').eq(0).attr('type');
            if (!range || !type)
                return false;
            shopBpopup(range, type);
        });
        $(document).on('click','.bott-table td',function(){
            var type = $(this).attr('type');
            if(!type)
                return false;
            $.post('<?php echo createUrl('user/ajax/dashboard/franchiseClass')?>',{type:type},function(response){
                $('#franchisesregions').html(response);
                testdrawChart();
            });
        });
    });
    
    function shopBpopup(range, type) {
        var url = '<?php echo createUrl('user/ajax/dashboard/eventdetail') ?>';
        $.post(url, {range: range, type: type}, function(response) {
//            return false;
            var response = JSON.parse(response);
            var html = '', show = false;
            $('.dashboard_message .content').html(html);
            for (x in response) {
                console.log(response[x]);
                show = true;
                var tmp = '';
                tmp += '<div class="title" style="font-size: 20px;">';
                tmp += response[x].name + '&nbsp;(' + response[x].result + ')';
                tmp += '</div>';
                $('.dashboard_message .content').append(tmp);
            }
            if (show)
                $('.dashboard_message').bPopup({
                    closeClass: 'cls',
                });
        });
    }
    function setTotal() {
        $('#totalg1').html(forEClass('G1'));
        $('#totalg2').html(forEClass('G2'));
        $('#totalg3').html(forEClass('G3'));
        $('#totalg4').html(forEClass('G4'));
        $('#totalg5').html(forEClass('total'));
    }
    function l(v) {
        console.log(v);
    }

    function forEClass(name) {
        var total = 0;
        $('.' + name).each(function() {
            total += parseFloat($(this).html());
        });
//        alert(total);
        return total;
    }
    function gV(str) {
        var data = $('#' + str).html();
        return parseFloat(data);
    }
</script>
<script src="js/chart.min.js" type="text/javascript"></script> 
<script>
    var chart = new Chart(document.getElementById("area-chart").getContext("2d"));
    $(document).ready(function() {
        var data = [gV('totalg1'), gV('totalg2'), gV('totalg3'), gV('totalg4')];
        var lineChartData = {
            labels: ["Apr-Jun", "Jul-Sep", "Oct-Dec", "Jan-Mar"],
            datasets: [
                {
                    fillColor: "rgba(151,187,205,0.5)",
                    strokeColor: "rgba(151,187,205,1)",
                    pointColor: "rgba(151,187,205,1)",
                    pointStrokeColor: "#fff",
                    data: data
                }
            ]
        }
        chart.Line(lineChartData);
    });
</script><!-- /Calendar -->

<button class="btn btn-primary closechart">X</button>
<div id="chartt"></div>
<?php
//echo "<pre>";
//e($display);
//print_r($models);
//exit;
$header = array();
$G1 = array();
$G2 = array();
$G3 = array();
$G4 = array();
$header[] = 'Year';
$G1[] = 'Apr-Jun';
$G2[] = 'Jul-Sep';
$G3[] = 'Oct-Dec';
$G4[] = 'Jan-Mar';
foreach ($models as $model):
    $show = true;
    if ($display == 'retail_buyed') {
        $show = false;
        foreach ($model as $a):
            if (arrIndex($a, $display)) {
                $show = true;
                break;
            }
        endforeach;
        if (!$show) {
            continue;
        }
    }
    if ($show) {
        $header[] = arrIndex($model, 'franchisename') . '-' . arrIndex($model, 'regionname');
        foreach ($model as $key => $a):
            switch ($key):
                case 'G1':
                    $G1[] = arrIndex($a, $display, 0);
                    break;
                case 'G2':
                    $G2[] = arrIndex($a, $display, 0);
                    break;
                case 'G3':
                    $G3[] = arrIndex($a, $display, 0);
                    break;
                case 'G4':
                    $G4[] = arrIndex($a, $display, 0);
                    break;
            endswitch;
        endforeach;
    }
endforeach;
$temp = array(
    $header,
    $G1,
    $G2,
    $G3,
    $G4
);
//e($temp);
?>
<script>
    var mainarray = <?php echo json_encode($temp); ?>;
    var newarr = [], y = 0;
    mainarray.forEach(function (elm) {
        var temp = [], i = 0;
//        console.log(elm);
        elm.forEach(function (el) {
            var t = parseFloat(el);
            temp[i++] = isNaN(t) ? el : t;
        });
        newarr[y] = temp;
        y++;
    });
    console.log(newarr);
    google.setOnLoadCallback(testdrawChart);
    function testdrawChart() {
        var data = google.visualization.arrayToDataTable(newarr);
        var options = {
            title: 'Events Performance',
            curveType: 'function',
            legend: {position: 'bottom'}
        }
        ;
        var chart = new google.visualization.LineChart(document.getElementById('chartt'));
        chart.draw(data, options);
    }
</script>
<table class="tab" cellpadding="10" cellspacing="0">
    <tbody>
        <tr class="th">
            <th width="30%">Summary</th>
            <th range="4-6">April - June 14</th>
            <th range="7-9">Jul - Sep 14</th>
            <th range="10-12">Oct - Dec 14</th>
            <th range="1-3">Jan - March 15</th>
            <th>Total</th>
        </tr>
        <?php foreach ($models as $model): ?>
            <?php
            if ($display == 'retail_buyed') {
                $show = false;
                foreach ($model as $a):
                    if (arrIndex($a, $display)) {
                        $show = true;
                    }
                endforeach;
                if (!$show) {
                    continue;
                }
            }
            ?>
            <tr class="franchise_user_id" user_id="<?php echo arrIndex($model, 'user_id') ?>" eventType="<?php echo $eventType ?>">
                <td>
                    <div><?php echo arrIndex($model, 'regionname') ?></div>
                    <div><?php echo arrIndex($model, 'franchisename') ?></div>
                </td>
                <?php
                $total = 0;
                $g1 = arrIndex($model, 'G1', array());
                ?>
                <td>&pound;<?php
                    $total += arrIndex($g1, $display, 0);
                    echo arrIndex($g1, $display, 0);
                    ?></td>
                <?php $g2 = arrIndex($model, 'G2', array()); ?>
                <td>&pound;<?php
                    $total += arrIndex($g2, $display, 0);
                    echo arrIndex($g2, $display, 0)
                    ?></td>
                <?php $g3 = arrIndex($model, 'G3', array()); ?>
                <td>&pound;<?php
                    $total += arrIndex($g3, $display, 0);
                    echo arrIndex($g3, $display, 0)
                    ?></td>
                <?php $g4 = arrIndex($model, 'G4', array()); ?>
                <td>&pound;<?php
                    $total += arrIndex($g4, $display, 0);
                    echo arrIndex($g4, $display, 0)
                    ?></td>
                <td>&pound;<?php echo $total ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<script>
    $(document).ready(function () {
        $('tr.franchise_user_id').on('click', function () {
            var user_id = $(this).attr('user_id'),
                    eventType = $(this).attr('eventType');
            if (!user_id || !eventType) {
                return false;
            }
            $.post('<?php echo createUrl('user/ajax/dashboard/franchiseClass') ?>', {type: eventType, franchise: user_id}, function (response) {
                $('#franchisesregions').html(response);
                testdrawChart();
            });
        });
        $('.closechart').on('click', function () {
            $('#franchisesregions').html('');
        });
    });
</script>
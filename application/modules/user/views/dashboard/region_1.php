<div class="top-table">
    <table class="tab" cellpadding="10" cellspacing="0">
        <tr class="th">
            <th width="30%">Summary</th><th range="4-6">April - June 14</th><th range="7-9">Jul - Sep 14</th><th range="10-12">Oct - Dec 14</th><th range="1-3">Jan - March 15</th><th>Total</th>
            <?php foreach ($dasbBoardData as $key => $data): ?>
            <tr>
                <td><?php
                    $region = arrIndex($regions, $key);
                    echo arrIndex($region, 'name');
                    ?></td>
                <?php
//                e($data);
                $G1 = arrIndex($data, 'G1');
                $G2 = arrIndex($data, 'G2');
                $G3 = arrIndex($data, 'G3');
                $G4 = arrIndex($data, 'G4');
//                e($G4);
                $total = 0;
                ?>
                <td class="G1_TOTAL"><?php
                    echo arrIndex($G1, $get);
                    $total+=arrIndex($G1, $get);
                    ?></td>
                <td class="G2_TOTAL"><?php
                    echo arrIndex($G2, $get);
                    $total+=arrIndex($G2, $get);
                    ?></td>
                <td class="G3_TOTAL"><?php
                    echo arrIndex($G3, $get);
                    $total+=arrIndex($G3, $get);
                    ?></td>
                <td class="G4_TOTAL"><?php
                    echo arrIndex($G4, $get);
                    $total+=arrIndex($G4, $get);
                    ?></td>
                <td class="TOTAL"><?php echo $total ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td>Total</td>
            <td id="G1_TOTAL"></td>
            <td id="G2_TOTAL"></td>
            <td id="G3_TOTAL"></td>
            <td id="G4_TOTAL"></td>
            <td id="TOTAL"></td>
        </tr>
    </table>    
</div>
<script>
    var total_income = [];
    function forEClass(name) {
        var total = 0;
        $('.' + name).each(function() {
            var val = $(this).html();
            val = +val;
            total += val;
        });
        return total;
    }
    function cP(classname) {
        return (parseFloat(forEClass(classname))) ? parseFloat(forEClass(classname)) : 0;
    }

    function setTotal() {
        $('#G1_TOTAL').html(forEClass('G1_TOTAL'));
        $('#G2_TOTAL').html(forEClass('G2_TOTAL'));
        $('#G3_TOTAL').html(forEClass('G3_TOTAL'));
        $('#G4_TOTAL').html(forEClass('G4_TOTAL'));
        $('#TOTAL').html(forEClass('TOTAL'));

        total_income[0] = cP('G1_TOTAL');
        total_income[1] = cP('G2_TOTAL');
        total_income[2] = cP('G3_TOTAL');
        total_income[3] = cP('G4_TOTAL');
        $('#chart_heading').html('<?php echo ucfirst($get) ?> Chart');
    }
    $(document).ready(function() {
        setTotal();
        var lineChartData = {
            labels: ['Apr-Jun', 'Jul-Sep', 'Oct-Dec', 'Jan-Mar'],
            datasets: [
                {
                    fillColor: "rgba(151,187,205,0.5)",
                    strokeColor: "rgba(151,187,205,1)",
                    pointColor: "rgba(151,187,205,1)",
                    pointStrokeColor: "#fff",
                    data: total_income
                }
            ]
        }
        chart.Line(lineChartData);
    });
</script>
<div class="top-table">
    <table class="tab" cellpadding="10" cellspacing="0">
        <tr class="th">
            <?php
            $get = 'customers';
            ?>
            <th width="30%">Summary</th><th range="4-6">April - June 14</th><th range="7-9">Jul - Sep 14</th><th range="10-12">Oct - Dec 14</th><th range="1-3">Jan - March 15</th><th>Total</th>
        </tr>
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
                <td class="G1_CUSTOMER"><?php
                    echo arrIndex($G1, $get);
                    $total+=arrIndex($G1, $get);
                    ?></td>
                <td class="G2_CUSTOMER"><?php
                    echo arrIndex($G2, $get);
                    $total+=arrIndex($G2, $get);
                    ?></td>
                <td class="G3_CUSTOMER"><?php
                    echo arrIndex($G3, $get);
                    $total+=arrIndex($G3, $get);
                    ?></td>
                <td class="G4_CUSTOMER"><?php
                    echo arrIndex($G4, $get);
                    $total+=arrIndex($G4, $get);
                    ?></td>
                <td class="CUSTOMER_TOTAL"><?php echo $total ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td>Total</td>
            <td id="G1_CUSTOMER_TOTAL"></td>
            <td id="G2_CUSTOMER_TOTAL"></td>
            <td id="G3_CUSTOMER_TOTAL"></td>
            <td id="G4_CUSTOMER_TOTAL"></td>
            <td id="CUSTOMER_TOTAL"></td>
        </tr>
    </table>    
</div>
<?php
$get = 'income';
?>
<div class="bott-table">
    <table class="tab" cellspacing="0" cellpadding="3">
        <tr class="th">
            <th width="30%">Income</th><th range="4-6">April - June 14</th><th range="7-9">Jul - Sep 14</th><th range="10-12">Oct - Dec 14</th><th range="1-3">Jan - March 15</th><th>Total</th>
        </tr>
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
                <td class="G1_INCOME"><?php
                    echo arrIndex($G1, $get);
                    $total+=arrIndex($G1, $get);
                    ?></td>
                <td class="G2_INCOME"><?php
                    echo arrIndex($G2, $get);
                    $total+=arrIndex($G2, $get);
                    ?></td>
                <td class="G3_INCOME"><?php
                    echo arrIndex($G3, $get);
                    $total+=arrIndex($G3, $get);
                    ?></td>
                <td class="G4_INCOME"><?php
                    echo arrIndex($G4, $get);
                    $total+=arrIndex($G4, $get);
                    ?></td>
                <td class="INCOME_TOTAL"><?php echo $total ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td>Total</td>
            <td id="G1_INCOME_TOTAL"></td>
            <td id="G2_INCOME_TOTAL"></td>
            <td id="G3_INCOME_TOTAL"></td>
            <td id="G4_INCOME_TOTAL"></td>
            <td id="INCOME_TOTAL"></td>
        </tr>
    </table>
</div>
<script>
    function l(v) {
        console.log(v);
    }
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

    function setTotal() {
        $('#G1_CUSTOMER_TOTAL').html(forEClass('G1_CUSTOMER'));
        $('#G2_CUSTOMER_TOTAL').html(forEClass('G2_CUSTOMER'));
        $('#G3_CUSTOMER_TOTAL').html(forEClass('G3_CUSTOMER'));
        $('#G4_CUSTOMER_TOTAL').html(forEClass('G4_CUSTOMER'));
        $('#CUSTOMER_TOTAL').html(forEClass('CUSTOMER_TOTAL'));

        $('#G1_INCOME_TOTAL').html(forEClass('G1_INCOME'));
        $('#G2_INCOME_TOTAL').html(forEClass('G2_INCOME'));
        $('#G3_INCOME_TOTAL').html(forEClass('G3_INCOME'));
        $('#G4_INCOME_TOTAL').html(forEClass('G4_INCOME'));
        $('#INCOME_TOTAL').html(forEClass('INCOME_TOTAL'));        
        
        total_income[0] = cP('G1_INCOME');
        total_income[1] = cP('G2_INCOME');
        total_income[2] = cP('G3_INCOME');
        total_income[3] = cP('G4_INCOME');
    }
    function cP(classname) {
        return (parseFloat(forEClass(classname))) ? parseFloat(forEClass(classname)) : 0;
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
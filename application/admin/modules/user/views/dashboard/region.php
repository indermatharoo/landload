<div class="top-table">
    <table class="tab" cellpadding="10" cellspacing="0">
        <tr class="th">
            <th width="30%">Summary</th><th range="4-6">April - June 14</th><th range="7-9">Jul - Sep 14</th><th range="10-12">Oct - Dec 14</th><th range="1-3">Jan - March 15</th><th>Total</th>
        </tr>
        <tr>
            <td type="CLASS_CUSTOMER">Total Class Customers</td>
            <?php
            $total = 0;
            foreach ($dasbBoardData[Event::$types['CLASS']] as $array):
                $total += (arrIndex($array, 'customers')) ? $array['customers'] : 0;
                ?>
                <td><?php echo (arrIndex($array, 'customers')) ? $array['customers'] : 0 ?></td>
            <?php endforeach; ?>
            <td><?php echo $total; ?></td>
        </tr>
        <tr>
            <td type="CLASS_COUNT">Total Classes</td>
            <?php
            $total = 0;
            foreach ($dasbBoardData[Event::$types['CLASS']] as $array):
                $total += (arrIndex($array, 'count')) ? $array['count'] : 0;
                ?>
                <td><?php echo (arrIndex($array, 'count')) ? $array['count'] : 0 ?></td>
            <?php endforeach; ?>
            <td><?php echo $total; ?></td>
        </tr>
        <tr>
            <td type="PARTY_CUSTOMER">Total Party Customers</td>
            <?php
            $total = 0;
            foreach ($dasbBoardData[Event::$types['PARTY']] as $array):
                $total += (arrIndex($array, 'customers')) ? $array['customers'] : 0;
                ?>
                <td><?php echo (arrIndex($array, 'customers')) ? $array['customers'] : 0 ?></td>
            <?php endforeach; ?>
            <td><?php echo $total; ?></td>
        </tr>
        <tr>
            <td type="PARTY_COUNT">Total Number Of Parties Run</td>
            <?php
            $total = 0;
            foreach ($dasbBoardData[Event::$types['PARTY']] as $array):
                $total += (arrIndex($array, 'count')) ? $array['count'] : 0;
                ?>
                <td><?php echo (arrIndex($array, 'count')) ? $array['count'] : 0 ?></td>
            <?php endforeach; ?>
            <td><?php echo $total; ?></td>
        </tr>
        <tr>
            <td type="CLUB_COUNT">Total Club Numbers</td>
            <?php
            $total = 0;
            foreach ($dasbBoardData[Event::$types['CLUB']] as $array):
                $total += (arrIndex($array, 'count')) ? $array['count'] : 0;
                ?>
                <td><?php echo (arrIndex($array, 'count')) ? $array['count'] : 0 ?></td>
            <?php endforeach; ?>
            <td><?php echo $total; ?></td>
        </tr>
        <tr>
            <td type="CLUB_CUSTOMER">Total Club Contracts</td>
            <?php
            $total = 0;
            foreach ($dasbBoardData[Event::$types['CLUB']] as $array):
                $total += (arrIndex($array, 'customers')) ? $array['customers'] : 0;
                ?>
                <td><?php echo (arrIndex($array, 'customers')) ? $array['customers'] : 0 ?></td>
            <?php endforeach; ?>
            <td><?php echo $total; ?></td>
        </tr>
        <tr>
            <td type="EVENT_COUNT">Total Numbers Of Event Run</td>
            <?php
            $total = 0;
            foreach ($dasbBoardData[Event::$types['EVENT']] as $array):
                $total += (arrIndex($array, 'count')) ? $array['count'] : 0;
                ?>
                <td><?php echo (arrIndex($array, 'count')) ? $array['count'] : 0 ?></td>
            <?php endforeach; ?>
            <td><?php echo $total; ?></td>
        </tr>
    </table>    
</div>
<div class="bott-table">
    <table class="tab1 tab" cellspacing="0" cellpadding="3">
        <tr class="th">
            <th width="30%">Income</th><th range="4-6">April - June 14</th><th range="7-9">Jul - Sep 14</th><th range="10-12">Oct - Dec 14</th><th range="1-3">Jan - March 15</th><th>Total</th>
        </tr>
        <tr>
            <td type="CLASS__income">Classes</td>
            <?php
            $total = 0;
            foreach ($dasbBoardData[Event::$types['CLASS']] as $array):
                $total += (arrIndex($array, 'income')) ? $array['income'] : 0;
                ?>
                <td>£<span class="<?php echo arrIndex($array, 'gid') ?>"><?php echo (arrIndex($array, 'income')) ? round($array['income'], 2) : 0 ?></span></td>
            <?php endforeach; ?>
            <td>£<span class="total"><?php echo round($total, 2); ?></span></td>
        </tr>
        <tr>
            <td type="PARTY__income">Parties</td>
            <?php
            $total = 0;
            foreach ($dasbBoardData[Event::$types['PARTY']] as $array):
                $total += (arrIndex($array, 'income')) ? $array['income'] : 0;
                ?>
                <td>£<span class="<?php echo arrIndex($array, 'gid') ?>"><?php echo (arrIndex($array, 'income')) ? round($array['income'], 2) : 0 ?></span></td>
            <?php endforeach; ?>
            <td>£<span class="total"><?php echo round($total, 2); ?></span></td>
        </tr>
        <tr>
            <td type="EVENT__income">Events</td>
            <?php
            $total = 0;
            foreach ($dasbBoardData[Event::$types['EVENT']] as $array):
                $total += (arrIndex($array, 'income')) ? $array['income'] : 0;
                ?>
                <td>£<span class="<?php echo arrIndex($array, 'gid') ?>"><?php echo (arrIndex($array, 'income')) ? round($array['income'], 2) : 0 ?></span></td>
            <?php endforeach; ?>
            <td>£<span class="total"><?php echo round($total, 2); ?></span></td>
        </tr>
        <tr>
            <td type="CLUB__income">Clubs</td>
            <?php
            $total = 0;
            foreach ($dasbBoardData[Event::$types['CLUB']] as $array):
                $total += (arrIndex($array, 'income')) ? $array['income'] : 0;
                ?>
                <td>£<span retail_buyed="<?php echo arrIndex($array, 'retail_buyed', 0) ?>" retail_sailed="<?php echo arrIndex($array, 'retail_sailed', 0) ?>" class="<?php echo arrIndex($array, 'gid') ?>"><?php echo arrIndex($array, 'income', 0) ?></span></td>
            <?php endforeach; ?>
            <td>£<span class="total"><?php echo round($total, 2); ?></span></td>
        </tr>
        <tr>
            <td>Clubs Contracts</td><td>£</td><td>£</td><td>£</td><td>£</td><td>£</td>
        </tr>
        <tr>
            <td type="RETAILS__retail_buyed">Retails</td>
            <?php
            $total = 0;
            $retail_buyed = $retail_sailed = 0;
            foreach ($dasbBoardData['retail'] as $key => $array):
                $total += arrIndex($array, 'retail_buyed', 0);
                ?>
                <td>£<span class="<?php echo $key ?>"><?php echo arrIndex($array, 'retail_buyed', 0) ?></span></td>
            <?php endforeach; ?>
            <td>£<span class="total"><?php echo round($total, 2); ?></span></td>
        </tr>
        <tr>
            <td>Total Income</td><td>£<span id="totalg1"></span></td><td>£<span id="totalg2"></span></td><td>£<span id="totalg3"></span></td><td>£<span id="totalg4"></span></td><td>£<span id="totalg5"></span></td>
        </tr>
    </table>    
</div>
<script>
    function setTotal() {
        $('#totalg1').html(forEClass('G1'));
        $('#totalg2').html(forEClass('G2'));
        $('#totalg3').html(forEClass('G3'));
        $('#totalg4').html(forEClass('G4'));
        $('#totalg5').html(forEClass('total'));
    }
    setTotal();
    var data = [gV('totalg1'), gV('totalg2'), gV('totalg3'), gV('totalg4')];
    $(document).ready(function() {
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
    }
    );
</script>
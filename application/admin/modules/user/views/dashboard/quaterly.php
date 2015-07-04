<?php
//e($monLabel);
?>
<div class="top-table">
    <table class="tab" cellpadding="10" cellspacing="0">
        <tr class="th">
            <th width="30%">Summary</th>
            <?php foreach ($monLabel as $key => $month): ?>
                <th range="<?php echo $key . '-' . $key ?>"><?php echo $month ?></th>
            <?php endforeach; ?>
            <th>Total</th>
        </tr>
        <tr>
            <td type="CLASS_CUSTOMER">Total Class Customers</td>
            <?php
            $total = 0;
            foreach ($dasbBoardData[Event::$types['CLASS']] as $key => $array):
                if ($key == 3)
                    continue;
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
            foreach ($dasbBoardData[Event::$types['CLASS']] as $key => $array):
                if ($key == 3)
                    continue;
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
            foreach ($dasbBoardData[Event::$types['PARTY']] as $key => $array):
                if ($key == 3)
                    continue;
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
            foreach ($dasbBoardData[Event::$types['PARTY']] as $key => $array):
                if ($key == 3)
                    continue;
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
            foreach ($dasbBoardData[Event::$types['CLUB']] as $key => $array):
                if ($key == 3)
                    continue;
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
            foreach ($dasbBoardData[Event::$types['CLUB']] as $key => $array):
                if ($key == 3)
                    continue;
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
            foreach ($dasbBoardData[Event::$types['EVENT']] as $key => $array):
                if ($key == 3)
                    continue;
                $total += (arrIndex($array, 'count')) ? $array['count'] : 0;
                ?>
                <td><?php echo (arrIndex($array, 'count')) ? $array['count'] : 0 ?></td>
            <?php endforeach; ?>
            <td><?php echo $total; ?></td>
        </tr>
    </table>    
</div>
<div class="bott-table">
    <table class="tab" cellspacing="0" cellpadding="3">
        <tr class="th">
            <th width="30%">Income</th>
            <?php foreach ($monLabel as $month): ?>
                <th range="<?php echo $key . '-' . $key ?>"><?php echo $month ?></th>
            <?php endforeach; ?>
            <th>Total</th>
        </tr>
        <tr>
            <td type="CLASS_INCOME">Classes</td>
            <?php
            $total = 0;
            foreach ($dasbBoardData[Event::$types['CLASS']] as $key => $array):
                if ($key == 3)
                    continue;
                $total += (arrIndex($array, 'income')) ? $array['income'] : 0;
                ?>
                <td>£<span class="<?php echo arrIndex($array, 'gid') ?>"><?php echo (arrIndex($array, 'income')) ? round($array['income'], 2) : 0 ?></span></td>
            <?php endforeach; ?>
            <td>£<span class="total"><?php echo round($total, 2); ?></span></td>
        </tr>
        <tr>
            <td type="PARTY_INCOME">Parties</td>
            <?php
            $total = 0;
            foreach ($dasbBoardData[Event::$types['PARTY']] as $key => $array):
                if ($key == 3)
                    continue;
                $total += (arrIndex($array, 'income')) ? $array['income'] : 0;
                ?>
                <td>£<span class="<?php echo arrIndex($array, 'gid') ?>"><?php echo (arrIndex($array, 'income')) ? round($array['income'], 2) : 0 ?></span></td>
            <?php endforeach; ?>
            <td>£<span class="total"><?php echo round($total, 2); ?></span></td>
        </tr>
        <tr>
            <td type="EVENT_INCOME">Events</td>
            <?php
            $total = 0;
            foreach ($dasbBoardData[Event::$types['EVENT']] as $key => $array):
                if ($key == 3)
                    continue;
                $total += (arrIndex($array, 'income')) ? $array['income'] : 0;
                ?>
                <td>£<span class="<?php echo arrIndex($array, 'gid') ?>"><?php echo (arrIndex($array, 'income')) ? round($array['income'], 2) : 0 ?></span></td>
            <?php endforeach; ?>
            <td>£<span class="total"><?php echo round($total, 2); ?></span></td>
        </tr>
        <tr>
            <td type="CLUB_INCOME">Clubs</td>
            <?php
            $total = 0;
            foreach ($dasbBoardData[Event::$types['CLUB']] as $key => $array):
                if ($key == 3)
                    continue;
                $total += (arrIndex($array, 'income')) ? $array['income'] : 0;
                ?>
                <td>£<span retail_buyed="<?php echo arrIndex($array, 'retail_buyed', 0) ?>" retail_sailed="<?php echo arrIndex($array, 'retail_sailed', 0) ?>" class="<?php echo arrIndex($array, 'gid') ?>"><?php echo arrIndex($array, 'income', 0) ?></span></td>
            <?php endforeach; ?>
            <td>£<span class="total"><?php echo round($total, 2); ?></span></td>
        </tr>
        <tr>
            <td>Clubs Contracts</td><td>£</td><td>£</td><td>£</td><td>£</td>
        </tr>
        <tr>
            <td type="RETAILS_RETAILS">Retails</td>
            <?php
            $total = 0;
            $retail_buyed = $retail_sailed = 0;
            foreach ($dasbBoardData['retail'] as $key => $array):
                if ($key == 'G4')
                    continue;
                $total += arrIndex($array, 'retail_buyed', 0);
                ?>
                <td>£<span class="<?php echo $key ?>"><?php echo arrIndex($array, 'retail_buyed', 0) ?></span></td>
            <?php endforeach; ?>
            <td>£<span class="total"><?php echo round($total, 2); ?></span></td>
        </tr>
        <tr>
            <td>Total Income</td><td>£<span id="totalg1"></span></td><td>£<span id="totalg2"></span></td><td>£<span id="totalg3"></span></td><td>£<span id="totalg5"></span></td>
        </tr>
    </table>    
</div>
<button class="back btn btn-primary" onclick="back()">Back</button>
<script>
    setTotal();
    var data = [gV('totalg1'), gV('totalg2'), gV('totalg3')], labels = [];
<?php $i = 0; ?>
<?php foreach ($monLabel as $key => $month): ?>
        labels[<?php echo $i ?>] = '<?php echo $month ?>';
    <?php $i++; ?>
<?php endforeach; ?>
//    l(labels);
    $(document).ready(function() {
        var lineChartData = {
            labels: labels,
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
<div class="row content-bg">
    <div id="left-column" class="col-lg-12 pad-left20 pad-top10">
        <link type="text/css" rel="stylesheet" href="<?php echo base_url() ?>css/datatables/dataTables.bootstrap.css">
        <style type="text/css">
            .circle { 
                width: 150px; 
                height: 150px; 
                background: #F16C20; 
                -moz-border-radius: 75px; 
                -webkit-border-radius: 75px; 
                border-radius: 75px; 
            }
            .circle-inner {
                display: inline-block;
                margin: 55px 26px;
                vertical-align: middle;
                width: 100px;
            }
            .circle-inner h2, h4 {
                margin: 0;
                padding: 0;
                color: #fff;
                text-align: center;
                font-size:15px;
            }
            select, .serc option{
                color: #000;
            }
        </style>

        <div class="">
            <header class="panel-heading">
                <div class="row">
                    <div class="col-sm-1">
                        <a href="user/dashboard" style="color: #fff;"><i class="fa fa-home fa-2x"></i></a>
                    </div>
                    <div class="col-sm-9">
                        <h3 style="margin: 0; text-align: center">Reports</h3>
                    </div>
                    <div style="text-align: right" class="col-sm-2">
                        <select name="targetTypes" class="serc pull-right">
                            <?php foreach ($targetTypes as $target): ?>
                                <option <?php echo ($targetid == arrIndex($target, 'id') ? "selected='true'" : '') ?> value="<?php echo arrIndex($target, 'id') ?>"><?php echo ucfirst(arrIndex($target, 'name')) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label class="pull-right">Target Type: </label>
                    </div>
                </div>
            </header>
            <div class="">
                <div class="table-responsive">
                    <div class="col-lg-12">
                        <?php foreach ($targetPerformance as $eventType => $targett): ?>
                            <?php foreach ($targett as $target_id => $description): ?>                    
                                <?php
                                if ($target_id != $targetid)
                                    continue;
                                ?>
                                <div class="circle" style="float:left;margin:10px">
                                    <div class="circle-inner">
                                        <h4><?php echo arrIndex($description, 'event_name') . ' '; ?><span class="counter"><?php echo arrIndex($description, '_event_percet') ?></span>%</h4>
                                        <h4>Events</h4>
                                    </div>
                                </div>
                                <div class="circle" style="float:left;margin:10px">
                                    <div class="circle-inner">
                                        <h4><?php echo arrIndex($description, 'event_name') . ' ' ?><span class="counter"><?php echo arrIndex($description, '_customer_percet') ?></span>%</h4>
                                        <h4>Customers</h4>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </div>
                    <div class="clearfix"></div>
                    <form action="" method="post">
                        <table id="table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Franchise Name</th>
                                    <th>Class Daily Events</th>
                                    <th>Class Weekly Events</th>
                                    <th>Class Monthly Events</th>
                                    <th>Class Yearly Events</th>
                                    <th>Party Daily Events</th>
                                    <th>Party Weekly Events</th>
                                    <th>Party Monthly Events</th>
                                    <th>Party Yearly Events</th>
                                    <th>Club Daily Events</th>
                                    <th>Club Weekly Events</th>
                                    <th>Club Monthly Events</th>
                                    <th>Club Yearly Events</th>
                                    <th>Event Daily Events</th>
                                    <th>Event Weekly Events</th>
                                    <th>Event Monthly Events</th>
                                    <th>Event Yearly Events</th>
                                </tr>
                            </thead>
                            <tbody>                    
                                <?php foreach ($models as $franchise_id => $model): ?>
                                    <?php
                                    $detail = arrIndex($model, 'detail');
                                    $targets = arrIndex($model, 'data');
                                    echo "<tr>";
                                    echo "<td>" . ucfirst(arrIndex($detail, 'name')) . "</td>";
                                    foreach ($targets as $event_id => $target):
                                        foreach ($target as $target_id => $Starget):
                                            ?>
                                        <td><input name="<?php echo $franchise_id . '-' . $event_id . '-' . $target_id . '-no_of_event' ?>" type="text" value="<?php echo arrIndex($Starget, 'no_of_event', '') ?>" class="form-control" style="width:60px"/></td>
                                        <?php
                                    endforeach;
                                endforeach;
                                echo "<tr>";
                                ?>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <table id="table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Franchise Name</th>
                                    <th>Class Daily Customers</th>
                                    <th>Class Weekly Customers</th>
                                    <th>Class Monthly Customers</th>
                                    <th>Class Yearly Customers</th>
                                    <th>Party Daily Customers</th>
                                    <th>Party Weekly Customers</th>
                                    <th>Party Monthly Customers</th>
                                    <th>Party Yearly Customers</th>
                                    <th>Club Daily Customers</th>
                                    <th>Club Weekly Customers</th>
                                    <th>Club Monthly Customers</th>
                                    <th>Club Yearly Customers</th>
                                    <th>Event Daily Customers</th>
                                    <th>Event Weekly Customers</th>
                                    <th>Event Monthly Customers</th>
                                    <th>Event Yearly Customers</th>
                                </tr>
                            </thead>
                            <tbody>                    
                                <?php foreach ($models as $franchise_id => $model): ?>
                                    <?php
                                    $detail = arrIndex($model, 'detail');
                                    $targets = arrIndex($model, 'data');
                                    echo "<tr>";
                                    echo "<td>" . ucfirst(arrIndex($detail, 'name')) . "</td>";
                                    foreach ($targets as $event_id => $target):
                                        foreach ($target as $target_id => $Starget):
                                            ?>
                                        <td><input name="<?php echo $franchise_id . '-' . $event_id . '-' . $target_id . '-no_of_customer' ?>" type="text" value="<?php echo arrIndex($Starget, 'no_of_customer', '') ?>" class="form-control" style="width:60px"/></td>
                                        <?php
                                    endforeach;
                                endforeach;
                                echo "<tr>";
                                ?>
                            <?php endforeach; ?>
                            </tbody>
                        </table>

                        <input class="btn btn-primary" type="submit" value="Save">                    
                    </form>
                    <div class="clearfix"></div>
                </div>

            </div>
        </div>
    </div>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $('.counter').counterUp({
                delay: 10,
                time: 1000
            });
        });
    </script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
    <script type="text/javascript" src="js/jquery.counterup.min.js"></script>
</div>
<?php
//$this->load->view('user/headers/user_index', array('base_url' => base_url()));
?>
<script>
            $(document).ready(function () {
                $('select[name="targetTypes"]').on('change', function () {
                    window.location = '<?php echo createUrl('reports/franchisesTarget/') ?>' + this.value;
                });
            });
</script>

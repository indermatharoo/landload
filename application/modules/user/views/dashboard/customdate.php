<div class="row content-bg">
    <div class="dashboard_message content-bg" style="min-width:200px;left: 207.5px; position: absolute; top: 152px; z-index: 9999; opacity: 1; display: none; padding: 10px;">
        <div class="cls" style="text-align: right; cursor: pointer">X</div>
        <div class="content" style="padding: 0; text-align: center; text-transform: capitalize"></div>
    </div>
    <div id="left-column" class="col-lg-7">
        <div class="row content-bg col-lg-8">    
            <div class="col-lg-12">
                <h4>Select Date Range</h4>
            </div>
            <form method="post" action="">
                <div class="col-lg-12">
                    <input class="form-control col-lg-12" type="text" name="customdate" placeholder="Select Date Range">
                </div>            
                <div class="col-lg-12">
                    <input type="submit" name="customdatesubmit" class="btn btn-primary" onclick="return checkLogin(this)"/>                    
                </div>
            </form>
        </div>
    </div>
    <?php if ($loadContent): ?>
    <div id="left-column" class="col-lg-7 pad-left30 pad-top20">
        <script>
            $(function () {
                $('input[name="customdate"]').daterangepicker({
                    timePicker: true,
                    format: 'DD-MM-YYYY h:mm',
                    timePickerIncrement: 5,
                    timePicker12Hour: false,
                    timePickerSeconds: false
                });
            });
            function checkLogin(elm) {
                val = $('input[name="customdate"]').val();
                if (!val) {
                    return false;
                }
            }
        </script>

        <div class="table_cont">
            <div class="top-table">
                <table class="tab" cellpadding="10" cellspacing="0">
                    <tr class="th">
                        <th width="30%">Summary</th><th range="4-6">April - June</th><th range="7-9">Jul - Sep</th><th range="10-12">Oct - Dec</th><th range="1-3">Jan - March</th><th>Total</th>
                    </tr>
                    <tr>
                        <td class="leftaligned" type="CLASS_CUSTOMER">Total Class Customers</td>
                        <?php
                        $total = 0;
                        foreach ($dasbBoardData[Event::$types['CLASS']] as $array):
                            $total += (arrIndex($array, 'customers')) ? $array['customers'] : 0;
                            ?>
                            <td><?php echo (arrIndex($array, 'customers')) ? $array['customers'] : 0 ?></td>
                        <?php endforeach; ?>
                        <td><?php echo round($total, 2) ?></td>
                    </tr>
                    <tr>
                        <td class="leftaligned" type="CLASS_COUNT">Total Classes</td>
                        <?php
                        $total = 0;
                        foreach ($dasbBoardData[Event::$types['CLASS']] as $array):
                            $total += (arrIndex($array, 'count')) ? $array['count'] : 0;
                            ?>
                            <td><?php echo (arrIndex($array, 'count')) ? $array['count'] : 0 ?></td>
                        <?php endforeach; ?>
                        <td><?php echo round($total, 2) ?></td>
                    </tr>
                    <tr>
                        <td class="leftaligned" type="PARTY_CUSTOMER">Total Party Customers</td>
                        <?php
                        $total = 0;
                        foreach ($dasbBoardData[Event::$types['PARTY']] as $array):
                            $total += (arrIndex($array, 'customers')) ? $array['customers'] : 0;
                            ?>
                            <td><?php echo (arrIndex($array, 'customers')) ? $array['customers'] : 0 ?></td>
                        <?php endforeach; ?>
                        <td><?php echo round($total, 2) ?></td>
                    </tr>
                    <tr>
                        <td class="leftaligned" type="PARTY_COUNT">Total Number Of Parties Run</td>
                        <?php
                        $total = 0;
                        foreach ($dasbBoardData[Event::$types['PARTY']] as $array):
                            $total += (arrIndex($array, 'count')) ? $array['count'] : 0;
                            ?>
                            <td><?php echo (arrIndex($array, 'count')) ? $array['count'] : 0 ?></td>
                        <?php endforeach; ?>
                        <td><?php echo round($total, 2) ?></td>
                    </tr>
                    <tr>
                        <td class="leftaligned" type="CLUB_COUNT">Total Club Numbers</td>
                        <?php
                        $total = 0;
                        foreach ($dasbBoardData[Event::$types['CLUB']] as $array):
                            $total += (arrIndex($array, 'count')) ? $array['count'] : 0;
                            ?>
                            <td><?php echo (arrIndex($array, 'count')) ? $array['count'] : 0 ?></td>
                        <?php endforeach; ?>
                        <td><?php echo round($total, 2) ?></td>
                    </tr>
                    <tr>
                        <td class="leftaligned" type="CLUB_CUSTOMER">Total Club Contracts</td>
                        <?php
                        $total = 0;
                        foreach ($dasbBoardData[Event::$types['CLUB']] as $array):
                            $total += (arrIndex($array, 'customers')) ? $array['customers'] : 0;
                            ?>
                            <td><?php echo (arrIndex($array, 'customers')) ? $array['customers'] : 0 ?></td>
                        <?php endforeach; ?>
                        <td><?php echo round($total, 2) ?></td>
                    </tr>
                    <tr>
                        <td class="leftaligned" type="EVENT_COUNT">Total Numbers Of Event Run</td>
                        <?php
                        $total = 0;
                        foreach ($dasbBoardData[Event::$types['EVENT']] as $array):
                            $total += (arrIndex($array, 'count')) ? $array['count'] : 0;
                            ?>
                            <td><?php echo (arrIndex($array, 'count')) ? $array['count'] : 0 ?></td>
                        <?php endforeach; ?>
                        <td><?php echo round($total, 2) ?></td>
                    </tr>
                </table>    
            </div>
            <div class="bott-table">
                <table class="tab1 tab" cellspacing="0" cellpadding="3">
                    <tr class="th">
                        <th width="30%">Income</th><th range="4-6">April - June</th><th range="7-9">Jul - Sep</th><th range="10-12">Oct - Dec</th><th range="1-3">Jan - March</th><th>Total</th>
                    </tr>
                    <tr>
                        <td class="leftaligned" type="CLASS__income">Classes</td>
                        <?php
                        $total = 0;
                        foreach ($dasbBoardData[Event::$types['CLASS']] as $array):
                            $total += (arrIndex($array, 'income')) ? $array['income'] : 0;
                            ?>
                            <td><span class="left">£</span><span class="<?php echo arrIndex($array, 'gid') ?>"><?php echo (arrIndex($array, 'income')) ? round($array['income'], 2) : 0 ?></span></td>
                        <?php endforeach; ?>
                        <td><span class="left">£</span><span class="total"><?php echo round($total, 2); ?></span></td>
                    </tr>
                    <tr>
                        <td class="leftaligned" type="PARTY__income">Parties</td>
                        <?php
                        $total = 0;
                        foreach ($dasbBoardData[Event::$types['PARTY']] as $array):
                            $total += (arrIndex($array, 'income')) ? $array['income'] : 0;
                            ?>
                            <td><span class="left">£</span><span class="<?php echo arrIndex($array, 'gid') ?>"><?php echo (arrIndex($array, 'income')) ? round($array['income'], 2) : 0 ?></span></td>
                        <?php endforeach; ?>
                        <td><span class="left">£</span><span class="total"><?php echo round($total, 2); ?></span></td>
                    </tr>
                    <tr>
                        <td class="leftaligned" type="EVENT__income">Events</td>
                        <?php
                        $total = 0;
                        foreach ($dasbBoardData[Event::$types['EVENT']] as $array):
                            $total += (arrIndex($array, 'income')) ? $array['income'] : 0;
                            ?>
                            <td><span class="left">£</span><span class="<?php echo arrIndex($array, 'gid') ?>"><?php echo (arrIndex($array, 'income')) ? round($array['income'], 2) : 0 ?></span></td>
                        <?php endforeach; ?>
                        <td><span class="left">£</span><span class="total"><?php echo round($total, 2); ?></span></td>
                    </tr>
                    <tr>
                        <td class="leftaligned" type="CLUB__income">Clubs</td>
                        <?php
                        $total = 0;
                        foreach ($dasbBoardData[Event::$types['CLUB']] as $array):
                            $total += (arrIndex($array, 'income')) ? $array['income'] : 0;
                            ?>
                            <td><span class="left">£</span><span retail_buyed="<?php echo arrIndex($array, 'retail_buyed', 0) ?>" retail_sailed="<?php echo arrIndex($array, 'retail_sailed', 0) ?>" class="<?php echo arrIndex($array, 'gid') ?>"><?php echo arrIndex($array, 'income', 0) ?></span></td>
                        <?php endforeach; ?>
                        <td><span class="left">£</span><span class="total"><?php echo round($total, 2); ?></span></td>
                    </tr>
                    <tr>
                        <td  class="leftaligned">Clubs Contracts</td><td><span class="left">£</span>-</td><td><span class="left">£</span>-</td><td><span class="left">£</span>-</td><td><span class="left">£</span>-</td><td><span class="left">£</span>-</td>
                    </tr>
                    <tr>
                        <td class="leftaligned" type="RETAILS__retail_buyed">Retails</td>
                        <?php
                        $total = 0;
                        $retail_buyed = $retail_sailed = 0;
                        foreach ($dasbBoardData['retail'] as $key => $array):
                            $total += arrIndex($array, 'retail_buyed', 0);
                            ?>
                            <td><span class="left">£</span><span class="<?php echo $key ?>"><?php echo arrIndex($array, 'retail_buyed', 0) ?></span></td>
                        <?php endforeach; ?>
                        <td><span class="left">£</span><span class="total"><?php echo round($total, 2); ?></span></td>
                    </tr>
                    <tr>
                        <td  class="leftaligned">Total Income</td><td><span class="left">£</span><span id="totalg1"></span></td><td><span class="left">£</span><span id="totalg2"></span></td><td><span class="left">£</span><span id="totalg3"></span></td><td><span class="left">£</span><span id="totalg4"></span></td><td><span class="left">£</span><span id="totalg5"></span></td>
                    </tr>
                </table>    
            </div>
        </div>
        <?php
        $G1 = arrIndex($magentoDashboardData, 'G1');
        $G2 = arrIndex($magentoDashboardData, 'G2');
        $G3 = arrIndex($magentoDashboardData, 'G3');
        $G4 = arrIndex($magentoDashboardData, 'G4');
        ?>
        <table cellspacing="0" cellpadding="3" class="tab1 tab">
            <tbody>
                <tr style="background: #feed00 none repeat">
                    <th width="30%">Magento Retail</th><th>April - June</th><th>Jul - Sep</th><th>Oct - Dec</th><th>Jan - March</th><th>Total</th>
                </tr>
                <tr>
                    <td class="leftaligned" >Amount</td>
                    <td><span class="left">£</span><span><?php echo round(arrIndex($G1, 'total'), 2) ?></span></td>
                    <td><span class="left">£</span><span><?php echo round(arrIndex($G2, 'total'), 2) ?></span></td>
                    <td><span class="left">£</span><span><?php echo round(arrIndex($G3, 'total'), 2) ?></span></td>
                    <td><span class="left">£</span><span><?php echo round(arrIndex($G4, 'total'), 2) ?></span></td>
                    <td><span class="left">£</span><span><?php echo round(arrIndex($G1, 'total') + arrIndex($G2, 'total') + arrIndex($G3, 'total') + arrIndex($G4, 'total'), 2) ?></span></td>
                </tr>
            </tbody>
        </table>
        <div id="franchise_performance" style=" border: 1px solid #aaa; border-radius: 5px;">
            <?php $this->load->view("dashboard/chart"); ?>
        </div>
        <div id="franchisesregions"> </div>
    </div>
    <?php endif; ?>
    <div id="right-column" class="col-lg-5 pad-top20">
        <div class="col-lg-12 menu padding-0">
            <?php $this->load->view(THEME . 'layout/inc-menu'); ?>
        </div>
        <div class="col-lg-12 graphs pad-left5 pad-right5">
            <div class="widget">
                <div class="widget-header"> <i class="icon-signal"></i>
                    <h3 id="chart_heading">Income Chart</h3>
                </div>
                <div class="widget-content">
                    <canvas id="area-chart" class="chart-holder" height="250" width="450"> </canvas>
                </div>
            </div>
        </div>
        <?php $this->load->view(THEME . 'layout/inc-notifications'); ?>
        <?php $this->load->view(THEME . 'layout/in-social-links'); ?>        
    </div>
</div>
<?php $this->load->view('headers/dashboard'); ?>
>>>>>>> f7a1556c531ab0d382242f5fb240b95e9fb72541

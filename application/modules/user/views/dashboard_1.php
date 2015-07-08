<div class="row content-bg">
    <div class="dashboard_message content-bg" style="min-width:200px;left: 207.5px; position: absolute; top: 152px; z-index: 9999; opacity: 1; display: none; padding: 10px;">
        <div class="cls" style="text-align: right; cursor: pointer">X</div>
        <div class="content" style="padding: 0; text-align: center; text-transform: capitalize"></div>
    </div>
    <div id="left-column" class="col-lg-7">
        <div class="table_cont">
            <div class="top-table">
                <?php
//            e($dasbBoardData);
                ?>
                <select name="year_range" class="year_range form-control mar-bot10">
                    <option>Select</option>
                    <option value="2014-2015">2014-2015</option>
                    <option value="2015-2016">2015-2016</option>
                </select>
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
                        <td type="CLASS_INCOME">Classes</td>
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
                        <td type="PARTY_INCOME">Parties</td>
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
                        <td type="EVENT_INCOME">Events</td>
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
                        <td type="CLUB_INCOME">Clubs</td>
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
                        <td type="RETAILS_RETAILS">Retails</td>
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
        </div>

    </div>
    <div id="right-column" class="col-lg-5">
        <div class="col-lg-12 menu padding-0">
            <?php $this->load->view(THEME . 'layout/inc-menu'); ?>
        </div>

        <div class="col-lg-12 graphs padding-0">
            <div class="widget">
                <div class="widget-header"> <i class="icon-signal"></i>
                    <h3>Income Chart</h3>
                </div>
                <div class="widget-content">
                    <canvas id="area-chart" class="chart-holder" height="250" width="450"> </canvas>
                </div>
            </div>
        </div>
        <?php $this->load->view(THEME . 'layout/inc-notifications'); ?>
        <div class="col-lg-12 social-part">
            <div class="row">
                <div class="col-lg-6">
                    <div class="social-top">
                        <img src="images/fb.jpg" alt="facebook" />
                    </div>
                    <div class="social">
                        <div class="social-content">

                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="social-top">
                        <img src="images/tw.jpg" alt="twitter" />
                    </div>
                    <div class="social">
                        <div class="social-content">

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="social-top">
                        <img src="images/gp.jpg" alt="google+" />
                    </div>
                    <div class="social">
                        <div class="social-content">

                        </div>
                    </div>
                </div>
                <div class=" col-lg-6">
                    <div class="social-top">
                        <img src="images/li.jpg" alt="linkedin" />
                    </div>
                    <div class="social">
                        <div class="social-content">

                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<?php $this->load->view('headers/dashboard'); ?>

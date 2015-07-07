<link href="<?php echo base_url() ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
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
        margin: 51px 26px;
        vertical-align: middle;
        width: 100px;
    }
    .circle-inner h2, h4 {
        margin: 0;
        padding: 0;
        color: #fff;
        text-align: center;
    }
</style>

<div class="">
    <div class="box-header ui-sortable-handle">
        <i class="fa fa-calendar-o"></i>
        <h3 class="box-title"><a href="invoice/monthly">Reports (Monthly)</a></h3>
        <?php $this->load->view(THEME . 'messages/inc-messages'); ?>
    </div>
    <div class="table-responsive">
        <table id="pagination-table" class="table table-bordered table-striped">
            
            <tbody>
                <tr>    
                    <td>
                        <?php
                        
                        function percent($num_amount, $num_total) {
                        $count1 = $num_amount / $num_total;
                        $count2 = $count1 * 100;
                        $count = number_format($count2, 0);
                        return $count;
                        }
                        $total_records = $total;
//                        $week = arrIndex($row, 'W');
//                        $monthly = arrIndex($row, 'M');
//                        $quarterly = arrIndex($row, 'Q');
//                        $halfyearly = arrIndex($row, 'HF');
                       if (!empty($total_rows_weekly) || $total_rows_weekly != '0') {
                            $weekly_percent = percent($total_rows_weekly, $total_records);
                        } else {
                            $weekly_percent = "0";
                        }
                        if (!empty($total_rows_monthly) || $total_rows_monthly != '0') {
                            $monthly_percent = percent($total_rows_monthly, $total_records);
                        } else {
                            $monthly_percent = "0";
                        }
                        ?>
                        <a href="invoice/index">
                            <div class="circle">
                                <div class="circle-inner">
                                    <h2><span class="counter"><?=$weekly_percent?></span>%</h2>
                                    <h4>Weekly</h4>
                                </div>
                            </div>
                        </a>
                    </td>
                    <td>
                        <a href="invoice/monthly">
                            <div class="circle">
                                <div class="circle-inner">
                                    <h2><span class="counter"><?=$monthly_percent?></span>%</h2>
                                    <h4>Monthly</h4>
                                </div>

                            </div>
                        </a>
                    </td>
                   <!--- <td>
                        <a href="invoice/quaterly">
                            <div class="circle">
                                <div class="circle-inner">
                                    <h2><span class="counter"><?=$quarterly_percent?></span>%</h2>
                                    <h4>Quarterly</h4>
                                </div>
                            </div>
                        </a>
                    </td>
                    <td>
                        <a href="invoice/halfyearly">
                            <div class="circle">
                                <div class="circle-inner">
                                    <h2><span class="counter"><?=$halfyearly_percent?></span>%</h2>
                                    <h4>Half Yearly</h4>
                                </div>
                            </div>
                        </a>
                    </td>--->

                </tr>

            </tbody>
            
        </table>
        
        <br /><br />
        
        <table id="pagination-table" class="table table-bordered table-striped">
            <thead>
                <tr>                        
                    <?php  ?>
                      <th>Sr.No</th>
                      <th>Month</th>
                      <th>Total Amount</th>
                      
                      <th>Paid Amount</th>
                      <th>Unpaid Amount</th>
                      <th>Balance</th>
                      <th>Action</th>
                      
                </tr>
            </thead>
            <tbody>
            
<?php  $i = 1; 
//e($monthly_data);
if(!empty($monthly_data)){
foreach ($monthly_data as $ev) { ?>
  <tr>
  <td><?=$i;?></td>
  <td><?php echo  date("F", mktime(0, 0, 0, $ev["month"], 10)); ?>/ <?php echo $ev["year"]; ?></td>
  <td>&pound;<?=$ev["final_price"]?></td>
  <td>&pound;<?= $ev['paid_amount']; ?></td>
  <td>&pound;<?= $ev['paid_amount']; ?></td>
  <td>&pound;<?php echo $ev["final_price"]-$ev['paid_amount']; ?>.00</td>
  <td><a href="invoice/monthly/detail">View Detail</a></td>
  
  </tr>
<?php $i++; }}
else{
    ?>
  <tr>
      <td colspan="7" algin="center"><h4 style="color:#000;">No Invoice found</h4></td>
  </tr>
  <?php
}
?>
            </tbody>
            <tfoot>
                <tr>                        
                        <th>Sr.No</th>
                        <th>Month</th>
                      <th>Total Amount</th>
                      <th>Paid Amount</th>
                      <th>Unpaid Amount</th>
                      <th>Balance</th>
                      <th>Action</th>
                </tr>
            </tfoot>
        </table>
        
        
        <div class="clearfix"></div>
        <div><?php //echo $pagination;   ?></div>
    </div>
</div>
<?php //$this->load->view('header/event_index');  ?>
<?php //$this->load->view('header/common-pagination', array('base_url' => base_url()));  ?>
<script type="text/javascript">
      jQuery(document).ready(function ($) {
                    $('.counter').counterUp({
                        delay: 10,
                        time: 1000
                    });
                });
    </script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
<script src="js/jquery.counterup.min.js" type="text/javascript"></script>
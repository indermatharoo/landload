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
<header class="panel-heading">
    <div class="row">
        <div class="col-sm-1">
            <a href="invoice/index" style=" color: #fff;"><i class="fa fa-home fa-2x"></i></a>
        </div>
        <div class="col-sm-10">
            <h3 style="margin: 0; text-align: center;">Reports Detail</h3>
        </div>
    </div>
</header>
<div class="">
    <div class="box-header ui-sortable-handle">
        <?php $this->load->view(THEME . 'messages/inc-messages'); ?>
    </div>
    <div class="table-responsive">
        <table id="table" class="table table-bordered table-striped">
            <thead>
                <tr>                        
                    <?php ?>
                    <th>Sr.No</th>
                    <th>Invoice No.</th>
                    <th>Total Amount</th>
                    <th>VAT</th>
                    <th>Created Date</th>
                    <th>Status</th>

                </tr>
            </thead>
            <tbody>

                <?php
                $i = 1;

                if (!empty($data)) {
                    foreach ($data as $ev) {
                        ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><a href="invoice/invoicedetail/<?= $ev["invoice_id"] ?>"><?= $ev["invoice_code"] ?></a></td>
                            <td>&pound;<?= $ev['total_amount']; ?></td>
                            <td><?= $ev['vat']; ?>%</td>
                            <td><?php echo date("d/m/Y", strtotime($ev['created_on'])); ?></td>
                            <td><?php
                                if ($ev['is_paid'] == 1) {
                                    echo "Paid";
                                } else {
                                    echo "UnPaid";
                                }
                                ?></td>

                        </tr>
                        <?php
                        $i++;
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="6" algin="center"><h4 style="color:#000;">No Invoice found</h4></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
            <tfoot>
                <tr>                        
<?php ?>
                    <th>Sr.No</th>
                    <th>Invoice No.</th>
                    <th>Total Amount</th>
                    <th>VAT</th>
                    <th>Created Date</th>
                    <th>Status</th>

                </tr>
            </tfoot>
        </table>


        <div class="clearfix"></div>
        <div><?php //echo $pagination;     ?></div>
    </div>
</div>
<?php $this->load->view('user/headers/user_index', array('base_url' => base_url())); ?>
<?php //$this->load->view('header/event_index');    ?>
<?php //$this->load->view('header/common-pagination', array('base_url' => base_url()));    ?>
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

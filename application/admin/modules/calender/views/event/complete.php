<?php $this->load->view('header/event_add'); ?>
<div class="col-lg-12">
    <div class="addevent">
        <?php $this->load->view(THEME . 'messages/inc-messages'); ?>
        <header class="panel-heading">
            <h3 style="margin: 0">Event Type : <?= arrIndex($event, 'event_type') ?></h3>
        </header>
        <div class="">
            <form class="form" method="post" action="" id="event-complete">
                <table class="table bott-table" width="100%" cellspacing="10" >
                    <caption class="tabl-hea">INCOME</caption>
                    <thead>
                        <tr>
                            <th class="th">Customers <?= arrIndex($event, 'event_type') ?></th>
                            <th class="th">No of Customer</th>
                            <th class="th">Total Income(£)</th>
                            <th class="th">Comments</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><b>Total</b></td>
                            <td><input type="text" class="form-control num-int" name="total_customer"  value="<?php echo arrIndex($eventcomplete, 'total_customer') ?>"/></td>
                            <td><input type="text" class="form-control num-float" name="total_income"  value="<?php echo arrIndex($eventcomplete, 'total_income') ?>"/></td>
                            <td><input type="text" class="form-control" name="total_comment"  value="<?php echo arrIndex($eventcomplete, 'total_comment') ?>"/></td>
                        </tr>
                        <tr>
                            <td><b>Retail</b></td>
                            <td><input type="text" class="form-control num-float" name="retail_buyed" placeholder="Purchased"  value="<?php echo arrIndex($eventcomplete, 'retail_buyed') ?>"/></td>
                            <td><input type="text" class="form-control num-float" name="retail_sailed" placeholder="Sold" value="<?php echo arrIndex($eventcomplete, 'retail_sailed') ?>"/></td>
                            <td><input type="text" class="form-control" name="retail_comment" value="<?php echo arrIndex($eventcomplete, 'retail_comment') ?>"/></td>
                        </tr>                                    
                        <tr>
                            <td><b>No of Customer Purchased</b></td>
                            <td><input type="text" class="form-control num-float" name="no_cus_purchased" placeholder=""  value="<?php echo arrIndex($eventcomplete, 'no_cus_purchased') ?>"/></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>                            
                <br/>
                <table class="table bott-table" width="100%" cellspacing="10">
                    <caption class="tabl-hea">EXPENDITURES</caption>
                    <thead>
                        <tr>
                            <th class="th">Cost Spend On</th>
                            <th class="th">Price(£)</th>
                            <th class="th">Comment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><b>Venues</b></td>
                            <td><input type="text" class="form-control num-float" name="venue" value="<?php echo arrIndex($eventcomplete, 'venue') ?>"/></td>
                            <td><input type="text" class="form-control" name="venue_comment" value="<?php echo arrIndex($eventcomplete, 'venue_comment') ?>"/></td>
                        </tr>
                        <tr>
                            <td><b>Stock / Material</b></td>
                            <td><input type="text" class="form-control num-float" name="stock" value="<?php echo arrIndex($eventcomplete, 'stock') ?>"/></td>
                            <td><input type="text" class="form-control" name="stock_comment" value="<?php echo arrIndex($eventcomplete, 'stock_comment') ?>"/></td>
                        </tr> 
                        <tr>
                            <td><b>Advertising</b></td>
                            <td><input type="text" class="form-control num-float" name="advertising" value="<?php echo arrIndex($eventcomplete, 'advertising') ?>"/></td>
                            <td><input type="text" class="form-control" name="advertising_comment" value="<?php echo arrIndex($eventcomplete, 'advertising_comment') ?>"/></td>
                        </tr> 
                        <tr>
                            <td><b>Staff</b></td>
                            <td><input type="text" class="form-control num-float" name="staff" value="<?php echo arrIndex($eventcomplete, 'staff') ?>"/></td>
                            <td><input type="text" class="form-control" name="staff_comment" value="<?php echo arrIndex($eventcomplete, 'staff_comment') ?>"/></td>
                        </tr> 
                        <tr>
                            <td><b>Insurance</b></td>
                            <td><input type="text" class="form-control num-float" name="insurance" value="<?php echo arrIndex($eventcomplete, 'insurance') ?>"/></td>
                            <td><input type="text" class="form-control" name="insurance_comment" value="<?php echo arrIndex($eventcomplete, 'insurance_comment') ?>"/></td>
                        </tr>
                        <tr>
                            <td><b>Support Fee</b></td>
                            <td><input type="text" class="form-control num-float" name="support" value="<?php echo arrIndex($eventcomplete, 'support') ?>"/></td>
                            <td><input type="text" class="form-control" name="support_comment" value="<?php echo arrIndex($eventcomplete, 'support_comment') ?>"/></td>
                        </tr>
                        <tr>
                            <td><b>Other</b></td>
                            <td><input type="text" class="form-control num-float" name="other" value="<?php echo arrIndex($eventcomplete, 'other') ?>"/></td>
                            <td><input type="text" class="form-control" name="other_comment" value="<?php echo arrIndex($eventcomplete, 'other_comment') ?>"/></td>
                        </tr>
                    </tbody>
                </table>
                <input type="hidden" name="event_id" value="<?= arrIndex($event, 'event_id') ?>">
                <div class="clearfix mar-top10">
                    <button class="save btn btn-primary pull-right" onclick="return false;">Save</button>
                </div> 
            </form>
        </div>
    </div>
</div>
<?php
$this->load->view('header/event_complete');
?>

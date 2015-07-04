<h1 style="color: #006C86">Edit Orders</h1>

<div class="corner4" id="ctx_menu">
    <a href="product">Place Orders</a> | <a href="customer/order">My Orders</a> | <a href="customer/dashboard/invoice">Invoices</a> | <a href="customer/dashboard/message">Messages</a> | <a href="">Loyalty points</a>   | <a href="customer/logout">Logout</a>
</div>
<div class="col-lg-6 top-20">

    <form action="/customer/order/reorder" name="" method="post">
        <table width="100%" cellpadding="3" cellspacing="0" border="0" class="o-detail table-responsive">
            <tr>
                <th width="20%">
                    Reference No.
                </th>
                <td><input type="text" name="product_id" class="" value="<?php echo $order['id']; ?>" readonly="readonly"/></td>
            </tr>
            <tr>
                <th>
                    Items
                </th>
                <td><input type="text" name="" class="" value=""/></td>
            </tr>
            <tr>
                <th>
                    Quantity
                </th>
                <td><input type="text" name="product_qty" class="" value="<?php echo $order['qty']; ?>"/></td>
            </tr>
            <tr>
                <th width="20%">
                    Date
                </th>
                <td>

                    <input type="text" name="product_date" id="date" class="input-group orderdate" value="<?php echo date('d/m/Y', $order['date']); ?>"/>

                </td>
            </tr>
            <tr>
                <th width="20%">
                    Time
                </th>
                <td>
                    <select name="product_time">
                        <?php
                        $_booked = test();
                        $order_time = getCutsomerTime();
                        $order_time = $order_time ? $order_time : "12:30";
                        $firstTimeCheck = true;
                        $backCheck = false;
                        $oorder_time = $order_time;
                        if (in_array($order_time, (array) $_booked)) {
                            while (in_array($order_time, $_booked)) {
                                list($order_time, $firstTimeCheck, $backCheck) = getNextTimeSlot($order_time, $firstTimeCheck, $backCheck, $oorder_time);
                            }
                        }
                        unset($minutes);
                        for ($ii = 7; $ii <= 19; $ii++) {
                            for ($xx = 0; $xx < 12; $xx++) {
                                $minutes = $minutes ? ($minutes == 60 ? "00" : $minutes) : "30";
                                if (in_array("$ii:" . str_pad($minutes, 2, "0", STR_PAD_LEFT), $_booked)) {
                                    echo "<optgroup style=\"padding: 0px; margin: 0px; font-style: normal; color: #AAA\" label=\"- FULL -\"></optgroup>\n";
                                } else {
                                    echo "<option value=\"$ii:" . str_pad($minutes, 2, "0", STR_PAD_LEFT) . "\"" . ($order['time'] == "$ii:$minutes" || $order['time'] == "$ii:" . str_pad($minutes, 2, "0", STR_PAD_LEFT) ? " selected" : "") . ">" . str_pad($ii, 2, "0", STR_PAD_LEFT) . ":" . str_pad($minutes, 2, "0", STR_PAD_LEFT) . "</option>\n";
                                }
                                $minutes += 5;
                                $xx = $minutes == 60 ? 12 : $xx;
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <?php if (!empty($order['specials'])) { ?>
                <tr>
                    <th width="20%">
                        Special Instructions
                    </th>
                    <td><textarea name="spcl_req"><?php echo $order['specials']; ?></textarea></td>
                </tr>
            <?php } ?>
            <tr>
                <td><input type="submit" name="product_sbm" class="order_edit_btn" value="submit"/></td>
            </tr>
        </table>    
    </form>
</div>

<div id="element_to_pop_up">
    <div class="pop_msg">
        sorry, you have past the cut off time to order on this date, please select an alternative date
    </div>
    <span class="button b-close">Ok</span>
</div>
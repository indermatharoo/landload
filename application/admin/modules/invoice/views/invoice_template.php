<?php

function vat($price_without_vat = NULL) {

    $vat = 20; // define what % vat is

    $price_with_vat = ($vat * ($price_without_vat / 100)); // work out the amount of vat

    $price_with_vat = round($price_with_vat, 2); // round to 2 decimal places

    return $price_with_vat;
}
?>
<div id="dvContainer">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td>
                <table width="729" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center" style="padding:10px;">
                    <tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-bottom: 1px solid rgb(206, 206, 206); padding-bottom: 10px;">
                                <tr>
                                    <td width="200"><a href= "#" target="_blank"><img src="<?php echo base_url() ?>images/logo.png" border="0" alt=""/></a></td>
                                    <td width="250">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td height="46" align="right" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td width="67%" align="right">
                                                                <font style="font-family:'Myriad Pro', Helvetica, Arial, sans-serif; color:#0087d4; font-size:21.5px; text-transform:uppercase;">
                                                                <strong>Landlord Masters </strong>
                                                                </font>
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td width="67%" align="right">
                                                                <font style="font-family: 'Arial' , sans-serif; color:#68696a; font-size:11.5px;font-weight: 100;">
                                                                <span>Dudley House</span><br/>
                                                                <span>3rd Floor</span><br/>
                                                                <span>Stone Street</span><br/>
                                                                <span>Dudley (DY1 1NP )</span><br/><br/>
                                                                <span style="font-weight:600; color:#000;">Telephone: 01384 239100</span><br/>
                                                                <span style="font-weight:600;color:#000;">enquiries@example.co.uk</span><br/>
                                                                </font>
                                                            </td>

                                                        </tr>

                                                    </table></td>
                                            </tr>

                                        </table></td>
                                </tr>
                            </table></td>
                    </tr>

                    <tr>
                        <td align="center" valign="middle">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin: 20px 0">

                                <tr>
                                    <td width="25%" align="left" style="line-height: 22px">
                                        <font style="font-family:'Myriad Pro', Helvetica, Arial, sans-serif; color:#68696a; font-size:13px; text-transform:uppercase;">
                                        <span style="font-size:19px;font-weight: bold;color: #414141;">Invoice To</span>
                                        </font>
                                    </td>
                                    <td width="25%" align="right" style="line-height: 22px" >
                                        <font style="font-family:'Myriad Pro', Helvetica, Arial, sans-serif; color:#68696a; font-size:13px; text-transform:uppercase;">
                                        <span style="font-size:19px;font-weight: 900;color: #000;">&nbsp;</span>
                                        </font>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="25%" align="left" style="line-height: 22px">
                                        <font style="font-family:'Myriad Pro', Helvetica, Arial, sans-serif; color:#68696a; font-size:13px; text-transform:uppercase;">
                                        <span><?php echo $invoice_detail["fname"] . " " . $invoice_detail["lname"]; ?> </span>
                                        </font>
                                    </td>
                                    <td width="25%" align="right" style="line-height: 22px" >
                                        <font style="font-family:'Myriad Pro', Helvetica, Arial, sans-serif; color:red; font-size:15px; text-transform:uppercase;font-weight: 900;">
                                        <strong style="color:#414141;">Invoice No: </strong>
                                        <span><?php echo $invoice_detail["invoice_code"]; ?> </span>
                                        </font>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="25%" align="left" style="line-height: 22px">
                                        <font style="font-family:'Myriad Pro', Helvetica, Arial, sans-serif; color:#68696a; font-size:13px; text-transform:uppercase;">

                                        <span><?php echo $invoice_detail["address"]; ?></span>
                                        </font>
                                    </td>
                                    <td width="25%" align="right" style="line-height: 22px">
                                        <font style="font-family:'Myriad Pro', Helvetica, Arial, sans-serif; color:#68696a; font-size:13px; text-transform:uppercase;">
                                        <strong>Payable Date: </strong>
                                        <span> <?php echo date("d/m/Y", strtotime($invoice_detail["created_on"])); ?>   </span>
                                        </font>
                                    </td>
                                </tr>


                                <tr>
                                    <<td width="25%" align="left" style="line-height: 22px">
                                        <font style="font-family:'Myriad Pro', Helvetica, Arial, sans-serif; color:#68696a; font-size:13px; text-transform:uppercase;">

                                        <span><?php //echo $invoice_detail["bussiness_address"];     ?></span>
                                        </font>
                                    </td>
                                    <td width="25%" align="right" style="line-height: 22px">
                                        <font style="font-family:'Myriad Pro', Helvetica, Arial, sans-serif; color:#68696a; font-size:13px; text-transform:uppercase;">
                                        <strong>Due Date: </strong>
                                        <span> <?php echo date("d/m/Y", strtotime($invoice_detail["due_on"])); ?> </span>
                                        </font>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="25%" align="left" style="line-height: 22px">
                                        <font style="font-family:'Myriad Pro', Helvetica, Arial, sans-serif; color:#68696a; font-size:13px; text-transform:uppercase;">

                                        <span><?php //echo $invoice_detail["territory_name"];     ?></span>
                                        </font>
                                    </td>
                                    <td width="25%" align="right" style="line-height: 22px">

                                    </td>
                                </tr>





                            </table>
                        </td>    
                    </tr>

                    <tr>
                        <td align="center" valign="middle">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="billing-detail">
                                <tr style="font-family:'Myriad Pro', Helvetica, Arial, sans-serif; color:#68696a; font-size:16px; border-bottom: 1px solid #d7d8d9;border-left: 1px solid #d7d8d9;border-top: 1px solid #d7d8d9;height:40px;">
                                    <th width="10%" style="-moz-border-bottom-colors: none;-moz-border-left-colors: none;-moz-border-right-colors: none;-moz-border-top-colors: none;
                                        border-color: #000000 -moz-use-text-color -moz-use-text-color #000000;border-image: none;border-style: solid none none solid;
                                        border-width: 1px 0 0 1px;">
                                        Sr no.</th>
                                    <th width="75%" style="-moz-border-bottom-colors: none;-moz-border-left-colors: none;-moz-border-right-colors: none;-moz-border-top-colors: none;
                                        border-color: #000000 -moz-use-text-color -moz-use-text-color #000000;border-image: none;border-style: solid none none solid;
                                        border-width: 1px 0 0 1px;">
                                        Items</th>
                                    <th width="15%" style="  -moz-border-bottom-colors: none;-moz-border-left-colors: none;-moz-border-top-colors: none;
                                        border-color: #000000 #000000 -moz-use-text-color #000000;border-image: none;border-style: solid solid none;
                                        border-width: 1px 1px 0;">
                                        Price</th>



                                </tr>
                                <tr style="font-family:'Myriad Pro', Helvetica, Arial, sans-serif; color:#68696a; font-size:16px;text-align: center;height:70px;">



                                    <td width="" style="-moz-border-bottom-colors: none;
                                        -moz-border-left-colors: none;
                                        -moz-border-right-colors: none;
                                        -moz-border-top-colors: none;
                                        border-color: #000000 -moz-use-text-color #000000 #000000;
                                        border-image: none;
                                        border-style: solid none solid solid;
                                        border-width: 1px 0 1px 1px;">
                                        <span> 1. </span>

                                    </td>

                                    <td width="" style="-moz-border-bottom-colors: none;
                                        -moz-border-left-colors: none;
                                        -moz-border-right-colors: none;
                                        -moz-border-top-colors: none;
                                        border-color: #000000 -moz-use-text-color #000000 #000000;
                                        border-image: none;
                                        border-style: solid none solid solid;
                                        border-width: 1px 0 1px 1px;"> Rent  </td>

                                    <td width="" style="
                                        border-color: #000000 -moz-use-text-color #000000 #000000;
                                        border-image: none;
                                        border-style: solid none solid solid;
                                        border-width: 1px 0 1px 1px;border-right:1px solid #000000;">  &pound;<?php echo $invoice_detail["installment_fees"]; ?>  </td>

                                </tr>

                            </table>
                        </td>
                    </tr>    

                    <tr>
                        <td align="center" valign="middle" >
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="">
                                <tr>
                                    <td align="center" valign="middle" style="padding-bottom: 50px;">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="5" style="margin-top: 0px; margin-bottom: 20px;">
                                            <tr style="font-family:'Myriad Pro', Helvetica, Arial, sans-serif; color:#68696a; font-size:16px;text-align: left; height:40px;">
                                                <td colspan="3"></td>
                                                <th width="20%" align="center"  style="color: #000; border:0;padding: 15px 0;">Subtotal: </th>
                                                <td width="15%" align="center"  style="border:1px solid #000000;border-top: 0;padding: 15px 0;">&pound;<?php echo $invoice_detail["installment_fees"]; ?> </td>
                                            </tr>

                                            <tr style="font-family:'Myriad Pro', Helvetica, Arial, sans-serif; color:#68696a; font-size:16px;text-align: left; height:40px;">
                                                <td colspan="3"></td>
                                                <th width="20%" align="center"  style="color: #000; border:0;padding: 15px 0;">VAT 20%: </th>
                                                <td width="15%" align="center"  style="border:1px solid #000000;border-top: 0;padding: 15px 0;">&pound;<?php echo vat($invoice_detail["installment_fees"]); ?>  </td>
                                            </tr>
                                            <tr style="font-family:'Myriad Pro', Helvetica, Arial, sans-serif; color:#68696a; font-size:16px;text-align: left; height:40px;">
                                                <td colspan="3"></td>
                                                <th width="20%" align="center"  style="background:#e3e3e3 none repeat scroll 0 0;color: #000;border:1px solid #333;border-right:0;">Total Due: </th>
                                                <td width="15%" align="center"  style="border:1px solid #000000; border-top:none;color: #000;font-weight: 900;">&pound;<?php echo $invoice_detail["total_amount"]; ?> </td>
                                            </tr>		

                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td align="center" valign="middle" style="padding-top: 50px;">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="10" style="border:1px solid #333;">
                                            <tr style="font-family:'Myriad Pro', Helvetica, Arial, sans-serif; color:#68696a; font-size:16px;text-align: left;">
                                                <td width="100%" align="left"  style="padding: 10px 0px 0px 10px;">
                                                    <span style="color:#444;font-size:13px;"> Our Terms and Condition Policy  </span></td>    
                                            </tr> 
                                            <tr style="font-family:'Myriad Pro', Helvetica, Arial, sans-serif; color:#68696a; font-size:16px;text-align: left;">
                                                <td width="100%" align="left"  style="">
                                                    <span style="color:#888;font-size:11px;">&#42; &nbsp; All Payments can be made to: Name Here and mailed to the address above</span><br/>
                                                    <span style="color:#888;font-size:11px;">&#42; &nbsp; Have questions, need another copy of the work, estimate, or invoice? </span><br/>
                                                    <span style="color:#888;font-size:11px;">&#42; &nbsp; Please contact me to address any concerns!</span><br/>
                                                </td>    
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td>&nbsp;</td>
                                </tr>

                            </table>

                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>




</div>

<input type="button" value="Print" id="btnPrint" class="btn btn-success"/>
<?php
echo arrIndex($invoice_detail, 'invoice_code');
$invoice_code = arrIndex($invoice_detail, 'invoice_code');
?>
<?php if ($this->aauth->isCustomer() && $invoice_code): ?>
    <button class="btn btn-success mar-left10" onclick="payInvoice()">Pay Online</button>
<?php endif; ?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
    function payInvoice() {
        var url = '<?php echo createUrl('invoice/pay/' . arrIndex($invoice_detail, 'invoice_code')) ?>';
        window.location = url;
    }
    $("#btnPrint").live("click", function () {
        var divContents = $("#dvContainer").html();
        var printWindow = window.open('', '', 'height=800,width=800');
        printWindow.document.write('<html><head><title>Invoice</title>');
        printWindow.document.write('</head><body >');
        printWindow.document.write(divContents);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    });


</script>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Invoice</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/custom_invoice_style.css'); ?>">
</head>
<body>

<table width="100%">
    <tbody>
    <tr>
       <td width="100%">
           <img src="<?php echo base_url('assets/images/invoice-header/sri-color-4.jpg'); ?>" height="150px" width="100%">
       </td>
    </tr>
    </tbody>
</table>
<hr>

<?php
if($invoice_master['inv_address'] == $invoice_master['inv_shipping_address'])
{
    ?>
    <table width="100%">
        <tbody>
        <tr>
            <td width="5%"></td>
            <td width="50%">
                <p class="address-title">PARTY ADDRESS :</p>
                <table width="100%" class="address-disp">
                    <tbody>
                    <?php
                    $cusfrtdet = array(
                        $customer['cus_address1'],
                        $customer['cus_address2'],
                        $customer['cus_place'],
                        $customer['cus_city']
                    );

                    $cussecdet = array(
                        $customer['cus_state'],
                        $customer['cus_country'],
                        $customer['pin_code']
                    );

                    $mobcusdet = array($customer['cus_phone'],$customer['cus_mobile1'],$customer['cus_mobile2']);

                    //print_r($det);
                    $cusfrstdec = implode(', ',array_filter($cusfrtdet));
                    $cussecdet = implode(', ',array_filter($cussecdet));
                    $cusphone = implode(', ',array_filter($mobcusdet));

                    if(!$customer['cus_name'] == '' && !$customer['cus_compnay_name'] == '')
                    {
                        $nameval = '<tr>
                                                                <td><div class="p">
                                                                <table width="100%">
                                                                    <tr>
                                                                        <td width="10%"><img src="'.base_url('assets/images/icons/persion.png').'" width="15px"></td>
                                                                        <td width="90%">'.$customer["cus_name"].'</td>
                                                                    </tr>
                                                                </table>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><div class="p">
                                                                        <table width="100%">
                                                                            <tr>
                                                                                <td width="10%"><img src="'.base_url('assets/images/icons/company.png').'" width="15px"></td>
                                                                                <td width="90%">'.$customer["cus_compnay_name"].'</td>
                                                                            </tr>
                                                                        </table>  
                                                                    </div>
                                                                </td>
                                                            </tr>';
                    }
                    elseif (!$customer['cus_name'] == '' && $customer['cus_compnay_name'] == '')
                    {
                        $nameval = '<tr>
                                                                <td><div class="p">
                                                                <table width="100%">
                                                                    <tr>
                                                                        <td width="10%"><img src="'.base_url('assets/images/icons/persion.png').'" width="15px"></td>
                                                                        <td width="90%">'.$customer["cus_name"].'</td>
                                                                    </tr>
                                                                </table>
                                                                    </div>
                                                                </td>
                                                            </tr>';
                    }
                    elseif ($customer['cus_name'] == '' && !$customer['cus_compnay_name'] == '')
                    {
                        $nameval = ' <tr>
                                                                <td><div class="p">
                                                                        <table width="100%">
                                                                            <tr>
                                                                                <td width="10%"><img src="'.base_url('assets/images/icons/company.png').'" width="15px"></td>
                                                                                <td width="90%">'.$customer["cus_compnay_name"].'</td>
                                                                            </tr>
                                                                        </table>  
                                                                    </div>
                                                                </td>
                                                            </tr>';
                    }
                    else
                    {
                        $nameval = '';
                    }
                    ?>
                    <?php echo $nameval; ?>
                    <tr>
                        <td><div class="p">
                                <table width="100%">
                                    <tr>
                                        <td width="10%"><img src="<?php echo base_url('assets/images/icons/home.png'); ?>" width="15px"></td>
                                        <td width="90%"><?php echo ($cusfrstdec); ?></td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="p">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php echo ($cussecdet); ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><div class="p">
                                <table width="100%">
                                    <tr>
                                        <td width="10%"><img src="<?php echo base_url('assets/images/icons/old_phone-512.png'); ?>" width="15px"></td>
                                        <td width="90%"><?php echo ($cusphone); ?></td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><div class="p">
                                <img src="<?php echo base_url('assets/images/icons/email-icon--clipart-best-22.png'); ?>" width="15px">&nbsp;
                                <?php echo ($customer['cus_email']); ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="50%"><div class="p">
                                <img src="<?php echo base_url('assets/images/icons/gst.png'); ?>" width="15px">&nbsp;
                                <?php echo 'GSTIN :'."\n".($customer['cus_gstin_no']); ?>
                            </div>
                        </td>
                        <td width="50%"><div class="p">
                                <?php echo 'STATE CODE :'."\n".($customer['cus_state_code']); ?>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
            <td width="45%">
                <table width="100%" class="invoice-disp">
                    <tbody>
                        <tr>
                            <td colspan="2" style="text-align: center; color: red; font-weight: bold"><div class="doctype"></div></td>
                        </tr>
                        <tr>
                            <td>Invoice No : </td>
                            <td class="inv-bold"><?php echo $invoice_master['inv_no']; ?></td>
                        </tr>
                        <tr>
                            <td>Invoice Date : </td>
                            <td class="inv-bold"><?php echo date('d-m-Y', strtotime($invoice_master['inv_date'])); ?></td>
                        </tr>
                        <tr>
                            <td>Order No : </td>
                            <td class="inv-bold"><?php echo $invoice_master['order_no']; ?></td>
                        </tr>
                        <tr>
                            <td>Transport Mode : </td>
                            <td class="inv-bold"><?php echo $invoice_master['transport_mode']; ?></td>
                        </tr>
                        <tr>
                            <td>Vehicle No : </td>
                            <td class="inv-bold"><?php echo $invoice_master['vehicle_no']; ?></td>
                        </tr>
                        <tr>
                            <td>Date of Supply : </td>
                            <td class="inv-bold"><?php if($invoice_master['date_of_supply']=='0000-00-00 00:00:00'){ echo '';}else{echo date('d-m-Y', strtotime($invoice_master['date_of_supply']));} ?></td>
                        </tr>
                        <tr>
                            <td>Place of Supply : </td>
                            <td class="inv-bold"><?php echo $invoice_master['place_of_supply']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
    <?php
}

?>
<hr>
<table class="prod_tab" width="100%">
    <thead>
    <tr>
        <th rowspan="2" width="3%">S.No</th>
        <th rowspan="2" width="30%">Description</th>
        <th rowspan="2">HSN</th>
        <th rowspan="2">Qty</th>
        <th rowspan="2">UOM</th>
        <th rowspan="2">Price</th>
        <th rowspan="2">Total</th>
        <?php if($invoice_master['igst'] == 0.00){ ?>
            <th colspan="2">CGST</th>
            <th colspan="2">SGST</th>
        <?php } else { ?>
            <th colspan="2">IGST</th>
        <?php } ?>
        <th rowspan="2">Amount</th>
    </tr>
    <tr>
        <?php if($invoice_master['igst'] == 0.00){ ?>
            <th>Rate</th>
            <th>Amount</th>
            <th>Rate</th>
            <th>Amount</th>
        <?php } else { ?>
            <th>Rate</th>
            <th>Amount</th>
        <?php } ?>
    </tr>
    </thead>
    <tbody class="border">
    <?php $sno=1; foreach ($invoice_detail as $v) { ?>

        <tr>
            <td><?php echo $sno++;?></td>
            <td>
                <?php
                    echo "<strong>".$v['prod_desc']."</strong>";
                ?>
            </td>
            <td><?php echo $v['hsn_code'];?></td>
            <td><?php echo $v['qty'];?></td>
            <td><?php echo $v['uom'];?></td>
            <td class="amount-display"><?php echo $v['price'];?></td>
            <td class="amount-display"><?php echo $v['total'];?></td>
            <?php if($invoice_master['igst'] == 0.00){ ?>
                <td class="amount-display"><?php echo $v['cgst_rate'];?>&nbsp;%</td>
                <td class="amount-display"><?php echo $v['cgst_amount'];?></td>
                <td class="amount-display"><?php echo $v['sgst_rate'];?>&nbsp;%</td>
                <td class="amount-display"><?php echo $v['sgst_amount'];?></td>
            <?php } else { ?>
                <td class="amount-display"><?php echo $v['igst_rate'];?>&nbsp;%</td>
                <td class="amount-display"><?php echo $v['igst_amount'];?></td>
            <?php } ?>
            <td class="amount-display"><?php
                $rowamt =  $v['taxable_value'] + $v['cgst_amount'] + $v['sgst_amount'] + $v['igst_amount'];
                echo sprintf("%01.2f", $rowamt);
                ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>


<div class="footer-tab">
    <table class="total-list">
        <tbody>
        <tr>
            <td class="terms-and-conditions" rowspan="7" width="35%">
                <h4><u>Terms and Conditions</u></h4>

                <p>1. Payment should be make by A/c Payee Cheque / Draft Only.</p>
                <p>2. Any Problems in recived Dyes Yarns should be intimated fous within 48 hrs. as in hank form. Otherwise deemed to be order.</p>
                <p>3. Subject to Namakkal jurisdction only.</p>
            </td>
            <td class="bank-details" rowspan="7" width="35%">
                <h4><u>BANK ACCOUNT DETAILS</u></h4>

                <p>Bank Name   : <b>CITY UNION BANK</b></p>
                <p>Account No  : <b>510909010072652</b></p>
                <p>Branch Name : <b>Brough Road, Erode</b></p>
                <p>IFSC Code   : <b>CIUB0000059</b></p>
            </td>
            <?php if($invoice_master['igst'] == 0.00){ ?>
		<tr class="amount-details">
             <td>Gross Amount</td>
            <td class="amount-display">
                <?php echo "&#x20b9;&nbsp;&nbsp;".$invoice_master['total']; ?>
            </td>
        </tr>
        <tr class="amount-details">
            <td>Total CGST</td>
            <td class="amount-display">
                <?php echo "&#x20b9;&nbsp;&nbsp;".$invoice_master['sgst']; ?>
            </td>
        </tr>
        <tr class="amount-details">
            <td>Total SGST</td>
            <td class="amount-display">
                <?php echo "&#x20b9;&nbsp;&nbsp;".$invoice_master['cgst']; ?>
            </td>
        </tr>
        <?php } else { ?>
            <tr class="amount-details">
                <td>Total IGST</td>
                <td class="amount-display">
                    <?php echo "&#x20b9;&nbsp;&nbsp;".$invoice_master['igst']; ?>
                </td>
            </tr>
        <?php } ?>
        <tr class="amount-details">
            <td>Total Amount</td>
            <td class="amount-display">
                <?php echo "&#x20b9;&nbsp;&nbsp;".$invoice_master['net_amount']; ?>
            </td>
        </tr>
        <tr class="amount-details">
            <td>Round Off </td>
            <td class="amount-display">
                <?php
                $v1 = $invoice_master['net_amount'];
                $v2 = round($v1);
                $v3 = $v2-$v1;
                echo "&#x20b9;&nbsp;&nbsp;".sprintf("%01.2f", $v3);
                ?>
            </td>
        </tr>
        <tr class="amount-details">
            <td>Net Amount</td>
            <td class="amount-display">
                <?php echo "&#x20b9;&nbsp;&nbsp;".sprintf("%01.2f", $v2); ?>
            </td>
        </tr>
        </tr>
        </tbody>
    </table>

    <table class="authsign">
        <tbody>
        <tr>
            <td width="70%" class="amountinwords">
                <p>Amount In Words : <strong><?php echo $invoice_master['amount_in_words']; ?></strong></p>
            </td>
            <td width="30%" class="auth-signatore">
                <b>FOR SRI COLOURS</b>
            </td>
        </tr>
        </tbody>
    </table>
</div>




</body>

<script src="<?php echo base_url('assets/jquery/dist/jquery.min.js'); ?>" type="text/javascript"></script>


<script>
    $(function(){
        setTimeout(function(){
            test1();
        }, 1000);

        setTimeout(function(){
            test2();
        }, 1000);

        setTimeout(function(){
            test3();
        }, 1000);

    });

    function test1() {
        $('.doctype').text('Original Copy');
        window.print();
    }

    function test2() {
        $('.doctype').text('Duplicate Copy');
        window.print();
    }

    function test3() {
        $('.doctype').text('Duplicate Copy');
        window.print();
    }

</script>
</html>


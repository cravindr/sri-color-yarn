
<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/custom_invoice_style.css'); ?>">
</head>
<body>

<table width="100%">
    <tbody>
    <tr>
        <td class="32.5%">
            <?php if(!empty($company['comp_logo'])){?>
                <img src="<?php echo base_url('images/').$company['comp_logo']; ?>" class="img-rounded" width="80px">
            <?php } else { ?>
                <img src="<?php echo base_url('images/default-logo/yourLogo_icon_red.png') ?>" class="img-rounded" width="80px">
            <?php }  ?>
        </td>
        <td class="32.5%">
            <h2 style="text-align: center"><?php echo strtoupper($reportname); ?></h2>
        </td>
        <td width="35%">
            <div class="bill-top"><?php echo $docmentcopy; ?></div>
            <div class="inv_no">Delivery Challan  &nbsp;<?php echo $dc_master[0]['inv_no']; ?></div>
            <div class="top-date">Date &nbsp;<?php echo date('d-m-Y', strtotime($dc_master[0]['inv_date'])); ?></div>
        </td>
    </tr>
    </tbody>
</table>
<hr>

<?php
if($dc_master[0]['inv_address'] == $dc_master[0]['inv_shipping_address'])
{
    ?>
    <table width="100%">
        <tbody>
        <tr>
            <td width="10%"></td>
            <td width="50%">
                <p class="address-title">From :</p>
                <table width="100%" class="address-disp">
                    <tbody>
                    <?php
                    $firstdet = array(
                        $company['comp_address1'],
                        $company['comp_address2'],
                        $company['comp_place'],
                        $company['comp_city'],
                    );

                    $secdet = array(
                        $company['comp_state']."\n".'-'."\n".$company['comp_state_code'],
                        $company['comp_country'],
                        $company['comp_pin_code']
                    );

                    $mobdet = array($company['comp_phone'],$company['comp_mobile1'],$company['comp_mobile2']);

                    //print_r($det);
                    $frstdec = implode(', ',array_filter($firstdet));
                    $secodec = implode(', ',array_filter($secdet));
                    $phone = implode(', ',array_filter($mobdet));
                    ?>
                    <tr>
                        <td><div class="p">
                                <table width="100%">
                                    <tr>
                                        <td width="7%"><img src="<?php echo base_url('assets/images/icons/company.png'); ?>" width="15px"></td>
                                        <td width="93%"><?php echo $company['comp_name']; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><div class="p">
                                <table width="100%">
                                    <tr>
                                        <td width="7%"><img src="<?php echo base_url('assets/images/icons/home.png'); ?>" width="15px"></td>
                                        <td width="93%"><?php echo ($frstdec); ?></td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="p">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php echo ($secodec); ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><div class="p">
                                <table width="100%">
                                    <tr>
                                        <td width="7%"><img src="<?php echo base_url('assets/images/icons/old_phone-512.png'); ?>" width="15px"></td>
                                        <td width="93%"><?php echo ($phone); ?></td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><div class="p">
                                <table width="100%">
                                    <tr>
                                        <td width="7%"><img src="<?php echo base_url('assets/images/icons/email-icon--clipart-best-22.png'); ?>" width="15px"></td>
                                        <td width="93%"><?php echo ($company['comp_email']); ?></td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><div class="p">
                                <table width="100%">
                                    <tr>
                                        <td width="7%"><img src="<?php echo base_url('assets/images/icons/gst.png'); ?>" width="15px"></td>
                                        <td width="93%"><?php echo 'GSTIN :'."\n".($company['comp_gstin_code']); ?></td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
            <td width="50%">
                <p class="address-title">Bill To :</p>
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
                        $customer['cus_state']."\n".'-'."\n".$customer['cus_state_code'],
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
                                                                        <td width="7%"><img src="'.base_url('assets/images/icons/persion.png').'" width="15px"></td>
                                                                        <td width="93%">'.$customer["cus_name"].'</td>
                                                                    </tr>
                                                                </table>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><div class="p">
                                                                        <table width="100%">
                                                                            <tr>
                                                                                <td width="7%"><img src="'.base_url('assets/images/icons/company.png').'" width="15px"></td>
                                                                                <td width="93%">'.$customer["cus_compnay_name"].'</td>
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
                                                                        <td width="7%"><img src="'.base_url('assets/images/icons/persion.png').'" width="15px"></td>
                                                                        <td width="93%">'.$customer["cus_name"].'</td>
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
                                                                                <td width="7%"><img src="'.base_url('assets/images/icons/company.png').'" width="15px"></td>
                                                                                <td width="93%">'.$customer["cus_compnay_name"].'</td>
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
                                        <td width="7%"><img src="<?php echo base_url('assets/images/icons/home.png'); ?>" width="15px"></td>
                                        <td width="93%"><?php echo ($cusfrstdec); ?></td>
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
                                        <td width="7%"><img src="<?php echo base_url('assets/images/icons/old_phone-512.png'); ?>" width="15px"></td>
                                        <td width="93%"><?php echo ($cusphone); ?></td>
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
                        <td><div class="p">
                                <img src="<?php echo base_url('assets/images/icons/gst.png'); ?>" width="15px">&nbsp;
                                <?php echo 'GSTIN :'."\n".($customer['cus_gstin_no']); ?>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
    <?php
}
else
{
    ?>
    <table width="100%">
        <tbody>
        <tr>
            <td width="30.3%">
                <p class="address-title">From :</p>
                <table width="100%" class="address-disp">
                    <tbody>
                    <?php
                    $firstdet = array(
                        $company['comp_address1'],
                        $company['comp_address2'],
                        $company['comp_place'],
                        $company['comp_city'],
                    );

                    $secdet = array(
                        $company['comp_state']."\n".'-'."\n".$company['comp_state_code'],
                        $company['comp_country'],
                        $company['comp_pin_code']
                    );

                    $mobdet = array($company['comp_phone'],$company['comp_mobile1'],$company['comp_mobile2']);

                    //print_r($det);
                    $frstdec = implode(', ',array_filter($firstdet));
                    $secodec = implode(', ',array_filter($secdet));
                    $phone = implode(', ',array_filter($mobdet));
                    ?>
                    <tr>
                        <td><div class="p">
                                <table width="100%">
                                    <tr>
                                        <td width="7%"><img src="<?php echo base_url('assets/images/icons/company.png'); ?>" width="15px"></td>
                                        <td width="93%"><?php echo $company['comp_name']; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><div class="p">
                                <table width="100%">
                                    <tr>
                                        <td width="7%"><img src="<?php echo base_url('assets/images/icons/home.png'); ?>" width="15px"></td>
                                        <td width="93%"><?php echo ($frstdec); ?></td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="p">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php echo ($secodec); ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><div class="p">
                                <table width="100%">
                                    <tr>
                                        <td width="7%"><img src="<?php echo base_url('assets/images/icons/old_phone-512.png'); ?>" width="15px"></td>
                                        <td width="93%"><?php echo ($phone); ?></td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><div class="p">
                                <table width="100%">
                                    <tr>
                                        <td width="7%"><img src="<?php echo base_url('assets/images/icons/email-icon--clipart-best-22.png'); ?>" width="15px"></td>
                                        <td width="93%"><?php echo ($company['comp_email']); ?></td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><div class="p">
                                <table width="100%">
                                    <tr>
                                        <td width="7%"><img src="<?php echo base_url('assets/images/icons/gst.png'); ?>" width="15px"></td>
                                        <td width="93%"><?php echo 'GSTIN :'."\n".($company['comp_gstin_code']); ?></td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
            <td width="30.3%">
                <p class="address-title">Bill To :</p>
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
                        $customer['cus_state']."\n".'-'."\n".$customer['cus_state_code'],
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
                                                                        <td width="7%"><img src="'.base_url('assets/images/icons/persion.png').'" width="15px"></td>
                                                                        <td width="93%">'.$customer["cus_name"].'</td>
                                                                    </tr>
                                                                </table>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><div class="p">
                                                                        <table width="100%">
                                                                            <tr>
                                                                                <td width="7%"><img src="'.base_url('assets/images/icons/company.png').'" width="15px"></td>
                                                                                <td width="93%">'.$customer["cus_compnay_name"].'</td>
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
                                                                        <td width="7%"><img src="'.base_url('assets/images/icons/persion.png').'" width="15px"></td>
                                                                        <td width="93%">'.$customer["cus_name"].'</td>
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
                                                                                <td width="7%"><img src="'.base_url('assets/images/icons/company.png').'" width="15px"></td>
                                                                                <td width="93%">'.$customer["cus_compnay_name"].'</td>
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
                                        <td width="7%"><img src="<?php echo base_url('assets/images/icons/home.png'); ?>" width="15px"></td>
                                        <td width="93%"><?php echo ($cusfrstdec); ?></td>
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
                                        <td width="7%"><img src="<?php echo base_url('assets/images/icons/old_phone-512.png'); ?>" width="15px"></td>
                                        <td width="93%"><?php echo ($cusphone); ?></td>
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
                        <td><div class="p">
                                <img src="<?php echo base_url('assets/images/icons/gst.png'); ?>" width="15px">&nbsp;
                                <?php echo 'GSTIN :'."\n".($customer['cus_gstin_no']); ?>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
            <td width="30.3%">
                <p class="address-title">Shipping To :</p>
                <table width="100%" class="address-disp">
                    <tbody>
                    <?php
                    $shifrtdet = array(
                        $customer_branch['shi_address1'],
                        $customer_branch['shi_address2'],
                        $customer_branch['shi_place'],
                        $customer_branch['shi_city']
                    );

                    $shisecdett = array(
                        $customer_branch['shi_state']."\n".'-'."\n".$customer_branch['shi_state_code'],
                        $customer_branch['shi_country'],
                        $customer_branch['pin_code']
                    );

                    $mobshidet = array($customer_branch['shi_phone'],$customer_branch['shi_mobile1'],$customer_branch['shi_mobile2']);

                    //print_r($det);
                    $shifrstdec = implode(', ',array_filter($shifrtdet));
                    $shisecdet = implode(', ',array_filter($shisecdett));
                    $shiphone = implode(', ',array_filter($mobshidet));

                    if(!$customer_branch['shi_name'] == '' && !$customer_branch['shi_compnay_name'] == '')
                    {
                        $nameval = '<tr>
                                                                <td><div class="p">
                                                                <table width="100%">
                                                                    <tr>
                                                                        <td width="7%"><img src="'.base_url('assets/images/icons/persion.png').'" width="15px"></td>
                                                                        <td width="93%">'.$customer_branch["shi_name"].'</td>
                                                                    </tr>
                                                                </table>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><div class="p">
                                                                        <table width="100%">
                                                                            <tr>
                                                                                <td width="7%"><img src="'.base_url('assets/images/icons/company.png').'" width="15px"></td>
                                                                                <td width="93%">'.$customer_branch["shi_compnay_name"].'</td>
                                                                            </tr>
                                                                        </table>  
                                                                    </div>
                                                                </td>
                                                            </tr>';
                    }
                    elseif (!$customer_branch['shi_name'] == '' && $customer_branch['shi_compnay_name'] == '')
                    {
                        $nameval = '<tr>
                                                                <td><div class="p">
                                                                <table width="100%">
                                                                    <tr>
                                                                        <td width="7%"><img src="'.base_url('assets/images/icons/persion.png').'" width="15px"></td>
                                                                        <td width="93%">'.$customer_branch["shi_name"].'</td>
                                                                    </tr>
                                                                </table>
                                                                    </div>
                                                                </td>
                                                            </tr>';
                    }
                    elseif ($customer_branch['shi_name'] == '' && !$customer_branch['shi_compnay_name'] == '')
                    {
                        $nameval = ' <tr>
                                                                <td><div class="p">
                                                                        <table width="100%">
                                                                            <tr>
                                                                                <td width="7%"><img src="'.base_url('assets/images/icons/company.png').'" width="15px"></td>
                                                                                <td width="93%">'.$customer_branch["shi_compnay_name"].'</td>
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
                                        <td width="7%"><img src="<?php echo base_url('assets/images/icons/home.png'); ?>" width="15px"></td>
                                        <td width="93%"><?php echo ($shifrstdec); ?></td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="p">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php echo ($shisecdet); ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><div class="p">
                                <table width="100%">
                                    <tr>
                                        <td width="7%"><img src="<?php echo base_url('assets/images/icons/old_phone-512.png'); ?>" width="15px"></td>
                                        <td width="93%"><?php echo ($shiphone); ?></td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><div class="p">
                                <img src="<?php echo base_url('assets/images/icons/email-icon--clipart-best-22.png'); ?>" width="15px">&nbsp;
                                <?php echo ($customer_branch['shi_email']); ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><div class="p">
                                <img src="<?php echo base_url('assets/images/icons/gst.png'); ?>" width="15px">&nbsp;
                                <?php echo 'GSTIN :'."\n".($customer_branch['shi_gstin_code']); ?>
                            </div>
                        </td>
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
        <th rowspan="2" width="2%">S.No</th>
        <th rowspan="2" width="50%">Description</th>
        <th rowspan="2" width="5%">HSN</th>
        <th rowspan="2" width="7%">Qty</th>
        <th rowspan="2" width="7%">UOM</th>
        <th rowspan="2" width="7%">Price</th>
        <th rowspan="2" width="7%">Total</th>
    </tr>
    </thead>
    <tbody class="border">
    <?php $sno=1; foreach ($dc_master as $v) { ?>
        <tr>
            <td><?php echo $sno++;?></td>
            <td><?php echo $v['prod_desc'];?></td>
            <td><?php echo $v['hsn_code'];?></td>
            <td><?php echo $v['qty'];?></td>
            <td><?php echo $v['uom'];?></td>
            <td><?php echo $v['price'];?></td>
            <td><?php $net[] = $v['qty'] * $v['price']; echo $v['qty'] * $v['price']; ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<table class="total-list" width="100%">
    <tbody>
    <tr>
        <td width="70%">
            <p><b>Amount In Words :</b>&nbsp;<?php echo strtoupper($dc_master[0]['amount_in_words']); ?></p>
        </td>
        <td width="5%"></td>
        <td class="amount-dis" width="25%">
            <p >Net Amount &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&#x20b9;&nbsp;<?php echo $dc_master[0]['net_amount']; ?></p>
        </td>
    </tr>
    </tbody>
</table>

<table class="footer-tab" width="100%">
    <tbody>
    <tr>
        <td class="border" width="70%">
            <p>
                <b>NOTE:</b>
            <p>
                The business invoice is an essential legal document prepared by a vendor or service provider and given to the customer or client to serve as a record of goods or services sold to the customer or client. The vendor or service provider needs to retain a copy as a record of their sales. The customer or client needs to retain a copy as a record of their purchase or expense
            </p>
            </p>
        </td>
        <td width="30%">
            <p class="auth-sign">Authorized Signatory</p>
        </td>
    </tr>
    </tbody>
</table>
</body>

<script>
    load();
    function load() {
        window.print();
    }
</script>
</html>
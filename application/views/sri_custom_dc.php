
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
        <td width="100%">
            <img src="<?php echo base_url('assets/images/invoice-header/sri-color-dc.jpg'); ?>" height="150px" width="100%">
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
                        <td>DC No : </td>
                        <td class="inv-bold"><?php echo $dc_master[0]['inv_no']; ?></td>
                    </tr>
                    <tr>
                        <td>DC Date : </td>
                        <td class="inv-bold"><?php echo date('d-m-Y', strtotime($dc_master[0]['inv_date'])); ?></td>
                    </tr>
                    <tr>
                        <td>Order No : </td>
                        <td class="inv-bold"><?php echo $dc_master[0]['order_no']; ?></td>
                    </tr>
                    <tr>
                        <td>Reference No : </td>
                        <td class="inv-bold"><?php echo $dc_master[0]['ref_no']; ?></td>
                    </tr>
                    <tr>
                        <td>Transport Mode : </td>
                        <td class="inv-bold"><?php echo $dc_master[0]['transport_mode']; ?></td>
                    </tr>
                    <tr>
                        <td>Vehicle No : </td>
                        <td class="inv-bold"><?php echo $dc_master[0]['vehicle_no']; ?></td>
                    </tr>
                    <tr>
                        <td>Date of Supply : </td>
                        <td class="inv-bold"><?php if($dc_master[0]['date_of_supply']=='0000-00-00 00:00:00' || $dc_master[0]['date_of_supply']== '' ){ echo '';}else{echo date('d-m-Y', strtotime($dc_master[0]['date_of_supply']));} ?></td>
                    </tr>
                    <tr>
                        <td>Place of Supply : </td>
                        <td class="inv-bold"><?php echo $dc_master[0]['place_of_supply']; ?></td>
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
            <td><?php
                $bh = " - [ B : ".number_format($v['no_of_bundle']).'/ H :'.number_format($v['hanking'])."]";
                echo "<strong>".$v['prod_desc']."</strong><div style='font-size: 12px; display: inline;'>".$bh."</div>";
                ?>
            </td>
            <td><?php echo $v['hsn_code'];?></td>
            <td class="amount-display"><?php echo $v['qty'];?></td>
            <td><?php echo $v['uom'];?></td>
            <td class="amount-display"><?php echo $v['price'];?></td>
            <td class="amount-display"><?php $net[] = $v['qty'] * $v['price']; $resamt = $v['qty'] * $v['price']; echo sprintf("%01.2f", $resamt); ?></td>
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
                Not for sales. Transportation purpose only...
            </p>
            </p>
        </td>
        <td width="30%">
            <p class="auth-sign">FOR SRI COLOURS</p>
        </td>
    </tr>
    </tbody>
</table>
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
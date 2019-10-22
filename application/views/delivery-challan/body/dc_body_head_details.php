<div class="body-top">

    <!-- Report title -->
    <div class="report-title">
        <?php
            $pagetile = "Delivery Challan";
            echo $pagetile;
       ?>
    </div>
    <!-- Report title -->

    <!-- Invoice Details Transport Details -->
    <div class="body-head-content">
        <table width="100%">
            <tbody>
                <tr>
                    <td width="100%">
                        <div class="head-content-left">
                            <p><b>Invoice No : <?php echo $dc_master[0]['inv_no']; ?></b></p>
                            <p><b>Invoice Date : </b><?php echo date('d-m-Y', strtotime($dc_master[0]['inv_date'])); ?></p>
                            <p><b>Tax is payable on reverse charge : </b><?php echo "No";?></p>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- /Invoice Details Transport Details -->

    <div class="customer-head-content">
        <table width="100%">
            <thead>
                <tr>
                    <th width="50%">Details Of Receiver</th>
                    <th width="50%">Details of Consignee(Shipped to)</th>
                </tr>
            </thead>
            <tbody>
                <?php if($customer_branch == 0) {?>
                <tr>
                    <td>
                        <p><b>Name : </b><?php echo $dc_master[0]['cus_name']; ?></p>
                        <p><b>Address : </b><?php $e = explode(',',$dc_master[0]['inv_address']); $i = array_filter($e); $j = implode(',',$i); echo $j;?></p>
                        <p><b>State : </b><?php echo $dc_master[0]['cus_state']; ?></p>
                        <p><b>State Code : </b><?php echo $dc_master[0]['cus_state_code']; ?></p>
                        <p><b>GSTIN Number : </b><?php echo $dc_master[0]['cus_gstin_no']; ?></p>
                    </td>

                    <td>
                        <p><b>Name : </b><?php echo $dc_master[0]['cus_name']; ?></p>
                        <p><b>Address : </b><?php $e = explode(',',$dc_master[0]['inv_address']); $i = array_filter($e); $j = implode(',',$i); echo $j;?></p>
                        <p><b>State : </b><?php echo $dc_master[0]['cus_state']; ?></p>
                        <p><b>State Code : </b><?php echo $dc_master[0]['cus_state_code']; ?></p>
                        <p><b>GSTIN Number : </b><?php echo $dc_master[0]['cus_gstin_no']; ?></p>
                    </td>
                </tr>
                <?php  } else{ ?>
                    <tr>
                        <td>
                            <p><b>Name : </b><?php echo $dc_master[0]['cus_name']; ?></p>
                            <p><b>Address : </b><?php $e = explode(',',$dc_master[0]['inv_address']); $i = array_filter($e); $j = implode(',',$i); echo $j;?></p>
                            <p><b>State : </b><?php echo $dc_master[0]['cus_state']; ?></p>
                            <p><b>State Code : </b><?php echo $dc_master[0]['cus_state_code']; ?></p>
                            <p><b>GSTIN Number : </b><?php echo $dc_master[0]['cus_gstin_no']; ?></p>
                        </td>

                        <td>
                            <p><b>Name : </b><?php echo $customer_branch['shi_name']; ?></p>
                            <p><b>Address : </b><?php $e = explode(',',$dc_master[0]['inv_shipping_address']); $i = array_filter($e); $j = implode(',',$i); echo $j;?></p>
                            <p><b>State : </b><?php echo $customer_branch['shi_state']; ?></p>
                            <p><b>State Code : </b><?php echo $customer_branch['shi_state_code']; ?></p>
                            <p><b>GSTIN Number : </b><?php echo $customer_branch['shi_gstin_code']; ?></p>
                        </td>
                    </tr>
                <?php  } ?>
            </tbody>
        </table>
    </div>
</div>


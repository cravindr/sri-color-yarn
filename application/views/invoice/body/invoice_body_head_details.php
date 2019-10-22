<div class="body-top">

    <!-- Report title -->
    <div class="report-title">
        <?php
            $pagetile = "Invoice Report";
            echo $pagetile;
       ?>
    </div>
    <!-- Report title -->

    <!-- Invoice Details Transport Details -->
    <div class="body-head-content">
        <table width="100%">
            <tbody>
                <tr>
                    <td width="50%">
                        <div class="head-content-left">
                            <p><b>Invoice No : <?php echo $invoice_master['inv_no']; ?></b></p>
                            <p><b>Invoice Date : </b><?php echo date('d-m-Y', strtotime($invoice_master['inv_date'])); ?></p>
                            <p><b>Tax is payable on reverse charge : </b><?php echo "No";?></p>
                        </div>
                    </td>
                    <td width="50%">
                        <div class="head-content-right">
                            <p><b>Transportaion Mode : </b><?php echo $invoice_master['transport_mode']; ?></p>
                            <p><b>Vehivle No : </b><?php echo $invoice_master['vehicle_no']; ?></p>
                            <p><b>Date of Supply : </b><?php echo date('d-m-Y', strtotime($invoice_master['date_of_supply'])); ?></p>
                            <p><b>Place Of Supply : </b><?php echo $invoice_master['place_of_supply']; ?></p>
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
                <?php if(empty($customer_branch)) {?>
                <tr>
                    <td>
                        <p><b>Name : </b><?php echo $customer['cus_name']; ?></p>
                        <p><b>Address : </b><?php $e = explode(',',$invoice_master['inv_address']); $i = array_filter($e); $j = implode(',',$i); echo $j;?></p>
                        <p><b>State : </b><?php echo $customer['cus_state']; ?></p>
                        <p><b>State Code : </b><?php echo $customer['cus_state_code']; ?></p>
                        <p><b>GSTIN Number : </b><?php echo $customer['cus_gstin_no']; ?></p>
                    </td>

                    <td>
                        <p><b>Name : </b><?php echo $customer['cus_name']; ?></p>
                        <p><b>Address : </b><?php $e = explode(',',$invoice_master['inv_address']); $i = array_filter($e); $j = implode(',',$i); echo $j;?></p>
                        <p><b>State : </b><?php echo $customer['cus_state']; ?></p>
                        <p><b>State Code : </b><?php echo $customer['cus_state_code']; ?></p>
                        <p><b>GSTIN Number : </b><?php echo $customer['cus_gstin_no']; ?></p>
                    </td>
                </tr>
                <?php  } else{ ?>
                    <tr>
                        <td>
                            <p><b>Name : </b><?php echo $customer['cus_name']; ?></p>
                            <p><b>Address : </b><?php $e = explode(',',$invoice_master['inv_address']); $i = array_filter($e); $j = implode(',',$i); echo $j;?></p>
                            <p><b>State : </b><?php echo $customer['cus_state']; ?></p>
                            <p><b>State Code : </b><?php echo $customer['cus_state_code']; ?></p>
                            <p><b>GSTIN Number : </b><?php echo $customer['cus_gstin_no']; ?></p>
                        </td>

                        <td>
                            <p><b>Name : </b><?php echo $customer_branch['shi_name']; ?></p>
                            <p><b>Address : </b><?php $e = explode(',',$invoice_master['inv_shipping_address']); $i = array_filter($e); $j = implode(',',$i); echo $j;?></p>
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


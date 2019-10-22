<tbody>
<?php $sno=1; foreach ($invoice_detail as $v) { ?>
    <tr>
        <td><?php echo $sno++;?></td>
        <td><?php echo $v['prod_desc'];?></td>
        <td><?php echo $v['hsn_code'];?></td>
        <td><?php echo $v['qty'];?></td>
        <td><?php echo $v['uom'];?></td>
        <td><?php echo $v['price'];?></td>
        <td><?php echo $v['total'];?></td>
        <td><?php echo $v['discount'];?></td>
        <td><?php echo $v['cgst_rate'];?></td>
        <td><?php echo $v['cgst_amount'];?></td>
        <td><?php echo $v['sgst_rate'];?></td>
        <td><?php echo $v['sgst_amount'];?></td>
        <td><?php echo $v['igst_rate'];?></td>
        <td><?php echo $v['igst_amount'];?></td>
        <td><?php echo $v['taxable_value'] + $v['cgst_amount'] + $v['sgst_amount'] + $v['igst_amount'] - $v['discount'];?></td>
    </tr>
<?php } ?>
</tbody>
<tbody>
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
<div class="body-amount-details">
    <table width="100%">
        <tbody>
            <tr>
                <td width="70%" style="border: none !important;">
                    <table width="100%">
                        <tr>
                            <th style="text-align: center">Invoice Value(In Words)</th>
                        </tr>
                        <tr>
                            <td style="text-align: center"><?php echo $invoice_master['amount_in_words']?></td>
                        </tr>
                    </table><br>
                    <table>
                        <tr>
                            <td><b>Electronic Refreence Number :</b></td>
                        </tr>
                    </table>
                </td>
                <td width="30%" style="border: none !important;">
                    <table width="100%">
                        <tr>
                            <td width="50%">Total SGST</td>
                            <td width="50%"><?php echo $invoice_master['sgst']; ?></td>
                        </tr>
                        <tr>
                            <td width="50%">Total CGST</td>
                            <td width="50%"><?php echo $invoice_master['cgst']; ?></td>
                        </tr>
                        <tr>
                            <td width="50%">Total IGST</td>
                            <td width="50%"><?php echo $invoice_master['igst']; ?></td>
                        </tr>
                        <tr>
                            <td width="50%">Total Amount</td>
                            <td width="50%"><?php echo $invoice_master['net_amount']; ?></td>
                        </tr>
                        <tr>
                            <td width="50%">Round Off Amount</td>
                            <td width="50%"><?php
                                $v1 = $invoice_master['net_amount'];
                                $v2 = round($v1);
                                 $v3 = $v2-$v1;
                                 echo $v3;
                                ?></td>
                        </tr>
                        <tr>
                            <td width="50%">Net Amount</td>
                            <td width="50%"><?php echo $v2; ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</div>
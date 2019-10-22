<table>
    <tr>

        <center>
            <!-- company Logo -->
            <div>
                <img src="https://seeklogo.com/images/A/apple-logo-52C416BDDD-seeklogo.com.png" width="20px">
            </div>
            <!-- /company Logo -->

            <!-- company title -->
            <div class="company-title"><?php echo $company['comp_name']; ?></div>
            <!-- /company title -->

            <!-- company address -->
            <div class="company-address">
                <?php
                        $val = array(
                            $company['comp_address1'],
                            $company['comp_address2'],
                            $company['comp_place'],
                            $company['comp_city'],
                            $company['comp_state'],
                            $company['comp_country'],
                            $company['comp_pin_code'],
                        );

                        //$statecode = $v->comp_state_code;
                       // $gstno = $v->comp_gstin_code;

                   print_r(implode(", ",array_filter($val)));
                ?>

                <br>
                <?php echo "<b>State Code : </b>".$company['comp_state_code']."";?>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                <?php echo "<b>GSTIN : </b>".$company['comp_gstin_code']."";?>
            </div>
            <!-- /company address -->
        </center>
    </tr>

</table>

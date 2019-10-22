<?php
$sup_id=fnSetDilt($sup_id);

/*$payment_type=fnSetDilt($payment_type);
$startdate=fnSetDilt($startdate);
$enddate=fnSetDilt($enddate);*/

function fnSetDilt($var) {
    if($var=='')
    {
        return '~';
    }
    else

    {
        return $var;
    }

}
?>
<script>

    var ajaxphpurl = "<?php echo site_url('payment/supplierserverside/'.$sup_id); ?>";

</script>


<script type="text/javascript" src="<?php echo base_url('assets/custom-js/supplier_rep_datatable_script.js'); ?>"></script>
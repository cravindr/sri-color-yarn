<?php
$cus_id=fnSetDilt($cus_id);

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

    var ajaxphpurl = "<?php echo site_url('payment/repserverside/'.$cus_id); ?>";

</script>


<script type="text/javascript" src="<?php echo base_url('assets/custom-js/cus_rep_datatable_script.js'); ?>"></script>
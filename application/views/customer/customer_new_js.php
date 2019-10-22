<script>
    $('#cus_state').on("change",function () {
        var state = $(this).val();

        $.post("<?php echo site_url('welcome/getstatecode'); ?>",{state:state},function (data) {
            $('#cus_state_code').val(data);
        });
    });
</script>

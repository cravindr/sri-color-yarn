<?php if($company_already_exists == 1){ ?>
<script>
    var urle = "<?php echo site_url('company/companyedit'); ?>";
    var imgurl = "<?php echo base_url('images/'); ?>";
    $(function () {
        CompanyEdit();
    });

    $('#comp_state').on("change",function () {
        var state = $(this).val();

        $.post("<?php echo site_url('Welcome/GetStateCode'); ?>",{state:state},function (data) {
            $('#comp_state_Code').val(data);
        });
    });


function CompanyEdit()
{
        $.post(urle, {id:1}, function (data) {
            var json = $.parseJSON(data);

            $('#comp_id').val(json.comp_id);
            $('#comp_name').val(json.comp_name);
            $('#comp_email').val(json.comp_email);
            $('#comp_mobile').val(json.comp_mobile1);
            $('#comp_mobile2').val(json.comp_mobile2);
            $('#comp_phone').val(json.comp_phone);
            $('#comp_address1').val(json.comp_address1);
            $('#comp_address2').val(json.comp_address2);
            $('#comp_place').val(json.comp_place);
            $('#comp_city').val(json.comp_city);
            $('#comp_state').val(json.comp_state);
            $('#comp_state_Code').val(json.comp_state_code);
            $('#comp_pin_code').val(json.comp_pin_code);
            $('#comp_website').val(json.comp_website);
            $('#comp_gstin_code').val(json.comp_gstin_code);


                $("#comp_logo").fileinput({
                    showUpload: false,
                    overwriteInitial: true,
                    initialPreview: imgurl+json.comp_logo,
                    initialPreviewAsData: true, // identify if you are sending preview data only and not the raw markup
                    initialPreviewFileType: 'image',
                    allowedFileExtensions : ['jpg', 'png','gif']
                });
        });
}
</script>
<?php }

else {
?>
    <script>
        $(function () {
            $("#comp_logo").fileinput({
                maxFileCount: 10,
                showUpload: false,
                allowedFileExtensions : ['jpg', 'png','gif']
            });
        });

        $('#comp_state').on("change",function () {
            var state = $(this).val();

            $.post("<?php echo site_url('Welcome/GetStateCode'); ?>",{state:state},function (data) {
                $('#comp_state_Code').val(data);
            });
        });
    </script>
<?php } ?>
$(function () {
    var table = $('#purchase').DataTable( {
        "processing": true,
        "serverSide": true,
        "lengthMenu": [[10, 25, 50, 100, 500, 1000, -1], [10, 25, 50, 100, 500, 1000, "Show All"]],
        "ajax": serversideurl
    } );

    table.column(0).visible(false);

    $('#purchase tbody').on("click","#btnedit",function () {
        var data = table.row($(this).parents('tr')).data();
        CompanyBranchEdit(data[0]);
    });

});


function CompanyBranchEdit(id) {
    $.ajax({
        url: editurl,
        data: {id:id},
        type: "POST",
        success: function (data) {

            var json = $.parseJSON(data);
            console.log(json);
            $('#branch_id').val(json.bra_id);
            $('#comp_name').val(json.bra_name);
            $('#comp_email').val(json.bra_email);
            $('#comp_mobile').val(json.bra_mobile1);
            $('#comp_mobile2').val(json.bra_mobile2);
            $('#comp_phone').val(json.bra_phone);
            $('#comp_address1').val(json.bra_address1);
            $('#comp_address2').val(json.bra_address2);
            $('#comp_place').val(json.bra_place);
            $('#comp_city').val(json.bra_city);
            $('#comp_country').val(json.bra_country);
            $('#comp_state').val(json.bra_state);
            $('#comp_state_Code').val(json.bra_state_code);
            $('#comp_pin_code').val(json.bra_pin_code);
            $('#comp_website').val(json.bra_website);
            $('#comp_gstin_code').val(json.bra_gstin_code);

            $("#comp_logo").fileinput({
                showUpload: false,
                overwriteInitial: true,
                initialPreview: imgurl+json.comp_logo,
                initialPreviewAsData: true, // identify if you are sending preview data only and not the raw markup
                initialPreviewFileType: 'image',
                allowedFileExtensions : ['jpg', 'png','gif']
            });

            $('#purchase_branch_edit_form').modal('show');
        }
    });
}

$('#purchaseimportbtn').click(function () {
    $('#purchase_import_file').modal('show');
});





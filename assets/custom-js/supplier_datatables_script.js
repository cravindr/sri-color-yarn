$(function () {

    var table = $('#supplier').DataTable( {
        "processing": true,
        "serverSide": true,
        "lengthMenu": [[10, 25, 50, 100, 500, 1000, -1], [10, 25, 50, 100, 500, 1000, "Show All"]],
        "ajax": ajaxphpurl
    } );

    table.column(0).visible(false);

    $('#supplier tbody').on("click","#btnview",function () {
        var data = table.row($(this).parents('tr')).data();
        SupplierView(data[0]);
    });

    $('#supplier tbody').on("click","#btnedit",function () {
        var data = table.row($(this).parents('tr')).data();
        SupplierEdit(data[0]);
    });

    $('#supplier tbody').on("click","#btnstatus",function () {
        var data = table.row($(this).parents('tr')).data();
        Status(data[0]);
    });

    $('#supplier tbody').on("click","#btndelete",function () {
        var data = table.row($(this).parents('tr')).data();
        SupplierDelete(data[0],data[2]);
    });

});

$('#sup_state_state').on("change",function () {
    alert(getstatecode);
    var state = $(this).val();

    $.post(getstatecode,{state:state},function (data) {
        $('#sup_state_Code').val(data);
    });
});

function SupplierView(id) {
    $.ajax({
        url: Editurl,
        data: {id:id},
        type: "POST",
        success: function (data) {

            var json = $.parseJSON(data);

            $('.sup_name').text(json.sup_name);
            $('.sup_compnay_name').text(json.sup_compnay_name);
            $('.sup_email').text(json.sup_email);
            $('.sup_mobile1').text(json.sup_mobile1);
            $('.sup_mobile2').text(json.sup_mobile2);
            $('.sup_phone').text(json.sup_phone);
            $('.sup_address1').text(json.sup_address1);
            $('.sup_address2').text(json.sup_address2);
            $('.sup_place').text(json.sup_place);
            $('.sup_city').text(json.sup_city);
            $('.sup_state').text(json.sup_state);
            $('.sup_state_code').text(json.sup_state_code);
            $('.sup_country').text(json.sup_country);
            $('.sup_pin_code').text(json.pin_code);
            $('.sup_website').text(json.website);
            $('.sup_gstin_no').text(json.sup_gstin_no);
            $('.sup_cdate').text(json.sup_cdate);
            $('.status').text(json.status);

            $('#supplier_view_details').modal('show');
        }
    });
}

function SupplierEdit(id) {
    $.ajax({
        url: Editurl,
        data: {id:id},
        type: "POST",
        success: function (data) {

            var json = $.parseJSON(data);

            $('#cusid').val(id);
            $('#sup_name').val(json.sup_name);
            $('#sup_company_name').val(json.sup_compnay_name);
            $('#sup_email').val(json.sup_email);
            $('#sup_mobile').val(json.sup_mobile1);
            $('#sup_mobile2').val(json.sup_mobile2);
            $('#sup_phone').val(json.sup_phone);
            $('#sup_address1').val(json.sup_address1);
            $('#sup_address2').val(json.sup_address2);
            $('#sup_place').val(json.sup_place);
            $('#sup_city').val(json.sup_city);
            $('#sup_country').val(json.sup_country);
            $('#cus_state').selectpicker('val',json.sup_state);
            $('#cus_state_code').val(json.sup_state_code);
            $('#sup_pin_code').val(json.sup_pin_code);
            $('#sup_website').val(json.sup_website);
            $('#sup_gstin_code').val(json.sup_gstin_code);

            $('#supplier_edit_form').modal('show');
        }
    });
}

function Status(id) {
    $.post(statusurl, {id:id}, function (data) {
        if(data == 1)
        {
            window.location.href = redirurl;
        }
        else
        {
            window.location.href = redirurl;
        }
    });
}

function SupplierDelete(id,name) {

    var con = confirm("Are you sure delete:" + name);

    if (con == 1)
    {
        $.ajax({
            url: deleteurl,
            data: {id: id},
            type: "POST",
            success: function (data) {
                if (data == 1) {
                    location.reload();
                }
            }
        });
    }
}





$(function () {

    var table = $('#customer').DataTable( {
        "processing": true,
        "serverSide": true,
        "lengthMenu": [[10, 25, 50, 100, 500, 1000, -1], [10, 25, 50, 100, 500, 1000, "Show All"]],
        "ajax": ajaxphpurl
    } );

    table.column(0).visible(false);

    $('#customer tbody').on("click","#btnview",function () {
        var data = table.row($(this).parents('tr')).data();
        CustomerView(data[0]);
    });

    $('#customer tbody').on("click","#btnedit",function () {
        var data = table.row($(this).parents('tr')).data();
        CustomerEdit(data[0]);
    });

    $('#customer tbody').on("click","#btnstatus",function () {
        var data = table.row($(this).parents('tr')).data();
        Status(data[0]);
    });

    $('#cus_state').on("change",function () {
        var state = $(this).val();

        $.post(getstatecode,{state:state},function (data) {
            $('#cus_state_code').val(data);
        });
    });

});



function CustomerView(id) {
    $.ajax({
        url: Editurl,
        data: {id:id},
        type: "POST",
        success: function (data) {

            var json = $.parseJSON(data);

            $('.cus_name').text(json.shi_name);
            $('.cus_compnay_name').text(json.shi_compnay_name);
            $('.cus_email').text(json.shi_email);
            $('.cus_mobile1').text(json.shi_mobile1);
            $('.cus_mobile2').text(json.shi_mobile2);
            $('.cus_phone').text(json.shi_phone);
            $('.cus_address1').text(json.shi_address1);
            $('.cus_address2').text(json.shi_address2);
            $('.cus_place').text(json.shi_place);
            $('.cus_city').text(json.shi_city);
            $('.cus_state').text(json.shi_state);
            $('.cus_state_code').text(json.shi_state_code);
            $('.cus_country').text(json.shi_country);
            $('.cus_pin_code').text(json.pin_code);
            $('.cus_website').text(json.website);
            $('.cus_gstin_no').text(json.shi_gstin_code);
            $('.cus_cdate').text(json.shi_cdate);
            $('.status').text(json.status);

            $('#customer_branch_view_details').modal('show');
        }
    });
}

function CustomerEdit(id) {
    $.ajax({
        url: Editurl,
        data: {id:id},
        type: "POST",
        success: function (data) {

            var json = $.parseJSON(data);

            $('#shiid').val(json.shi_id);
            $('#cus_name').val(json.shi_name);
            $('#cus_company_name').val(json.shi_compnay_name);
            $('#cus_email').val(json.shi_email);
            $('#cus_mobile').val(json.shi_mobile1);
            $('#cus_mobile2').val(json.shi_mobile2);
            $('#cus_phone').val(json.shi_phone);
            $('#cus_address1').val(json.shi_address1);
            $('#cus_address2').val(json.shi_address2);
            $('#cus_place').val(json.shi_place);
            $('#cus_city').val(json.shi_city);
            $('#cus_country').val(json.shi_country);
            $('#cus_state').selectpicker('val',json.shi_state);
            $('#cus_state_code').val(json.shi_state_code);
            $('#cus_pin_code').val(json.pin_code);
            $('#cus_website').val(json.website);
            $('#cus_gstin_code').val(json.shi_gstin_code);

            $('#customer_branch_edit_form').modal('show');
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







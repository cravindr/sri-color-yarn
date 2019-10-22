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

    $('#customer tbody').on("click","#btnaddaddress",function () {
        var data = table.row($(this).parents('tr')).data();
        NewAddress(data[0]);
    });

});

$('#cus_state_state').on("change",function () {
    alert(getstatecode);
    var state = $(this).val();

    $.post(getstatecode,{state:state},function (data) {
        $('#cus_state_Code').val(data);
    });
});

function CustomerView(id) {
    $.ajax({
        url: Editurl,
        data: {id:id},
        type: "POST",
        success: function (data) {

            var json = $.parseJSON(data);

            $('.cus_name').text(json.cus_name);
            $('.cus_compnay_name').text(json.cus_compnay_name);
            $('.cus_email').text(json.cus_email);
            $('.cus_mobile1').text(json.cus_mobile1);
            $('.cus_mobile2').text(json.cus_mobile2);
            $('.cus_phone').text(json.cus_phone);
            $('.cus_address1').text(json.cus_address1);
            $('.cus_address2').text(json.cus_address2);
            $('.cus_place').text(json.cus_place);
            $('.cus_city').text(json.cus_city);
            $('.cus_state').text(json.cus_state);
            $('.cus_state_code').text(json.cus_state_code);
            $('.cus_country').text(json.cus_country);
            $('.cus_pin_code').text(json.pin_code);
            $('.cus_website').text(json.website);
            $('.cus_gstin_no').text(json.cus_gstin_no);
            $('.cus_cdate').text(json.cus_cdate);
            $('.status').text(json.status);

            $('#customer_view_details').modal('show');
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

            $('#cusid').val(id);
            $('#cus_name').val(json.cus_name);
            $('#cus_company_name').val(json.cus_compnay_name);
            $('#cus_email').val(json.cus_email);
            $('#cus_mobile').val(json.cus_mobile1);
            $('#cus_mobile2').val(json.cus_mobile2);
            $('#cus_phone').val(json.cus_phone);
            $('#cus_address1').val(json.cus_address1);
            $('#cus_address2').val(json.cus_address2);
            $('#cus_place').val(json.cus_place);
            $('#cus_city').val(json.cus_city);
            $('#cus_country').val(json.cus_country);
            $('#cus_state').selectpicker('val',json.cus_state);
            $('#cus_state_code').val(json.cus_state_code);
            $('#cus_pin_code').val(json.cus_pin_code);
            $('#cus_website').val(json.cus_website);
            $('#cus_gstin_code').val(json.cus_gstin_code);

           $('#customer_edit_form').modal('show');
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

function NewAddress(id) {
    $.post(addaddressgetid, {id:id}, function (data) {
        if(data)
        {
            var list = addresscustomerlist+'/'+data+'/';
            window.location.href = list;
        }
    });
}





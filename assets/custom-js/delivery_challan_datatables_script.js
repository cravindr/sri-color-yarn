$(function () {
    var table = $('#delivery-challan').DataTable( {
        "order": [[ 0, 'desc' ]],
        "processing": true,
        "serverSide": true,
        "lengthMenu": [[10, 25, 50, 100, 500, 1000, -1], [10, 25, 50, 100, 500, 1000, "Show All"]],
        "ajax": dcserversideurl
    } );

    table.column(0).visible(false);

    $('#delivery-challan tbody').on("click","#dcbtnview",function () {
        var data = table.row($(this).parents('tr')).data();
        DeliveryChallanView(data[0]);
    });

    $('#delivery-challan tbody').on("click","#dcbtndelete",function () {
        var data = table.row($(this).parents('tr')).data();
        DeliveryChallanDelete(data[0],data[1]);
    });

    $('#delivery-challan tbody').on("click","#dcbtnprint",function () {
        var data = table.row($(this).parents('tr')).data();
        DeliveryChallanPrint(data[1]);

    });

});


function DeliveryChallanPrint(id) {
    var dc_no = id;
    window.location.href = printdc+'/'+dc_no+'/';
}

function DeliveryChallanView(id) {
    $.ajax({
        url: viewdataurl,
        data: {id:id},
        type: "POST",
        success: function (data) {

            var json = $.parseJSON(data);

            $(".inv_no").text(json.inv_no);
            $(".rcm").text(json.rcm);
            $(".transport_mode").text(json.transport_mode);
            $(".vehicle_no").text(json.vehicle_no);
            $(".date_of_supply").text(json.date_of_supply);
            $(".inv_date").text(json.inv_date);
            $(".place_of_supply").text(json.place_of_supply);
            $(".inv_address").text(json.inv_address);
            $(".inv_shipping_address").text(json.inv_shipping_address);
            $(".total").text(json.total);
            $(".cgst").text(json.cgst);
            $(".sgst").text(json.sgst);
            $(".igst").text(json.igst);
            $(".gst").text(json.gst);
            $(".total_tax").text(json.total_tax);
            $(".net_amount").text(json.net_amount);
            $(".rcgst").text(json.rcgst);
            $(".rsgst").text(json.rsgst);
            $(".rigst").text(json.rigst);
            $(".rgst").text(json.rgst);
            $(".erf_no").text(json.erf_no);
            $(".bill_generator_name").text(json.bill_generator_name);
            $(".auth_sign_name").text(json.auth_sign_name);
            $(".auth_sign_designation").text(json.auth_sign_designation);
            $(".amount_in_words").text(json.amount_in_words);
            $(".payment_type").text(json.payment_type);

            $('#delivery-challan_view_details').modal('show');
        }
    });
}

function DeliveryChallanDelete(id,invno) {

    var con = confirm("Are you sure delete:" + invno);
    if (con == 1) {
        $.ajax({
            url: deleteurl,
            data: {id: id},
            type: "POST",
            success: function (data) {
                if (data == 1)
                {
                    location.reload();
                    $('.message').html('<div class="alert alert-success">Deleted Successfully</div>');
                }
                else
                {
                    location.reload();
                    $('.message').html('<div class="alert alert-danger">Deleted Unsuccessfull</div>');
                }
            }
        });
    }
}












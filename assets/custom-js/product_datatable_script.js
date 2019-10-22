$(function () {
    var table = $('#product').DataTable( {
        "order": [[ 0, 'desc' ]],
        "processing": true,
        "serverSide": true,
        "lengthMenu": [[10, 25, 50, 100, 500, 1000, -1], [10, 25, 50, 100, 500, 1000, "Show All"]],
        "ajax": ajaxphpurl,

    } );

    $('#product').DataTable();
    //table.column(0).visible(false);

    $('#product tbody').on("click","#btnedit",function () {
        var data = table.row($(this).parents('tr')).data();
        //alert(data[0]);
        ProductEdit(data[0]);
    });

    $('#product tbody').on("click","#btnview",function () {
        var data = table.row($(this).parents('tr')).data();
        ProductView(data[0]);
    });

    $('#product tbody').on("click","#btnadd",function () {
        var data = table.row($(this).parents('tr')).data();
        ProductAdd(data[0]);
    });


    $('#product tbody').on("click","#btnstatus",function () {
        var data = table.row($(this).parents('tr')).data();
        Status(data[0]);
    });

/*    $('#close_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });*/

function Status(id) {
    $.ajax({
        url: statusupdateurl,
        data: {id:id},
        type: 'POST',
        success: function (data) {
            if(data == 1)
            {
                location.reload();
            }
        }
    });
}


// ############################### for Multi level Select box

    $('.parent').livequery('change', function() {

        $(this).nextAll('.parent').remove();
        $(this).nextAll('label').remove();

        $('#show_sub_categories').append('<img src="loader.gif" style="float:left; margin-top:7px;" id="loader" alt="" />');

        $.post(getchildcategory, {
            parent_id: $(this).val(),
        }, function(response){

            setTimeout("finishAjax('show_sub_categories', '"+escape(response)+"')", 400);
        });

        return false;
    });

});

// ############################### for Load Multi level Select box ###############

function finishAjax(id, response){
    $('#loader').remove();

    $('#'+id).append(unescape(response));
}

// ############################### for Multi level Select box #####################

function ProductEdit(id) {


    $.ajax({
        url: editurl,
        data: {id:id},
        type: 'POST',
        success: function (data) {
            var json = $.parseJSON(data);

            $('#product_id_edit').val(json.product_id);
            $('#product_name_edit').val(json.product_name);
            $('#category_edit').selectpicker('val',json.cat_id);

            $('#price_edit').val(json.price);
            $('#hsncode_edit').val(json.hsncode);
            $('#uom_edit').selectpicker('val',json.uom);
            $('#tax_group_edit').selectpicker('val',json.tax_group_id);
            $('#reordered_level_edit').val(json.reordered_level);

            if(json.discount == 'per')
            {
                $('#discount_val_edit').val(json.discount_per);
                $('input[name="discount_edit"][value="'+json.discount+'"]').prop("checked",true);
            }
            else
            {
                $('#discount_val_edit').val(json.discount_amount);
                $('input[name="discount_edit"][value="'+ json.discount +'"]').prop("checked",true);
            }

            $('#status_product_edit').selectpicker('val',json.status);

            $('#product_modal-edit').modal('show');
        }
    });
}

function ProductView(id) {

    $.ajax({
        url: vieweurl,
        data: {id:id},
        type: "post",
        success: function (data) {
            var json = $.parseJSON(data);

            $(".product_id").text(json.product_id);
            $(".product_name").text(json.product_name);
            $(".hsncode").text(json.hsncode);
            $(".category_id").text(json.cat_desc);
            $(".uom").text(json.uom);
            $(".prodprice").text(json.price);
            $(".tax_group_id").text(json.tax_groups_desc);
            $(".reordered_level").text(json.reordered_level);
            $(".discount_amount").text(json.discount_amount);
            $(".discount_per").text(json.discount_per);
            $(".discount").text(json.discount);
            $(".status").text(json.status);

            $('#product_view_details').modal('show');
        }
    });
}
function ProductAdd(id) {

    $.ajax({
        url: addurl,
        data: {id:id},
        type: "post",
        success: function (data) {
            var json = $.parseJSON(data);

            $("#product_id_add").val(json.product_id);
            $("#product_name_add").val(json.product_name);
            $("#price_add").val(json.price);
            $("#qty_in_stock").val(json.total_qty);
            $("#total_qty").val('');
            $("#qty_add").val('')
            $('#product_modal-addstock').modal('show');

        }
    });

}


function ProductDisable(id,status) {
    alert("Disable");
    $.ajax({
        url: deleteurl,
        data: {id:id,status:status},
        type: "post",
        success: function (data) {
if(data=='success')
{
    location.href="zone";
}
        }
    });

}

function addNew() {
    $("#product_modal-add").modal("show");
}

$('#productimportbtn').click(function () {
    $('#product_import_file').modal('show');
});







function fnQtyKeyPress() {
    var stkqty=$("#qty_in_stock").val();
    var addqty=$("#qty_add").val();



    if( stkqty==''  )
    {
        var  stkqty= parseInt(addqty)
    }
    else
    {
        var  stkqty=parseInt(stkqty,10)+parseInt(addqty,10);
    }

        $("#total_qty").val(stkqty);
}


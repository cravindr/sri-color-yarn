$(function () {
    var table = $('#category').DataTable( {
        "order": [[ 0, 'desc' ]],
        "processing": true,
        "serverSide": true,
        "lengthMenu": [[10, 25, 50, 100, 500, 1000, -1], [10, 25, 50, 100, 500, 1000, "Show All"]],
       /* "ajax": ajaxphpurl,*/
        "ajax": {
            "url": ajaxphpurl,
            "dataType": "json"
        }
    } );

    $('#category').DataTable();
    //table.column(0).visible(false);

    $('#category tbody').on("click","#btnedit",function () {
        var data = table.row($(this).parents('tr')).data();
        //alert(data[0]);
        categoryEdit(data[0]);
    });

    $('#category tbody').on("click","#btnview",function () {
        var data = table.row($(this).parents('tr')).data();
        //alert(data[0]);
        categoryView(data[0]);
    });

    $('#category tbody').on("click","#btndelete",function () {
        var data = table.row($(this).parents('tr')).data();
        ZoneDisable(data[0],data[3]);
    });

/*    $('#close_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });*/


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

function categoryEdit(id) {

    $.ajax({
        url  : '',
        data : {id:id},
        type : 'POST',
        success: function (data) {

            $("#category_modal_edit").modal('show');
        }
    });
}

function categoryView(id) {
    //$("#btnsave").html('Update');
    $("#btnsave").html('View');
    $("#btnsave").attr("disabled", "disabled");

    $('#tax_zone').attr('action', updateurl);
    $("#tax_zone_form").modal("show");
    $.ajax({
        url: vieweurl,
        data: {id:id},
        type: "post",
        success: function (data) {

            var json=$.parseJSON(data);

            $("#zone_id").val(json.zone_id);
            $("#zone_desc").val(json.zone_desc);
            $("#zone_codes").selectpicker('val',json.zone_codes.split(','));
        }
    });
}


function ZoneDisable(id,status) {
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
    $('#cat_desc').val('');
    $("#btnsave").html('Save');
    $("#btnsave").removeAttr("disabled");
    $('#category_form').attr('action', saveurl);
    $("#category_modal").modal("show");
}



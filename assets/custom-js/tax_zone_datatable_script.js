$(function () {

    var table = $('#taxzone').DataTable( {
        "processing": true,
        "serverSide": true,
        "lengthMenu": [[10, 25, 50, 100, 500, 1000, -1], [10, 25, 50, 100, 500, 1000, "Show All"]],
        "ajax": ajaxphpurl
    } );

    //table.column(0).visible(false);

    $('#taxzone tbody').on("click","#btnedit",function () {
        var data = table.row($(this).parents('tr')).data();
        //alert(data[0]);
        TaxZoneEdit(data[0]);
    });

    $('#taxzone tbody').on("click","#btnview",function () {
        var data = table.row($(this).parents('tr')).data();
        //alert(data[0]);
        TaxZoneView(data[0]);
    });

    $('#taxzone tbody').on("click","#btndelete",function () {
        var data = table.row($(this).parents('tr')).data();
        ZoneDisable(data[0],data[3]);
    });

/*    $('#close_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });*/
});

function TaxZoneEdit(id) {
    $("#btnsave").html('Update');

    $("#btnsave").removeAttr("disabled");
    $('#tax_zone').attr('action', updateurl);
    $("#tax_zone_form").modal("show");
    $.ajax({
        url: vieweurl,
        data: {id:id},
        type: "post",
        success: function (data) {
        console.log(data);
        var json=$.parseJSON(data);

        $("#zone_id").val(json.zone_id);
        $("#zone_desc").val(json.zone_desc);
        $("#zone_codes").selectpicker('val',json.zone_codes.split(','));
        }
    });
}

function TaxZoneView(id) {
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
    $('#zone_codes option').attr("selected",false);
    $('#zone_codes').selectpicker('refresh');
    $('#zone_desc').val('');
    $("#btnsave").html('Save');
    $("#btnsave").removeAttr("disabled");
    $('#tax_zone').attr('action', saveurl);
    //$('#tax_zone').attr('action', updateurl);
     $("#tax_zone_form").modal("show");
}


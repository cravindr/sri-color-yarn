$(function () {
    var table = $('#tax').DataTable( {
        "processing": true,
        "serverSide": true,
        "lengthMenu": [[10, 25, 50, 100, 500, 1000, -1], [10, 25, 50, 100, 500, 1000, "Show All"]],
        "ajax": ajaxphpurl
    } );

    //table.column(0).visible(false);

    $('#tax tbody').on("click","#btnedit",function () {
        var data = table.row($(this).parents('tr')).data();
        //alert(data[0]);
        taxEdit(data[0]);
    });

    $('#tax tbody').on("click","#btnview",function () {
        var data = table.row($(this).parents('tr')).data();
        //alert(data[0]);
        taxView(data[0]);
    });

    $('#tax tbody').on("click","#btndelete",function () {
        var data = table.row($(this).parents('tr')).data();
        TaxDisable(data[0],data[4]);
    });

/*    $('#close_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });*/
});

function taxEdit(id) {

    $('#taxforms').attr('action', updateurl); // form action url
    $("#btnsave").html('Update');
    $("#btnsave").removeAttr("disabled");
    $("#tax_form").modal("show"); // modal window  name

    $.ajax({
        url: vieweurl,
        data: {id:id},
        type: "post",
        success: function (data) {
        console.log(data);
        var json=$.parseJSON(data);

        $("#tax_id").val(json.tax_id);
        $("#tax_name").val(json.tax_name);
        $("#tax_value").val(json.tax_value);
        $("#tax_zone_id").selectpicker('val',json.tax_zone_id.split(','));
        }
    });
}

function taxView(id) {

    //$("#btnsave").html('Update');
    $("#btnsave").html('View');
    $("#btnsave").attr("disabled", "disabled");

    $('#taxforms').attr('action', updateurl);   // form action url
    $("#tax_form").modal("show");              // modal window  name

    $.ajax({
        url: vieweurl,
        data: {id:id},
        type: "post",
        success: function (data) {
            console.log(data);
            var json=$.parseJSON(data);

            $("#tax_id").val(json.tax_id);
            $("#tax_name").val(json.tax_name);
            $("#tax_value").val(json.tax_value);
            $("#tax_zone_id").selectpicker('val',json.tax_zone_id.split(','));
        }
    });
}


function TaxDisable(id,status) {
    $.ajax({
        url: deleteurl,
        data: {id:id,status:status},
        type: "post",
        success: function (data) {
if(data=='success')
{
    location.href="tax";
}
        }
    });

}

function addNew() {
    $('#tax_zone_id option').attr("selected",false);
    $('#tax_zone_id').selectpicker('refresh');

    $('#tax_name').val('');
    $('#tax_value').val('');

    $("#btnsave").html('Save');

    $("#btnsave").removeAttr("disabled");

    $('#taxform').attr('action', saveurl);
    //$('#tax_zone').attr('action', updateurl);
     $("#tax_form").modal("show");
}


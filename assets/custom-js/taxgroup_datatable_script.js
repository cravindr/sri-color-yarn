$(function () {
    var table = $('#taxgroup').DataTable( {
        "processing": true,
        "lengthMenu": [[10, 25, 50, 100, 500, 1000, -1], [10, 25, 50, 100, 500, 1000, "Show All"]],
        "ajax": ajaxphpurl



    } );

    $('#taxgroup tbody').on("click","#btnedit",function () {
        var data = table.row($(this).parents('tr')).data();
         taxgroupEdit(data[0]);
    });

    $('#taxgroup tbody').on("click","#btnview",function () {
        var data = table.row($(this).parents('tr')).data();
        taxgroupView(data[0]);
    });

    $('#taxgroup tbody').on("click","#btndelete",function () {
        var data = table.row($(this).parents('tr')).data();
        TaxgroupDisable(data[0],data[3]);
    });
});

function taxgroupEdit(id) {

    $('#taxgroupforms').attr('action', updateurl); // form action url
    $("#btnsave").html('Update');
    $("#btnsave").removeAttr("disabled");
    $("#taxgroup_form").modal("show"); // modal window  name

    $.ajax({
        url: vieweurl,
        data: {id:id},
        type: "post",
        success: function (data) {
        var json=$.parseJSON(data);
        $("#taxgroup_id").val(json.tax_group_id);
        $("#taxgroup_name").val(json.tax_groups_desc);
    $("#tax_id").selectpicker('val',json.tax_id_groups.split(','));
        }
    });
}

function taxgroupView(id) {
    $("#btnsave").html('View');
    $("#btnsave").attr("disabled", "disabled");
    $('#taxgroupforms').attr('action', updateurl); // form action url
    $("#taxgroup_form").modal("show"); // modal window  name

    $.ajax({
        url: vieweurl,
        data: {id:id},
        type: "post",
        success: function (data) {
            var json=$.parseJSON(data);
            $("#taxgroup_id").val(json.tax_group_id);
            $("#taxgroup_name").val(json.tax_groups_desc);
            $("#tax_id").selectpicker('val',json.tax_id_groups.split(','));
        }
    });
}


function TaxgroupDisable(id,status) {
    $.ajax({
        url: deleteurl,
        data: {id:id,status:status},
        type: "post",
        success: function (data) {
if(data=='success')
{
    location.href="taxgroup";
}
        }
    });

}

function addNew() {
    $('#taxgroupforms').attr('action', saveurl);  //action url
    $('#tax_id option').attr("selected",false);
    $('#tax_id').selectpicker('refresh');
    $('#taxgroup_name').val('');
    $("#btnsave").html('Save');
    $("#btnsave").removeAttr("disabled");
     $("#taxgroup_form").modal("show");
}


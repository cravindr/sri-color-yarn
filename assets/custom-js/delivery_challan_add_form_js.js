$('.transport-mode-form').hide();
$(function(){
    Bundles(10,10,5);
    var count = 1;


    $('#inv_date').datetimepicker({
        defaultDate:'now',
        format: 'YYYY-MM-DD'
    });


    $('#btnaddnew').click(function () {

        var html = AddtextFields(count++);
        GetProduct();
        $('.tabledataadd').append(html);

    });

    $('.tabledataadd').on('click','#btnremovebtn', function () {
        $(this).parents('tr').remove();
        OverAllTotal();
    });

});

$('#inv_customer').on('change', function () {
    var cusid = $(this).val();
    localStorage.setItem('cus_id',cusid);
    $.post(getshipaddress, {id:cusid}, function (data) {
        var json = $.parseJSON(data);
        $('#ship_address').empty();
        $.each(json, function (i,v) {
            $('#ship_address').append('<option value="'+v.shi_id+'">'+v.shi_name+'</option>');
        });

        $("#ship_address").selectpicker("refresh");
    });
});

//product items Select script
$('.tabledataadd').on("change",".clsitems",function () {
    var cusid = $('#inv_customer').val();

    if(cusid == '')
    {
        alert("choose Customer First");
    }
    else
    {
        //alert(getproductalltaxzonedata);
        var at = $(this).attr("id");
        var thisval = $(this).val();
        var no = at.split('-')[1];
        // var cus_id = localStorage.getItem("cus_id");

        $.post(getproductalltaxzonedata,{id:thisval,cusid:cusid}, function (data) {

            var json = $.parseJSON(data);
            console.log(json);
            $('#hsncode-'+no+'').val(json[0].hsncode);
            $('#qty-'+no+'').val('1');
            $('#uom-'+no+'').val(json[0].uom);
            $('#price-'+no+'').val(json[0].price);

            $('#bundlecount-'+no+'').val('1');
            $('#nobundle-'+no+'').val('0');
            $('#hanking-'+no+'').val('0');

            var row_total = RowsTotal(no);
            $('#amt-'+no+'').val(row_total);

            OverAllTotal();
        });
    }
});


$('.tabledataadd').on('keyup','.clsbundlecount',function () {
    var at = $(this).attr("id");
    var thisval = $(this).val();
    var no = at.split('-')[1];

    var bc =  $('#bundlecount-'+no+'').val();
    var nb =  $('#nobundle-'+no+'').val();
    var h =  $('#hanking-'+no+'').val();

    var res = Bundles(bc,nb,h);
    $('#qty-'+no+'').val(res);

    var row_total = RowsTotal(no);
    $('#amt-'+no+'').val(row_total);
    OverAllTotal();

});

$('.tabledataadd').on('keyup','.clsnobuldle',function () {
    var at = $(this).attr("id");
    var thisval = $(this).val();
    var no = at.split('-')[1];

    var bc =  $('#bundlecount-'+no+'').val();
    var nb =  $('#nobundle-'+no+'').val();
    var h =  $('#hanking-'+no+'').val();

    var res = Bundles(bc,nb,h);
    $('#qty-'+no+'').val(res);

    var row_total = RowsTotal(no);
    $('#amt-'+no+'').val(row_total);
    OverAllTotal();
});

$('.tabledataadd').on('keyup','.clshanking',function () {
    var at = $(this).attr("id");
    var thisval = $(this).val();
    var no = at.split('-')[1];

    var bc =  $('#bundlecount-'+no+'').val();
    var nb =  $('#nobundle-'+no+'').val();
    var h =  $('#hanking-'+no+'').val();

    var res = Bundles(bc,nb,h);
    $('#qty-'+no+'').val(res);

    var row_total = RowsTotal(no);
    $('#amt-'+no+'').val(row_total);
    OverAllTotal();
});



function Bundles(bc,nb,h) {
    var bcres = ('1' / parseFloat(bc));
    var res = (parseFloat(bcres) * parseFloat(h)) + parseFloat(nb);
   return res.toFixed(2);
}

function RowsTotal(no) {
    var item_price = $('#price-'+no+'').val();
    var item_qty = $('#qty-'+no+'').val();
    var total = parseFloat(item_price) * parseFloat(item_qty);
    return total.toFixed(2);
}

function OverAllTotal() {
    var sum = 0;
    $(".clsamount").each(function() {
        sum += +$(this).val();
    });

    $('.amounttotal').text(sum.toFixed(2));
    $('.netamount').val(sum.toFixed(2));
}

$('#transport_mode_option').on('change', function () {
    var val = $(this).val();

    if(val == 'yes')
    {
        $('#supply_date').datetimepicker({format: 'YYYY-MM-DD'});
        $('.transport-mode-form').show();
    }
    else
    {
        $('.transport-mode-form').hide();
        $('#supply_date').val('');
    }
});

function AddtextFields(count) {
    localStorage.setItem('count',count);
    var html = '<tr>';
    html += '<td>';
    html += '<button type="button" id="btnremovebtn" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
    html += '</td>';
    html += '<td>';
    html += '<select class="selectpicker show-tick form-control clsitems" id="items-'+count+'" name="product[]" title="Product Select" data-live-search="true"></select>';
    html += '</td>';
    html += '<td>';
    html += '<input type="text" class="form-control clshsn" id="hsncode-'+count+'" name="hsn[]" readonly>';
    html += '</td>';
    html += '<td>';
    html += '<input type="text" class="form-control clsbundlecount" id="bundlecount-'+count+'" name="bundlecount[]">';
    html += '</td>';
    /*html += '<td>';
    html += '<input type="text" class="form-control clsnobuldle" id="nobundle-'+count+'" name="nobundle[]">';
    html += '</td>';
    html += '<td>';
    html += '<input type="text" class="form-control clshanking" id="hanking-'+count+'" name="hanking[]" >';
    html += '</td>';*/
    html += '<td>';
    html += '<input type="text" class="form-control clsqty" id="qty-'+count+'" name="qty[]">';
    html += '</td>';
    html += '<td>';
    html += '<input type="text" class="form-control" id="uom-'+count+'" name="uom[]" readonly>';
    html += '</td>';
    html += '<td>';
    html += '<input type="text" class="form-control clsprice" id="price-'+count+'" name="price[]">';
    html += '</td>';
    html += '<td>';
    html += '<input type="text" class="form-control clsamount" id="amt-'+count+'" name="amount[]" readonly>';
    html += '</td>';
    return html += '<tr>';

}

// product Quantity Change function
$('.tabledataadd').on("keyup",".clsqty",function () {

    var at = $(this).attr("id");
    var qty = $(this).val();
    var no = at.split('-')[1];

    var row_total = RowsTotal(no);
    $('#amt-'+no+'').val(row_total);
    OverAllTotal();
});

// product Rate Change function
$('.tabledataadd').on("keyup",".clsprice",function () {

    var at = $(this).attr("id");
    var rate = $(this).val();
    var no = at.split('-')[1];

    var row_total = RowsTotal(no);
    $('#amt-'+no+'').val(row_total);
    OverAllTotal();
});


function GetProduct() {
    $.post(getinvoiceproduct, function (data) {
        var json = $.parseJSON(data);
        var loc = localStorage.getItem('count');
        var itm = '#items-'+loc;
        $.each(json, function (i,v) {
            $(itm).append('<option value="'+v.id+'">'+v.name+'</option>');
        });
        $(itm).selectpicker('refresh');
    });
}











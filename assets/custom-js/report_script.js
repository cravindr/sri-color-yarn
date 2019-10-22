$('.transport-mode-form').hide();
$(function(){
    var count = 1;


    $('#start_date').datetimepicker({

        format: 'YYYY-MM-DD',
        useCurrent: false

    });
    $('#end_date').datetimepicker({

        format: 'YYYY-MM-DD',
        useCurrent: false
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
        var at = $(this).attr("id");
        var thisval = $(this).val();
        var no = at.split('-')[1];
       // var cus_id = localStorage.getItem("cus_id");

        $.post(getproductalltaxzonedata,{id:thisval,cusid:cusid}, function (data) {
            //alert(data);
            var json = $.parseJSON(data);

            var tax_value = json[0].tax_groups_desc.match(/\d+/);

            var taxamount = GST(json[0].price,tax_value);
            var amount = Discount(json[0].discount,json[0].discount_amount,json[0].discount_per,json[0].price);
            var totalamount = TotalAmount(amount,taxamount);

            //AmountSet(totalamount);

            $('#hsncode-'+no+'').val(json[0].hsncode);
            $('#qty-'+no+'').val('1');
            $('#uom-'+no+'').val(json[0].uom);
            $('#rate-'+no+'').val(json[0].price);
            $('#gst-'+no+'').val(json[0].tax_groups_desc);

            $('#dis_per-'+no+'').val(json[0].discount_per);
            $('#dis_amt-'+no+'').val(json[0].discount_amount);
            $('#gstamt-'+no+'').val(taxamount);
            $('#amt-'+no+'').val(totalamount);
            $('#orgamt-'+no+'').val(totalamount);
            $('#discount-'+no+'').val(json[0].discount);



            if(json.length == '2')
            {
                $('#sgst-'+no+'').val(json[0].tax_value);
                $('#cgst-'+no+'').val(json[1].tax_value);
                $('#igst-'+no+'').val('');

                var gstamount = parseFloat(taxamount)/2;
                $('#cgstamt-'+no+'').val(gstamount);
                $('#sgstamt-'+no+'').val(gstamount);
                $('#igstamt-'+no+'').val('');
            }
            else
            {
                $('#sgst-'+no+'').val('');
                $('#cgst-'+no+'').val('');
                $('#igst-'+no+'').val(json[0].tax_value);

                $('#cgstamt-'+no+'').val('');
                $('#sgstamt-'+no+'').val('');
                $('#igstamt-'+no+'').val(taxamount);
            }

            OverAllTotal();

            var valqty = $('#qty-'+no+'').val();
            var valrate = $('#rate-'+no+'').val();

            var total1 = (parseFloat(valrate) * parseFloat(valqty));
            $('#total-'+no+'').val(total1);
        });
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
    html += '<input type="text" class="form-control clsqty" id="qty-'+count+'" name="qty[]">';
    html += '</td>';
    html += '<td>';
    html += '<input type="text" class="form-control" id="uom-'+count+'" name="uom[]" readonly>';
    html += '</td>';
    html += '<td>';
    html += '<input type="text" class="form-control clsrate" id="rate-'+count+'" name="rate[]">';
    html += '</td>';
    html += '<td>';
    html += '<input type="text" class="form-control" id="dis_per-'+count+'" name="dis_per[]" readonly>';
    html += '</td>';
    html += '<td>';
    html += '<input type="text" class="form-control" id="dis_amt-'+count+'" name="dis_amt[]" readonly>';
    html += '</td>';
    html += '<td>';
    html += '<input type="text" class="form-control" id="gst-'+count+'" name="gst[]" readonly>';
    html += '</td>';
    html += '<td>';
    html += '<input type="text" class="form-control" id="gstamt-'+count+'" name="gstamt[]" readonly>';
    html += '</td>';
    html += '<td>';
    html += '<input type="text" class="form-control clsamount" id="amt-'+count+'" name="amount[]" readonly>' +
        '<input type="hidden" name="orgamt[]" id="orgamt-'+count+'">' +
        '<input type="hidden" name="discount[]" id="discount-'+count+'">' +
        '<input type="hidden" name="cgst[]" id="cgst-'+count+'">' +
        '<input type="hidden" name="sgst[]" id="sgst-'+count+'">' +
        '<input type="hidden" name="igst[]" id="igst-'+count+'">' +
        '<input type="hidden" name="cgstamt[]" id="cgstamt-'+count+'">' +
        '<input type="hidden" name="sgstamt[]" id="sgstamt-'+count+'">' +
        '<input type="hidden" name="igstamt[]" id="igstamt-'+count+'">' +
        '<input type="hidden" name="total[]" id="total-'+count+'">';
    html += '</td>';
    return html += '<tr>';

}

// product Quantity Change function
$('.tabledataadd').on("keyup",".clsqty",function () {

    var at = $(this).attr("id");
    var qty = $(this).val();
    var no = at.split('-')[1];

    var tax = $('#gst-'+no+'').val();
    var dis_per = $('#dis_per-'+no+'').val();
    var dis_amt = $('#dis_amt-'+no+'').val();
    var discount = $('#discount-'+no+'').val();
    var rate = $('#rate-'+no+'').val();
    var tax_value = tax.match(/\d+/);


    var taxamount = GST(rate,tax_value);
    var amount = Discount(discount,dis_amt,dis_per,rate);
    var total = TotalAmount(amount,taxamount);

    var totalamount =  QuantityCount(qty,total);

        $('#amt-'+no+'').val(totalamount);


        $('#gstamt-'+no+'').val(parseFloat(taxamount)*qty);

        var aftgstamt = $('#gstamt-'+no+'').val();

        $('#sgst-'+no+'').val($('#sgst-'+no+'').val());
        $('#cgst-'+no+'').val($('#cgst-'+no+'').val());
        $('#igst-'+no+'').val($('#igst-'+no+'').val());

        var igstamt = $('#igst-'+no+'').val();

        var gstamount = parseFloat(aftgstamt)/2;
        $('#cgstamt-'+no+'').val(gstamount);
        $('#sgstamt-'+no+'').val(gstamount);

        if(igstamt == '')
        {
            $('#igstamt-'+no+'').val('');
        }
        else
        {
            $('#igstamt-'+no+'').val(aftgstamt);
        }


        OverAllTotal();

    var valqty = $('#qty-'+no+'').val();
    var valrate = $('#rate-'+no+'').val();

    var total1 = (parseFloat(valrate) * parseFloat(valqty));
    $('#total-'+no+'').val(total1);

});

// product Rate Change function
$('.tabledataadd').on("keyup",".clsrate",function () {

    var at = $(this).attr("id");
    var rate = $(this).val();
    var no = at.split('-')[1];

    var tax = $('#gst-'+no+'').val();
    var dis_per = $('#dis_per-'+no+'').val();
    var dis_amt = $('#dis_amt-'+no+'').val();
    var discount = $('#discount-'+no+'').val();
    var qty =  $('#qty-'+no+'').val();
    var tax_value = tax.match(/\d+/);


    var taxamount = GST(rate,tax_value);
    var amount = Discount(discount,dis_amt,dis_per,rate);
    var total = TotalAmount(amount,taxamount);
    var totalamount =  QuantityCount(qty,total);

    $('#gstamt-'+no+'').val(taxamount);
    $('#amt-'+no+'').val(totalamount);

    OverAllTotal();

    var valqty = $('#qty-'+no+'').val();
    var valrate = $('#rate-'+no+'').val();

    var total1 = (parseFloat(valrate) * parseFloat(valqty));
    $('#total-'+no+'').val(total1);

});

function OverAllTotal() {
    var sum = 0;
    $(".clsamount").each(function() {
        sum += +$(this).val();
    });

    $('.amounttotal').text(sum);
    $('.netamount').val(sum);
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

function QuantityCount(qty,amt) {
    //var amt = localStorage.getItem("prod_amt");
    var totalamount = (parseFloat(amt) * parseFloat(qty));
    return totalamount;
}

function TotalAmount(dis_amount,tax_amount) {
    var total = '';
    return total = (parseFloat(dis_amount) + parseFloat(tax_amount));
}

function GST(price,tax) {
    var a = parseFloat(price) * parseFloat(tax);
    var total = parseFloat(a)/100;
    return total;
}

function Discount(discount,dis_amount,dis_per,prod_amount) {
    var total = '';

    if(discount != 0)
    {
        if(discount == 'flat')
        {
            total = (parseFloat(prod_amount) - parseFloat(dis_amount));
            return total;
        }
        else
        {
            var dis = (parseFloat(prod_amount) * parseFloat(dis_per)/100);
            total = (parseFloat(prod_amount) - parseFloat(dis));
            return total;
        }
    }
    else
    {
        return prod_amount;
    }
}

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



/*$('.tabledataadd').on('mouseenter', '.clsqty',function () {
    var at = $(this).attr("id");
    var thisval = $(this).val();
    var no = at.split('-')[1];

    var newamt = $('#orgamt-'+no+'').val();
   console.log(newamt);
    AmountSet(newamt);

});

function AmountSet(amt) {
    var amount = localStorage.setItem("prod_amt", amt);
    return amount;
}*/

/*function GetGST() {
    $.post(getgsttaxdata, function (data) {
        var json = $.parseJSON(data);
        var loc = localStorage.getItem('count');
        var itm = '#gst-'+loc;
        $.each(json, function (i,v) {
            $(itm).append('<option value="'+v.tax_group_id+'">'+v.tax_groups_desc+'</option>');
        });
        $(itm).selectpicker('refresh');
    });
}*/





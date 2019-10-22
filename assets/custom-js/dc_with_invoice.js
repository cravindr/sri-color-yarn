$('.transport-mode-form').hide();
$(function(){
//alert(dcnumbers);
    $('#inv_date').datetimepicker({
        defaultDate:'now',
        format: 'YYYY-MM-DD'
    });

    $('.tabledataadd').on('click','#btnremovebtn', function () {
        $(this).parents('tr').remove();
        OverAllTotal();
    });

});

$('#inv_customer').on('change', function () {
    var cusid = $(this).val();
    DcGetProduct(cusid);
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
            //console.log(json);
           // var tax_value = json[0].tax_groups_desc.match(/\d+/);
            var tax_value = json[0].tax_value;

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
            $('#amt-'+no+'').val(totalamount.toFixed(2));
            $('#orgamt-'+no+'').val(totalamount);
            $('#discount-'+no+'').val(json[0].discount);



            if(json.length == '2')
            {
                $('#sgst-'+no+'').val(json[0].tax_value);
                $('#cgst-'+no+'').val(json[1].tax_value);
                $('#igst-'+no+'').val(0);

                var gstamount = parseFloat(taxamount)/2;
                $('#cgstamt-'+no+'').val(gstamount);
                $('#sgstamt-'+no+'').val(gstamount);
                $('#igstamt-'+no+'').val(0);
            }
            else
            {
                $('#sgst-'+no+'').val(0);
                $('#cgst-'+no+'').val(0);
                $('#igst-'+no+'').val(json[0].tax_value);

                $('#cgstamt-'+no+'').val(0);
                $('#sgstamt-'+no+'').val(0);
                $('#igstamt-'+no+'').val(taxamount);
            }

            OverAllTotal();

            var valqty = $('#qty-'+no+'').val();
            var valrate = $('#rate-'+no+'').val();

            var total1 = (parseFloat(valrate) * parseFloat(valqty));
            $('#total-'+no+'').val(total1.toFixed(2));
        });
    }


});

// product Quantity Change function
$('.tabledataadd').on("keyup",".clsqty",function () {


    var at = $(this).attr("id");
    var qty = $(this).val();
    var no = at.split('-')[1];

    var tax = $('#gst-'+no+'').val();
    var rate = $('#rate-'+no+'').val();
    var tax_value = tax.match(/\d+/);


    var taxamount = GST(rate,tax_value);
    var totalamount =  QuantityCount(qty,rate);

        //GST Amount and Quantity
        var totaltaxamount = parseFloat(taxamount) * parseFloat(qty);
        $('#gstamt-'+no+'').val(totaltaxamount);

        //Total Row Amount
        var totalrowamount = parseFloat(totalamount) + parseFloat(totaltaxamount);
        $('#amt-'+no+'').val(totalrowamount.toFixed(2));

            var tax_val = $('#igst-'+no+'').val();

            if(tax_val !== '0')
            {
                $('#sgst-'+no+'').val(0);
                $('#cgst-'+no+'').val(0);
                $('#igst-'+no+'').val(tax_val);

                $('#cgstamt-'+no+'').val(0);
                $('#sgstamt-'+no+'').val(0);
                $('#igstamt-'+no+'').val(totaltaxamount);
            }
            else
            {
                $('#sgst-'+no+'').val(tax_val);
                $('#cgst-'+no+'').val(tax_val);
                $('#igst-'+no+'').val(0);

                var tax_cgst_sgst_amt = parseFloat(totaltaxamount) / 2;
                var amt_tax_sgst_cgst = tax_cgst_sgst_amt.toFixed(2);

                $('#cgstamt-'+no+'').val(amt_tax_sgst_cgst);
                $('#sgstamt-'+no+'').val(amt_tax_sgst_cgst);
                $('#igstamt-'+no+'').val(0);
            }


        OverAllTotal();

    var valqty = $('#qty-'+no+'').val();
    var valrate = $('#rate-'+no+'').val();

    var total1 = (parseFloat(valrate) * parseFloat(valqty));
    $('#total-'+no+'').val(total1.toFixed(2));

});

// product Rate Change function
$('.tabledataadd').on("keyup",".clsrate",function () {

    var at = $(this).attr("id");
    var rate = $(this).val();
    var no = at.split('-')[1];

    var tax = $('#gst-'+no+'').val();
    var qty =  $('#qty-'+no+'').val();
    var tax_value = tax.match(/\d+/);


    var taxamount = GST(rate,tax_value);
    var totalamount =  QuantityCount(qty,rate);

    //GST Amount and Quantity
    var totaltaxamount = parseFloat(taxamount) * parseFloat(qty);

    $('#gstamt-'+no+'').val(totaltaxamount);

    //Total Row Amount
    var totalrowamount = parseFloat(totalamount) + parseFloat(totaltaxamount);
    $('#amt-'+no+'').val(totalrowamount.toFixed(2));

    var tax_val = $('#igst-'+no+'').val();

    if(tax_val !== '0')
    {
        $('#sgst-'+no+'').val(0);
        $('#cgst-'+no+'').val(0);
        $('#igst-'+no+'').val(tax_val);

        $('#cgstamt-'+no+'').val(0);
        $('#sgstamt-'+no+'').val(0);
        $('#igstamt-'+no+'').val(totaltaxamount);
    }
    else
    {
        $('#sgst-'+no+'').val(tax_val);
        $('#cgst-'+no+'').val(tax_val);
        $('#igst-'+no+'').val(0);

        var tax_cgst_sgst_amt = parseFloat(totaltaxamount) / 2;
        var amt_tax_sgst_cgst = tax_cgst_sgst_amt.toFixed(2);

        $('#cgstamt-'+no+'').val(amt_tax_sgst_cgst);
        $('#sgstamt-'+no+'').val(amt_tax_sgst_cgst);
        $('#igstamt-'+no+'').val(0);
    }

    OverAllTotal();

    var valqty = $('#qty-'+no+'').val();
    var valrate = $('#rate-'+no+'').val();

    var total1 = (parseFloat(valrate) * parseFloat(valqty));
    $('#total-'+no+'').val(total1.toFixed(2));

});

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

function DcGetProduct(cusid) {
    var dc_no = [];
    $('#dc_no').find('option').remove();
    $.post(dcwiseinvoiceget, {cusid:cusid}, function (data) {
        var json = $.parseJSON(data);
       $.each(json, function (i,v) {
           $('#dc_no').append('<option value="'+v.inv_no+'">'+v.inv_no+'- Ref.No ['+v.ref_no+']</option>');
       });
        $('#dc_no').selectpicker('refresh');
    });

}

$('#dc_no').on('change', function() {
    var values = $(this).find('option:selected').map(function() {
        return this.value;
    }).get();

    $.post(dcnumbers, {dcnum:values}, function (data) {
        var count = 1;
        var json = $.parseJSON(data);
        $('#productinv').find('.tabledataadd > tr').remove();
        $.each(json,function (i,v) {
            var html = AddtextFields(count++,v);
            $('.tabledataadd').append(html);
            OverAllTotal();
        });

    });
});

function AddtextFields(count,v) {
    //console.log(v);
    localStorage.setItem('count',count);
    var tax_value = v.tax_groups_desc;
    var tax_per = tax_value.split('GST')[1];
    var tax = tax_per.split('%');
    var tax_val = tax.join("");


    var gstamount = GST(v.price,tax_val);
    var qtywithamount = QuantityCount(v.qty,v.price);

    //Total Row Amount
    var totalrowamount = parseFloat(qtywithamount) + parseFloat(gstamount);


    var cusid = $('#inv_customer').val();


    $.post(taxdetailswithvalues,{cusid:cusid,tax_group_id:v.tax_group_id}, function (data) {
        var json = $.parseJSON(data);

       $.each(json,function (i,d) {
           var taxname = d.tax_name;
           var gettaxname = taxname.startsWith("IGST");

          if(gettaxname == true)
          {
              var qtywithamount = QuantityCount(v.qty,v.price);
              var gstamount = GST(qtywithamount,tax_val);

              $('#sgst-'+count+'').val(0);
              $('#cgst-'+count+'').val(0);
              $('#igst-'+count+'').val(d.tax_value);

              $('#cgstamt-'+count+'').val(0);
              $('#sgstamt-'+count+'').val(0);
              $('#igstamt-'+count+'').val(gstamount);

              $('#gstamt-'+count+'').val(gstamount);
		$('#total-'+count+'').val(qtywithamount);

              var totalrowamount = parseFloat(qtywithamount) + parseFloat(gstamount);
              $('#amt-'+count+'').val(totalrowamount);
              OverAllTotal();
          }
          else
          {

              var qtywithamount = QuantityCount(v.qty,v.price);
              var scst_cgst_amt = GST(qtywithamount,d.tax_value);
              //var totaltaxamount = parseFloat(scst_cgst_amt)*2;


              $('#sgst-'+count+'').val(d.tax_value);
              $('#cgst-'+count+'').val(d.tax_value);
              $('#igst-'+count+'').val(0);

              $('#cgstamt-'+count+'').val(scst_cgst_amt);
              $('#sgstamt-'+count+'').val(scst_cgst_amt);
              $('#igstamt-'+count+'').val(0);

              var gstamt_row = parseFloat($('#cgstamt-'+count+'').val()) + parseFloat($('#sgstamt-'+count+'').val())
              $('#gstamt-'+count+'').val(gstamt_row);
		$('#total-'+count+'').val(qtywithamount);
              var totalrowamount = parseFloat(qtywithamount) + parseFloat(gstamt_row);
              $('#amt-'+count+'').val(totalrowamount);
              OverAllTotal();

          }
       });
    });


    var html = '<tr>';
    html += '<td>';
    html += '<button type="button" id="btnremovebtn" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
    html += '</td>';
    html += '<td>';
    html += '<input class="form-control clsitems" id="items-'+count+'" name="product[]" value="'+v.prod_desc+'">';
    html += '</td>';
    html += '<td>';
    html += '<input type="text" class="form-control clshsn" id="hsncode-'+count+'" name="hsn[]" value="'+v.hsn_code+'" readonly>';
    html += '</td>';
    html += '<td>';
    html += '<input type="text" class="form-control clsqty" id="qty-'+count+'" name="qty[]" value="'+v.qty+'">';
    html += '</td>';
    html += '<td>';
    html += '<input type="text" class="form-control" id="uom-'+count+'" name="uom[]" value="'+v.uom+'" readonly>';
    html += '</td>';
    html += '<td>';
    html += '<input type="text" class="form-control clsrate" id="rate-'+count+'" value="'+v.price+'" name="rate[]">';
    html += '</td>';
    html += '<td>';
    html += '<input type="text" class="form-control" id="gst-'+count+'" name="gst[]"  value="'+tax_per+'" readonly>';
    html += '</td>';
    html += '<td>';
    html += '<input type="text" class="form-control" id="gstamt-'+count+'" name="gstamt[]" readonly>';
    html += '</td>';
    html += '<td>';
    html += '<input type="text" class="form-control clsamount" id="amt-'+count+'" name="amount[]" readonly>' +
        '<input type="hidden" name="product_id[]" id="product_id-'+count+'" value="'+v.product_id+'">' +
        '<input type="hidden" name="orgamt[]" id="orgamt-'+count+'" value="'+v.price+'">' +
        '<input type="hidden" name="bundlecount[]" id="bundlecount-'+count+'" value="'+v.bundle_count+'">' +
        '<input type="hidden" name="nobundle[]" id="nobundle-'+count+'" value="'+v.no_of_bundle+'">' +
        '<input type="hidden" name="hanking[]" id="hanking-'+count+'" value="'+v.hanking+'">' +
        '<input type="hidden" name="ref_no[]" id="ref_no-'+count+'" value="'+v.ref_no+'">' +
        '<input type="hidden" name="cgst[]" id="cgst-'+count+'">' +
        '<input type="hidden" name="sgst[]" id="sgst-'+count+'">' +
        '<input type="hidden" name="igst[]" id="igst-'+count+'">' +
        '<input type="hidden" name="cgstamt[]" id="cgstamt-'+count+'">' +
        '<input type="hidden" name="sgstamt[]" id="sgstamt-'+count+'">' +
        '<input type="hidden" name="igstamt[]" id="igstamt-'+count+'">' +
        '<input type="hidden" name="dcnumber[]" id="dcnumber-'+count+'" value="'+v.inv_no+'">' +
        '<input type="hidden" name="total[]" id="total-'+count+'">';
    html += '</td>';
    return html += '<tr>';

}







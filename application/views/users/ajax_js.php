<script>

$('#country').on('change',function () {

    var cont = $(this).val();

    $.ajax({
        url : "<?php echo site_url('welcome/loadstate'); ?>",
        data: {id:cont},
        type: 'POST',
        success: function (data) {
            var html = LoadState(data);
            $('.loadstate').html(html);
            $('#state').selectpicker('refresh');
        }
    });
});

function LoadState(data) {
    var json = $.parseJSON(data);

  var html = '<select id="state" name="state[]" multiple class="selectpicker form-control validate[required]">';
                $.each(json,function (i,v) {
                html += "<option value='"+ v.zone_id +"'>"+ v.name+ "</option>";
             });

 return html += '<select>'
}

$(function () {
  $("#validate").validationEngine();
})

</script>
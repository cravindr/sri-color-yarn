
$(document).ready(function() {
    $('#supplierreport').dataTable({
        "order": [[ 0, 'desc' ]],
        "scrollX": true,

        "processing": true,
      //  "serverSide": true,
        "lengthMenu": [[10, 25, 50, 100, 500, 1000, -1], [10, 25, 50, 100, 500, 1000, "Show All"]],

        "ajax": ajaxphpurl,
        "dom": 'lBfrtip',
        "buttons": [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],

        "oLanguage": {

            "sZeroRecords": "No records to display"
        }

    });



});


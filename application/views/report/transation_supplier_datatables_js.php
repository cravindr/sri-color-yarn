
<script>
    $(document).ready(function() {
        $('#suppliertrans').dataTable({
            "order": [[ 0, 'desc' ]],
            "scrollX": true,

            "processing": true,
            //  "serverSide": true,
            "lengthMenu": [[10, 25, 50, 100, 500, 1000, -1], [10, 25, 50, 100, 500, 1000, "Show All"]],

            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;

                // converting to interger to find total
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                // computing column Total of the complete result
                var debit = api
                    .column( 3 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                var credit = api
                    .column( 4 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );


                // Update footer by showing the total with the reference of the column index
                $( api.column( 2 ).footer() ).html('Total');
                $( api.column( 3 ).footer() ).html(debit);
                $( api.column( 4 ).footer() ).html(credit);
            },

            "ajax": '<?php echo site_url("report/suppliertransationserverside/".$sup_id."/".$start_date."/".$end_date."/") ?>',
            "dom": 'lBfrtip',
            "buttons": [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],

            "oLanguage": {

                "sZeroRecords": "No records to display"
            }

        });
    });
</script>
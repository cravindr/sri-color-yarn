<div class="row">
    <?php echo $message; ?>
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Supplier Transation List</small></h2>
            <!--<a class="btn btn-info pull-right" href="<?php /*echo site_url('tax/zone_create'); */?>"><i class="fa fa-plus" aria-hidden="true"></i> Add Tax Zone</a>-->

            <div class="clearfix"></div>
        </div>
        <div class="x_content table-responsive">

            <table id="suppliertrans" class="table table-striped table-bordered bulk_action employee">
                <thead>
                <tr>
                    <th width="10%">Trans Id</th>
                    <th width="10%">Date</th>
                    <th width="10%">Description</th>

                    <th width="10%">Debit</th>
                    <th width="10%">Credit</th>
                    <th width="15%">Total Amount</th>
                </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

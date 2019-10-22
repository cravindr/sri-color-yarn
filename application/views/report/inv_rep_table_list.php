<div class="row">
    <?php echo $message; ?>
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Invoice List</small></h2>
            <!--<a class="btn btn-info pull-right" href="<?php /*echo site_url('tax/zone_create'); */?>"><i class="fa fa-plus" aria-hidden="true"></i> Add Tax Zone</a>-->

            <div class="clearfix"></div>
        </div>
        <div class="x_content table-responsive">

            <table id="product" class="table table-striped table-bordered bulk_action employee">
                <thead>
                <tr>
                    <th width="5%"> S.no</th>
                    <th width="10%"> Invoice NO</th>
                    <th width="10%">Customer Name</th>
                    <th width="10%">Date</th>
                    <th width="10%">Total Amount</th>
                    <th width="10%">CGST</th>
                    <th width="10%">SGST</th>
                    <th width="10%">IGST</th>
                    <th width="10%">GST</th>
                    <th width="15%">Net Amount</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div class="row">
    <?php echo $message; ?>
    <div class="message"></div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Delivery Challan List</small></h2>
            <a class="btn btn-info pull-right" href="<?php echo site_url('invoice/newdeliverychallan'); ?>"><i class="fa fa-plus" aria-hidden="true"></i> New Delivery Challan</a>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <table id="delivery-challan" class="table table-striped table-bordered bulk_action employee">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Invoice No</th>
                    <th>Date</th>
                    <th>Company Name</th>
                    <th>Amount</th>
                    <th>State</th>
                    <th width="15%">Action</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>


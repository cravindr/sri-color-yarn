<div class="row">
    <?php echo $message; ?>
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Customer List</small></h2>
            <a class="btn btn-info pull-right" href="<?php echo site_url('customer/newcustomer'); ?>"><i class="fa fa-plus" aria-hidden="true"></i> Add Customer</a>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <table id="customer" class="table table-striped table-bordered bulk_action employee">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Company Name</th>
                    <th>Mobile No</th>
                    <th>Place</th>
                    <th>Status</th>
                    <th width="15%">Action</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>


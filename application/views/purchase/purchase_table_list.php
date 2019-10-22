<div class="row">
    <?php echo $message; ?>
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Product Purchase List</small></h2>
            <button type="button" id="purchaseimportbtn" class="btn btn-primary pull-right">Import</button>
            <a class="btn btn-info pull-right" href="#" data-toggle="modal" data-target="#purchase_modal-add"><i class="fa fa-plus" aria-hidden="true"></i> New Purchase</a>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <table id="purchase" class="table table-striped table-bordered bulk_action employee">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Prod ID</th>
                    <th>HSN Code</th>
                    <th>Product Name</th>
                    <th>Stock</th>
                    <th>Purchase No</th>
                    <th>Created At</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>


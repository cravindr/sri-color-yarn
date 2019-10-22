<div class="row">
    <?php echo $message; ?>
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Tax  List</small></h2>
            <!--<a class="btn btn-info pull-right" href="<?php /*echo site_url('tax/zone_create'); */?>"><i class="fa fa-plus" aria-hidden="true"></i> Add Tax Zone</a>-->
            <button class="btn btn-info pull-right" onclick="addNew();" ><i class="fa fa-plus" aria-hidden="true"></i> Add Tax </button>
            <div class="clearfix"></div>
        </div>
        <div class="x_content table-responsive">

            <table id="tax" class="table table-striped table-bordered bulk_action employee">
                <thead>
                <tr>
                    <th width="5%">ID</th>
                    <th width="25%">Tax Name</th>
                    <th width="10%">Tax Vaue</th>
                    <th width="30%">Tax Zone</th>
                    <th width="15%">Status</th>
                    <th width="15%">Action</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

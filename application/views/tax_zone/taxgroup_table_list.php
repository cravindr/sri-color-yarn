<div class="row">
    <?php echo $message; ?>
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Tax Group  List</small></h2>
            <!--<a class="btn btn-info pull-right" href="<?php /*echo site_url('tax/zone_create'); */?>"><i class="fa fa-plus" aria-hidden="true"></i> Add Tax Zone</a>-->
            <button class="btn btn-info pull-right" onclick="addNew();" ><i class="fa fa-plus" aria-hidden="true"></i> Add Tax Group </button>
            <div class="clearfix"></div>
        </div>
        <div class="x_content table-responsive">

            <table id="taxgroup" class="table table-striped table-bordered bulk_action employee">
                <thead>
                <tr>
                    <th width="5%">Tax Group ID</th>
                    <th width="25%">Tax Group Name</th>
                    <th width="40%">Tax Groups</th>
                    <th width="10%">Status</th>
                    <th width="20%">Action</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

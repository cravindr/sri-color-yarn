<!-- Modal -->
<div id="tax_form" class="modal fade" role="dialog">
    <div class="modal-dialog ">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tax </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form  id="taxforms" name="taxforms"  class="form-horizontal form-label-left input_mask" method="post" enctype="multipart/form-data" action="<?php echo site_url('tax/tax_create');?>">
                        <input type="hidden" name="tax_id" id="tax_id" value="">
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Tax Name</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input name="tax_name" id="tax_name" class="date-picker form-control col-md-7 col-xs-12 complient_id" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Tax Value</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input name="tax_value" id="tax_value" class="date-picker form-control col-md-7 col-xs-12 complient_id" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Tax Zone</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">

                                <select name="tax_zone_id" id="tax_zone_id" class="form-control selectpicker show-tick"  title="Select Your Tax Zone">
                                    <?php

                                    foreach ($taxzone   as $v)
                                    {
                                        echo "<option value='$v->zone_id'>$v->zone_desc</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <!--<div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Close Date</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input name="close_date" id="close_date" class="date-picker form-control col-md-7 col-xs-12 close_date" type="text" >
                            </div>
                        </div>-->
                        <button id="btnsave" class="btn btn-success pull-right" >Update</button>
                    </form>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<!--/Modal -->


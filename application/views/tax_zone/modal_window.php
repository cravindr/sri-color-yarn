<!-- Modal -->
<div id="tax_zone_form" class="modal fade" role="dialog">
    <div class="modal-dialog ">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tax Zone</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form  id="tax_zone" name="tax_zone"  class="form-horizontal form-label-left input_mask" method="post" enctype="multipart/form-data" action="<?php echo site_url('tax/zone_create');?>">
                        <input type="hidden" name="zone_id" id="zone_id" value="">
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Zone Description</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input name="zone_desc" id="zone_desc" class="date-picker form-control col-md-7 col-xs-12 complient_id" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Status</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <select name="zone_codes[]" id="zone_codes" class="form-control selectpicker show-tick" multiple data-actions-box="true" title="Select Your State">
                                    <?php
                                    foreach ($state   as $v)
                                    {
                                        echo "<option value='$v->statecode'>$v->name</option>";
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


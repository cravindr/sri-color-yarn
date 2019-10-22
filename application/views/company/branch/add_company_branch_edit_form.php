<!-- Modal -->
<div id="company_branch_edit_form" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Company Branch</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal form-label-left input_mask" method="post" enctype="multipart/form-data" action="<?php echo site_url('company/companybranchupdate');?>">
                    <div class="col-lg-6 col-md-6 col-xs-12">

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Company Name</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="hidden" name="branch_id" id="branch_id">
                                <input name="comp_name" id="comp_name" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Enter Company Name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Email Id</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input name="comp_email" id="comp_email" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Enter Company Email">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Mobile No</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input name="comp_mobile" id="comp_mobile" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Enter Company Mobile">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Mobile No 2</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input name="comp_mobile2" id="comp_mobile2" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Enter Company Mobile Others eg:9688007350,9942346409">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Phone</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input name="comp_phone" id="comp_phone" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Enter Company Phone">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Address 1</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input name="comp_address1" id="comp_address1" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Enter Company Street 1">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Address 2</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input name="comp_address2" id="comp_address2" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Enter Company Street 2">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Place</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input name="comp_place" id="comp_place" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Enter Company Place">
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12">

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">City</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input name="comp_city" id="comp_city" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Enter Company City">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Country</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input name="comp_country" id="comp_country" class="date-picker form-control col-md-7 col-xs-12" type="text" value="India">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">State</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select name="comp_state" id="comp_state" class="form-control selectpicker" title="Select Your State">
                                    <?php
                                    foreach ($state as $v)
                                    {
                                        echo "<option value='$v->name'>$v->name</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">State Code</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input name="comp_state_Code" id="comp_state_Code" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Enter the State Code">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Pin Code</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input name="comp_pin_code" id="comp_pin_code" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Enter the Pin Code">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Company Website</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input name="comp_website" id="comp_website" class="date-picker form-control col-md-7 col-xs-12" type="text"
                                       placeholder="Enter the Company Website Url">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">GSTIN Code</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input name="comp_gstin_code" id="comp_gstin_code" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Enter the GSTIN Code">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Company Logo</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input name="comp_logo" id="comp_logo" class="date-picker form-control col-md-7 col-xs-12" type="file">
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="pull-right">
                                <button type="submit" class="btn btn-success">Update</button>
                                <button type="submit" class="btn btn-default">Discard</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

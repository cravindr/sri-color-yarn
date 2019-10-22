<div class="row">
    <div class="col-md-12 col-lg-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>New Supplier</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <form class="form-horizontal form-label-left input_mask" method="post" enctype="multipart/form-data" action="<?php echo site_url('supplier/suppliersave');?>">
                        <div class="col-lg-6 col-md-6 col-xs-12">

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Supplier Name</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input name="sup_name" id="sup_name" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Enter Supplier Name">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Company Name</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input name="sup_company_name" id="sup_company_name" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Enter Company Name">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Email Id</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input name="sup_email" id="sup_email" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Enter Supplier Email">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Mobile No</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input name="sup_mobile" id="sup_mobile" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Enter Supplier Mobile">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Mobile No 2</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input name="sup_mobile2" id="sup_mobile2" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Enter Supplier Mobile Others eg:9688007350,9942346409">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Phone</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input name="sup_phone" id="sup_phone" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Enter Supplier Phone">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Address 1</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input name="sup_address1" id="sup_address1" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Enter Supplier Street 1">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Address 2</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input name="sup_address2" id="sup_address2" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Enter Supplier Street 2">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Place</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input name="sup_place" id="sup_place" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Enter Supplier Place">
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-6 col-md-6 col-xs-12">

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">City</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input name="sup_city" id="sup_city" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Enter Supplier City">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Country</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input name="sup_country" id="sup_country" class="date-picker form-control col-md-7 col-xs-12" type="text" value="India">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">State</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select name="cus_state" id="cus_state" class="form-control selectpicker" title="Select Your State">
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
                                    <input name="cus_state_code" id="cus_state_code" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Enter the State Code">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Pin Code</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input name="sup_pin_code" id="sup_pin_code" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Enter the Pin Code">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Website</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input name="sup_website" id="sup_website" class="date-picker form-control col-md-7 col-xs-12" type="text"
                                           placeholder="Enter the Supplier Website Url">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">GSTIN Code</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input name="sup_gstin_code" id="sup_gstin_code" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Enter the GSTIN Code">
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-success">Save</button>
                                    <button type="submit" class="btn btn-default">Discard</button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

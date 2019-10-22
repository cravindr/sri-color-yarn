<div class="row">
    <div class="col-md-12 col-lg-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>New Customer</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <form class="form-horizontal form-label-left input_mask" method="post" enctype="multipart/form-data" action="<?php echo site_url('customer/customersave');?>">
                        <div class="col-lg-6 col-md-6 col-xs-12">

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Customer Name</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input name="cus_name" id="cus_name" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Enter Customer Name">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Company Name</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input name="cus_company_name" id="cus_company_name" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Enter Company Name">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Email Id</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input name="cus_email" id="cus_email" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Enter Customer Email">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Mobile No</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input name="cus_mobile" id="cus_mobile" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Enter Customer Mobile">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Mobile No 2</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input name="cus_mobile2" id="cus_mobile2" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Enter Customer Mobile Others eg:9688007350,9942346409">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Phone</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input name="cus_phone" id="cus_phone" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Enter Customer Phone">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Address 1</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input name="cus_address1" id="cus_address1" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Enter Customer Street 1">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Address 2</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input name="cus_address2" id="cus_address2" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Enter Customer Street 2">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Place</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input name="cus_place" id="cus_place" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Enter Customer Place">
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-6 col-md-6 col-xs-12">

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">City</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input name="cus_city" id="cus_city" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Enter Customer City">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Country</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input name="cus_country" id="cus_country" class="date-picker form-control col-md-7 col-xs-12" type="text" value="India">
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
                                    <input name="cus_pin_code" id="cus_pin_code" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Enter the Pin Code">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Website</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input name="cus_website" id="cus_website" class="date-picker form-control col-md-7 col-xs-12" type="text"
                                           placeholder="Enter the Customer Website Url">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">GSTIN Code</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input name="cus_gstin_code" id="cus_gstin_code" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Enter the GSTIN Code">
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

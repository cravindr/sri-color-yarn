<div class="row">
    <?php echo $message; ?>
</div>
<div class="row">
    <div class="col-md-12 col-lg-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>New Purchase</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <form class="form-horizontal form-label-left input_mask" method="post" enctype="multipart/form-data" action="<?php echo site_url('purchase/purchaseinvoicesave');?>">
                        <div class="col-lg-6 col-md-6 col-xs-12">

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Purchase No</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input name="invoice_no" id="invoice_no" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Enter Invoice Number">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Customer</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select name="inv_customer" id="inv_customer" class="form-control selectpicker show-tick" data-live-search="true" title="Choose Customer">
                                        <?php
                                        foreach ($getcustomer as $v)
                                        {
                                            echo "<option value='$v->cus_id'>$v->cus_name</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Payment</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select name="inv_payment_option" id="inv_payment_option" class="form-control selectpicker show-tick" title="Choose Payment Option">
                                        <?php
                                        foreach ($payment_option as $v)
                                        {
                                            echo "<option value='$v->pay_name'>$v->pay_name</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>


                        </div>

                        <div class="col-lg-6 col-md-6 col-xs-12">

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Date</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input name="inv_date" id="inv_date" class="date-picker form-control col-md-7 col-xs-12" type="text">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Shipping</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select name="ship_address" id="ship_address" class="form-control selectpicker" title="Choose Shipping Address">
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Transport Mode Option</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select name="transport_mode_option" id="transport_mode_option" class="form-control selectpicker show-tick" title="Choose Transport Mode Option">
                                        <option value="yes">YES</option>
                                        <option value="no">NO</option>
                                    </select>

                                    <div class="transport-mode-form">
                                        <div class="form-group">
                                            <label>Transport Mode</label>
                                            <input type="text" name="trans_mode" id="trans_mode" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Vehicle No</label>
                                            <input type="text" name="vehicle_no" id="vehicle_no" class="form-control" placeholder="Enter the Vehicle No">
                                        </div>
                                        <div class="form-group">
                                            <label>Date of Supply</label>
                                            <input type="text" name="supply_date" id="supply_date" class="form-control" placeholder="Enter the Supply Date">
                                        </div>
                                        <div class="form-group">
                                            <label>Place of Supply</label>
                                            <input type="text" name="place_supply" id="place_supply" class="form-control" placeholder="Enter the Supply Place">
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>
                        <hr>
                        <div class="row" style="padding-top:170px">
                            <div class="col-lg-12 col-md-12">

                                <div class="form-group">
                                    <table id="productinv" class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th width="0.5%"></th>
                                            <th width="30%">Item Description &nbsp;<a href="" data-toggle="modal" data-target="#product_modal" title="New Product"><i class="fa fa-plus-circle" aria-hidden="true"></i></a></th>
                                            <th width="7%">HSN Code</th>
                                            <th width="7%">Quantity</th>
                                            <th width="6%">Uom</th>
                                            <th width="8%">Rate</th>
                                            <th width="6%">Dic.(%)</th>
                                            <th width="6%">Dic Rate</th>
                                            <th width="8%">GST(%)</th>
                                            <th width="7%">GST Rate</th>
                                            <th>Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody class="tabledataadd">
                                        </tbody>
                                    </table>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-1">
                                            <button type="button" id="btnaddnew" class="btn btn-primary">Add New</button>
                                        </div>
                                        <div class="totalamount col-lg-offset-6 col-lg-5">
                                            <div class="row">
                                                <div class="col-lg-offset-5 col-lg-7">
                                                    <table width="100%" class="table table-bordered">
                                                        <tbody>
                                                        <tr>
                                                            <td width="45%"><b class="pull-right">Total</b></td>
                                                            <td width="60%">
                                                                <b class="amounttotal"></b>
                                                                <input type="hidden" name="netamount" id="netamount" class="netamount">
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-success">Save and Print</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

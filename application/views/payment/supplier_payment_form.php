<div class="row">
    <?php echo $message;
     //print_r($customer); exit; 
    ?>
</div>
<div class="row">
    <div class="col-md-offset-3 col-md-6 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Supplier Payment Form</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form id="payment_form" class="form-horizontal form-label-left input_mask" method="post" enctype="multipart/form-data" action="<?php  echo site_url('payment/supplierpaymentsave'); ?>">

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Supplier Name</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select name="sup_id" id="sup_id"  class="selectpicker form-control show-tick validate[required]" data-live-search="true"  title="Select Supplier Name">
                                    <?php

                                    foreach($supplier as $v)
                                    {
                                        echo "<option value='$v->sup_id'>".$v->sup_compnay_name."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Description</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" name="description" id="description" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Supplier Inv No</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" name="inv_no" id="inv_no" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Amount</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" name="amount" id="amount" class="form-control validate[required]">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Payemnt Option</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select name="payment_option" id="payment_option"  class="selectpicker form-control show-tick validate[required]" data-live-search="true"  title="Select Supplier Payment Option">
                                   <option value="credit" selected>Credit</option>
                                   <option value="debit">Debit</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Date</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" name="date" id="date" class="form-control validate[required]">
                            </div>
                        </div>

                        <div class="form-group">
                            <button  type="submit" value="submit" class="btn btn-primary pull-right">Submit</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <?php echo $message; ?>
</div>
<div class="row">
    <div class="col-md-12 col-lg-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Supplier Transation</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                   <!-- <form class="form-horizontal form-label-left input_mask" method="post" enctype="multipart/form-data" action="<?php /*echo site_url('report/generate');*/?>">-->
                    <form class="form-horizontal form-label-left input_mask" method="post" enctype="multipart/form-data" action="<?php echo site_url('report/suppliertransation');?>">
                        <div class="col-lg-offset-3 col-lg-5 col-md-offset-3 col-md-5 col-xs-12">

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Start Date</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input name="start_date" id="start_date" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Start Date" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">End Date</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input name="end_date" id="end_date" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="End Date" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Supplier</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select name="sup_id" id="sup_id" class="form-control selectpicker show-tick" data-live-search="true" title="Choose Customer">
                                        <?php
                                        foreach ($getsupplier as $v)
                                        {
                                            echo "<option value='$v->sup_id'>$v->sup_compnay_name</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <button class="btn btn-success pull-right"><i class="fa fa-bar-chart" aria-hidden="true"></i> Generate Report</button>
                                </div>
                            </div>

                        </div>

                        <!--<div class="col-lg-6 col-md-6 col-xs-12">

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">End Date</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input name="end_date" id="end_date" class="date-picker form-control col-md-7 col-xs-12" type="text">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <button class="btn btn-success pull-right"><i class="fa fa-bar-chart" aria-hidden="true"></i> Generate Report</button>
                                </div>
                            </div>

                            <div class="form-group" HIDDEN>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Shipping</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select name="ship_address" id="ship_address" class="form-control selectpicker" title="Choose Shipping Address">
                                    </select>
                                </div>
                            </div>



                        </div>-->
                        <hr>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>



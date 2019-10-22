<!-- Modal -->
<div id="purchase_modal-add" class="modal fade" role="dialog">
    <div class="modal-dialog ">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">New Purchase</h4>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="container">

                        <form id="product_form" name="product_form" class="form-horizontal"  method="post" action="<?php echo site_url('purchase/savepurchase');  ?>" enctype="multipart/form-data">
                            <input type="hidden" name="product_id" id="product_id">

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12">Product Quantity</label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <input name="product_qty" id="product_qty" class="date-picker form-control col-md-7 col-xs-12 product_name" type="text">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12">Total Price</label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <input name="product_tot_price" id="product_tot_price" class="date-picker form-control col-md-7 col-xs-12 product_name" type="text">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12">Product Name</label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <input name="product_name" id="product_name" class="date-picker form-control col-md-7 col-xs-12 product_name" type="text">
                                </div>
                            </div>

                            <div class="form-group">

                                <label class="control-label col-md-4 col-sm-4 col-xs-12">Category Name</label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <select name="category" id="category" class="form-control selectpicker show-tick"  title="Select Category">

                                        <?php
                                        foreach($category as $v)
                                        {
                                            echo "<option value='$v->cat_id'> $v->result</option>";
                                        }
                                        ?>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12">Price</label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <input name="price" id="price" class= "form-control col-md-7 col-xs-12 " type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12">HSN Code</label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <input name="hsncode" id="hsncode" class= "form-control col-md-7 col-xs-12 " type="text">
                                </div>
                            </div>

                            <div class="form-group">

                                <label class="control-label col-md-4 col-sm-4 col-xs-12">UOM</label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <select name="uom" id="uom" class="form-control selectpicker show-tick"  title="Select UOM">

                                        <?php

                                        foreach ($uom as $v)
                                        {
                                            echo "<option value='$v->uom_desc'>$v->uom_desc</option>";
                                        }

                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">

                                <label class="control-label col-md-4 col-sm-4 col-xs-12">Tax Group</label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <select name="tax_group" id="tax_group" class="form-control selectpicker show-tick"   title="Select Tax Group">
                                        <!--<option value="0">Please Select Tax Group</option>-->
                                        <?php

                                        foreach($taxgroup as $v)
                                        {
                                            echo "<option value='$v->tax_group_id'> $v->tax_groups_desc</option>";
                                        }


                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12">Reordered Level</label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <input name="reordered_level" id="reordered_level" class= "form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">

                                <label class="control-label col-md-4 col-sm-4 col-xs-12">Discount</label>
                                <div class="col-md-4 col-sm-8 col-xs-12">
                                    <input name="discount_val" id="discount_val" class= "form-control col-md-7 col-xs-12" type="text">
                                </div>
                                <div class="col-md-4 col-sm-8 col-xs-12">
                                    <div class="form-group">
                                        <input name="discount" class="flat col-md-4" id="discount" type="radio"  value="flat">
                                        <label for="radio100">Flat</label>

                                        <input name="discount" class="flat col-md-offset-1 col-md-6" type="radio" id="discount" value="per">
                                        <label for="radio100">Percentage</label>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">

                                <label class="control-label col-md-4 col-sm-4 col-xs-12">Status</label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <select name="status_product" id="status_product" class="form-control selectpicker show-tick"   title="Select Product Status">
                                        <!--<option value="0">Please Select Tax Group</option>-->
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">

                                <div class="col-md-12 col-sm-8 col-xs-12">
                                    <button id="btnsave"  type="submit" class="btn btn-success pull-right" >Save</button>
                                </div>
                            </div>





                        </form>

                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<!--/Modal -->

<!-- Modal -->
<div id="purchase_import_file" class="modal fade" role="dialog">
    <div class="modal-dialog ">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Import Purchase</h4>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="container">

                        <form id="product_form" name="product_form" class="form-horizontal"  method="post" action="<?php echo site_url('product/importproducttodatabase');  ?>" enctype="multipart/form-data">

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12">Choose File</label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <input type="file" name="purchaseexcelfile" id="purchaseexcelfile" class="form-control">
                                </div>
                            </div>
                        </form>

                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<!--/Modal -->
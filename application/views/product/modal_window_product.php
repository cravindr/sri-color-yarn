
<!-- Modal -->
<div id="product_modal-add" class="modal fade" role="dialog">
    <div class="modal-dialog ">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">New Product</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <?php $acturl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']; $this->session->set_userdata('product_save_redirect',$acturl); ?>

                    <div class="container">

                        <form id="product_form" name="product_form" class="form-horizontal"  method="post" action="<?php echo site_url('product/productcreate');  ?>" enctype="multipart/form-data">
                            <input type="hidden" name="product_id" id="product_id">
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
<div id="product_modal-edit" class="modal fade" role="dialog">
    <div class="modal-dialog ">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Product Edit </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <?php $acturl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']; $this->session->set_userdata('product_save_redirect',$acturl); ?>

                    <div class="container">

                        <form id="product_form" name="product_form" class="form-horizontal"  method="post" action="<?php echo site_url('product/productupdate');  ?>" enctype="multipart/form-data">
                            <input type="hidden" name="product_id_edit" id="product_id_edit">
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12">Product Name</label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <input name="product_name_edit" id="product_name_edit" class="date-picker form-control col-md-7 col-xs-12 product_name" type="text">
                                </div>
                            </div>
                            <div class="form-group">

                                <label class="control-label col-md-4 col-sm-4 col-xs-12">Category Name</label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <select name="category_edit" id="category_edit" class="form-control selectpicker show-tick"  title="Select Category">

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
                                    <input name="price_edit" id="price_edit" class= "form-control col-md-7 col-xs-12 " type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12">HSN Code</label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <input name="hsncode_edit" id="hsncode_edit" class= "form-control col-md-7 col-xs-12 " type="text">
                                </div>
                            </div>

                            <div class="form-group">

                                <label class="control-label col-md-4 col-sm-4 col-xs-12">UOM</label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <select name="uom_edit" id="uom_edit" class="form-control selectpicker show-tick"  title="Select UOM">

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
                                    <select name="tax_group_edit" id="tax_group_edit" class="form-control selectpicker show-tick"   title="Select Tax Group">
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
                                    <input name="reordered_level_edit" id="reordered_level_edit" class= "form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">

                                <label class="control-label col-md-4 col-sm-4 col-xs-12">Discount</label>

                                <div class="col-md-4 col-sm-8 col-xs-12">
                                    <input name="discount_val_edit" id="discount_val_edit" class= "form-control col-md-7 col-xs-12" type="text">
                                </div>

                                <div class="col-md-4 col-sm-8 col-xs-12">
                                   <div class="form-group">
                                       <input name="discount_edit" class="flat col-md-4" id="discount_edit" type="radio"  value="flat">
                                       <label for="radio100">Flat</label>

                                       <input name="discount_edit" class="flat col-md-offset-1 col-md-6" type="radio" id="discount_edit" value="per">
                                       <label for="radio100">Percentage</label>
                                   </div>
                                </div>

                            </div>

                            <div class="form-group">

                                <label class="control-label col-md-4 col-sm-4 col-xs-12">Status</label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <select name="status_product_edit" id="status_product_edit" class="form-control selectpicker show-tick"   title="Select Product Status">
                                        <!--<option value="0">Please Select Tax Group</option>-->
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">

                                <div class="col-md-12 col-sm-8 col-xs-12">
                                    <button id="btnsave"  type="submit" class="btn btn-success pull-right" >Update</button>
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


<!--Modal Add Stock -->
<div id="product_modal-addstock" class="modal fade" role="dialog">
    <div class="modal-dialog ">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Product Stock Entry</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <?php /*$acturl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']; $this->session->set_userdata('product_save_redirect',$acturl); */?>

                    <div class="container">

                        <form id="product_form" name="product_form" class="form-horizontal"  method="post" action="<?php echo site_url('product/addproductqty');  ?>" enctype="multipart/form-data">
                            <input type="hidden" name="product_id_add" id="product_id_add">
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12">Product Name</label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <input name="product_name_add" id="product_name_add" class="date-picker form-control col-md-7 col-xs-12 " type="text">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12">Price</label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <input name="price_add" id="price_add" class= "form-control col-md-7 col-xs-12 " type="text">
                                </div>
                            </div>

                            <div class="row">
                                <div class=" col-lg-offset-4 col-md-4 col-lg-4">
                                    <div class="form-group">

                                        <label class="">Qty In Stock</label>

                                            <input name="qty_in_stock" id="qty_in_stock" class= "form-control col-md-4 col-xs-12" type="text" readonly>

                                    </div>
                                </div>

                                <div class="col-md-4 col-lg-4">
                                    <div class="form-group">

                                        <label class="">Addable Qty </label>

                                        <input name="qty_add" id="qty_add" onkeyup="fnQtyKeyPress()" class= "form-control col-md-4 col-xs-12" type="text">

                                    </div>
                                </div>
                            </div></div>

                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Total Qty</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input name="total_qty" id="total_qty" class= "form-control col-md-7 col-xs-12 " type="text" readonly>
                        </div>
                    </div>



                            <div class="form-group">

                                <div class="col-md-12 col-sm-8 col-xs-12">
                                    <button id="btnsave"  type="submit" class="btn btn-success pull-right" >Add</button>
                                </div>
                            </div>





                        </form>

                    </div>

                </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>-->
<!--/Modal -->


<!-- Modal -->
<div id="product_import_file" class="modal fade" role="dialog">
    <div class="modal-dialog ">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Import Product</h4>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="container">

                        <form id="product_form" name="product_form" class="form-horizontal"  method="post" action="<?php echo site_url('product/importproducttodatabase');  ?>" enctype="multipart/form-data">

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12">Choose File</label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <input type="file" name="productexcelfile" id="productexcelfile" class="form-control">
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

<style>
    tr:nth-child(even) {background-color: #f2f2f2;}
</style>
<div id="product_view_details" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Product View</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th width="45%">Property</th>
                        <th>Values</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Product Name :</td>
                        <td class="product_name"></td>
                    </tr>
                    <tr>
                        <td>HSN Code :</td>
                        <td class="hsncode"></td>
                    </tr>
                    <tr>
                        <td>Category :</td>
                        <td class="category_id"></td>
                    </tr>
                    <tr>
                        <td>Unit Of Measurement(uom) :</td>
                        <td class="uom"></td>
                    </tr>
                    <tr>
                        <td>Price :</td>
                        <td class="prodprice"></td>
                    </tr>
                    <tr>
                        <td>Tax :</td>
                        <td class="tax_group_id"></td>
                    </tr>
                    <tr>
                        <td>Reordered Level :</td>
                        <td class="reordered_level"></td>
                    </tr>
                    <tr>
                        <td>Discount Amount :</td>
                        <td class="discount_amount"></td>
                    </tr>
                    <tr>
                        <td>Discount percentage :</td>
                        <td class="discount_per"></td>
                    </tr>
                    <tr>
                        <td>Discount :</td>
                        <td class="discount"></td>
                    </tr>
                    <tr>
                        <td>Status :</td>
                        <td class="status"></td>
                    </tr>

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>






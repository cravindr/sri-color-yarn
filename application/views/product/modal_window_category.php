<!-- Modal -->
<div id="category_modal" class="modal fade" role="dialog">
    <div class="modal-dialog ">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Category</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form  id="category_form" name="category_form"  class="form-horizontal form-label-left input_mask" method="post" enctype="multipart/form-data" action="">
                        <input type="hidden" name="cat_id" id="cat_id" value="">

                        <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12">Select Parent Category </label>
                                <div id="show_sub_categories">
                                    <select name="search_category" class="parent form-control ">
                                        <option value="" selected="selected">-- Categories --</option>
                                        <?php
                                        foreach($categorys as $catagory)
                                        {?>
                                            <option value="<?php echo $catagory->cat_id;?>"><?php echo $catagory->cat_desc;?></option>
                                            <?php
                                        }?>
                                    </select>
                                </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Category Description</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input name="cat_desc" id="cat_desc" class=" form-control col-md-7 col-xs-12" type="text">
                            </div>
                        </div>


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


<!-- Modal -->
<div id="category_modal_edit" class="modal fade" role="dialog">
    <div class="modal-dialog ">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Category Edit</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form  id="category_form" name="category_form"  class="form-horizontal form-label-left input_mask" method="post" enctype="multipart/form-data" action="">
                        <input type="hidden" name="cat_id" id="cat_id" value="">

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Select Parent Category </label>
                            <div id="show_sub_categories">
                                <select name="search_category" class="parent form-control selectpicker">
                                    <option value="" selected="selected">-- Categories --</option>
                                    <?php
                                    foreach($categorys as $catagory)
                                    {?>
                                        <option value="<?php echo $catagory->cat_id;?>"><?php echo $catagory->cat_desc;?></option>
                                        <?php
                                    }?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Category Description</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input name="cat_desc" id="cat_desc" class=" form-control col-md-7 col-xs-12" type="text">
                            </div>
                        </div>


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


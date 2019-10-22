<div class="row">
    <?php echo $message; ?>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-offset-4 col-lg-4 col-md-offset-4 col-md-4 col-xs-12" style="margin-top: 15%">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Tax Form <small>Add New Tax</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form id="validate" action="<?php echo site_url('settings/taxsave') ?>" method="post">
                        <div class="form-group">
                            <label>Tax Name</label>
                            <input type="text" id="tax_name" name="tax_name" placeholder="Enter Tax Name eg. SGST 14 % "
                                   class="form-control validate[required]">
                        </div>
                        <div class="form-group">
                            <label>Tax Value </label>
                            <input type="text" id="tax_value" name="tax_value" placeholder=" Enter Tax % eg. 14" class="form-control validate[required,custom[number]]">
                        </div>
                        <div class="form-group">
                            <select id="tax_type" name="tax_type"  class="selectpicker show-tick form-control validate[required]" title="Select a Tax">

                                    <option value='L'>Local State</option>
                                    <option value='O'>Other State</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <div class="loadstate"></div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </form>
                    <!-- end form for validations -->
                </div>
            </div>
        </div>
    </div>
</div>



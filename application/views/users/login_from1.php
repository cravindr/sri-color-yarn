<div class="container-fluid">
    <div class="row">
        <div class="col-lg-offset-4 col-lg-4 col-md-offset-4 col-md-4 col-xs-12" style="margin-top: 15%">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Login Form <small>Click to Login</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form id="validate" action="<?php echo site_url('welcome/save') ?>" method="post">
                        <div class="form-group">
                            <label>Gio Group Name</label>
                            <input type="text" name="giogroupname" placeholder="Enter Gio Group Name eg.GST Tamilnadu"
                                   class="form-control validate[required]">
                        </div>
                        <div class="form-group">
                            <label>Gio Group Description </label>
                            <input type="text" name="giogroupdesc" placeholder="Enter Gio Group Name eg.Tamil Nadu is the Local State" class="form-control validate[required]">
                        </div>
                    <div class="form-group">
                    <select id="country" data-live-search="true" class="selectpicker form-control validate[required]" title="Select a Country">
                        <?php
                        foreach ($Country as $v)
                        {
                            echo "<option value='$v->country_id'>$v->name</option>";
                        }
                        ?>
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


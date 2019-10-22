<div class="row">
    <?php echo $message; ?>
</div>
<div class="row">
    <div class="col-md-offset-3 col-md-6 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Change Password Form</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form id="changepassword" method="post" action="<?php echo site_url('Admin/ChangePassword'); ?>">
                    <div class="form-group">
                        <label>Enter Current Password</label>
                        <input type="password" name="oldpassword" id="oldpassword" class="form-control validate[required]" placeholder="Enter Current Password">
                    </div>
                    <div class="form-group">
                        <label>Enter New Password</label>
                        <input type="password" name="newpassword" id="newpassword" class="form-control validate[required]" placeholder="Enter New Password">
                    </div>
                    <div class="form-group">
                        <label>Enter Conform Password</label>
                        <input type="password" name="conpassword" id="conpassword" class="form-control validate[required,equals[newpassword]]" placeholder="Enter Conform Password">
                    </div>
                    <div class="form-group">
                        <label></label>
                        <button class="btn btn-primary pull-right">Change</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


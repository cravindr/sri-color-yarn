<div class="row">
    <?php echo $message; ?>
</div>
<div class="row">
    <div class="col-md-offset-3 col-md-6 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Profile Edit Form</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form method="post" action="">
                    <div class="form-group">
                        <label>Enter Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="<?php echo $name; ?>" placeholder="Enter Name">
                    </div>
                    <div class="form-group">
                        <label>Enter Email Id</label>
                        <input type="text" name="email" id="email" class="form-control" value="<?php echo $emailid; ?>" placeholder="Enter Email Id">
                    </div>
                    <div class="form-group">
                        <label>Enter Username</label>
                        <input type="text" name="username" id="username" class="form-control" value="<?php echo $username; ?>" placeholder="Enter Username">
                    </div>
                    <div class="form-group">
                        <label></label>
                        <button class="btn btn-primary pull-right">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



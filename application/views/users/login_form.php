<div class="container-fluid">
    <div class="row">
        <div class="col-lg-offset-4 col-lg-4 col-md-offset-4 col-md-4 col-xs-12" style="margin-top: 6%">
           <div class="row">
               <div class="form-group">
                   <center><img src="<?php echo $complogo; ?>" class="img-thumbnail" width="65px"></center>
                   <h1 style="color: #00CC00; text-align: center; font-family: Calibri ">
                       <?php echo $company; ?>
                   </h1>
               </div>
           </div>
            <div class="x_panel" style="margin-top: 10%">
                <div class="x_title">
                    <h2>Login Form <small>Click to Login</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <!-- start form for validation -->
                    <form id="demo-form" method="post" action="<?php echo site_url('welcome/login');?>">

                        <div class="form-group">
                            <label for="fullname">Username * :</label>
                            <input type="text" id="username" class="form-control" name="username" placeholder="Enter your Username" />
                        </div>

                        <div class="form-group">
                            <label for="fullname">Password * :</label>
                            <input type="password" id="password" class="form-control" name="password" placeholder="Enter your Password" />
                        </div>

                        <div class="form-group">
                            <label for="fullname"></label>
                            <button class="btn btn-round btn-success form-control">Login</button>
                        </div>

                    </form>
                    <!-- end form for validations -->

                </div>
            </div>

        </div>
    </div>
</div>


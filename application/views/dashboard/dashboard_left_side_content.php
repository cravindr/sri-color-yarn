<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title">
                <img src="<?php echo $logo;?>" alt="..." class="img-circle" width="30px">
                <span><?php echo $company; ?></span>
            </a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="<?php echo base_url('assets/images/User_Circle.png');?>" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $name; ?></h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li><a><i class="fa fa-edit"></i> Accounts <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo site_url('payment/'); ?>">Payment</a></li>
                            <li><a href="<?php echo site_url('payment/supplierpayemnt'); ?>">Supplier Payment</a></li>
                            <li><a href="<?php echo site_url('payment/report'); ?>">Payment History</a></li>
                            <li><a href="<?php echo site_url('payment/supplierreport'); ?>">Supplier Payment History</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-home"></i> Company <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo site_url('company/addcompany');?>">Company Add</a></li>
                            <li><a href="<?php echo site_url('company/branchlist');?>">Company Branch List</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-shopping-cart"></i> Purchase <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo site_url('purchase/'); ?>">Purchase List</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-desktop"></i> Product <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo site_url('product/category'); ?>">Category List</a></li>
                            <li><a href="<?php echo site_url('product/productlist'); ?>">Product List</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-camera"></i> Customer <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo site_url('customer/newcustomer'); ?>">New Customer</a></li>
                            <li><a href="<?php echo site_url('customer/'); ?>">Customer List</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-building"></i> Supplier <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo site_url('supplier/newsupplier'); ?>">New Supplier</a></li>
                            <li><a href="<?php echo site_url('supplier/'); ?>">Supplier List</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-table"></i> Invoice <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo site_url('invoice/newinvoice'); ?>">New Invoice</a></li>
                            <li><a href="<?php echo site_url('invoice/newdcinvoice'); ?>">New DC Invoice</a></li></li>
                            <li><a href="<?php echo site_url('invoice/invoicelist'); ?>">Invoice List</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-truck" aria-hidden="true"></i> Delivery <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo site_url('invoice/newdeliverychallan'); ?>">New Delivery Challan</a></li>
                            <li><a href="<?php echo site_url('invoice/deliverychallanlist'); ?>">Delivery Challan List</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-percent"></i> Tax <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo site_url('tax/zone'); ?>">Tax Zone</a></li>
                            <li><a href="<?php echo site_url('tax/tax'); ?>">Tax List</a></li>
                            <li><a href="<?php echo site_url('tax/taxgroup'); ?>">Tax Group</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-bar-chart" aria-hidden="true"></i> Report <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo site_url('report/invoice'); ?>">Invoice Report</a></li>
                            <li><a href="<?php echo site_url('report/customertransactionreport'); ?>">Customer Transation Report</a></li>
                            <li><a href="<?php echo site_url('report/suppliertransactionreport'); ?>">Supplier Transation Report</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo site_url('welcome/Logout')?>">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>


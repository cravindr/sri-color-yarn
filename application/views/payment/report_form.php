<div class="container-fluid">
    <form class="form-horizontal" id="validate" action="<?php echo site_url('payment/getReport');?>"  method="post" enctype="multipart/form-data">
         <div class="form-group">
             <div class="row">
                 <div class="col-lg-2">
                     <label>Customer Name</label>
                 </div>
                 <div class="col-lg-5">
                     <!--<input type="text" name="cus_name" id="cus_name" class="form-control">-->

                     <select class="selectpicker form-control show-tick validate[required]"   name="report_customer" id="report_customer"    data-live-search="true"  title="Select Customer Name">

                         <?php

                          foreach ($customer as $v)

                          {
                              echo "<option value = '$v->cus_id'>$v->cus_compnay_name</option>";
                          }


                         ?>
                     </select>

                 </div>


             </div>
         </div>

      <!--   <div class="form-group">
              <div class="row">
                  <div class="col-lg-2">
                      <label>Date</label>
                  </div>
                  <div class="col-lg-5">
                      <select class="selectpicker form-control show-tick" name="cust_date" id="cust_date" title="Select Date" >
                          <?php
/*
                          foreach ($ledger as $v)
                          {
                              echo "<option value = '$v->trans_dates'>$v->trans_date</option>";
                          }


                          */?>
                      </select>
                  </div>
              </div>
         </div>
-->
        <div class="form-group">
            <div class="row">
                <div class="col-lg-2">

                </div>
                <div class="col-lg-5">
                    <button class="btn btn-success"><i class="fa fa-bar-chart" aria-hidden="true"></i> Generate Report</button>
                </div>
            </div>
        </div>


    </form>
</div>
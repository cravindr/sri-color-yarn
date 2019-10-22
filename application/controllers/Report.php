<?php
/**
 * Created by PhpStorm.
 * User: Ravi
 * Date: 30-12-2017
 * Time: 10:51
 */

class Report extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model(array('dashboard_model','report_model','invoice_model','product_model'));
    }

    public function Generate()
    {
        //print_r($this->input->post());
        $inv_customer=$this->input->post('inv_customer');
        $inv_payment_option=$this->input->post('inv_payment_option');
        $start_date=$this->input->post('start_date');
        $end_date=$this->input->post('end_date');

        $this->load->model("report_model");
        $this->report_model->GenerateReport($inv_customer,$inv_payment_option,$start_date,$end_date);
    }

    public function CustomerTransactionReport()
    {

        $mes = $this->session->userdata("report");
        $res = $this->dashboard_model->GetCompanydatas();

        if(isset($mes))
        {
            $data = array(
                'logo' => $res[0],
                'company' => $res[1],
                'title' => 'Invoice || Dashboard',
                'message' => $this->Message($mes),
                'name' => $this->dashboard_model->userdetails()->u_name,
                'getcustomer' => $this->GetInvoiceCustomer(),
                'payment_option' => $this->GetInvoicePayOption(),
                'category' => $this->LoadCatagoryList(),
                'uom' => $this->LoadUOMList(),
                'taxgroup' => $this->LoadTaxGroupList()
            );
        }
        else
        {
            $data = array(
                'logo' => $res[0],
                'company' => $res[1],
                'title' => 'Invoice || Dashboard',
                'message' => '',
                'name' => $this->dashboard_model->userdetails()->u_name,
                'getcustomer' => $this->GetInvoiceCustomer(),
                'payment_option' => $this->GetInvoicePayOption(),
                'category' => $this->LoadCatagoryList(),
                'uom' => $this->LoadUOMList(),
                'taxgroup' => $this->LoadTaxGroupList()
            );
        }

        $this->load->view('transation_gen', $data);
        $this->session->unset_userdata("report");
    }


    public function Invoice()
    {

        $mes = $this->session->userdata("report");
        $res = $this->dashboard_model->GetCompanydatas();

        if(isset($mes))
        {
            $data = array(
                'logo' => $res[0],
                'company' => $res[1],
                'title' => 'Invoice || Dashboard',
                'message' => $this->Message($mes),
                'name' => $this->dashboard_model->userdetails()->u_name,
                'getcustomer' => $this->GetInvoiceCustomer(),
                'payment_option' => $this->GetInvoicePayOption(),
                'category' => $this->LoadCatagoryList(),
                'uom' => $this->LoadUOMList(),
                'taxgroup' => $this->LoadTaxGroupList()
            );
        }
        else
        {
            $data = array(
                'logo' => $res[0],
                'company' => $res[1],
                'title' => 'Invoice || Dashboard',
                'message' => '',
                'name' => $this->dashboard_model->userdetails()->u_name,
                'getcustomer' => $this->GetInvoiceCustomer(),
                'payment_option' => $this->GetInvoicePayOption(),
                'category' => $this->LoadCatagoryList(),
                'uom' => $this->LoadUOMList(),
                'taxgroup' => $this->LoadTaxGroupList()
            );
        }

        $this->load->view('invoice_gen', $data);
        $this->session->unset_userdata("report");
    }

    private function GetInvoiceCustomer()
    {
        $res = $this->invoice_model->getcustomer();
        return $res;
    }

    public function LoadSupplier()
    {
        $this->load->model('supplier_model');
        $result = $this->supplier_model->getsupplier();
        return $result;
    }

    private function GetInvoicePayOption()
    {
        $res = $this->invoice_model->getpaymentoption();
        return $res;
    }

    public function GetInvoiceShippingAddress()
    {
        $cus_id = $this->input->post('id');

        $result = $this->invoice_model->getinvoiceshippingaddressbyid($cus_id);

        echo json_encode($result);
    }

    private function Message($message)
    {
        if($message == 'saved')
        {
            $mess = '<div class="alert alert-success"><strong>Success!!!</strong>&nbsp; Customer Record Inserted Successfully...</div>';
        }
        elseif ($message == 'unsaved')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>&nbsp; Customer Record Does not Inserted Try again...</div>';
        }
        elseif ($message == 'updated')
        {
            $mess = '<div class="alert alert-success"><strong>Success!!!</strong>&nbsp; Customer Record Updated Successfully...</div>';
        }
        elseif ($message == 'unupdated')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>&nbsp; Customer Record Does not Updated Try again...</div>';
        }

        return $mess;
    }


    public function ProductServerSide()
    {
        // DB table to use
        $table = 'product';

        // Table's primary key
        $primaryKey = 'product_id';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes
        $columns = array(
            array( 'db' => 'product_id', 'dt' => 0 ),
            array( 'db' => 'product_name',  'dt' => 1 ),
            array( 'db' => 'hsncode',  'dt' => 2 ),
            array( 'db' => 'UOM',  'dt' => 3 ),
            array( 'db' => 'price',  'dt' => 4 ),


            array( 'db' => 'status',   'dt' => 5 ),
            array(
                'db'        => 'product_id',
                'dt'        => 6,
                'formatter' => function( $d, $row ) {
                    return '<button type="button" id="btnview" class="btn btn-success btn-xs" title="View"><i class="fa fa-eye" aria-hidden="true"></i></button> &nbsp; 
                                    <button type="button" id="btnedit" class="btn btn-primary btn-xs" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button> &nbsp;
                                    <button type="button" id="btndelete" class="btn btn-danger btn-xs" title="Status Change"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
                }
            )
        );

        // SQL server connection information
        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db'   => $this->db->database,
            'host' => $this->db->hostname
        );


        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * If you just want to use the basic configuration for DataTables with PHP
         * server-side, there is no need to edit below this line.
         */

        echo json_encode(
            SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
        );


    }

    public function LoadTaxGroupList()
    {
        return $this->product_model->LoadTaxGroup();
    }

    public function LoadCatagoryList()
    {
        return $this->product_model->LoadCategory();
    }

    public function LoadUOMList()
    {
        return $this->product_model->LoadUOM();
    }


    public function GenInvoice()
    {
        $inv_customer=$this->input->post('inv_customer');
        $inv_payment_option=$this->input->post('inv_payment_option');
        $start_date=$this->input->post('start_date');
        $end_date=$this->input->post('end_date');

        $this->load->model("report_model");
      $ret = $this->report_model->GenerateReport($inv_customer,$inv_payment_option,$start_date,$end_date);


        $mes = $this->session->userdata("invoice");
        $res = $this->dashboard_model->GetCompanydatas();

        if(isset($mes))
        {
            $data = array(
                'logo' => $res[0],
                'company' => $res[1],
                'title' => 'Invoice || Dashboard',
                'message' => $this->Message($mes),
                'name' => $this->dashboard_model->userdetails()->u_name,
                'output'=>$ret
              );
        }
        else
        {
            $data = array(
                'logo' => $res[0],
                'company' => $res[1],
                'title' => 'Invoice || Dashboard',
                'message' => '',
                'name' => $this->dashboard_model->userdetails()->u_name,
                'output'=>$ret
                );
        }

        $this->load->view('invoice_gen_out', $data);
        $this->session->unset_userdata("invoice");



    }

    public function GenTransation()
    {

        $data1 = array(
            'cus_id' => $this->input->post('inv_customer'),
            'start_date' => $this->input->post('start_date'),
            'end_date' => $this->input->post('end_date')
        );

      if(empty($data1['cus_id']) && isset($data1['start_date']) && isset($data1['end_date']))
      {
          $data1['cus_id'] = 0;
      }
      elseif (isset($data1['cus_id']) && empty($data1['start_date']) && empty($data1['end_date']))
      {
          $data1['start_date'] = 0;
          $data1['end_date'] = 0;
      }
      //$res = $this->TransationServerSide($data1['cus_id'],$data1['start_date'],$data1['end_date']);
      //print_r($res); exit;

        $mes = $this->session->userdata("report");
        $res = $this->dashboard_model->GetCompanydatas();

        if(isset($mes))
        {
            $data = array(
                'logo' => $res[0],
                'company' => $res[1],
                'title' => 'Invoice || Dashboard',
                'message' => $this->Message($mes),
                'name' => $this->dashboard_model->userdetails()->u_name,
               'cus_id' => $data1['cus_id'],
               'start_date' => $data1['start_date'],
               'end_date' => $data1['end_date']
            );
        }
        else
        {
            $data = array(
                'logo' => $res[0],
                'company' => $res[1],
                'title' => 'Invoice || Dashboard',
                'message' => '',
                'name' => $this->dashboard_model->userdetails()->u_name,
                'cus_id' => $data1['cus_id'],
                'start_date' => $data1['start_date'],
                'end_date' => $data1['end_date']
            );
        }

       //print_r(json_encode($data['finaldata'])); exit;
        $this->load->view('transation_report_gen_out', $data);
        $this->session->unset_userdata("report");
    }

    public function TransationServerSide($cus_id, $startdate, $enddate)
    {
        $data = array(
            'cus_id' => $cus_id,
            'start_date' => $startdate,
            'end_date' => $enddate
        );
        
        $this->load->model("report_model");
        $ret = $this->report_model->customertransationreport($data);

      print_r(json_encode($ret));
    }
    

    public  function invServerside($cus_id='',$payment_type='',$startdate='',$enddate='')
    {
       // echo "$cus_id $payment_type $startdate $enddate ";
        $this->load->model("report_model");
        $res=$this->report_model->getInvoiceListJson($cus_id,$payment_type,$startdate,$enddate);
        print_r(json_encode($res));
    }


    public function getInvoice()
    {
        $inv_customer=$this->input->post('inv_customer');
        $inv_payment_option=$this->input->post('inv_payment_option');
        $start_date=$this->input->post('start_date');
        $end_date=$this->input->post('end_date');
       /* $data=array('cus_id'=>$inv_customer,
                    'payment_type'=>$inv_payment_option,
                    'startdate'=>$start_date,
                    'enddate'=>$end_date);*/

        $mes = $this->session->userdata("invoice");
        $res = $this->dashboard_model->GetCompanydatas();

        if(isset($mes))
        {
            $data = array(
                'logo' => $res[0],
                'company' => $res[1],
                'title' => 'Report || Invoice',
                'message' => $this->Message($mes),
                'name' => $this->dashboard_model->userdetails()->u_name,
                'cus_id'=>$inv_customer,
                'payment_type'=>$inv_payment_option,
                'startdate'=>$start_date,
                'enddate'=>$end_date

            );
        }
        else
        {
            $data = array(
                'logo' => $res[0],
                'company' => $res[1],
                'title' => 'Report || Invoice',
                'message' => '',
                'name' => $this->dashboard_model->userdetails()->u_name,
                'cus_id'=>$inv_customer,
                'payment_type'=>$inv_payment_option,
                'startdate'=>$start_date,
                'enddate'=>$end_date

            );
        }

        $this->load->view('inv_report_list', $data);
        $this->session->unset_userdata("invoice");



    }



    //Supplier

    public function SupplierTransactionReport()
    {

        $mes = $this->session->userdata("report");
        $res = $this->dashboard_model->GetCompanydatas();

        if(isset($mes))
        {
            $data = array(
                'logo' => $res[0],
                'company' => $res[1],
                'title' => 'Invoice || Dashboard',
                'message' => $this->Message($mes),
                'name' => $this->dashboard_model->userdetails()->u_name,
                'getsupplier' => $this->LoadSupplier(),
                'payment_option' => $this->GetInvoicePayOption(),
                'category' => $this->LoadCatagoryList(),
                'uom' => $this->LoadUOMList(),
                'taxgroup' => $this->LoadTaxGroupList()
            );
        }
        else
        {
            $data = array(
                'logo' => $res[0],
                'company' => $res[1],
                'title' => 'Invoice || Dashboard',
                'message' => '',
                'name' => $this->dashboard_model->userdetails()->u_name,
                'getsupplier' => $this->LoadSupplier(),
                'payment_option' => $this->GetInvoicePayOption(),
                'category' => $this->LoadCatagoryList(),
                'uom' => $this->LoadUOMList(),
                'taxgroup' => $this->LoadTaxGroupList()
            );
        }

        $this->load->view('transation_supplier_gen', $data);
        $this->session->unset_userdata("report");
    }

    public function SupplierTransation()
    {

        $data1 = array(
            'sup_id' => $this->input->post('sup_id'),
            'start_date' => $this->input->post('start_date'),
            'end_date' => $this->input->post('end_date')
        );

        if(empty($data1['sup_id']) && isset($data1['start_date']) && isset($data1['end_date']))
        {
            $data1['sup_id'] = 0;
        }
        elseif (isset($data1['sup_id']) && empty($data1['start_date']) && empty($data1['end_date']))
        {
            $data1['start_date'] = 0;
            $data1['end_date'] = 0;
        }

        $mes = $this->session->userdata("report");
        $res = $this->dashboard_model->GetCompanydatas();

        if(isset($mes))
        {
            $data = array(
                'logo' => $res[0],
                'company' => $res[1],
                'title' => 'Invoice || Dashboard',
                'message' => $this->Message($mes),
                'name' => $this->dashboard_model->userdetails()->u_name,
                'sup_id' => $data1['sup_id'],
                'start_date' => $data1['start_date'],
                'end_date' => $data1['end_date']
            );
        }
        else
        {
            $data = array(
                'logo' => $res[0],
                'company' => $res[1],
                'title' => 'Invoice || Dashboard',
                'message' => '',
                'name' => $this->dashboard_model->userdetails()->u_name,
                'sup_id' => $data1['sup_id'],
                'start_date' => $data1['start_date'],
                'end_date' => $data1['end_date']
            );
        }
        //print_r(json_encode($data['finaldata'])); exit;
        $this->load->view('transation_supplier_report_gen_out', $data);
        $this->session->unset_userdata("report");
    }

    public function SupplierTransationServerSide($sup_id,$startdate,$enddate)
    {
        $data = array(
            'sup_id' => $sup_id,
            'start_date' => $startdate,
            'end_date' => $enddate
        );

        $this->load->model("report_model");
        $ret = $this->report_model->suppliertransationreport($data);

        print_r(json_encode($ret));
    }

}

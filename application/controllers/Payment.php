<?php


class Payment  extends  CI_Controller
{
     public function __construct()
     {
         parent::__construct();

         $this->load->model(array('dashboard_model','invoice_model','payment_model','supplier_model'));
     }
    public function  index()
    {
        $mes = $this->session->userdata("payment");
        $res = $this->dashboard_model->GetCompanydatas();

        if(isset($mes))
        {
            $sample = array(
                'logo' => $res[0],
                'company' => $res[1],
                'name' => $this->dashboard_model->userdetails()->u_name,
                'title' => 'Payment Form || Dashboard',
                'customer' => $this->LoadCustomer(),
                'payment'  => $this->LoadAmount(),
                'message' => $this->Message($mes)
            );
        }
        else
        {
            $sample = array(
                'logo' => $res[0],
                'company' => $res[1],
                'name' => $this->dashboard_model->userdetails()->u_name,
                'title' => 'Payment Form || Dashboard',
                'customer' => $this->LoadCustomer(),
                'payment'  => $this->LoadAmount(),
                'message' => ''
            );
        }


        $this->load->view('payment_list' ,$sample);
        $this->session->unset_userdata("payment");
    }

    public function LoadCustomer()
    {
        $res =  $this->invoice_model->getcustomer();

        return $res;
    }

    public function LoadAmount()
    {

        $res =  $this->invoice_model->getpaymentoption();

        return $res;
    }

    public function LoadReport()
    {
        $res = $this->payment_model->loadcustomername();

        return $res;
    }

    public function  Payment_Save()
    {
        $cus_id = $this->input->post('customer_name');

        $description = $this->input->post('description');

        $amount = $this->input->post('amount');

        $pay_type = $this->input->post('payment_option');

        $data = array(
            'cus_id' => $cus_id,
            'desc'   =>  $description,
            'amount' => $amount,
            'trans_date' => $this->input->post('date'),
            'trans_type' => $pay_type
        );


        //print_r($data); exit;

        $res = $this->payment_model->save($data);

        if($res)
        {
            redirect('payment');
        }
    }

    public function  Report()
    {
        $res = $this->dashboard_model->GetCompanydatas();
        $data = array(
            'logo' => $res[0],
            'company' => $res[1],
            'name' => $this->dashboard_model->userdetails()->u_name,
            'title'=>'Report Form',
            'customer' =>$this->LoadReport(),
            'ledger' => $this->GetLedgerDate()
        );

        $this->load->view('report_list' ,$data);
    }

    public function GetReport()
    {
        // $report_customer = $this->input->post('report_customer');
        $res = $this->dashboard_model->GetCompanydatas();
        $cus_id  = $this->input->post("report_customer");


        $cust_date = $this->input->post('cust_date');

        $mes = $this->session->userdata("report");

        if (isset($mes))
        {
            $data = array(
                'logo' => $res[0],
                'company' => $res[1],
                'title' => 'Report || Payment',
                'message' => '',
                'name' => $this->dashboard_model->userdetails()->u_name,
                'cus_id' => $cus_id,
            );
        }
        else
        {
            $data = array(
                'logo' => $res[0],
                'company' => $res[1],
                'title' => 'Report || Payment',
                'message' => '',
                'name' => $this->dashboard_model->userdetails()->u_name,
                'cus_id' => $cus_id,
                'cus_date' => $cust_date

            );
        }


        $this->load->view('report_cus_list', $data);
        $this->session->unset_userdata("report");


    }

    public  function repServerside($cus_id='')
    {
        $res=$this->payment_model->getReportListJson($cus_id);

        print_r(json_encode($res));
    }

    public function GetLedgerDate()
    {
        $res =  $this->payment_model->LoadLedgerDate();

        return $res;
    }

    //Aravinth Code

    public function SupplierPayemnt()
    {
        $mes = $this->session->userdata("payment");
        $res = $this->dashboard_model->GetCompanydatas();

        if(isset($mes))
        {
            $data = array(
                'logo' => $res[0],
                'company' => $res[1],
                'name' => $this->dashboard_model->userdetails()->u_name,
                'title' => 'Payment Form || Dashboard',
                'supplier' => $this->LoadSupplier(),
                'payment'  => $this->LoadAmount(),
                'message' => $this->Message($mes)
            );
        }
        else
        {
            $data = array(
                'logo' => $res[0],
                'company' => $res[1],
                'name' => $this->dashboard_model->userdetails()->u_name,
                'title' => 'Payment Form || Dashboard',
                'supplier' => $this->LoadSupplier(),
                'payment'  => $this->LoadAmount(),
                'message' => ''
            );
        }


        $this->load->view('supplier_payment_list', $data);
        $this->session->unset_userdata("payment");
    }

    public function SupplierPaymentSave()
    {
        $data = array(
            'cus_id' => $this->input->post('sup_id'),
            'desc' => $this->input->post('description'),
            'amount' => $this->input->post('amount'),
            'inv_id' => $this->input->post('inv_no'),
            'trans_date' => $this->input->post('date'),
            'trans_type' => $this->input->post('payment_option')
        );
        //print_r($this->input->post('date')); exit;
        $res = $this->supplier_model->savesupplierledger($data);

        if($res == 1)
        {
            $this->session->set_userdata("payment","saved");
            redirect('payment/supplierpayemnt/');
        }
        else
        {
            $this->session->set_userdata("payment","unsaved");
            redirect('payment/supplierpayemnt/');
        }
    }

    public function LoadSupplier()
    {
        $result = $this->supplier_model->getsupplier();
        return $result;
    }


    public function  SupplierReport()
    {
        $res = $this->dashboard_model->GetCompanydatas();
        $data = array(
            'logo' => $res[0],
            'company' => $res[1],
            'name' => $this->dashboard_model->userdetails()->u_name,
            'title'=>'Report Form',
            'supplier' => $this->LoadSupplier(),
            'ledger' => $this->GetLedgerDate()
        );

        $this->load->view('supplier_report_list' ,$data);
    }

    public function GetSupplierReport()
    {
        // $report_customer = $this->input->post('report_customer');
        $res = $this->dashboard_model->GetCompanydatas();
        $sup_id  = $this->input->post("sup_id");


        $cust_date = $this->input->post('cust_date');

        $mes = $this->session->userdata("report");

        if (isset($mes))
        {
            $data = array(
                'logo' => $res[0],
                'company' => $res[1],
                'title' => 'Report || Payment',
                'message' => '',
                'name' => $this->dashboard_model->userdetails()->u_name,
                'sup_id' => $sup_id,
            );
        }
        else
        {
            $data = array(
                'logo' => $res[0],
                'company' => $res[1],
                'title' => 'Report || Payment',
                'message' => '',
                'name' => $this->dashboard_model->userdetails()->u_name,
                'sup_id' => $sup_id,
                'cus_date' => $cust_date

            );
        }


        $this->load->view('report_supplier_list', $data);
        $this->session->unset_userdata("report");


    }

    public  function SupplierServerSide($sup_id='')
    {
        $res=$this->supplier_model->supplierserversidereport($sup_id);

        print_r(json_encode($res));
    }

    private function Message($message)
    {
        if($message == 'saved')
        {
            $mess = '<div class="alert alert-success"><strong>Success!!!</strong>&nbsp; Payemnt Saved</div>';
        }
        elseif ($message == 'unsaved')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>&nbsp; Payemnt Cannot Saved</div>';
        }

        return $mess;
    }

}
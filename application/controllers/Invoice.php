<?php
/**
 * Created by PhpStorm.
 * User: Attract-01
 * Date: 11/15/2017
 * Time: 6:28 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

require_once (APPPATH.'/controllers/Product.php');

class Invoice extends Product
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model(array('dashboard_model','invoice_model'));
    }

    public function InvoiceList()
    {
        $mes = $this->session->userdata("invoice");
        $res = $this->dashboard_model->GetCompanydatas();

        if(isset($mes))
        {
            $data = array(
                'logo' => $res[0],
                'company' => $res[1],
                'title' => 'Invoice List || Dashboard',
                'message' => $this->Message($mes),
                'name' => $this->dashboard_model->userdetails()->u_name
            );
        }
        else
        {
            $data = array(
                'logo' => $res[0],
                'company' => $res[1],
                'title' => 'Invoice List || Dashboard',
                'message' => '',
                'name' => $this->dashboard_model->userdetails()->u_name
            );
        }

        $this->load->view('invoice_list', $data);
        $this->session->unset_userdata("invoice");
    }

    public function DeliveryChallanList()
    {
        $mes = $this->session->userdata("invoice");
        $res = $this->dashboard_model->GetCompanydatas();

        if(isset($mes))
        {
            $data = array(
                'logo' => $res[0],
                'company' => $res[1],
                'title' => 'DC List || Dashboard',
                'message' => $this->Message($mes),
                'name' => $this->dashboard_model->userdetails()->u_name
            );
        }
        else
        {
            $data = array(
                'logo' => $res[0],
                'company' => $res[1],
                'title' => 'DC List || Dashboard',
                'message' => '',
                'name' => $this->dashboard_model->userdetails()->u_name
            );
        }

        $this->load->view('delivery_challan_list', $data);
        $this->session->unset_userdata("invoice");
    }

    public function InvoiceView()
    {
        $inv_id = $this->input->post('id');
        $result = $this->invoice_model->viewinvoice($inv_id);
        $res = $result[0];
        echo json_encode($res);
    }

    public function InvoiceDelete()
    {
        $id = $this->input->post('id');
        $result = $this->invoice_model->deleteinvoice($id);
        echo $result;
    }

    public function InvoiceServerSide()
    {

        // DB table to use
        $table = 'invoice_master';

        // Table's primary key
        $primaryKey = 'inv_id';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes

        $columns = array(
            array( 'db' => '`inv_mas`.`inv_id`', 'dt' => 0,'field' => 'inv_id'),

            array( 'db' => '`inv_mas`.`inv_no`',  'dt' => 1,'field' => 'inv_no'  ),
            array( 'db' => '`inv_mas`.`inv_date`',   'dt' =>2,'field' => 'inv_date'  ),
            array( 'db' => '`cus`.`cus_compnay_name`',     'dt' => 3,'field' => 'cus_compnay_name'  ),

            array( 'db' => '`inv_mas`.`net_amount`',     'dt' => 4,'field' => 'net_amount' ),

            array( 'db' => '`cus`.`cus_state`',     'dt' => 5,'field' => 'cus_state' ),



            array(
                'db'        => '`cus`.`cus_state`',
                'dt'        => 6,
                'field' => 'cus_state',
                'formatter' => function( $d, $row ) {
                    return '<button type="button" id="btnprint" class="btn btn-dark btn-xs" title="Print Invoice"><i class="fa fa-print" aria-hidden="true"></i></button>
                            <button type="button" id="btnview" class="btn btn-success btn-xs" title="View"><i class="fa fa-eye" aria-hidden="true"></i></button>
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

        $joinQuery = "FROM invoice_master AS inv_mas JOIN customer AS cus ON (inv_mas.cus_id = cus.cus_id)";
        $extraWhere = "";
        $groupBy = "";
        $having = "";

        echo json_encode(
            SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $having )
        );

    }

    public function DeliveryChallanServerSide()
    {

        // DB table to use
        $table = 'delivery_master';

        // Table's primary key
        $primaryKey = 'dc_id';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes

        $columns = array(
            array( 'db' => '`dc_mas`.`dc_id`', 'dt' => 0,'field' => 'dc_id'),

            array( 'db' => '`dc_mas`.`inv_no`',  'dt' => 1,'field' => 'inv_no'  ),
            array( 'db' => '`dc_mas`.`inv_date`',   'dt' =>2,'field' => 'inv_date'  ),
            array( 'db' => '`cus`.`cus_compnay_name`',     'dt' => 3,'field' => 'cus_compnay_name'  ),

            array( 'db' => '`dc_mas`.`net_amount`',     'dt' => 4,'field' => 'net_amount' ),

            array( 'db' => '`cus`.`cus_state`',     'dt' => 5,'field' => 'cus_state' ),



            array(
                'db'        => '`cus`.`cus_state`',
                'dt'        => 6,
                'field' => 'cus_state',
                'formatter' => function( $d, $row ) {
                    return '<button type="button" id="dcbtnprint" class="btn btn-dark btn-xs" title="Print Delivery Challan"><i class="fa fa-print" aria-hidden="true"></i></button>
                            <button type="button" id="dcbtnview" class="btn btn-success btn-xs" title="View"><i class="fa fa-eye" aria-hidden="true"></i></button>
                            <button type="button" id="dcbtndelete" class="btn btn-danger btn-xs" title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
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

        $joinQuery = "FROM delivery_master AS dc_mas JOIN customer AS cus ON (dc_mas.cus_id = cus.cus_id)";
        $extraWhere = "";
        $groupBy = "";
        $having = "";

        echo json_encode(
            SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $having )
        );

    }

    public function InvoiceSave()
    {
        $data = array(
            'inv_no' => $this->input->post('invoice_no'),
            'inv_date' => $this->input->post('inv_date'),
            'inv_customer' => $this->input->post('inv_customer'),
            'ship_address' => $this->input->post('ship_address'),
            'inv_payment_option' => $this->input->post('inv_payment_option'),
            'product_id' => $this->input->post('product'),
            'hsn_code' => $this->input->post('hsn'),
            'qty' => $this->input->post('qty'),
            'uom' => $this->input->post('uom'),
            'rate' => $this->input->post('rate'),
            'dis_per' => $this->input->post('dis_per'),
            'dis_amt' => $this->input->post('dis_amt'),
            'gst' => $this->input->post('gst'),
            'gstamt' => $this->input->post('gstamt'),
            'amount' => $this->input->post('amount'),
            'netamount' => $this->input->post('netamount'),
            'transport_mode_option' => $this->input->post('transport_mode_option'),
            'trans_mode' => $this->input->post('trans_mode'),
            'vehicle_no' => $this->input->post('vehicle_no'),
            'supply_date' => $this->input->post('supply_date'),
            'place_supply' => $this->input->post('place_supply'),
            'cgst' => $this->input->post('cgst'),
            'sgst' => $this->input->post('sgst'),
            'igst' => $this->input->post('igst'),
            'cgstamt' => $this->input->post('cgstamt'),
            'sgstamt' => $this->input->post('sgstamt'),
            'igstamt' => $this->input->post('igstamt'),
            'total' => $this->input->post('total'),
            'prepared_by' => $this->dashboard_model->userdetails()->u_name,
            'order_no' => $this->input->post('order_no')
        );
		/*echo "<pre>";
        print_r($data);
        //print_r(array_sum($data['total']));
        exit;*/

        $result1 =  $this->invoice_model->getcustomerbyid($data['inv_customer']);
        $cus_state_code = $result1[0]->cus_state_code;

        $result = $this->invoice_model->GenerateInvoice($data);
        $product = $this->input->post('product');
        $qty = $this->input->post('qty');

        //print_r($result); exit;

        foreach ($product as $k => $v)
        {
            $product_id = $v;
           /* echo "mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm".$v."<br>";*/
            $pro_qty = $qty[$k];
            $dc_no = '';
            $rate = $data['rate'][$k];

            $this->load->model("invoicedetail_model");
            $result1 = $this->invoicedetail_model->Insert($product_id,$pro_qty,$rate,$cus_state_code,$result->id,$result->invoice_id);
        }

            if($result1 == 1)
            {
                $invno = $result->invoice_id;
                redirect('invoice/printinvoice/'.$invno.'/');
            }
    }

    public function InvoiceDCSave()
    {

        $data = array(
            'inv_no' => $this->input->post('invoice_no'),
            'inv_date' => $this->input->post('inv_date'),
            'inv_customer' => $this->input->post('inv_customer'),
            'ship_address' => $this->input->post('ship_address'),
            'inv_payment_option' => $this->input->post('inv_payment_option'),
            'product_id' => $this->input->post('product_id'),
            'hsn_code' => $this->input->post('hsn'),
            'qty' => $this->input->post('qty'),
            'uom' => $this->input->post('uom'),
            'rate' => $this->input->post('rate'),
            'dis_per' => $this->input->post('dis_per'),
            'dis_amt' => $this->input->post('dis_amt'),
            'gst' => $this->input->post('gst'),
            'gstamt' => $this->input->post('gstamt'),
            'amount' => $this->input->post('amount'),
            'netamount' => $this->input->post('netamount'),
            'transport_mode_option' => $this->input->post('transport_mode_option'),
            'trans_mode' => $this->input->post('trans_mode'),
            'vehicle_no' => $this->input->post('vehicle_no'),
            'supply_date' => $this->input->post('supply_date'),
            'place_supply' => $this->input->post('place_supply'),
            'cgst' => $this->input->post('cgst'),
            'sgst' => $this->input->post('sgst'),
            'igst' => $this->input->post('igst'),
            'cgstamt' => $this->input->post('cgstamt'),
            'sgstamt' => $this->input->post('sgstamt'),
            'igstamt' => $this->input->post('igstamt'),
            'total' => $this->input->post('total'),
            'prepared_by' => $this->dashboard_model->userdetails()->u_name,
            'order_no' => $this->input->post('order_no')
        );
        //print_r($data); exit;

        $result1 =  $this->invoice_model->getcustomerbyid($data['inv_customer']);
        $cus_state_code = $result1[0]->cus_state_code;

        $result = $this->invoice_model->GenerateInvoice($data);
        $product = $this->input->post('product_id');
        $rates = $this->input->post('rate');
        $qty = $this->input->post('qty');
        $dcno = $this->input->post('dcnumber');

        $bundle_count = $this->input->post('bundlecount');
        $no_of_bundle = $this->input->post('nobundle');
        $hanking = $this->input->post('hanking');
        $refno = $this->input->post('ref_no');

        foreach ($product as $k => $v)
        {
            $product_id = $v;
            $pro_qty = $qty[$k];
            $dc_no = $dcno[$k];
            $rate = $rates[$k];
            $ref_no = $refno[$k];

            $bc = $bundle_count[$k];
            $nob = $no_of_bundle[$k];
            $hank = $hanking[$k];

            $this->load->model("invoicedetail_model");
            //echo "InsertDC($dc_no,$product_id,$pro_qty,$cus_state_code,$result->id,$result->invoice_id)"; exit;
            $result1 = $this->invoicedetail_model->InsertDC($dc_no,$product_id,$pro_qty,$rate,$cus_state_code,$result->id,$result->invoice_id,$bc,$nob,$hank,$ref_no);
        }

            if($result1 == 1)
            {
                $invno = $result->invoice_id;
                $this->session->set_userdata("InvoiceCondition","Invoicewithdc");
                redirect('invoice/printinvoice/'.$invno.'/');
            }
    }

    public function PrintInvoice($inv_no)
    {
        $res = $this->invoice_model->InvoiceParametters($inv_no);
        $comp = $this->invoice_model->getcompanydetails();
        $company = (array) $comp[0];

        $data = array(
            'company' => $company,
            'invoice_master' => $res['master'],
            'invoice_detail' => $res['details'],
            'customer' => $res['customer'],
            'customer_branch' => $res['customer_branch'],
            'reportname' => 'invoice'
        );

        //print_r($res); exit;
       if($res['details'][0]['dc_no'] == '')
       {
           $this->load->view('sri_custom_invoice', $data);
       }
       else
       {
           $this->load->view('sri_custom_dc_invoice', $data);
       }
        $this->session->unset_userdata("InvoiceCondition");
    }

    public function PrintDC($dc_no)
    {
        $res = $this->invoice_model->GetDataPrintDeliveryChallan($dc_no);

        $comp = $this->invoice_model->getcompanydetails();
        $cus1 = $this->invoice_model->GetCustomerById($res[0]['cus_id']);
        $cus = (array) $cus1[0];
        $company = (array) $comp[0];

        if($res[0]['cus_ship_id'] <> 0)
        {
            $customer_branchs = $this->GetCustomerBranchById($res[0]['cus_ship_id']);
            $customer_branch = (array) $customer_branchs[0];
        }
        else
        {
            $customer_branch = 0;
        }

        $data = array(
            'company' => $company,
            'dc_master' => $res,
            'customer' => $cus,
            'customer_branch' => $customer_branch,
            'reportname' => 'delivery chellan'
        );
        //print_r($data); exit;
        $this->load->view('sri_custom_dc', $data);
        //$this->load->view('delivery_challan', $data);
    }

    public function DeliveryChallanSave()
    {
        $data = array(
            'cus_id' => $this->input->post('inv_customer'),
            'date' => $this->input->post('inv_date'),
            'prod_id' => $this->input->post('product'),
            'hsncode' => $this->input->post('hsn'),
            'qty' => $this->input->post('qty'),
            'uom' => $this->input->post('uom'),
            'price' => $this->input->post('price'),
            'amount' => $this->input->post('amount'),
            'totalamount' => $this->input->post('netamount'),
            'prepared_by' => $this->dashboard_model->userdetails()->u_name,
            'order_no' => $this->input->post('order_no'),
            'transport_mode' => $this->input->post('trans_mode'),
            'vehicle_no' => $this->input->post('vehicle_no'),
            'date_of_supply' => $this->input->post('supply_date'),
            'place_of_supply' => $this->input->post('place_supply'),
            'bundle_count' => $this->input->post('bundlecount'),
            'no_of_bundle' => $this->input->post('nobundle'),
            'hanking' => $this->input->post('hanking'),
            'ref_no' => $this->input->post('ref_no')
        );
        //print_r($data); exit;
       $result = $this->invoice_model->savedeliverychallan($data);

        if(!$result == 0)
        {
            redirect('invoice/printdc/'.$result.'/');
        }
    }

    public function GetInvoiceProduct()
    {
        $result =  $this->product_model->getproduct();
        echo json_encode($result);
    }

    public function GetTaxGST()
    {
        $result =  $this->invoice_model->GetGSTTax();
        echo json_encode($result);
    }

    public function GetProductAndTaxAndZone()
    {
        $id = $this->input->post('id');
        $cus_id = $this->input->post('cusid');

        $result =  $this->product_model->getproductbyid($id);
        $result1 =  $this->invoice_model->getcustomerbyid($cus_id);

        $tax_group_id = $result[0]->tax_group_id;
        $cus_state_code = $result1[0]->cus_state_code;
        $_SESSION['STATE_CODE'] = $result1[0]->cus_state_code;
        //$result2 =  $this->invoice_model->getinvoicetax($cus_state_code,$tax_group_id);
        $result2 =  $this->invoice_model->getinvoicetax($cus_state_code,$tax_group_id,$id);

        echo json_encode($result2);
    }

    public function NewInvoice()
    {
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

        $this->load->view('invoice_add', $data);
        $this->session->unset_userdata("invoice");
    }

    public function NewDCInvoice()
    {
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

        $this->load->view('invoice_with_dc', $data);
        $this->session->unset_userdata("invoice");
    }

    public function NewDeliveryChallan()
    {
        $mes = $this->session->userdata("invoice");
        $res = $this->dashboard_model->GetCompanydatas();

        if(isset($mes))
        {
            $data = array(
                'logo' => $res[0],
                'company' => $res[1],
                'title' => 'Delivery Challan || Dashboard',
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
                'title' => 'Delivery Challan || Dashboard',
                'message' => '',
                'name' => $this->dashboard_model->userdetails()->u_name,
                'getcustomer' => $this->GetInvoiceCustomer(),
                'payment_option' => $this->GetInvoicePayOption(),
                'category' => $this->LoadCatagoryList(),
                'uom' => $this->LoadUOMList(),
                'taxgroup' => $this->LoadTaxGroupList()
            );
        }

        $this->load->view('delivery_challan_add', $data);
        $this->session->unset_userdata("invoice");
    }

    public function GetInvoiceCustomer()
    {
        $res = $this->invoice_model->getcustomer();
        return $res;
    }

    public function GetInvoicePayOption()
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

    public function DeliveryChallanDelete()
    {
        $id = $this->input->post('id');

        $result = $this->invoice_model->deletedc($id);

        echo $result;
    }

    public function DeliveryChallanView()
    {
        $inv_id = $this->input->post('id');
        $result = $this->invoice_model->viewdc($inv_id);
        $res = $result[0];
        echo json_encode($res);
    }

    public function InvoiceDcGetProduct()
    {
        $cusid = $this->input->post('cusid');
        $resultobj = $this->invoice_model->dcinvoicegetcustomerproduct($cusid);

        $arrobj = json_decode(json_encode($resultobj),true);
        echo json_encode($arrobj);
    }

    public function InvoiceDcNumbers()
    {
        $dcno = $this->input->post('dcnum');


        foreach ($dcno as &$value) {
            $value = "'".$value."'";
        }
        unset($value);

        $dcnums = implode(',',$dcno);
        $result = $this->invoice_model->GetInvoiceFromDc($dcnums);

        $arrobj = json_decode(json_encode($result),true);
        echo json_encode($arrobj);
    }

    public function GetTaxDetailsWithDc()
    {
        $cus_id = $this->input->post('cusid');
        $tax_group_id = $this->input->post('tax_group_id');

        $result1 =  $this->invoice_model->getcustomerbyid($cus_id);

        $cus_state_code = $result1[0]->cus_state_code;

        $result = $this->invoice_model->gettaxdetails($tax_group_id,$cus_state_code);

        $arrobj = json_decode(json_encode($result),true);
        echo json_encode($arrobj);
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
        elseif ($message == 'already_existed')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>&nbsp; This Invoice Number alredy Existed... Please give another number...</div>';
        }

        return $mess;
    }
}
?>

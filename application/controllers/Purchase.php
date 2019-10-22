<?php
/**
 * Created by PhpStorm.
 * User: Attract-01
 * Date: 1/29/2018
 * Time: 4:49 PM
 */

require_once (APPPATH.'controllers/Product.php');
class Purchase extends Product
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array("purchase_model","invoice_model"));
    }

    public function index()
    {
        $mes = $this->session->userdata("purchase");
        $res = $this->dashboard_model->GetCompanydatas();

        if(isset($mes))
        {
            $data = array(
                'logo' => $res[0],
                'company' => $res[1],
                'title' => 'Purchase || Dashboard',
                'message' => $this->Message($mes),
                'name' => $this->dashboard_model->userdetails()->u_name,
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
                'title' => 'Purchase || Dashboard',
                'message' => '',
                'name' => $this->dashboard_model->userdetails()->u_name,
                'category' => $this->LoadCatagoryList(),
                'uom' => $this->LoadUOMList(),
                'taxgroup' => $this->LoadTaxGroupList()
            );
        }

        $this->load->view('purchase_list', $data);
        $this->session->unset_userdata("purchase");
    }

    public function NewPurchase()
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

        $this->load->view('purchase_add', $data);
        $this->session->unset_userdata("invoice");
    }

    public function PurchaseInvoiceSave()
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
            'prepared_by' => $this->dashboard_model->userdetails()->u_name
        );

        //print_r($data); exit;

        $result = $this->invoice_model->GenerateInvoice($data);
        $product = $this->input->post('product');
        $qty = $this->input->post('qty');

        foreach ($product as $k => $v)
        {
            $product_id = $v;
            $pro_qty = $qty[$k];

            $this->load->model("invoicedetail_model");
            $result1 = $this->invoicedetail_model->Insert($product_id,$pro_qty,$_SESSION['STATE_CODE'],$result->id,$result->invoice_id);
        }

        if($result1 == 1)
        {
            $invno = $result->invoice_id;
            redirect('invoice/printinvoice/'.$invno.'/');
        }
    }

    public function SavePurchase()
    {
        $discount = $this->input->post('discount');
        $disval = $this->input->post('discount_val');

        if($discount == 'flat')
        {
            $flat = $disval;
            $per = 0;
        }
        elseif ($discount == 'per')
        {
            $per = $disval;
            $flat = 0;
        }
        else
        {
            $flat = 0;
            $per = 0;
            $discount = 0;
        }

        $data = array(
            'product_name' => $this->input->post('product_name'),
            'hsncode' => $this->input->post('hsncode'),
            'category_id' => $this->input->post('category'),
            'uom' => $this->input->post('uom'),
            'price' => $this->input->post('price'),
            'tax_group_id' => $this->input->post('tax_group'),
            'reordered_level' => $this->input->post('reordered_level'),
            'discount_amount' => $flat,
            'discount_per' => $per,
            'discount' => $discount,
            'status' => 'active'
        );

        $res = $this->purchase_model->purchaseproductsave($data);

        if(!$res == 0)
        {
            $data1 = array(
                'prod_id' => $res,
                'inv_no' => '0',
                'pur_no' => '0',
                'quantity' => $this->input->post('product_qty'),
                'created_at' => $this->dashboard_model->DateTime()
            );

                $result = $this->purchase_model->PurchaseSave($data1);

                if($result == 1)
                {
                    $this->session->set_userdata("purchase","purchase_saved");
                    redirect('purchase/');
                }
                else
                {
                    $this->session->set_userdata("purchase","purchase_unsaved");
                    redirect('purchase/');
                }
        }
        else
        {
            $this->session->set_userdata("purchase","something_wrong");
            redirect('purchase/');
        }
    }

    public function PurchaseServerSide()
    {

        // DB table to use
        $table = 'product_stock';

        // Table's primary key
        $primaryKey = 'stock_id';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes

        $columns = array(
            array( 'db' => '`sto`.`stock_id`', 'dt' => 0,'field' => 'stock_id'),

            array( 'db' => '`sto`.`prod_id`',  'dt' => 1,'field' => 'prod_id'  ),
            array( 'db' => '`prod`.`hsncode`',   'dt' =>2,'field' => 'hsncode'  ),
            array( 'db' => '`prod`.`product_name`',     'dt' => 3,'field' => 'product_name'  ),

            array( 'db' => '`sto`.`stock`',     'dt' => 4,'field' => 'stock' ),

            array( 'db' => '`sto`.`pur_no`',     'dt' => 5,'field' => 'pur_no' ),
            array( 'db' => '`sto`.`created_at`',     'dt' => 6,'field' => 'created_at' )

        );

        // SQL server connection information
        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db'   => $this->db->database,
            'host' => $this->db->hostname
        );

        $joinQuery = "FROM product AS prod JOIN product_stock AS sto ON (prod.product_id = sto.prod_id)";
        $extraWhere = "";
        $groupBy = "";
        $having = "";

        echo json_encode(
            SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $having )
        );

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

    private function Message($message)
    {
        if($message == 'purchase_saved')
        {
            $mess = '<div class="alert alert-success"><strong>Success!!!</strong>&nbsp; Purchase Record Inserted Successfully...</div>';
        }
        elseif ($message == 'purchase_saved')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>&nbsp; Purchase Record Does not Inserted Try again...</div>';
        }
        elseif ($message == 'updated')
        {
            $mess = '<div class="alert alert-success"><strong>Success!!!</strong>&nbsp; Customer Record Updated Successfully...</div>';
        }
        elseif ($message == 'something_wrong')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>&nbsp; Purchase Record does not inserted please check try again...</div>';
        }

        return $mess;
    }

    public function ImportPurchaseToDatabase()
    {
        //print_r($_POST); exit;
        if(!empty($_FILES['productexcelfile']['name']))
        {
            $pathinfo = pathinfo($_FILES['productexcelfile']['name']);

            if (($pathinfo['extension'] == 'xlsx' || $pathinfo['extension'] == 'xls') && $_FILES['productexcelfile']['size'] > 0 )
            {
                $excelfile = $_FILES['productexcelfile']['tmp_name'];
                $xl = new SimpleXLSX($excelfile);

                foreach ($xl->rows() as $row)
                {
                    $res[] = $row;
                }

                unset($res[0]);

                foreach ($res as $v)
                {
                    $data = array(
                        "product_id" => $v[0],
                        "product_name" => $v[1],
                        "hsncode" => $v[2],
                        "category_id" => $v[3],
                        "uom" => $v[4],
                        "price" => $v[5],
                        "tax_group_id" => $v[6],
                        "reordered_level" => $v[7],
                        "discount_amount" => $v[8],
                        "discount_per" => $v[9],
                        "discount" => $v[10],
                        "status" => $v[11]
                    );

                    $result = $this->product_model->importbulkproduct($data);
                }

                if($result == 1)
                {
                    $this->session->set_userdata("purchase","product_saved");
                    redirect('purchase/');
                }
                else
                {
                    $this->session->set_userdata("purchase","product_unsaved");
                    redirect('purchase/');
                }


            }
            else
            {
                $this->session->set_userdata("purchase",'filedoesnotexcel');
            }
        }
        else
        {
            $this->session->set_userdata("purchase",'choosefile');
        }

        redirect('purchase/');

    }

    public function test()
    {
        $this->load->view('test_invoice');
    }
}
?>
<?php
/**
 * Created by PhpStorm.
 * User: Attract-01
 * Date: 4/6/2018
 * Time: 10:46 AM
 */

require_once ('Welcome.php');
require_once (APPPATH.'libraries/ssp.class.php');

class Supplier extends Welcome
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model(array('dashboard_model','supplier_model'));
    }

    public function index()
    {
        $mes = $this->session->userdata("supplier");
        $res = $this->dashboard_model->GetCompanydatas();

        if(isset($mes))
        {
            $data = array(
                'logo' => $res[0],
                'company' => $res[1],
                'title' => 'Supplier || Dashboard',
                'message' => $this->Message($mes),
                'name' => $this->dashboard_model->userdetails()->u_name,
                'state' => $this->LoadState()
            );
        }
        else
        {
            $data = array(
                'logo' => $res[0],
                'company' => $res[1],
                'title' => 'Supplier || Dashboard',
                'message' => '',
                'name' => $this->dashboard_model->userdetails()->u_name,
                'state' => $this->LoadState()
            );
        }

        $this->load->view('supplier_list', $data);
        $this->session->unset_userdata("supplier");
    }

    public function NewSupplier()
    {
        $mes = $this->session->userdata("supplier");
        $res = $this->dashboard_model->GetCompanydatas();

        if(isset($mes))
        {
            $data = array(
                'logo' => $res[0],
                'company' => $res[1],
                'title' => 'Add Supplier || Dashboard',
                'message' => $this->Message($mes),
                'name' => $this->dashboard_model->userdetails()->u_name,
                'state' => $this->LoadState()
            );
        }
        else
        {
            $data = array(
                'logo' => $res[0],
                'company' => $res[1],
                'title' => 'Add Supplier || Dashboard',
                'message' => '',
                'name' => $this->dashboard_model->userdetails()->u_name,
                'state' => $this->LoadState()
            );
        }

        $this->load->view('supplier_new', $data);
        $this->session->unset_userdata("supplier");

    }

    public function SupplierSave()
    {

        $data = array(
            'sup_name' => $this->input->post('sup_name'),
            'sup_compnay_name' => $this->input->post('sup_company_name'),
            'sup_email' => $this->input->post('sup_email'),
            'sup_mobile1' => $this->input->post('sup_mobile'),
            'sup_mobile2' => $this->input->post('sup_mobile2'),
            'sup_phone' => $this->input->post('sup_phone'),
            'sup_address1' => $this->input->post('sup_address1'),
            'sup_address2' => $this->input->post('sup_address2'),
            'sup_place' => $this->input->post('sup_place'),
            'sup_city' => $this->input->post('sup_city'),
            'sup_country' => $this->input->post('sup_country'),
            'sup_state' => $this->input->post('cus_state'),
            'sup_state_code' => $this->input->post('cus_state_code'),
            'pin_code' => $this->input->post('sup_pin_code'),
            'website' => $this->input->post('sup_website'),
            'sup_gstin_no' => $this->input->post('sup_gstin_code'),
            'sup_cdate' => $this->dashboard_model->date(),
            'status' => 'active'
        );

        $result = $this->supplier_model->savesupplier($data);

        if($result == 1)
        {
            $this->session->set_userdata("supplier","saved");
            redirect('supplier/');
        }
        else
        {
            $this->session->set_userdata("supplier","unsaved");
            redirect('supplier/');
        }
    }

    public function supplierEdit()
    {
        $sup_id = $this->input->post('id');

        $result = $this->supplier_model->getsupplierbyid($sup_id);

        $val = $result[0];

        echo json_encode($val);
    }

    public function SupplierUpdate()
    {
        $id = $this->input->post('cusid');
        $data = array(
            'sup_name' => $this->input->post('sup_name'),
            'sup_compnay_name' => $this->input->post('sup_company_name'),
            'sup_email' => $this->input->post('sup_email'),
            'sup_mobile1' => $this->input->post('sup_mobile'),
            'sup_mobile2' => $this->input->post('sup_mobile2'),
            'sup_phone' => $this->input->post('sup_phone'),
            'sup_address1' => $this->input->post('sup_address1'),
            'sup_address2' => $this->input->post('sup_address2'),
            'sup_place' => $this->input->post('sup_place'),
            'sup_city' => $this->input->post('sup_city'),
            'sup_country' => $this->input->post('sup_country'),
            'sup_state' => $this->input->post('cus_state'),
            'sup_state_code' => $this->input->post('cus_state_code'),
            'pin_code' => $this->input->post('sup_pin_code'),
            'website' => $this->input->post('sup_website'),
            'sup_gstin_no' => $this->input->post('sup_gstin_code'),
            'sup_cdate' => $this->dashboard_model->date(),
            'status' => 'active'
        );

        $result = $this->supplier_model->updatesupplier($id,$data);

        if($result == 1)
        {
            $this->session->set_userdata("supplier","updated");
            redirect('supplier/');
        }
        else
        {
            $this->session->set_userdata("supplier","unupdated");
            redirect('supplier/');
        }
    }

    public function StatusUpdate()
    {
        $id = $this->input->post('id');
        $res = $this->supplier_model->statusupdatesupplier($id);
        echo $res;
    }

    public function SupplierDelete()
    {
        $id = $this->input->post('id');
        $res = $this->supplier_model->deletesupplier($id);
        echo $res;
    }

    public function SupplierServerSide()
    {
        // DB table to use
        $table = 'supplier';

        // Table's primary key
        $primaryKey = 'sup_id';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes
        $columns = array(
            array( 'db' => 'sup_id', 'dt' => 0 ),
            array( 'db' => 'sup_name',  'dt' => 1 ),
            array( 'db' => 'sup_compnay_name',   'dt' => 2 ),
            array( 'db' => 'sup_mobile1',     'dt' => 3 ),
            array( 'db' => 'sup_place',     'dt' => 4 ),
            array(
                'db'        => 'status',
                'dt'        => 5,
                'formatter' => function( $d, $row ) {
                    if($d == 'active')
                    {
                        $btn = "btn btn-success btn-xs";
                    }
                    else
                    {
                        $btn = "btn btn-danger btn-xs";
                    }
                    return '<button type="button" id="btnstatus" class="'.$btn.'">'.$d.'</button>';
                }
            ),

            array(
                'db'        => 'sup_place',
                'dt'        => 6,
                'formatter' => function( $d, $row ) {
                    return '<button type="button" id="btnview" class="btn btn-success btn-xs" title="View"><i class="fa fa-eye" aria-hidden="true"></i></button> &nbsp; 
                            <button type="button" id="btnedit" class="btn btn-primary btn-xs" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                            &nbsp; <button type="button" id="btndelete" class="btn btn-danger btn-xs" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button>';
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

        $joinQuery = "";
        $extraWhere = "";
        $groupBy = "";
        $having = "";

        echo json_encode(
            SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere,$groupBy,$having)
        );
    }

    private function Message($message)
    {
        if($message == 'saved')
        {
            $mess = '<div class="alert alert-success"><strong>Success!!!</strong>&nbsp; Supplier Record Inserted Successfully...</div>';
        }
        elseif ($message == 'unsaved')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>&nbsp; Supplier Record Does not Inserted Try again...</div>';
        }
        elseif ($message == 'updated')
        {
            $mess = '<div class="alert alert-success"><strong>Success!!!</strong>&nbsp; Supplier Record Updated Successfully...</div>';
        }
        elseif ($message == 'unupdated')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>&nbsp; Supplier Record Does not Updated Try again...</div>';
        }

        return $mess;
    }
}
?>
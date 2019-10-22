<?php
/**
 * Created by PhpStorm.
 * User: Attract-01
 * Date: 12/18/2017
 * Time: 12:55 PM
 */
require_once ('Welcome.php');
require_once (APPPATH.'libraries/ssp.class.php');

class Customer extends Welcome
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model(array('dashboard_model','customer_model'));
    }

    public function index()
    {
        $mes = $this->session->userdata("customer");
        $res = $this->dashboard_model->GetCompanydatas();

        if(isset($mes))
        {
            $data = array(
                'logo' => $res[0],
                'company' => $res[1],
                'title' => 'New Customer || Dashboard',
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
                'title' => 'New Customer || Dashboard',
                'message' => '',
                'name' => $this->dashboard_model->userdetails()->u_name,
                'state' => $this->LoadState()
            );
        }

        $this->load->view('customer_list', $data);
        $this->session->unset_userdata("customer");
    }

    public function NewCustomer()
    {
        $mes = $this->session->userdata("customer");
        $res = $this->dashboard_model->GetCompanydatas();

        if(isset($mes))
        {
            $data = array(
                'logo' => $res[0],
                'company' => $res[1],
                'title' => 'Add Company || Dashboard',
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
                'title' => 'Add Company || Dashboard',
                'message' => '',
                'name' => $this->dashboard_model->userdetails()->u_name,
                'state' => $this->LoadState()
            );
        }

        $this->load->view('customer_new', $data);
        $this->session->unset_userdata("customer");

    }

    public function CustomerEdit()
    {
        $cus_id = $this->input->post('id');

        $result = $this->customer_model->getcustomerbyid($cus_id);

        $val = $result[0];

        echo json_encode($val);
    }

    public function CustomerBranchEdit()
    {
        $cus_id = $this->input->post('id');

        $result = $this->customer_model->getcustomerbranchbyid($cus_id);

        $val = $result[0];

        echo json_encode($val);
    }

    public function CustomerSave()
    {

        $data = array(
            'cus_name' => $this->input->post('cus_name'),
            'cus_compnay_name' => $this->input->post('cus_company_name'),
            'cus_email' => $this->input->post('cus_email'),
            'cus_mobile1' => $this->input->post('cus_mobile'),
            'cus_mobile2' => $this->input->post('cus_mobile2'),
            'cus_phone' => $this->input->post('cus_phone'),
            'cus_address1' => $this->input->post('cus_address1'),
            'cus_address2' => $this->input->post('cus_address2'),
            'cus_place' => $this->input->post('cus_place'),
            'cus_city' => $this->input->post('cus_city'),
            'cus_country' => $this->input->post('cus_country'),
            'cus_state' => $this->input->post('cus_state'),
            'cus_state_code' => $this->input->post('cus_state_code'),
            'pin_code' => $this->input->post('cus_pin_code'),
            'website' => $this->input->post('cus_website'),
            'cus_gstin_no' => $this->input->post('cus_gstin_code'),
            'cus_cdate' => $this->dashboard_model->date(),
            'status' => 'active'
        );

        $result = $this->customer_model->savecustomer($data);

            if($result == 1)
            {
                $this->session->set_userdata("customer","saved");
                redirect('customer/');
            }
            else
            {
                $this->session->set_userdata("customer","unsaved");
                redirect('customer/');
            }
    }

    public function CustomerBranchSave()
    {
        $bid = $this->session->userdata("customer_branch_id");

        $data = array(
            'cus_id' => $bid,
            'shi_name' => $this->input->post('cus_name'),
            'shi_compnay_name' => $this->input->post('cus_company_name'),
            'shi_email' => $this->input->post('cus_email'),
            'shi_mobile1' => $this->input->post('cus_mobile'),
            'shi_mobile2' => $this->input->post('cus_mobile2'),
            'shi_phone' => $this->input->post('cus_phone'),
            'shi_address1' => $this->input->post('cus_address1'),
            'shi_address2' => $this->input->post('cus_address2'),
            'shi_place' => $this->input->post('cus_place'),
            'shi_city' => $this->input->post('cus_city'),
            'shi_country' => $this->input->post('cus_country'),
            'shi_state' => $this->input->post('cus_state'),
            'shi_state_code' => $this->input->post('cus_state_code'),
            'pin_code' => $this->input->post('cus_pin_code'),
            'website' => $this->input->post('cus_website'),
            'shi_gstin_code' => $this->input->post('cus_gstin_code'),
            'shi_cdate' => $this->dashboard_model->date(),
            'status' => 'active'
        );

        $result = $this->customer_model->savecustomerbranch($data);

        if($result == 1)
        {
            $this->session->set_userdata("customer","saved");
            redirect('customer/customerbranch/'.$bid.'/');
        }
        else
        {
            $this->session->set_userdata("customer","unsaved");
            redirect('customer/customerbranch/'.$bid.'/');
        }
    }

    public function CustomerUpdate()
    {
        $id = $this->input->post('cusid');
        $data = array(
            'cus_name' => $this->input->post('cus_name'),
            'cus_compnay_name' => $this->input->post('cus_company_name'),
            'cus_email' => $this->input->post('cus_email'),
            'cus_mobile1' => $this->input->post('cus_mobile'),
            'cus_mobile2' => $this->input->post('cus_mobile2'),
            'cus_phone' => $this->input->post('cus_phone'),
            'cus_address1' => $this->input->post('cus_address1'),
            'cus_address2' => $this->input->post('cus_address2'),
            'cus_place' => $this->input->post('cus_place'),
            'cus_city' => $this->input->post('cus_city'),
            'cus_country' => $this->input->post('cus_country'),
            'cus_state' => $this->input->post('cus_state'),
            'cus_state_code' => $this->input->post('cus_state_code'),
            'pin_code' => $this->input->post('cus_pin_code'),
            'website' => $this->input->post('cus_website'),
            'cus_gstin_no' => $this->input->post('cus_gstin_code'),
            'cus_cdate' => $this->dashboard_model->date(),
            'status' => 'active'
        );

        $result = $this->customer_model->updatecustomer($id,$data);

        if($result == 1)
        {
            $this->session->set_userdata("customer","updated");
            redirect('customer/');
        }
        else
        {
            $this->session->set_userdata("customer","unupdated");
            redirect('customer/');
        }
    }

    public function CustomerBranchUpdate()
    {
        $bid = $this->session->userdata("customer_branch_id");
        $id = $this->input->post('shiid');

        $data = array(
            'shi_name' => $this->input->post('cus_name'),
            'shi_compnay_name' => $this->input->post('cus_company_name'),
            'shi_email' => $this->input->post('cus_email'),
            'shi_mobile1' => $this->input->post('cus_mobile'),
            'shi_mobile2' => $this->input->post('cus_mobile2'),
            'shi_phone' => $this->input->post('cus_phone'),
            'shi_address1' => $this->input->post('cus_address1'),
            'shi_address2' => $this->input->post('cus_address2'),
            'shi_place' => $this->input->post('cus_place'),
            'shi_city' => $this->input->post('cus_city'),
            'shi_country' => $this->input->post('cus_country'),
            'shi_state' => $this->input->post('cus_state'),
            'shi_state_code' => $this->input->post('cus_state_code'),
            'pin_code' => $this->input->post('cus_pin_code'),
            'website' => $this->input->post('cus_website'),
            'shi_gstin_code' => $this->input->post('cus_gstin_code'),
            'shi_cdate' => $this->dashboard_model->date(),
            'status' => 'active'
        );

        $result = $this->customer_model->updatecustomerbranch($id,$data);

        if($result == 1)
        {
            $this->session->set_userdata("customer","updated");
            redirect('customer/customerbranch/'.$bid.'/');
        }
        else
        {
            $this->session->set_userdata("customer","unupdated");
            redirect('customer/customerbranch/'.$bid.'/');
        }
    }

    public function StatusUpdate()
    {
        $id = $this->input->post('id');
        $res = $this->customer_model->statusupdatecustomer($id);
        echo $res;
    }

    public function StatusUpdateCustomerBranch()
    {
        $id = $this->input->post('id');
        $res = $this->customer_model->statusupdatecustomerbranch($id);
        echo $res;
    }

    public function CustomerServerSide()
    {
        // DB table to use
        $table = 'customer';

        // Table's primary key
        $primaryKey = 'cus_id';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes
        $columns = array(
            array( 'db' => 'cus_id', 'dt' => 0 ),
            array( 'db' => 'cus_name',  'dt' => 1 ),
            array( 'db' => 'cus_compnay_name',   'dt' => 2 ),
            array( 'db' => 'cus_mobile1',     'dt' => 3 ),
            array( 'db' => 'cus_place',     'dt' => 4 ),
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
                'db'        => 'cus_place',
                'dt'        => 6,
                'formatter' => function( $d, $row ) {
                    return '<button type="button" id="btnview" class="btn btn-success btn-xs" title="View"><i class="fa fa-eye" aria-hidden="true"></i></button> &nbsp; 
                            <button type="button" id="btnedit" class="btn btn-primary btn-xs" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                            &nbsp; <button type="button" id="btnaddaddress" class="btn btn-success btn-xs" title="Add Address"><i class="fa fa-location-arrow" aria-hidden="true"></i></button>';
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

    public function CustomerBranchServerSide($cus_id)
    {
        // DB table to use
        $table = 'customer_branch';

        // Table's primary key
        $primaryKey = 'shi_id';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes
        $columns = array(
            array( 'db' => 'shi_id', 'dt' => 0 ),
            array( 'db' => 'shi_name',  'dt' => 1 ),
            array( 'db' => 'shi_mobile1',     'dt' => 2 ),
            array( 'db' => 'shi_place',     'dt' => 3 ),
            array(
                'db'        => 'status',
                'dt'        => 4,
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
                'db'        => 'status',
                'dt'        => 5,
                'formatter' => function( $d, $row ) {
                    return '<button type="button" id="btnview" class="btn btn-success btn-xs" title="View"><i class="fa fa-eye" aria-hidden="true"></i></button> &nbsp; 
                            <button type="button" id="btnedit" class="btn btn-primary btn-xs" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>';
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
        $extraWhere = "cus_id = '$cus_id' ";
        $groupBy = "";
        $having = "";

        echo json_encode(
            SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere,$groupBy,$having)
        );
    }

    public function CustomerBranch($cus_id)
    {
        $mes = $this->session->userdata("customer");
        $res = $this->dashboard_model->GetCompanydatas();

        if(isset($mes))
        {
            $data = array(
                'logo' => $res[0],
                'company' => $res[1],
                'title' => 'New Customer Address || Dashboard',
                'message' => $this->Message($mes),
                'name' => $this->dashboard_model->userdetails()->u_name,
                'cus_id' => $cus_id,
                'state' => $this->LoadState()
            );
        }
        else
        {
            $data = array(
                'logo' => $res[0],
                'company' => $res[1],
                'title' => 'New Customer Address || Dashboard',
                'message' => '',
                'cus_id' => $cus_id,
                'name' => $this->dashboard_model->userdetails()->u_name,
                'state' => $this->LoadState()
            );
        }

        $this->load->view('customer_branch_list', $data);
        $this->session->unset_userdata("customer");
    }

    public function AddAddressGetId()
    {
        $id = $this->input->post('id');
            $this->session->set_userdata("customer_branch_id",$id);
        echo $id;
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

}
?>
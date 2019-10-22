<?php
/**
 * Created by PhpStorm.
 * User: Attract-01
 * Date: 11/20/2017
 * Time: 12:36 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

require_once ('Welcome.php');
require_once (APPPATH.'libraries/ssp.class.php');

class Company extends Welcome
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model(array('company_model','dashboard_model'));

    }

    public function AddCompany()
    {
        $mes = $this->session->userdata("company");
        $res = $this->dashboard_model->GetCompanydatas();

            if(isset($mes))
            {
                $data = array(
                    'logo' => $res[0],
                    'company' => $res[1],
                    'title' => 'Add Company || Dashboard',
                    'message' => $this->Message($mes),
                    'name' => $this->dashboard_model->userdetails()->u_name,
                    'listform' => '',
                    'company_already_exists' => $this->dashboard_model->company()->comp_id,
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
                    'listform' => '',
                    'company_already_exists' => $this->dashboard_model->company()->comp_id,
                    'state' => $this->LoadState()
                );
            }

        $this->load->view('add_company',$data);
       $this->session->unset_userdata("company");
    }

    public function AddCompanyBranch()
    {
        $mes = $this->session->userdata("company");
        $res = $this->dashboard_model->GetCompanydatas();

        if(isset($mes))
        {
            $data = array(
                'logo' => $res[0],
                'company' => $res[1],
                'title' => 'Add CompanyModel || Dashboard',
                'message' => $this->Message($mes),
                'name' => $this->dashboard_model->userdetails()->u_name,
                'listform' => 'brachform',
                'state' => $this->LoadState()
            );
        }
        else
        {
            $data = array(
                'logo' => $res[0],
                'company' => $res[1],
                'title' => 'Add CompanyModel || Dashboard',
                'message' => '',
                'name' => $this->dashboard_model->userdetails()->u_name,
                'listform' => 'brachform',
                'state' => $this->LoadState()
            );
        }

        $this->load->view('add_company',$data);
        $this->session->unset_userdata("company");
    }

    public function CompanyEdit()
    {
        $id = $this->input->post('id');
        $result = $this->company_model->CompanyGetById($id);
        echo json_encode($result[0]);
    }

    public function CompanySave()
    {
                        $data = array(
                                        'comp_name' => $this->input->post('comp_name'),
                                        'comp_email' => $this->input->post('comp_email'),
                                        'comp_mobile1' => $this->input->post('comp_mobile'),
                                        'comp_mobile2' => $this->input->post('comp_mobile2'),
                                        'comp_phone' => $this->input->post('comp_phone'),
                                        'comp_address1' => $this->input->post('comp_address1'),
                                        'comp_address2' => $this->input->post('comp_address2'),
                                        'comp_place' => $this->input->post('comp_place'),
                                        'comp_city' => $this->input->post('comp_city'),
                                        'comp_state' => $this->input->post('comp_state'),
                                        'comp_state_code' => $this->input->post('comp_state_Code'),
                                        'comp_country' => $this->input->post('comp_country'),
                                        'comp_pin_code' => $this->input->post('comp_pin_code'),
                                        'comp_website' => $this->input->post('comp_website'),
                                        'comp_gstin_code' => $this->input->post('comp_gstin_code'),
                                        'comp_cdate' => $this->dashboard_model->date(),
                                        'comp_logo' => $this->ImageUpload('comp_logo'),
                                        'status' => 'active'
                                );

                                    $result = $this->company_model->SaveCompany($data);

                                    if($result == 1)
                                    {
                                        $this->session->set_userdata("company","company saved");
                                        redirect('company/addcompany');
                                    }
                                    else
                                    {
                                        $this->session->set_userdata("company","company unsaved");
                                        redirect('company/addcompany');
                                    }


    }

    public function CompanyUpdate()
    {
        $data = array(
            'comp_name' => $this->input->post('comp_name'),
            'comp_email' => $this->input->post('comp_email'),
            'comp_mobile1' => $this->input->post('comp_mobile'),
            'comp_mobile2' => $this->input->post('comp_mobile2'),
            'comp_phone' => $this->input->post('comp_phone'),
            'comp_address1' => $this->input->post('comp_address1'),
            'comp_address2' => $this->input->post('comp_address2'),
            'comp_place' => $this->input->post('comp_place'),
            'comp_city' => $this->input->post('comp_city'),
            'comp_state' => $this->input->post('comp_state'),
            'comp_state_code' => $this->input->post('comp_state_Code'),
            'comp_country' => $this->input->post('comp_country'),
            'comp_pin_code' => $this->input->post('comp_pin_code'),
            'comp_website' => $this->input->post('comp_website'),
            'comp_gstin_code' => $this->input->post('comp_gstin_code'),
            'comp_logo' => $this->ImageUpload('comp_logo'),
            'status' => 'active'
        );

        $compid = $this->input->post('comp_id');

        $result = $this->company_model->updatecompany($compid,$data);

        if($result == 1)
        {
            $this->session->set_userdata("company","company updated");
            redirect('company/addcompany');
        }
        else
        {
            $this->session->set_userdata("company","company unupdated");
            redirect('company/addcompany');
        }


    }

    public function CompanyServerSide()
    {
        // DB table to use
        $table = 'company_branch';

        // Table's primary key
        $primaryKey = 'bra_id';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes
        $columns = array(
            array( 'db' => 'bra_id', 'dt' => 0 ),
            array( 'db' => 'bra_name',  'dt' => 1 ),
            array( 'db' => 'bra_gstin_code',   'dt' => 2 ),
            array( 'db' => 'bra_mobile1',     'dt' => 3 ),
            array( 'db' => 'bra_place',     'dt' => 4 ),
            array( 'db' => 'bra_state',     'dt' => 5 ),

            array(
                'db'        => 'bra_state',
                'dt'        => 6,
                'formatter' => function( $d, $row ) {
                    return '<button type="button" id="btnview" class="btn btn-success btn-sm" title="View"><i class="fa fa-eye" aria-hidden="true"></i></button> &nbsp; 
                                    <button type="button" id="btnedit" class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>';
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

    public function BranchSave()
    {
        $data = array(

            'comp_id' => $this->dashboard_model->company()->comp_id,
            'bra_name' => $this->input->post('comp_name'),
            'bra_email' => $this->input->post('comp_email'),
            'bra_mobile1' => $this->input->post('comp_mobile'),
            'bra_mobile2' => $this->input->post('comp_mobile2'),
            'bra_phone' => $this->input->post('comp_phone'),
            'bra_address1' => $this->input->post('comp_address1'),
            'bra_address2' => $this->input->post('comp_address2'),
            'bra_place' => $this->input->post('comp_place'),
            'bra_city' => $this->input->post('comp_city'),
            'bra_state' => $this->input->post('comp_state'),
            'bra_state_code' => $this->input->post('comp_state_Code'),
            'bra_country' => $this->input->post('comp_country'),
            'bra_pin_code' => $this->input->post('comp_pin_code'),
            'bra_website' => $this->input->post('comp_website'),
            'bra_gstin_code' => $this->input->post('comp_gstin_code'),
            'bra_cdate' => $this->dashboard_model->date(),
            'comp_logo' => $this->ImageUpload('comp_logo'),
            'status' => 'active'
        );

        $result = $this->company_model->savecompanybranch($data);

        if($result == 1)
        {
            $this->session->set_userdata("company","company branch saved");
            redirect('company/AddCompany');
        }
        else
        {
            $this->session->set_userdata("company","company branch unsaved");
            redirect('company/AddCompany');
        }
    }

    public function CompanyBranchEdit()
    {
        $id = $this->input->post('id');
        $result = $this->company_model->BranchGetById($id);
        echo json_encode($result[0]);
    }

    public function BranchList()
    {
        $mes = $this->session->userdata("company");
        $res = $this->dashboard_model->GetCompanydatas();

        if(isset($mes))
        {
            $data = array(
                'logo' => $res[0],
                'company' => $res[1],
                'title' => 'Add CompanyModel || Dashboard',
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
                'title' => 'Add CompanyModel || Dashboard',
                'message' => '',
                'name' => $this->dashboard_model->userdetails()->u_name,
                'state' => $this->LoadState()
            );
        }

        $this->load->view('company_branch_list',$data);
        $this->session->unset_userdata("company");
    }

    public function CompanyBranchUpdate()
    {
        $data = array(

            'comp_id' => $this->dashboard_model->company()->comp_id,
            'bra_name' => $this->input->post('comp_name'),
            'bra_email' => $this->input->post('comp_email'),
            'bra_mobile1' => $this->input->post('comp_mobile'),
            'bra_mobile2' => $this->input->post('comp_mobile2'),
            'bra_phone' => $this->input->post('comp_phone'),
            'bra_address1' => $this->input->post('comp_address1'),
            'bra_address2' => $this->input->post('comp_address2'),
            'bra_place' => $this->input->post('comp_place'),
            'bra_city' => $this->input->post('comp_city'),
            'bra_state' => $this->input->post('comp_state'),
            'bra_state_code' => $this->input->post('comp_state_Code'),
            'bra_country' => $this->input->post('comp_country'),
            'bra_pin_code' => $this->input->post('comp_pin_code'),
            'bra_website' => $this->input->post('comp_website'),
            'bra_gstin_code' => $this->input->post('comp_gstin_code'),
            'bra_cdate' => $this->dashboard_model->date(),
            'comp_logo' => $this->ImageUpload('comp_logo'),
            'status' => 'active'
        );

        $id = $this->input->post('branch_id');

        $result = $this->company_model->updatecompanybranch($data,$id);

        if($result == 1)
        {
            $this->session->set_userdata("company","company branch updated");
            redirect('company/branchlist');
        }
        else
        {
            $this->session->set_userdata("company","company branch unupdated");
            redirect('company/branchlist');
        }
    }

    public function ImageUpload($image)
    {
        $config = array(
            'allowed_types' => 'jpg|png|jpeg',
            'upload_path' => './images/',
            'max_size' => 50000
        );

        $this->load->library('upload', $config);

        if($this->upload->do_upload($image))
        {
            $file = $this->upload->data();
            return $file['file_name'];
        }
        else
        {
            return 0;
        }
    }

    private function Message($message)
    {
        if($message == 'company saved')
        {
            $mess = '<div class="alert alert-success"><strong>Success!!!</strong>&nbsp; Company Record Inserted Successfully...</div>';
        }
        elseif ($message == 'company unsaved')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>&nbsp; Company Record Does not Inserted Try again...</div>';
        }
        elseif($message == 'company updated')
        {
            $mess = '<div class="alert alert-success"><strong>Success!!!</strong>&nbsp; Company Record Updated Successfully...</div>';
        }
        elseif ($message == 'company unupdated')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>&nbsp; Company Record Does not Updated Try again...</div>';
        }
        elseif ($message == 'company branch saved')
        {
            $mess = '<div class="alert alert-success"><strong>Success!!!</strong>&nbsp; Company Branch Record Inserted Successfully...</div>';
        }
        elseif ($message == 'company branch unsaved')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>&nbsp; Company Branch Record Does not Inserted Try again...</div>';
        }
        elseif ($message == 'company branch updated')
        {
            $mess = '<div class="alert alert-success"><strong>Success!!!</strong>&nbsp; Company Branch Record Updated Successfully...</div>';
        }
        elseif ($message == 'company branch unupdated')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>&nbsp; Company Branch Record Does not Updated Try again...</div>';
        }
        elseif ($message == 'company deleted')
        {
            $mess = '<div class="alert alert-success"><strong>Success!!!</strong>&nbsp; Company Branch Record Deleted Successfully...</div>';
        }
        elseif ($message == 'company undeleted')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>&nbsp; Company Branch Record Does not Deleted Try again...</div>';
        }

        return $mess;
    }
}
?>
<?php
/**
 * Created by PhpStorm.
 * User: Ravi
 * Date: 11/14/2017
 * Time: 1:50 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model(array("dashboard_model","task_model"));
    }

    public function test()
    {
        $res = $this->task_model->TotalInvoiceRecords();
        print_r($res);
    }

    public function index()
    {
        $res = $this->dashboard_model->GetCompanydatas();

        $data = array(
            'logo' => $res[0],
            'title' => 'Dashboard',
            'company' => $res[1],
            'name' => $this->dashboard_model->userdetails()->u_name,
        );

        $this->load->view('dashboard',$data);

    }

    public function ChangePassword()
    {
        $mes = $this->session->userdata("profile_edit");
        $res = $this->dashboard_model->GetCompanydatas();

        if(isset($mes))
        {
            $data = array(
                'logo' => $res[0],
                'company' => $res[1],
                'title' => 'Change Password || Dashboard',
                'name' => $this->dashboard_model->userdetails()->u_name,
                'emailid' => $this->dashboard_model->userdetails()->u_email,
                'username' => $this->dashboard_model->userdetails()->u_name,
                'message' => $this->Message($mes)
            );

        }
        else
        {
            $data = array(
                'logo' => $res[0],
                'company' => $res[1],
                'title' => 'Change Password || Dashboard',
                'name' => $this->dashboard_model->userdetails()->u_name,
                'emailid' => $this->dashboard_model->userdetails()->u_email,
                'username' => $this->dashboard_model->userdetails()->u_name,
                'message' => ''
            );
        }

        $this->load->view('changepassword',$data);
        $this->session->unset_userdata('changepassword');
    }

    public function ProfileEdit()
    {
        $mes = $this->session->userdata("profile_edit");
        $res = $this->dashboard_model->GetCompanydatas();

        if(isset($mes))
        {
                $data = array(
                    'logo' => $res[0],
                    'company' => $res[1],
                    'title' => 'Edit Profile || Dashboard',
                    'name' => $this->dashboard_model->userdetails()->u_name,
                    'emailid' => $this->dashboard_model->userdetails()->u_email,
                    'username' => $this->dashboard_model->userdetails()->u_name,
                    'message' => $this->Message($mes)
                );

        }
        else
        {
            $data = array(
                'logo' => $res[0],
                'company' => $res[1],
                'title' => 'Edit Profile || Dashboard',
                'name' => $this->dashboard_model->userdetails()->u_name,
                'emailid' => $this->dashboard_model->userdetails()->u_email,
                'username' => $this->dashboard_model->userdetails()->u_name,
                'message' => ''
            );
        }

        $this->load->view('admin_profile_edit',$data);
        $this->session->unset_userdata('profile_edit');
    }

    private function Message($message)
    {
        if($message == 'password_mismatch')
        {
            $mess = "<div class='alert alert-danger'>Your Current Password Do not Match...!!!</div>";
        }
        elseif ($message == 'password_updated')
        {
            $mess = "<div class='alert alert-success'><strong>Success...!!!</strong> Password Changed Successfully...</div>";
        }
        elseif ($message == 'password_un_updated')
        {
            $mess = "<div class='alert alert-danger'><strong>Failed...!!!</strong> Password Cannot Changed...!!!</div>";
        }
        elseif($message == 'profile_updated')
        {
            $mess = "<div class='alert alert-success'><strong>Success...!!!</strong> Profile Updated Successfully...!!!</div>";
        }
        elseif ($message == 'profile_un_updated')
        {
            $mess = "<div class='alert alert-danger'><strong>Failed...!!!</strong>Profile Cannot Updated...!!!</div>";
        }

        return $mess;
    }

}
?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
    {
        parent::__construct();

        $this->load->model(array('zone_model','user_model','company_model'));
    }

    public function index()
	{
        $path = base_url('images/');
        $com = $this->GetCompany();
	    if(!empty($com->comp_logo) || !empty($com->comp_name))
        {
            $logo = $path.$com->comp_logo;
            $company_name = $com->comp_name;
        }
        else
        {
            $logo = base_url('images/default-logo/attract-logo-small.png');
            $company_name = 'Attract Software';
        }

        $data = array(
            'message' => '',
            'title' => 'Login',
            'company' => $company_name,
            'complogo' => $logo
        );
            //print_r($data);
        $this->load->view('welcome',$data);
    }

    public function GetCompany()
    {
       $res = $this->company_model->CompanyGetById(1);
       return $res[0];
    }

    public function LoadState()
    {
        $result = $this->zone_model->loadState();
        return $result;
    }

    public function GetStateCode()
    {
        $state = $this->input->post('state');
        $result = $this->zone_model->GetByStateName($state);
        $val = $result[0]->statecode;
        echo $val;
    }

    public function Login()
    {
        $this->load->model('user_model');

       $data = array(
           'username' => $this->input->post('username'),
           'password' => $this->input->post('password')
       );

       $result =  $this->user_model->login($data);

       if($result == 0)
        {
            redirect('welcome/');
        }
        else
        {
            $this->session->set_userdata('user_detail',$result[0]);
            redirect('dashboard/');
        }
    }

    public function Logout()
    {
        $this->session->unset_userdata('user_detail');

        redirect('welcome/');
    }
}

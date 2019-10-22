<?php
/**
 * Created by PhpStorm.
 * User: Attract-01
 * Date: 12/12/2017
 * Time: 4:37 PM
 */

class Dashboard_model extends CI_Model
{
    var $create;
    var $read;
    var $update;
    var $delete;

    var $date;
    var $datetime;
    var $user_detail;
    var $formid;

    public function __construct()
    {
        parent::__construct();

        $this->Redirect();
        date_default_timezone_set('Asia/Kolkata');
        $this->date = date('Y-m-d');
        $this->datetime = date('Y-m-d H:i:s');
    }

    public function GetCompanydatas()
    {
        $path = base_url('images/');
        $com = $this->Company();
        if(!empty($com->comp_logo) || !empty($com->comp_name))
        {
            $logo = $path.$com->comp_logo;
            $company_name = $com->comp_name;
        }
        else
        {
            $logo = $path.'icon_company.jpg';
            $company_name = '3Fi Creaters';
        }

       return $data = array($logo,$company_name);
    }

    public function Company()
    {
        $qry = $this->db->get_where("company",array('comp_id' => '1'));

        if($qry->num_rows() == 1)
        {
            $res = $qry->result();
            return $res[0];
        }
    }

    public function Date()
    {
        return $this->date;
    }

    public function DateTime()
    {
        return $this->datetime;
    }

    public function Redirect()
    {
        $this->user_detail = $this->session->userdata('user_detail');
        if(!isset($this->user_detail->u_id))
        {
            redirect('welcome/');
        }
    }

    public function UserDetails()
    {
        return $this->user_detail;
    }

    public function Create($formid)
    {
        $this->RoleAccess($this->user_detail->u_id,$formid);
        return $this->create;
    }

    public function Read($formid)
    {
        $this->RoleAccess($this->user_detail->u_id,$formid);
        return $this->read;
    }

    public function Update($formid)
    {
        $this->RoleAccess($this->user_detail->u_id,$formid);
        return $this->update;
    }

    public function Delete($formid)
    {
        $this->RoleAccess($this->user_detail->u_id,$formid);
        return $this->delete;
    }

    public function RoleAccess($userid,$fromid)
    {
        $qry = $this->db->query("SELECT
                                      user_role_access.c,
                                      user_role_access.r,
                                      user_role_access.u,
                                      user_role_access.d
                                    FROM users JOIN user_role ON (users.user_role_id = user_role.user_role_id)
                                      JOIN user_role_access ON (user_role_access.user_role_id=user_role.user_role_id)
                                     WHERE users.u_id = '$userid' AND user_role_access.user_form_id = '$fromid'");

        $res =  $qry->result();

        $this->create = $res[0]->c;
        $this->read = $res[0]->r;
        $this->update = $res[0]->u;
        $this->delete = $res[0]->d;
    }
}
?>
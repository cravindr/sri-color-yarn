<?php
/**
 * Created by PhpStorm.
 * User: Attract-01
 * Date: 11/20/2017
 * Time: 4:21 PM
 */

class Company_model extends  CI_Model
{
    public function SaveCompany($data)
    {
        $qry = $this->db->insert('company',$data);
        return $qry;
    }

    public function CompanyGetById($id)
    {
        $qry = $this->db->get_where('company',array('comp_id' => $id));
        return $qry->result();
    }

    public function UpdateCompany($id,$data)
    {
        $qry = $this->db->update("company",$data, array('comp_id' => $id));
        return $qry;
    }

    public function SaveCompanyBranch($data)
    {
        $qry = $this->db->insert('company_branch',$data);
        return $qry;
    }

    public function UpdateCompanyBranch($data,$id)
    {
        $qry = $this->db->update("company_branch", $data, array('bra_id' => $id));
        return $qry;
    }

    public function BranchGetById($id)
    {
        $qry = $this->db->get_where('company_branch', array('bra_id' => $id));
        return $qry->result();
    }

    public function DeleteCompanyBranch($id)
    {
        $qry = $this->db->delete("company_branch", array('bra_id' => $id));
        return $qry;
    }
}
?>
<?php
/**
 * Created by PhpStorm.
 * User: Attract-01
 * Date: 12/18/2017
 * Time: 2:02 PM
 */

class Customer_model extends CI_Model
{
    public function SaveCustomer($data)
    {
        $qry = $this->db->insert("customer", $data);
        return $qry;
    }

    public function SaveCustomerBranch($data)
    {
        $qry = $this->db->insert("customer_branch", $data);
        return $qry;
    }

    public function GetCustomerById($id)
    {
        $qry = $this->db->get_where("customer", array('cus_id' => $id));
        return $qry->result();
    }

    public function GetCustomerBranchById($id)
    {
        $qry = $this->db->get_where("customer_branch", array('shi_id' => $id));
        return $qry->result();
    }

    public function UpdateCustomer($id,$data)
    {
        $qry = $this->db->update("customer", $data, array('cus_id' => $id));
        return $qry;
    }

    public function UpdateCustomerBranch($id,$data)
    {
        $qry = $this->db->update("customer_branch", $data, array('shi_id' => $id));
        return $qry;
    }

    public function DeleteCustomer($id)
    {
        $qry = $this->db->delete("customer", array('cus_id' => $id));
        return $qry;
    }

    public function StatusUpdateCustomer($id)
    {
        $cus = $this->GetCustomerById($id);

        if($cus[0]->status == 'active')
        {
            $status = 'inactive';
        }
        else
        {
            $status = 'active';
        }

        $data['status'] = $status;

        $qry = $this->db->update("customer", $data, array('cus_id' => $id));
        return $qry;

    }

    public function StatusUpdateCustomerBranch($id)
    {
        $cus = $this->GetCustomerBranchById($id);

        if($cus[0]->status == 'active')
        {
            $status = 'inactive';
        }
        else
        {
            $status = 'active';
        }

        $data['status'] = $status;

        $qry = $this->db->update("customer_branch", $data, array('shi_id' => $id));
        return $qry;

    }
}
?>
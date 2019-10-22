<?php
/**
 * Created by PhpStorm.
 * User: Attract-01
 * Date: 4/6/2018
 * Time: 12:04 PM
 */

class Supplier_model extends CI_Model
{
    public function SaveSupplier($data)
    {
        $qry = $this->db->insert("supplier", $data);
        return $qry;
    }

    public function GetSupplierById($id)
    {
        $qry = $this->db->get_where("supplier", array('sup_id' => $id));
        return $qry->result();
    }

    public function UpdateSupplier($id,$data)
    {
        $qry = $this->db->update("supplier", $data, array('sup_id' => $id));
        return $qry;
    }

    public function StatusUpdateSupplier($id)
    {
        $cus = $this->GetSupplierById($id);

        if($cus[0]->status == 'active')
        {
            $status = 'inactive';
        }
        else
        {
            $status = 'active';
        }

        $data['status'] = $status;

        $qry = $this->db->update("supplier", $data, array('sup_id' => $id));
        return $qry;

    }

    public function DeleteSupplier($id)
    {
        $qry = $this->db->delete('supplier', array('sup_id' => $id));
        return $qry;
    }

    public function GetSupplier()
    {
        $qry = $this->db->get('supplier');

        return $qry->result();
    }

    public function SaveSupplierLedger($data)
    {
        $qry = $this->db->insert('supplier_ledger',$data);
        return $qry;
    }

    public function SupplierServerSideReport($sup_id)
    {
        $qry = $this->db->query("SELECT
                                     s.trans_id,s.desc,s.inv_id,s.trans_date,
                                  @d:=COALESCE(CASE WHEN s.trans_type = 'debit' THEN s.amount END,0) as 'debit',
                                  @c:=COALESCE(CASE WHEN s.trans_type = 'credit' THEN s.amount END,0) as 'credit',
                                  @b := @b +  @d - @c as 'totalamount'
                                FROM
                                  (SELECT @b := 0.0) AS dummy
                                  CROSS JOIN
                                   supplier_ledger AS s
                                WHERE cus_id= '$sup_id'  
                                ORDER BY
                                  trans_id ");

        $total = $qry->num_rows();
        $count = 1;
        foreach ($qry->result() as $v)
        {
            $res[] = array(
                 $count++,
                $v->trans_id,
                $v->desc,
                $v->inv_id,
                $v->debit,
                $v->trans_date,
                $v->credit,
                $v->totalamount
            );
        }


        $final = array(
            "draw"=>1,
            "recordsTotal"=>$total,
            "recordsFiltered"=>$total,
            "data"=>$res
        );

        return $final;
    }
}
?>
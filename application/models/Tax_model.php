<?php
/**
 * Created by PhpStorm.
 * User: Ravi
 * Date: 11/21/2017
 * Time: 6:37 PM
 */

class Tax_model extends CI_Model
{


    public function SaveTax($data)
    {
        $qry=$this->db->insert('tax',$data);
     return $qry;
    }

    public function TaxZoneList()
    {
        $qry=$this->db->get_where("tax_zone" , array("status"=>'active'));
        return $qry->result();
    }

    public function  getTaxById($id)
    {
        $qry=$this->db->get_where("tax",array("tax_id"=>$id));
        return $qry->result();

    }

    public function UpdateTax($id,$data)
    {
        $qry=$this->db->update("tax",$data,array("tax_id"=>$id));
        return $qry;
    }

    public function EnableDisableTax($id,$status)
    {
        $qry=$this->db->query("UPDATE tax SET status='$status' WHERE tax_id='$id'");

        return $qry;
    }


    public function TaxList()
    {
        $qry=$this->db->get_where("tax" , array("status"=>'active'));
        return $qry->result();
    }

    public function getTaxGroupNameById($id)
    {
        $qry="SELECT group_concat(tax.tax_name) as 'tax_groups'
              FROM tax_group
              JOIN tax ON  find_in_set(tax.tax_id,tax_group.tax_id_groups)
              WHERE tax_group.tax_id_groups='$id'
              GROUP BY tax_group_id";

        $res=$this->db->query($qry);
        $ret=$res->result();
        return $ret[0]->tax_groups;

    }

    public function SaveTaxGroup($data)
    {
        $ret=$this->db->insert("tax_group",$data);
        return $ret;
    }
    public function UpdateTaxGroup($id,$data)
    {
        $ret=$this->db->update("tax_group",$data,array("tax_group_id"=>$id));
        return $ret;
    }
    public function EnableDisableTaxGroup($id,$status)
    {
        $qry=$this->db->query("UPDATE tax_group SET status='$status' WHERE tax_group_id='$id'");

        return $qry;
    }


    public function getTaxGroupDataById($id)
    {
       $qry= $this->db->get_where("tax_group",array("tax_group_id"=>$id));
       $res=$qry->result();
       return $res[0];
    }

    public function fnTaxGroupJson()
    {
        $qry=$this->db->query("select tg.tax_group_id as 'tax_group_id',tg.tax_groups_desc as 'tax_groups_desc',group_concat(t.tax_name) as 'tax_name',tg.status as 'status'  from tax_group tg join tax t on find_in_set(t.tax_id,tg.tax_id_groups) group by tg.tax_group_id");
        $tot=$qry->num_rows();
        $res=$qry->result();
        $btn='<button type="button" id="btnview" class="btn btn-success btn-xs" title="View"><i class="fa fa-eye" aria-hidden="true"></i>
                            </button>&nbsp;<button type="button" id="btnedit" class="btn btn-primary btn-xs" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                            <button type="button" id="btndelete" class="btn btn-danger btn-xs" title="Status Change"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
        foreach ($res as $re)
        {
          $a[]=array($re->tax_group_id,$re->tax_groups_desc,$re->tax_name,$re->status,$btn);
        }


        $final=array("draw"=>1,
            "recordsTotal"=>$tot,
            "recordsFiltered"=>$tot,
            "data"=>$a);

        return $final;
    }

}
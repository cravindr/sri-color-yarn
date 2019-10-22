<?php
/**
 * Created by PhpStorm.
 * User: Attract-01
 * Date: 1/30/2018
 * Time: 11:00 AM
 */

class Purchase_model extends CI_Model
{
    public function PurchaseSave($data)
    {
        $qry = $this->db->insert("product_stock",$data);
        return $qry;
    }

    public function PurchaseProductSave($data)
    {
        $this->db->insert("product",$data);
        return $this->db->insert_id();
    }
}
?>
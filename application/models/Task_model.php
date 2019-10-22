<?php
/**
 * Created by PhpStorm.
 * User: Attract-01
 * Date: 1/27/2018
 * Time: 7:45 PM
 */

class Task_model extends CI_Model
{
    public function TotalInvoiceRecords()
    {
        $qry = $this->db->get("invoice_master");
        return $qry->num_rows();
    }
}
?>
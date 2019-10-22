<?php
/**
 * Created by PhpStorm.
 * User: Ravi
 * Date: 11/14/2017
 * Time: 12:04 PM
 */

class Zone_model extends CI_Model
{
    public function loadState()
    {
        $qry = $this->db->get('state');
        return $qry->result();
    }

    public function GetByStateName($name)
    {
        $qry = $this->db->get_where("state",array("name" => $name ));
        return $qry->result();
    }

    public function ZoneSave($data)
    {
        $qry=$this->db->insert("tax_zone",$data);
        return $qry;

    }

    public function ZoneUpdate($id,$data)
    {
        $qry=  $this->db->update("tax_zone",$data,array('zone_id' => $id));
        return $qry;
    }

    public function EnableDisable($id,$status)
    {
        $qry=$this->db->query("UPDATE tax_zone SET status='$status' WHERE zone_id='$id'");
        return $qry;
    }

    public function getTaxZoneById($id)
    {
       $qry= $this->db->get_where("tax_zone",array("zone_id"=>$id));
       return $qry->result();

    }

}
?>
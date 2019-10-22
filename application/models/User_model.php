<?php
/**
 * Created by PhpStorm.
 * User: Ravi
 * Date: 11/14/2017
 * Time: 11:26 AM
 */

class User_model extends CI_Model
{
    public function Login($data)
    {
        $uname = $data['username'];
        $upass = $data['password'];

            $this->db->select('*');
            $this->db->from('users');
            $this->db->where("(`u_email`= '$uname' OR `u_mobile` = '$uname')");
            $this->db->where('u_password', md5($upass));
            $this->db->where('status', 'active');
            $qry = $this->db->get();

        if($qry->num_rows()==1)
        {
            return $qry->result();
        }
        else
        {
            return 0;
        }
    }


}
?>
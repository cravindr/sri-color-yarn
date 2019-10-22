<?php
/**
 * Created by PhpStorm.
 * User: Ravi
 * Date: 17-01-2018
 * Time: 11:35 AM
 */

class Missed_inv_no_model extends  CI_Model
{

    public function getMissedInvoiceNo()
    {

        $qry = $this->db->query("SELECT max(substr(inv_no,10,6)) AS `invoice_no` FROM invoice_master");
        $result = $qry->result();
        $max_inv_no =  $result[0]->invoice_no;
        $num = $max_inv_no;

        $qry = $this->db->query("SELECT substr(inv_no,10,6) AS `invoice_no` FROM invoice_master");
        $results = $qry->result();

        foreach ($results as $result)
        {
            $numbers[]=   $result-> invoice_no;
        }


        $start      = 1;
        $end        = $max_inv_no;
        $out=$this->findMissing($start,$end,$numbers);
        print_r( json_encode($out) );







    }


    public function findMissing($start,$end,$numbers)
    {
        sort($numbers);



        for($i=$start; $i<=$end; $i++)
        {

            if (in_array($i, $numbers))
            {
                //$allowed[]=$i;
            }
            else
            {
                $missed[]=$this->InvFormat($i);
            }

        }

        return $missed;
    }


    public function InvFormat($num)
    {   $inv_first_val = 'INV';
        $inv_middle_val = date('Y');
        $inv_last_val = str_pad($num, 6, 0, STR_PAD_LEFT);
        return $inv_no = $inv_first_val.'-'.$inv_middle_val.'-'.$inv_last_val;
    }



}
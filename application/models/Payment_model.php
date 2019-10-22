<?php
/**
 * Created by PhpStorm.
 * User: attract
 * Date: 1/4/2018
 * Time: 12:00 PM
 */

class Payment_model extends CI_Model
{

    public function Save($data)
    {

        $qry = $this->db->insert("ledger",$data);

        return $qry;

    }

    public function LoadCustomerName()
    {
       $qry = $this->db->get_where("customer",array('status'=>'active'));

       return $qry->result();
    }

    public function LoadLedgerDate()
    {
        $qry = $this->db->get("ledger");

        return $qry->result();
    }

    public function getReportListJson($cus_id='')

    {
        $strQry='';
            if($cus_id <>  '')
            {
                if($strQry=='')
                {
                    $strQry="ledger.cus_id=$cus_id";
                }
                else
                {
                    $strQry= $strQry." AND". "ledger.cus_id=$cus_id";
                }
            }

                     $qry="SELECT
                                  s.trans_id,s.desc,s.trans_date,
                                  @d:=COALESCE(CASE WHEN s.trans_type = 'debit' THEN s.amount END,0) as 'debit',
                                  @c:=COALESCE(CASE WHEN s.trans_type = 'credit' THEN s.amount END,0) as 'credit',
                                  @b := @b +  @d - @c as 'totalamount'
                                FROM
                                  (SELECT @b := 0.0) AS dummy
                                  CROSS JOIN
                                  ledger AS s
                                WHERE cus_id=$cus_id  
                                ORDER BY
                                  trans_id";


                    $ret=  $this->db->query($qry);
                    if($strQry)
                    {
                        $qry=$qry." WHERE ".   $strQry;


                        $res=$ret->result();

                        $btn="";
                        $tot=$ret->num_rows();
                        $res=$ret->result();
                        $sno=0;
                        foreach ($res as $re)
                        {
                            //print_r($re);
                            $sno=$sno+1;
                            $a[]=array($sno,
                                $re->trans_id,
                                $re->desc,
                                $re->debit,
                                $re->trans_date,
                                $re->credit,
                                number_format((float)$re->totalamount, 2, '.', '')

                            );
                        }

                        $final=array("draw"=>1,
                            "recordsTotal"=>$tot,
                            "recordsFiltered"=>$tot,
                            "data"=>$a);

                        return $final;





                    }
                    else
                    {



                        $tot=0;

                        $sno=0;


                            $a[]=array('.','.','.','.','.','.');



                        $final=array("draw"=>1,
                            "recordsTotal"=>$tot,
                            "recordsFiltered"=>$tot,
                            "data"=>$a);

                        return $final;

                    }


    }

    public function getPaymentListJSON($cus_id = '')
    {
        $cus_id=$this->fnRemoveDilt($cus_id);



//echo " cusid=$cus_id  : PayTye= $payment_type : Sdate=$startdate : Edate =$enddate";
        $output="";
        $strQry='';
        if($cus_id<>'')
        {
            if($strQry=='')
            {
                $strQry="ledger.cus_id=$cus_id";
            }
            else
            {
                $strQry= $strQry." AND". "ledger.cus_id=$cus_id";
            }
        }


        $qry="SELECT
              s.trans_id,s.cus_id,s.trans_date,
              @d:=COALESCE(CASE WHEN s.trans_type = 'debit' THEN s.amount END,0) as 'debit',
              @c:=COALESCE(CASE WHEN s.trans_type = 'credit' THEN s.amount END,0) as 'credit',
              @b := @b +  @d - @c as 'totalamount'
            FROM
              (SELECT @b := 0.0) AS dummy
              CROSS JOIN
              ledger AS s
            WHERE cus_id=$cus_id
            ORDER BY
              trans_id;
                       ";

        if($strQry)
        {
            $qry=$qry." WHERE ".   $strQry;
        }
        //     echo $qry;
        $ret=  $this->db->query($qry);
        $res=$ret->result();

        $btn="";
        $tot=$ret->num_rows();
        $res=$ret->result();
        $sno=0;
        foreach ($res as $re)
        {
            //print_r($re);
            $sno=$sno+1;
            $a[]=array($sno,
                $re->trans_id,
                $re->cus_id,
                $re->trans_date,
                $re->debit,
                $re->credit,
                $re->totalamount,

            );
        }


        $final=array("draw"=>1,
            "recordsTotal"=>$tot,
            "recordsFiltered"=>$tot,
            "data"=>$a);

        return $final;
    }

    function fnRemoveDilt($var) {
        if($var=='~')
        {
            return '';
        }
        else

        {
            return $var;
        }

    }




}
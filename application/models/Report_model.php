<?php
/**
 * Created by PhpStorm.
 * User: Ravi
 * Date: 30-12-2017
 * Time: 11:03
 */

class Report_model extends CI_Model
{

    public function GenerateReport($cus_id='',$payment_type='',$startdate='',$enddate='')
    {
        $output="";
        $strQry='';
        if($cus_id<>'')
        {
            if($strQry=='')
            {
                $strQry="invoice_master.cus_id=$cus_id";
            }
            else
            {
                $strQry= $strQry." AND". "invoice_master.cus_id=$cus_id";
            }
        }

        if($payment_type<>'')
        {
            if($strQry=='')
            {
                $strQry="invoice_master.payment_type='$payment_type'";
            }
            else
            {
                $strQry= $strQry." AND ". "invoice_master.payment_type='$payment_type'";
            }
        }


        if($startdate<>'' && $enddate<>'' )
        {
            if($strQry=='')
            {
                $strQry=" inv_date BETWEEN '$startdate' and '$enddate'";
            }
            else
            {
                $strQry= $strQry." AND inv_date BETWEEN '$startdate' and '$enddate'";
            }
        }
        elseif ($startdate<>'' )
        {
            if($strQry=='')
            {
                $strQry="invoice_master.inv_date='$startdate'";
            }
            else
            {
                $strQry= $strQry." AND ". "invoice_master.inv_date='$startdate'";
            }
        } elseif ($enddate<>'' )
        {
            if($strQry=='')
            {
                $strQry="invoice_master.inv_date='$enddate'";
            }
            else
            {
                $strQry= $strQry." AND ". "invoice_master.inv_date='$enddate'";
            }
        }


    $qry="SELECT inv_id,inv_no, cus.cus_name, inv_date,total,cgst,sgst,igst,gst,total,net_amount FROM invoice_master
          JOIN  customer cus ON (cus.cus_id=invoice_master.cus_id)
           ";

        if($strQry)
        {
            $qry=$qry." WHERE ".   $strQry;
        }

          //  echo $qry;


        $thead="<table cellpadding='1' cellspacing='1' border='1' width='100%'>
                <thead>
                <th>S.No</th>
                <th>Inv Id</th>
                <th>Inv.No</th>
                <th>Customer Name</th>
                <th>Date</th>
                <th>Total Amount</th>
                <th>CGST</th>
                <th>SGST</th>
                <th>IGST</th>
                <th>GST</th>
                <th>Net Amount</th>
                </thead>
                <tbody>";



        $tfoot="</tbody>
                </table>";



       $res= $this->db->query($qry);
        $rows=$res->result();
       // echo $thead;
        $output=$output.$thead;
$i=0;
        foreach ($rows as $row)
        {
            $i=$i+1;
            $sno =$i;
            $invid =$row->inv_id;
            $invno =$row->inv_no;
            $cusname =$row->cus_name;
            $invdate =$row->inv_date;
            $total=$row->total;
            $cgst=$row->cgst;
            $sgst=$row->sgst;
            $igst=$row->igst;
            $gst =$row->gst;
            $netamount =$row->net_amount;

            $tbody="<tr>
                    <td> $sno </td>
                    <td>$invid</td>
                    <td>$invno</td>
                    <td>$cusname</td>
                    <td>$invdate</td>
                    <td>$total</td>
                    <td>$cgst</td>
                    <td>$sgst</td>
                    <td>$igst</td>
                    <td>$gst</td>
                    <td>$netamount</td>
                </tr>";


            //echo  $tbody;
            $output=$output.$tbody;
        }

//echo $tfoot;
        $output=$output.$tfoot;

        return $output;
    }
    

    public function CustomerTransationReport($data)
    {

        $start_date = $data['start_date'];
        $end_date = $data['end_date'];
        $cusid = $data['cus_id'];
        $end_date_fin = $end_date.' 23:59:59';

        if($start_date == 0 && $end_date == 0 && !$cusid == 0)
        {
            //echo "customer id only mentioned"; exit;
            $qry1 = $this->db->query("(SELECT
                                                s.trans_id,
                                                s.desc,
                                                s.trans_date,
                                                @d:=COALESCE(CASE WHEN s.trans_type = 'debit' THEN s.amount END,0) as 'debit',
                                                @c:=COALESCE(CASE WHEN s.trans_type = 'credit' THEN s.amount END,0) as 'credit',
                                                @b := @b + @d - @c as 'totalamount'
                                            
                                             FROM (SELECT @b := 0.0) AS dummy CROSS JOIN ledger AS s WHERE cus_id= '$cusid'  ORDER BY trans_date, trans_id)");
            $finalresult = $qry1->result();
            $total = $qry1->num_rows();

            foreach ($finalresult as $v)
            {
                $res[] = array(
                    $v->trans_id,
                    $v->trans_date,
                    $v->desc,
                    $v->debit,
                    $v->credit,
                    $v->totalamount
                );
            }

            $final = array("draw" => 1,
                "recordsTotal" => $total,
                "recordsFiltered" => $total,
                "data" => $res);

            return $final;
        }
        elseif (!$start_date == 0 && !$end_date == 0 && $cusid == 0)
        {
            //echo "date only mentioned"; exit;
            $qry1 = $this->db->query("SELECT
                                      s.trans_id,s.desc,s.trans_date,cus.cus_compnay_name,
                                      @d:=COALESCE(CASE WHEN s.trans_type = 'debit' THEN s.amount END,0) as 'debit',
                                      @c:=COALESCE(CASE WHEN s.trans_type = 'credit' THEN s.amount END,0) as 'credit'
                                    FROM
                                      ledger AS s join customer as cus on (s.cus_id = cus.cus_id)
                                    WHERE s.trans_date between '$start_date' and '$end_date_fin'
                                    ORDER BY
                                      trans_id");
           // print_r($this->db->last_query()); exit;
            $finalresult = $qry1->result();
            $total = $qry1->num_rows();

            foreach ($finalresult as $v)
            {
                $res[] = array(
                    $v->trans_id,
                    $v->trans_date,
                    $v->cus_compnay_name,
                    $v->debit,
                    $v->credit
                );
            }

            $final = array("draw" => 1,
                "recordsTotal" => $total,
                "recordsFiltered" => $total,
                "data" => $res);

            return $final;
        }
        elseif (!$start_date == 0 && !$end_date == 0 && !$cusid == 0)
        {
            //echo "all mentioned"; exit;
            //echo "Else  part excecute";
            $qryoppning = $this->db->query("(SELECT
                                               s.trans_id,
                                               s.desc,
                                               s.trans_date,
                                               @d:=COALESCE(CASE WHEN s.trans_type = 'debit' THEN s.amount END,0) as 'debit',
                                               @c:=COALESCE(CASE WHEN s.trans_type = 'credit' THEN s.amount END,0) as 'credit',
                                               @b := @b + @d - @c as 'totalamount',
                                               @res :=@b as balance
                                             FROM (SELECT @b := 0.0) AS dummy CROSS JOIN ledger AS s WHERE cus_id= '$cusid' and trans_date <  '$start_date' ORDER BY trans_date, trans_id)");
            //print_r($this->db->last_query()); exit;
            $res = $qryoppning->result();
            $rec = $qryoppning->num_rows();

            if(!$rec == 0)
            {
                $reco = $rec - 1;
                //print_r($reco); exit;
                $op_bal =  $res[$reco]->balance;
            }
            else
            {
                $op_bal =  0.00;
            }

            //print_r($op_bal); exit;

            $qry = $this->db->query("(SELECT
                                       st.trans_id,
                                       st.desc,
                                       st.trans_date,
                                       @d:=COALESCE(CASE WHEN st.trans_type = 'debit' THEN st.amount END,0) as 'debit',
                                       @c:=COALESCE(CASE WHEN st.trans_type = 'credit' THEN st.amount END,0) as 'credit',
                                       @b := @b + @d - @c as 'totalamount'
                                     FROM (SELECT @b := '$op_bal') AS dummy CROSS JOIN ledger AS st 
                                     WHERE cus_id= '$cusid' and trans_date between  '$start_date' and '$end_date_fin'  ORDER BY trans_date, trans_id)");
            $total = $qry->num_rows();
            $finalresult = $qry->result();


            $res = array(
                '',
                '',
                'Opening Balance',
                '',
                '',
                $op_bal
            );

            $arr = array();

            array_push($arr,$res);
            foreach ($finalresult as $v)
            {
                if($v->desc == null)
                {
                    $desc = "";
                }
                else
                {
                    $desc = $v->desc;
                }
                $r = array (
                    $v->trans_id,
                    $v->trans_date,
                    $desc,
                    $v->debit,
                    $v->credit,
                    $v->totalamount
                );

                array_push($arr,$r);
            }

            $final = array("draw" => 1,
                "recordsTotal" => $total,
                "recordsFiltered" => $total,
                "data" => $arr);

            return $final;
        }
    }
    
    public function SupplierTransationReport($data)
    {

        $start_date = $data['start_date'];
        $end_date = $data['end_date'];
        $cusid = $data['sup_id'];
        $end_date_fin = $end_date.' 23:59:59';

        if($start_date == 0 && $end_date == 0 && !$cusid == 0)
        {
            //echo "customer id only mentioned"; exit;
            $qry1 = $this->db->query("(SELECT
                                                s.trans_id,
                                                s.desc,
                                                s.trans_date,
                                                @d:=COALESCE(CASE WHEN s.trans_type = 'debit' THEN s.amount END,0) as 'debit',
                                                @c:=COALESCE(CASE WHEN s.trans_type = 'credit' THEN s.amount END,0) as 'credit',
                                                @b := @b + @d - @c as 'totalamount'
                                            
                                             FROM (SELECT @b := 0.0) AS dummy CROSS JOIN supplier_ledger AS s WHERE cus_id= '$cusid'  ORDER BY trans_date, trans_id)");
            $finalresult = $qry1->result();
            $total = $qry1->num_rows();

            foreach ($finalresult as $v)
            {
                $res[] = array(
                    $v->trans_id,
                    $v->trans_date,
                    $v->desc,
                    $v->debit,
                    $v->credit,
                    $v->totalamount
                );
            }

            $final = array("draw" => 1,
                "recordsTotal" => $total,
                "recordsFiltered" => $total,
                "data" => $res);

            return $final;
        }
        elseif (!$start_date == 0 && !$end_date == 0 && $cusid == 0)
        {
            //echo "date only mentioned"; exit;
            $qry1 = $this->db->query("SELECT
                                      s.trans_id,s.desc,s.trans_date,sup.sup_compnay_name,
                                      @d:=COALESCE(CASE WHEN s.trans_type = 'debit' THEN s.amount END,0) as 'debit',
                                      @c:=COALESCE(CASE WHEN s.trans_type = 'credit' THEN s.amount END,0) as 'credit'
                                    FROM
                                      supplier_ledger AS s join supplier as sup on (s.cus_id = sup.sup_id)
                                    WHERE s.trans_date between '$start_date' and '$end_date_fin'
                                    ORDER BY
                                      trans_id");

            $finalresult = $qry1->result();
            $total = $qry1->num_rows();

            foreach ($finalresult as $v)
            {
                $res[] = array(
                    $v->trans_id,
                    $v->trans_date,
                    $v->sup_compnay_name,
                    $v->debit,
                    $v->credit
                );
            }

            $final = array("draw" => 1,
                "recordsTotal" => $total,
                "recordsFiltered" => $total,
                "data" => $res);

            return $final;
        }
        elseif (!$start_date == 0 && !$end_date == 0 && !$cusid == 0)
        {
            //echo "all mentioned"; exit;
            //echo "Else  part excecute";
            $qryoppning = $this->db->query("(SELECT
                                               s.trans_id,
                                               s.desc,
                                               s.trans_date,
                                               @d:=COALESCE(CASE WHEN s.trans_type = 'debit' THEN s.amount END,0) as 'debit',
                                               @c:=COALESCE(CASE WHEN s.trans_type = 'credit' THEN s.amount END,0) as 'credit',
                                               @b := @b + @d - @c as 'totalamount',
                                               @res :=@b as balance
                                             FROM (SELECT @b := 0.0) AS dummy CROSS JOIN supplier_ledger AS s WHERE cus_id= '$cusid' and trans_date <  '$start_date' ORDER BY trans_date, trans_id)");
            //print_r($this->db->last_query()); exit;
            $res = $qryoppning->result();
            $rec = $qryoppning->num_rows();

                    if(!$rec == 0)
                    {
                        $reco = $rec - 1;
                        //print_r($reco); exit;
                        $op_bal =  $res[$reco]->balance;
                    }
                    else
                    {
                        $op_bal =  0.00;
                    }

            $qry = $this->db->query("(SELECT
                                       st.trans_id,
                                       st.desc,
                                       st.trans_date,
                                       @d:=COALESCE(CASE WHEN st.trans_type = 'debit' THEN st.amount END,0) as 'debit',
                                       @c:=COALESCE(CASE WHEN st.trans_type = 'credit' THEN st.amount END,0) as 'credit',
                                       @b := @b + @d - @c as 'totalamount'
                                     FROM (SELECT @b := '$op_bal') AS dummy CROSS JOIN supplier_ledger AS st 
                                     WHERE cus_id= '$cusid' and trans_date between  '$start_date' and '$end_date_fin'  ORDER BY trans_date, trans_id)");
            $total = $qry->num_rows();
            $finalresult = $qry->result();


            $res = array(
                '',
                '',
                'Opening Balance',
                '',
                '',
                $op_bal
            );

            $arr = array();

            array_push($arr,$res);
            foreach ($finalresult as $v)
            {
                if($v->desc == null)
                {
                    $desc = "";
                }
                else
                {
                    $desc = $v->desc;
                }
                $r = array (
                    $v->trans_id,
                    $v->trans_date,
                    $desc,
                    $v->debit,
                    $v->credit,
                    $v->totalamount
                );

                array_push($arr,$r);
            }

            $final = array("draw" => 1,
                "recordsTotal" => $total,
                "recordsFiltered" => $total,
                "data" => $arr);

            return $final;
        }
    }

    public function getInvoiceListJson($cus_id='',$payment_type='',$startdate='',$enddate='')

    {
        $cus_id=$this->fnRemoveDilt($cus_id);
        $payment_type=$this->fnRemoveDilt($payment_type);
        $startdate=$this->fnRemoveDilt($startdate);
        $enddate=$this->fnRemoveDilt($enddate);


//echo " cusid=$cus_id  : PayTye= $payment_type : Sdate=$startdate : Edate =$enddate";
        $output="";
        $strQry='';
        if($cus_id<>'')
        {
            if($strQry=='')
            {
                $strQry="invoice_master.cus_id=$cus_id";
            }
            else
            {
                $strQry= $strQry." AND". "invoice_master.cus_id=$cus_id";
            }
        }

        if($payment_type<>'')
        {
            if($strQry=='')
            {
                $strQry="invoice_master.payment_type='$payment_type'";
            }
            else
            {
                $strQry= $strQry." AND ". "invoice_master.payment_type='$payment_type'";
            }
        }


        if($startdate<>'' && $enddate<>'' )
        {
            if($strQry=='')
            {
                $strQry=" inv_date BETWEEN '$startdate' and '$enddate'";
            }
            else
            {
                $strQry= $strQry." AND inv_date BETWEEN '$startdate' and '$enddate'";
            }
        }
        elseif ($startdate<>'' )
        {
            if($strQry=='')
            {
                $strQry="invoice_master.inv_date='$startdate'";
            }
            else
            {
                $strQry= $strQry." AND ". "invoice_master.inv_date='$startdate'";
            }
        } elseif ($enddate<>'' )
        {
            if($strQry=='')
            {
                $strQry="invoice_master.inv_date='$enddate'";
            }
            else
            {
                $strQry= $strQry." AND ". "invoice_master.inv_date='$enddate'";
            }
        }
        $qry="SELECT inv_id,inv_no, cus.cus_name, inv_date,total,cgst,sgst,igst,gst,total,net_amount FROM invoice_master
          JOIN  customer cus ON (cus.cus_id=invoice_master.cus_id)
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
                $re->inv_no,
                $re->cus_name,
                $re->inv_date,
                $re->total,
                $re->cgst,
                $re->sgst,
                $re->igst,
                $re->gst,
                $re->net_amount
                );
        }

        if (empty($a)) {
                return 0 ;
        }
        else
        {
            $final=array("draw"=>1,
                "recordsTotal"=>$tot,
                "recordsFiltered"=>$tot,
                "data"=>$a);

            return $final;
        }

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

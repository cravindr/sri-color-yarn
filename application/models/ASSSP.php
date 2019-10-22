<?php
/**
 * Created by PhpStorm.
 * User: Ravi
 * Date: 22-12-2017
 * Time: 10:42
 */

class ASSSP extends CI_Model
{
    var $get;
    var $search;
    var $limit;
    var $orderby;
    public function __construct()
    {
     parent::__construct();

    }

    public function fnCategoryJson($get)
    {
        $this->get=$get;

        $limit=$this->getLimit($get);
        $search=$this->getSearch($get);
        $order=$this->getOrder($get);
        $orderByDirection=$order->orderbyMode;

        $flelds[]=array("field_name"=>'a.cat_id',"field_id"=>0,"field_aliases"=>'cat_id');
        $flelds[]=array("field_name"=>'a.cat_desc',"field_id"=>1,"field_aliases"=>'cat_desc');
        $flelds[]=array("field_name"=>' b.cat_desc',"field_id"=>2,"field_aliases"=>'parent_cat');
        $flelds[]=array("field_name"=>'a.status',"field_id"=>3,"field_aliases"=>'');


        if($order->orderbyField==0)
        {
            $orderField=" ORDER BY a.cat_id";
        }elseif ($order->orderbyField==1)
        {
            $orderField=" ORDER BY a.cat_desc";
        }elseif ($order->orderbyField==2)
        {
            $orderField=" ORDER BY b.cat_desc";
        }elseif ($order->orderbyField==3)
        {
            $orderField=" ORDER BY a.status";
        }else
        {
            $orderField="";
        }
        $where=" where lower( Concat( IFNULL(a.cat_id,''), '', IFNULL(a.cat_desc,''), '', IFNULL(b.cat_desc,''),IFNULL(a.status,''),'')) like lower('%$search%')";
        $qrystr="select a.cat_id as 'cat_id',a.cat_desc as 'cat_desc', b.cat_desc as 'parent_desc',a.status as 'status' from category a left JOIN category b on (a.parent_category=b.cat_id) ";
        $qry=$this->db->query($qrystr );
        $tot=$qry->num_rows();
        if($search)
        {
            $qrystr=$qrystr .  " $where ";
            $qry=$this->db->query($qrystr );
            $tot=$qry->num_rows();
        }
        if($orderField)
        {
            $qrystr=$qrystr .  "$orderField $orderByDirection ";
        }
        $qrystr="$qrystr $limit ";




        $qry=$this->db->query($qrystr);

        $res=$qry->result();
        $btn='<button type="button" id="btnview" class="btn btn-success btn-xs" title="View"><i class="fa fa-eye" aria-hidden="true"></i>
                            </button>&nbsp;<button type="button" id="btnedit" class="btn btn-primary btn-xs" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                            <button type="button" id="btndelete" class="btn btn-danger btn-xs" title="Status Change"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
        foreach ($res as $re)
        {
            $a[]=array($re->cat_id,$re->cat_desc,$re->parent_desc,$re->status,$btn);
        }

        $final=array("draw"=>0,
            "recordsTotal"=>intval($tot),
            "recordsFiltered"=>intval($tot),
            "data"=>$a);

        return json_encode($final);
    }
    public function getLimit ()
    {
        $request=$this->get;

        $limit = '';

        if ( isset($request['start']) && $request['length'] != -1 ) {
            $limit = "LIMIT ".intval($request['start']).", ".intval($request['length']);
        }
        else
        {
            $limit="  LIMIT 10";
        }
        $this->limit=$limit;
        return $limit;
    }

    public function getOrder()
    {
        $get=$this->get;
        $orderbyArray=$get['order'];
        $orderby=$orderbyArray[0];
        $orderbyField=$orderby['column'];
        $orderbyMode=$orderby['dir'];

/*        $order=new stdClass();
        $order->orderbyField=$orderbyField;
        $order->orderbyMode=$orderbyMode;
        return $order;*/

        $str="ORDER BY $orderbyField $orderbyMode ";
        $this->orderby=$str;
        return $str;

    }

    public function getSearch($get)
    {
        if(isset($get['search']))
        {
            $search=$get['search'];
            $this->search=$search['value'];
            return $search['value'];
        }

    }

    public function fnOrderByField($fields,$fieldId)
    {
        $field =$fields[$fieldId]['field_name'];
        return "ORDER BY ".$field;
    }

    public function fnGetFields($fleld)
    {
        $field_name=$fleld['field_name'];
        $field_aliases=$fleld['field_aliases'];

        if($field_aliases)
        {
            return "$field_name as '$field_aliases'";
        }
        else
        {
            return "$field_name";
        }


    }

    public function  getQueryFields($flelds)
    {
        $fleld_list="";
        foreach($flelds as $fleld)
        {

            if($fleld_list=='')
            {
                $fleld_list=fnGetFields($fleld);
            }
            else
            {
                $fleld_list=$fleld_list. ",".fnGetFields($fleld);
            }
        }

        return $fleld_list;
    }

    function fnBuildWhareCondition($flelds)
    {
        $search="";
        $fleld_list = "";
        foreach ($flelds as $fleld) {
            $field_name = $fleld['field_name'];
            if ($fleld_list == '') {
                $fleld_list = " IFNULL($field_name,''), ''";
            } else {
                $fleld_list = $fleld_list . "," . " IFNULL($field_name,''), ''";
            }

        }
        return " WHERE lower( Concat($fleld_list)) like lower('%$search%')";
    }




}
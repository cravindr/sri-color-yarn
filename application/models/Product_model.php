<?php
/**
 * Created by PhpStorm.
 * User: Ravi
 * Date: 15-12-2017
 * Time: 15:03
 */

class Product_model extends CI_Model
{
    var $get;

    public function getCategoryById($id)
    {
      $qry=  $this->db->get_where("category" , array("cat_id"=>$id));
      $res= $qry->result();

        if (is_null($res[0]->cat_desc))
        {
            return 'No Parent';
        }
        else
        {
            return $res[0]->cat_desc;
        }


     /// return $res[0]->cat_desc;
    }

    public function GetProductById($id)
    {
        $qry = $this->db->get_where("product", array('product_id' => $id));
        return $qry->result();
    }

    public function OrderCategory()
    {
        $qry=$this->db->query("select * from category ORDER by cat_id");

    }

    public function  getParentCategory()
    {

       $res=  $this->db->query("SELECT * FROM `category` WHERE `parent_category` IS NULL");
       //echo $this->db->last_query();
        return ($res->result());
    }

    public function getChildCategory($id)
    {
        $qry=$this->db->get_where("category",array("parent_category"=>$id));
        $row=$qry->result();
        //echo $this->db->last_query();
        return $row;
    }

    public function SaveCategory($data)
    {
       return $this->db->insert("category",$data);
         //$this->db->insert("category",$data);
        // echo $this->db->last_query();exit;
    }

    public function fnCategoryJson($get)
    {
        //$this->get=$get;



        $limit=$this->getLimit($get);
        $search=$this->getSearch($get);
        $order=$this->getOrder($get);
        $orderByDirection=$order->orderbyMode;

/*        $flelds[]=array("field_name"=>'a.cat_id',"field_id"=>0,"field_aliases"=>'cat_id');
        $flelds[]=array("field_name"=>'a.cat_desc',"field_id"=>1,"field_aliases"=>'cat_desc');
        $flelds[]=array("field_name"=>' b.cat_desc',"field_id"=>2,"field_aliases"=>'parent_cat');
        $flelds[]=array("field_name"=>'a.status',"field_id"=>3,"field_aliases"=>'');*/


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
        if($res)
        {
            foreach ($res as $re)
            {
                $a[]=array($re->cat_id,$re->cat_desc,$re->parent_desc,$re->status,$btn);
            }
        }
        else
        {
            $a[]=array("-","-","No Data found","-","-");
        }


        $final=array("draw"=>0,
            "recordsTotal"=>intval($tot),
            "recordsFiltered"=>intval($tot),
            "data"=>$a);

        return json_encode($final);
    }

    public function getLimit ($request )
    {
        $limit = '';

        if ( isset($request['start']) && $request['length'] != -1 ) {
            $limit = "LIMIT ".intval($request['start']).", ".intval($request['length']);
        }
        else
        {
            $limit="  LIMIT 10";
        }

        return $limit;
    }

    public function getOrder($get)
    {
        $orderbyArray=$get['order'];
        $orderby=$orderbyArray[0];
        $orderbyField=$orderby['column'];
        $orderbyMode=$orderby['dir'];

        $order=new stdClass();
        $order->orderbyField=$orderbyField;
        $order->orderbyMode=$orderbyMode;
        return $order;
        // return "$orderbyField,$orderbyMode";
    }

    public function getSearch($get)
    {
        if(isset($get['search']))
        {
            $search=$get['search'];
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

    public function LoadCustomerName()
    {
        $qry = $this->db->get_where("customer",array('status'=>'active'));

        return $qry->result();
    }

    public function getQueryFields($flelds)
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

    public function fnBuildWhareCondition($flelds)
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

    public function LoadCategory()
    {
            $qry=" select a.cat_id as 'cat_id' ,
         a.cat_desc as 'cate_desc' ,
         b.cat_desc as 'pare_cate_desc',
         group_concat(c.cat_desc order by c.cat_id asc) as 'category_name',
         Concat( IFNULL(Concat(REPLACE(group_concat(c.cat_desc order by c.cat_id asc),',','>'),'>'),''), '', IFNULL(a.cat_desc,'')) as 'result' 
         from category a 
         left JOIN category b on (a.parent_category=b.cat_id) 
         left JOIN category c on find_in_set(c.cat_id,a.par_cat_order) 
         WHERE a.status='active'
         GROUP by a.cat_id ORDER by result ASC";

            $qry=$this->db->query($qry);
            return $qry->result();
    }

    public function LoadUOM()
    {
    $qry=$this->db->get_where("uom",array("status"=>'active'));
    return $qry->result();
    }

    public function LoadTaxGroup()
    {
        $qry=$this->db->get_where('tax_group',array("status"=>'active'));
        return $qry->result();
    }

    public function GetProduct()
    {
        $qry = $this->db->query("SELECT * FROM `product` WHERE status = 'active'");

        foreach ($qry->result() as $v)
        {
            $res[] = array(
                'id' => $v->product_id,
                'name' => $v->product_name,
                'hsn' => $v->hsncode,
                'category_id' => $v->category_id,
                'uom' => $v->uom,
                'price' => $v->price,
                'status' => $v->status
            );
        }

        return $res;
    }

    public function GetProducTaxCatgorytById($id)
    {
        $qry1 = $this->db->get_where("product", array("product_id" => $id));
        $prod_res = $qry1->result();

            if($prod_res[0]->category_id == 0)
            {
                $qry = $this->db->query("SELECT * 
                                        FROM   product prod 
                                               JOIN tax_group tg 
                                                 ON ( prod.tax_group_id = tg.tax_group_id ) 
                                        WHERE  prod.product_id = '$id'; 
                                ");
            }
            else
            {
                $qry = $this->db->query("SELECT * 
                                        FROM   product prod 
                                               JOIN category catg 
                                                 ON ( prod.category_id = catg.cat_id ) 
                                               JOIN tax_group tg 
                                                 ON ( prod.tax_group_id = tg.tax_group_id ) 
                                        WHERE  prod.product_id = '$id'; 
                                ");
            }

        return $qry->result();
    }

    public function CreateProduct($data)
    {
        $qry = $this->db->insert("product", $data);
        return $qry;
    }

    public function UpdateProduct($prod_id,$data)
    {
        $qry = $this->db->update("product" , $data, array('product_id' => $prod_id));
        return $qry;
    }

    public function ViewProduct($id)
    {
        $prod = $this->GetProductById($id);
        if($prod[0]->category_id == 0)
        {
            $qry = $this->db->query("SELECT 
                                            prod.product_id,
                                            prod.product_name,
                                            prod.hsncode,
                                            prod.uom,
                                            prod.price,
                                            prod.reordered_level,
                                            prod.discount,
                                            prod.discount_amount,
                                            prod.discount_per,
                                            prod.status,
                                            tax_grp.tax_groups_desc
                                        FROM
                                            product AS prod
                                                JOIN
                                            tax_group AS tax_grp ON (prod.tax_group_id = tax_grp.tax_group_id)
                                        WHERE
                                            prod.product_id = '$id'");
        }
        else
        {
            $qry = $this->db->query("SELECT 
                                            prod.product_id,
                                            prod.product_name,
                                            prod.hsncode,
                                            prod.uom,
                                            prod.price,
                                            prod.reordered_level,
                                            prod.discount,
                                            prod.discount_amount,
                                            prod.discount_per,
                                            prod.status,
                                            tax_grp.tax_groups_desc,
                                            cat.cat_desc
                                        FROM
                                            product AS prod
                                                JOIN
                                            tax_group AS tax_grp ON (prod.tax_group_id = tax_grp.tax_group_id)
                                                JOIN
                                            category AS cat ON (prod.category_id = cat.cat_id)
                                        WHERE
                                            prod.product_id = '$id'");
        }

        return $qry->result();

    }
    public function AddProduct($id)
    {
        $qry = $this->db->query("SELECT
                                          product_id,
                                          product_name,
                                          price
                                        
                                        FROM
                                          product WHERE  product_id='$id'");

        $pro= $qry->result();

        $qry = $this->db->query("Select sum(stock) as 'total_qty' FROM product_stock WHERE prod_id='$id'");
        $tot=$qry->result();
        $retdata=array(
            'product_id'=>$pro[0]->product_id,
            'product_name'=>$pro[0]->product_name,
            'price'=>$pro[0]->price,
            'total_qty'=>$tot[0]->total_qty );
        return $retdata;

    }


    public function AddProductQty($data)
    {
        $qry=$this->db->insert('product_stock',$data);
        return $qry;
    }

    public function ImportBulkProduct($data)
    {
        $qry = $this->db->replace("product",$data);
        return $qry;
    }

    public function ProductStatusUpdate($id)
    {
        $prod = $this->GetProductById($id);

        if($prod[0]->status == 'active')
        {
            $data['status'] = 'inactive';
            $qry = $this->db->update("product",$data,array('product_id' => $id));
        }
        else
        {
            $data['status'] = 'active';
            $qry = $this->db->update("product",$data,array('product_id' => $id));
        }

        return $qry;

    }

}
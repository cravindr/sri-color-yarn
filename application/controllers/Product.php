<?php
/**
 * Created by PhpStorm.
 * User: Ravi
 * Date: 15-12-2017
 * Time: 15:02
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require_once (APPPATH.'libraries/ssp.customized.class.php');
require_once (APPPATH.'libraries/simple-xlsx-2017-09-09/simplexlsx.class.php');

class Product extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array("dashboard_model","product_model"));

    }

    public function Category()
    {
        $mes = $this->session->userdata("product");
        $res = $this->dashboard_model->GetCompanydatas();

        if(isset($mes))
        {
                 $data = array(
                     'logo' => $res[0],
                     'company' => $res[1],
                     'title' => 'Tax Zone || Dashboard',
                     'message' => $this->Message($mes),
                     'name' => $this->dashboard_model->userdetails()->u_name,
                     'categorys'=>$this->getParentCategory()
                 );
        }
        else
        {
            $data = array(
                'logo' => $res[0],
                'company' => $res[1],
                'title' => 'Tax Zone || Dashboard',
                'message' => '',
                'name' => $this->dashboard_model->userdetails()->u_name,
                'categorys'=>$this->getParentCategory()
            );
        }

        $this->load->view("category_list.php",$data);
        $this->session->unset_userdata("product");
    }

    public function Category_Create()
    {
        $this->load->model("dashboard_model");
        $cat_desc=$this->input->post("cat_desc");
        $subcats=($this->input->post("sub_category"))   ;
        $parcats=($this->input->post("search_category"))   ;
        if($parcats)
        {
            $sc="";
            $parent_cat="";
            foreach ($subcats as $subcat)
            {
                if($sc=="")
                {
                    $sc=$subcat;
                }
                else {
                    if($subcat>0)
                    {
                        $sc=$sc .",".$subcat;
                    }
                }


                // echo "<br>Sub Catagory : $parent_cat<br>";
            }

            $get=explode(",",$sc);
            $parent_cat=end($get);   // get the last array value
            if($parent_cat<1)
                {
                    $parent_cat=  $parcats;
                }

            if($sc=="")
            {
                $cat_order_list=$parcats;
            }else{
                $cat_order_list=$parcats.",".$sc;
            }


        }
        else
        {
            $parent_cat=null;
            $cat_order_list=null;
        }

        $data=array("cat_desc"=>$cat_desc,
            "parent_category"=>$parent_cat,
            "cdate"=>$this->dashboard_model->datetime(),
            "par_cat_order"=>$cat_order_list,
            "status"=>"active");
       // print_r($data);exit;
        $this->load->model("product_model");
        $res=$this->product_model->savecategory($data);
        if($res)
        {
            $this->session->set_userdata("product","category_saved");
            redirect("product/category");
        }
    }

    public function CategoryServerSide()
    {

            $get=$this->input->get();
             $this->load->model("product_model");
            $res=$this->product_model->fnCategoryJson($get);
        echo $res;
    }

    public function GetCategoryById($id)
    {
        $this->load->model("product_model");
        return $this->product_model->getCategoryById($id);
    }

    public function getParentCategory()
    {
        $this->load->model("product_model");
       return $this->product_model->getParentCategory();

    }

    public function getChildCategory()
    {
        $parentid=$this->input->post("parent_id");
        $this->load->model("product_model");
       $retvals= $this->product_model->getChildCategory($parentid);

       if($retvals)
       {
           $rets ="<select name='sub_category[]' class='parent form-control'>";
           $rets=$rets."<option value='' selected='selected'>-- Sub Category --</option>";

           foreach ($retvals as $retval)
           {
               $catid=$retval->cat_id;
               $cat_desc=$retval->cat_desc;
               $rets=$rets."<option value='$catid'>$cat_desc</option>";
           }
           $ret=$rets."</select>";
       }
        else
        {
            $rets='<label style="padding:7px;float:left; font-size:12px;">No Record Found !</label>';
        }

        echo $rets;

    }

    public function ProductList()
    {
        $mes = $this->session->userdata("product");
        $res = $this->dashboard_model->GetCompanydatas();

        if(isset($mes))
        {
            $data = array(
                'logo' => $res[0],
                'company' => $res[1],
                'name' => $this->dashboard_model->userdetails()->u_name,
                'message' => $this->Message($mes),
                'category' => $this->LoadCatagoryList(),
                'uom' => $this->LoadUOMList(),
                'taxgroup' => $this->LoadTaxGroupList(),
                'title' => 'Tax Zone'
            );
        }
        else
        {
            $data = array(
                'logo' => $res[0],
                'company' => $res[1],
                'name' => $this->dashboard_model->userdetails()->u_name,
                'message' => '',
                'category' => $this->LoadCatagoryList(),
                'uom' => $this->LoadUOMList(),
                'taxgroup' => $this->LoadTaxGroupList(),
                'title' => 'Tax Zone'
            );
        }

        $this->load->view("product_list",$data);
        $this->session->unset_userdata("product");
    }

    public function ProductCreate()
    {
        $discount = $this->input->post('discount');
        $disval = $this->input->post('discount_val');

                if($discount == 'flat')
                {
                    $flat = $disval;
                    $per = 0;
                }
                elseif ($discount == 'per')
                {
                    $per = $disval;
                    $flat = 0;
                }
                else
                {
                    $flat = 0;
                    $per = 0;
                    $discount = 0;
                }

        $data = array(
            'product_name' => $this->input->post('product_name'),
            'hsncode' => $this->input->post('hsncode'),
            'category_id' => $this->input->post('category'),
            'uom' => $this->input->post('uom'),
            'price' => $this->input->post('price'),
            'tax_group_id' => $this->input->post('tax_group'),
            'reordered_level' => $this->input->post('reordered_level'),
            'discount_amount' => $flat,
            'discount_per' => $per,
            'discount' => $discount,
            'status' => 'active'
        );

        $result = $this->product_model->createproduct($data);

            if($result == 1)
            {
                $this->session->set_userdata("product","product_saved");

                if($this->session->userdata('product_save_redirect'))
                 {
                     $url = $this->session->userdata("product_save_redirect");
                     $result = end(explode('/index.php/', $url));
                     redirect($result);
                 }
            }
            else
            {
                $this->session->set_userdata("product","product_unsaved");

                if($this->session->userdata('product_save_redirect'))
                {
                    $url = $this->session->userdata("product_save_redirect");
                    $result = end(explode('/index.php/', $url));
                    redirect($result);
                }
            }
    }

    public function ProductView()
    {
        $id = $this->input->post('id');
        $res = $this->product_model->viewproduct($id);
        echo json_encode($res[0]);
    }

    public function ProductAdd()
    {
        $id = $this->input->post('id');
        $res = $this->product_model->addproduct($id);
        echo json_encode($res);
    }

    public function AddProductQty()
    {
        $product_id=$this->input->post('product_id_add');
        $product_qty_add=$this->input->post('qty_add');
        $date=$this->dashboard_model->datetime();

        $data=array('prod_id'=>$product_id,
                    'stock'=>$product_qty_add,
                    'inv_no'=>0,
                    'pur_no'=>0,
                    'created_at'=>$date);
        $this->product_model->AddProductQty($data);
        redirect("product/productlist");

    }

    public function ProductEdit()
    {
        $id = $this->input->post('id');
        $res = $this->product_model->GetProducTaxCatgorytById($id);
        echo json_encode($res[0]);
    }

    public function ProductUpdate()
    {
        $discount = $this->input->post('discount_edit');
        $disval = $this->input->post('discount_val_edit');
        $prodid = $this->input->post('product_id_edit');

        if($discount == 'flat')
        {
            $flat = $disval;
            $per = 0;
        }
        elseif ($discount == 'per')
        {
            $per = $disval;
            $flat = 0;
        }
        else
        {
            $flat = 0;
            $per = 0;
            $discount = 0;
        }

            $data = array(
                'product_name' => $this->input->post('product_name_edit'),
                'hsncode' => $this->input->post('hsncode_edit'),
                'category_id' => $this->input->post('category_edit'),
                'uom' => $this->input->post('uom_edit'),
                'price' => $this->input->post('price_edit'),
                'tax_group_id' => $this->input->post('tax_group_edit'),
                'reordered_level' => $this->input->post('reordered_level_edit'),
                'discount_amount' => $flat,
                'discount_per' => $per,
                'discount' => $discount,
                'status' => $this->input->post('status_product_edit')
            );

        $result = $this->product_model->updateproduct($prodid,$data);

            if($result == 1)
            {
                $this->session->set_userdata("product","product_updated");
                redirect('product/productlist');
            }
            else
            {
                $this->session->set_userdata("product","product_unupdated");
                redirect('product/productlist');
            }

    }

    public function ProductStatus()
    {
        $id = $this->input->post('id');
        $res = $this->product_model->productstatusupdate($id);
        echo $res;
    }

    public function ProductServerSide()
    {
        // DB table to use
        $table = 'product';

        // Table's primary key
        $primaryKey = 'product_id';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes
        $columns = array(
            array( 'db' => 'product_id', 'dt' => 0 ),
            array( 'db' => 'product_name',  'dt' => 1 ),
            array( 'db' => 'hsncode',  'dt' => 2 ),
            array( 'db' => 'UOM',  'dt' => 3 ),
            array( 'db' => 'price',  'dt' => 4 ),


            array( 'db' => 'status', 'dt' => 5 , 'formatter' => function($s){

                if($s == 'active')
                {
                    return '<a id="btnstatus" class="label label-success">Active</a>';
                }
                else
                {
                    return '<a id="btnstatus" class="label label-danger">Inactive</a>';
                }

            }),
            array(
                'db'        => 'product_id',
                'dt'        => 6,
                'formatter' => function( $d, $row ) {
                    return '<button type="button" id="btnview" class="btn btn-success btn-xs" title="View"><i class="fa fa-eye" aria-hidden="true"></i></button> &nbsp; 
                                    <button type="button" id="btnedit" class="btn btn-primary btn-xs" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                    <button type="button" id="btnadd" class="btn btn-primary btn-xs" title="Add"><i class="fa fa-plus-circle " aria-hidden="true"></i></button>';
                }
            )
        );

        // SQL server connection information
        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db'   => $this->db->database,
            'host' => $this->db->hostname
        );


        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * If you just want to use the basic configuration for DataTables with PHP
         * server-side, there is no need to edit below this line.
         */

        echo json_encode(
            SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
        );


    }

    public function LoadTaxGroupList()
    {
        return $this->product_model->LoadTaxGroup();
    }

    public function LoadCatagoryList()
    {
    return $this->product_model->LoadCategory();
    }

    public function LoadUOMList()
    {
    return $this->product_model->LoadUOM();
    }

    private function Message($message)
    {
        if($message == 'product_saved')
        {
            $mess = '<div class="alert alert-success"><strong>Success!!!</strong>&nbsp; Product Record Saved Successfully...</div>';
        }
        elseif ($message == 'unsaved')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>&nbsp; Customer Record Does not Inserted Try again...</div>';
        }
        elseif ($message == 'category_saved')
        {
            $mess = '<div class="alert alert-success"><strong>Success!!!</strong>&nbsp; Product Record Saved Successfully...</div>';
        }
        elseif ($message == 'unupdated')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>&nbsp; Customer Record Does not Updated Try again...</div>';
        }
        elseif ($message == 'product_updated')
        {
            $mess = '<div class="alert alert-success"><strong>Success!!!</strong>&nbsp; Product Record Updated Successfully...</div>';
        }
        elseif ($message == 'product_unupdated')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>&nbsp; Product Record Does not Updated Try again...</div>';
        }
        elseif ($message == 'filedoesnotexcel')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>&nbsp; This is not excel file... please upload excel file only...</div>';
        }
        elseif ($message == 'choosefile')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>&nbsp; You are does not selected any file... Select a valid file...</div>';
        }


        return $mess;
    }

    public function ImportProductToDatabase()
    {
        //print_r($_POST); exit;
        if(!empty($_FILES['productexcelfile']['name']))
        {
            $pathinfo = pathinfo($_FILES['productexcelfile']['name']);

            if (($pathinfo['extension'] == 'xlsx' || $pathinfo['extension'] == 'xls') && $_FILES['productexcelfile']['size'] > 0 )
            {
                $excelfile = $_FILES['productexcelfile']['tmp_name'];
                $xl = new SimpleXLSX($excelfile);

                foreach ($xl->rows() as $row)
                {
                    $res[] = $row;
                }

                unset($res[0]);

                foreach ($res as $v)
                {
                    $data = array(
                        "product_id" => $v[0],
                        "product_name" => $v[1],
                        "hsncode" => $v[2],
                        "category_id" => $v[3],
                        "uom" => $v[4],
                        "price" => $v[5],
                        "tax_group_id" => $v[6],
                        "reordered_level" => $v[7],
                        "discount_amount" => $v[8],
                        "discount_per" => $v[9],
                        "discount" => $v[10],
                        "status" => $v[11]
                    );

                    $result = $this->product_model->importbulkproduct($data);
                }

                if($result == 1)
                {
                    $this->session->set_userdata("product","product_saved");
                    redirect('product/productlist');
                }
                else
                {
                    $this->session->set_userdata("product","product_unsaved");
                    redirect('product/productlist');
                }


            }
            else
            {
                $this->session->set_userdata("product",'filedoesnotexcel');
            }
        }
        else
        {
            $this->session->set_userdata("product",'choosefile');
        }

        redirect('product/productlist');

    }
    
}
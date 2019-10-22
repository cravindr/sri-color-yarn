<?php
/**
 * Created by PhpStorm.
 * User: Ravi
 * Date: 12-12-2017
 * Time: 15:59
 */
defined('BASEPATH') OR exit('No direct script access allowed');
//require_once (APPPATH.'libraries/ssp.class.php');
require_once (APPPATH.'libraries/ssp.customized.class.php');
class Tax extends CI_Controller
{
    public  function __construct()
    {
       parent::__construct();
        $this->load->model(array("dashboard_model"));
    }

    public function Zone_Create()
    {

    $statelist=$this->input->post('zone_codes');
    $zonedesc=$this->input->post('zone_desc');
    $stateCode="";
        foreach ($statelist as $v)
        {
            if($stateCode=="")
            {
                $stateCode=$v;
            }else{
                $stateCode=$stateCode.",". $v;
            }


        }
        $data=array('zone_desc'=>$zonedesc,
                    'zone_codes'=>$stateCode

        );
        $this->load->model("zone_model");
       $ret= $this->zone_model->zonesave($data);
    if( $ret)
    {
        redirect("tax/zone");
    }

    }
    public function Zone_View()
    {
        $id=$this->input->post("id");
        $this->load->model("zone_model");
        $retv=$this->zone_model->getTaxZoneById($id);
        $ret=$retv[0];
        echo json_encode($ret);
    }
    public function Zone_Update()
    {
        $zone_id=$this->input->post("zone_id");
        $zone_desc=$this->input->post("zone_desc");
        $zone_codes=$this->input->post("zone_codes");


        $statoecode="";
        foreach ($zone_codes as $v)
        {
            if($statoecode=="")
            {
                $statoecode=$v;
            }else
            {
                $statoecode=$statoecode.",".$v;
            }
        }

        $data=array("zone_desc"=>$zone_desc,
            "zone_codes"=>$statoecode
            );
        $this->load->model("zone_model");
        $ret=$this->zone_model->zoneupdate($zone_id,$data);
        if($ret){
            redirect("tax/zone");
        }
    }
    public function Zone_Disable()
    {
        $id=  $this->input->post('id');
        $status=  $this->input->post('status');

        if($status=='active')
        {
            $status='inactive';
        }
        else
        {
            $status='active';
        }

        $this->load->model("zone_model");
       $ret= $this->zone_model->enabledisable($id,$status);
      /* if($ret)
       {
           redirect("tax/zone");
       }*/

      if($ret)
      {
          echo "success";
      }
    }
    public function Zone()
    {
        $mes = $this->session->userdata("tax");
        $res = $this->dashboard_model->GetCompanydatas();

        if(isset($mes))
        {
            $data = array(
                'logo' => $res[0],
                'company' => $res[1],
                'name' => $this->dashboard_model->userdetails()->u_name,
                'message' => $this->Message($mes),
                'state' => $this->LoadState(),
                'title'=>'Tax Zone'
            );
        }
        else
        {
            $data = array(
                'logo' => $res[0],
                'company' => $res[1],
                'name' => $this->dashboard_model->userdetails()->u_name,
                'message'=>'',
                'state' => $this->LoadState(),
                'title'=>'Tax Zone'
            );
        }


        $this->load->view("tax_zone_list",$data);
        $this->session->unset_userdata("tax");
    }
    public function ZoneServerSide()
    {


        // DB table to use
        $table = 'tax_zone';

        // Table's primary key
        $primaryKey = 'zone_id';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes
        $columns = array(
            array( 'db' => 'zone_id', 'dt' => 0 ),
            array( 'db' => 'zone_desc',  'dt' => 1 ),

            array( 'db' => 'zone_codes',   'dt' => 2,'formatter' => function( $d, $row ) {
                if(strlen($d)>50)
                {
                    return substr($d,0,50)."...";
                }
                else
                {
                    return $d;
                }

            } ),
            array( 'db' => 'status',   'dt' => 3 ),
             array(
                'db'        => 'zone_id',
                'dt'        => 4,
                'formatter' => function( $d, $row ) {
                    return '<button type="button" id="btnview" class="btn btn-success btn-xs" title="View"><i class="fa fa-eye" aria-hidden="true"></i></button> &nbsp; 
                                    <button type="button" id="btnedit" class="btn btn-primary btn-xs" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button> &nbsp;
                                    <button type="button" id="btndelete" class="btn btn-danger btn-xs" title="Status Change"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
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
    public function LoadState()
    {
        $this->load->model("zone_model");
        $result = $this->zone_model->loadState();
        return $result;
    }

    public function tax()
    {
        $res = $this->dashboard_model->GetCompanydatas();

        $data=array(
            'logo' => $res[0],
            'company' => $res[1],
            'name' => $this->dashboard_model->userdetails()->u_name,
            'taxzone' => $this->LoadTaxZone(),
            'message'=>'welcome',
            'title'=>'Tax Zone'
        );
        //$this->load->view("tax_list",$data);
        $this->load->view("tax_list",$data);
    }
    public function Tax_Create()
    {
        $this->load->model("dashboard_model");
        $this->load->model("tax_model");
        $tax_name=$this->input->post("tax_name");
        $tax_value=$this->input->post("tax_value");
        $tax_zone_id=$this->input->post("tax_zone_id");
        $data=array("tax_name"=>$tax_name,
                    "tax_value"=>$tax_value,
                    "tax_zone_id"=>$tax_zone_id,
                    "tax_cdate"=>$this->dashboard_model->DateTime()
            );
      $ret=  $this->tax_model->savetax($data);
        if($ret)
        {
            redirect("tax/tax");
        }

    }
    public function Tax_View()
    {
        $id=$this->input->post("id");
        $this->load->model("tax_model");
        $ret=$this->tax_model->gettaxbyid($id);
        $res=$ret[0];
        echo json_encode($res);
    }
    public function Tax_Update()
    {
        $tax_id=$this->input->post("tax_id");
        $tax_name=$this->input->post("tax_name");
        $tax_value=$this->input->post("tax_value");
        $tax_zone_id=$this->input->post("tax_zone_id");
        $data=array("tax_name"=>$tax_name,
                    "tax_value"=>$tax_value,
                    "tax_zone_id"=>$tax_zone_id
        );
            $this->load->model("tax_model");
            $ret=$this->tax_model->updatetax($tax_id,$data);

            if($ret)
            {
                redirect("tax/tax");
            }

    }
    public function Tax_Disable()
    {

        $id=$this->input->post("id");
        $status=$this->input->post("status");

        if($status=='active')
        {
            $status="inactive";
        }else
        {
            $status="active";
        }


        $this->load->model("tax_model");

      $ret= $this->tax_model->enabledisabletax($id,$status);
      if($ret)
      {
         // redirect("tax/tax");
          echo "success";
      }

    }
    public function TaxServerSide()
    {


        // DB table to use
        $table = 'tax';

        // Table's primary key
        $primaryKey = 'tax_id';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes

        $columns = array(
            array( 'db' => '`tax`.`tax_id`', 'dt' => 0,'field' => 'tax_id'),

            array( 'db' => '`tax`.`tax_name`',  'dt' => 1,'field' => 'tax_name'  ),
            array( 'db' => '`tax`.`tax_value`',   'dt' =>2,'field' => 'tax_value'  ),
            array( 'db' => '`tax_zone`.`zone_desc`',     'dt' => 3,'field' => 'zone_desc'  ),

            array( 'db' => '`tax`.`status`',     'dt' => 4,'field' => 'status'  ),



            array(
                'db'        => '`tax`.`status`',
                'dt'        => 5,
                'field' => 'status',
                'formatter' => function( $d, $row ) {
                    return '<button type="button" id="btnview" class="btn btn-success btn-xs" title="View"><i class="fa fa-eye" aria-hidden="true"></i>
                            </button>&nbsp;<button type="button" id="btnedit" class="btn btn-primary btn-xs" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                            <button type="button" id="btndelete" class="btn btn-danger btn-xs" title="Status Change"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
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


        echo json_encode(
            SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
        );
        */
        /*
                    $joinQuery = "FROM `{$table}` AS `co` LEFT JOIN `customer` AS `cu` ON (`co`.`id` = `cu`.`cus_id`)";
                   // $extraCondition = "`co`.`status`="."'active' AND `co`.`complient_status`='registered' ";
                    $extraCondition = "";*/

        //$joinQuery = "FROM `complient` AS `co` JOIN `customer` AS `cu` ON (`co`.`cus_id` = `cu`.`cus_id`)";

        //echo $joinQuery;exit;

        $joinQuery = "from tax join tax_zone ON (tax.tax_zone_id=tax_zone.zone_id)";
        $extraWhere = "";
        $groupBy = "";
        $having = "";

        echo json_encode(
            SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $having )
        );

    }
    public function LoadTaxZone()
    {
    $this->load->model("tax_model");
    $ret=$this->tax_model->taxzonelist();
    return $ret;

    }

    public function TaxGroup()
    {
        $res = $this->dashboard_model->GetCompanydatas();

        $data=array(
            'logo' => $res[0],
            'company' => $res[1],
            'name' => $this->dashboard_model->userdetails()->u_name,
            'tax' => $this->LoadTax(),
            'message'=>'',
            'title'=>'Tax Zone'
        );

        //$this->load->view("tax_list",$data);
        $this->load->view("taxgroup_list",$data);
    }

    public function TaxGroup_Create()
    {
        $this->load->model("Dashboard_model");

        $tax_ids=$this->input->post("tax_id");
        $tax_groups_desc=$this->input->post("taxgroup_name");
        $tax_id_groups="";
        foreach ($tax_ids as $tax_id)
        {
            if($tax_id_groups=="")
            {
                $tax_id_groups=$tax_id;
            }
            else
            {
                $tax_id_groups=$tax_id_groups . "," . $tax_id;
            }
        }

        $data=array("tax_groups_desc"=>$tax_groups_desc,
                    "tax_id_groups"=>$tax_id_groups,
                    "tax_group_cdate"=>$this->Dashboard_model->DateTime()
            );

        $this->load->model("tax_model");
        $ret=$this->tax_model->savetaxgroup($data);
        if($ret)
        {
            redirect("tax/taxgroup");
        }


    }
    public function TaxGroup_View()
    {
        $id=$this->input->post("id");
        $this->load->model("tax_model");
        $res=$this->tax_model->getTaxGroupDataById($id);
        echo json_encode($res);
    }
    public function TaxGroup_Update()
    {
        $taxgroup_id=$this->input->post("taxgroup_id");
        $tax_groups_desc=$this->input->post("taxgroup_name");
        $tax_ids=$this->input->post("tax_id");
        $tax_id_groups="";
        foreach ($tax_ids as $tax_id)
        {
            if($tax_id_groups=="")
            {
                $tax_id_groups=$tax_id;
            }
            else
            {
                $tax_id_groups=$tax_id_groups . "," . $tax_id;
            }
        }

        $data=array("tax_groups_desc"=>$tax_groups_desc,
            "tax_id_groups"=>$tax_id_groups
        );

        $this->load->model("tax_model");
        $ret=$this->tax_model->updatetaxgroup($taxgroup_id,$data);
        if($ret)
        {
            redirect("tax/taxgroup");
        }



    }
    public function TaxGroup_Disable()
    {
        $id=$this->input->post("id");
        $status=$this->input->post("status");
        if($status=='active')
        {
            $status="inactive";
        }else
        {
            $status="active";
        }
        $this->load->model("tax_model");
        $ret= $this->tax_model->enabledisabletaxgroup($id,$status);
        if($ret)
        {
            echo "success";
        }


    }

    /*public function TaxGroupServerSide()
    {   // DB table to use
        $table = 'tax_group';

        // Table's primary key
        $primaryKey = 'tax_group_id';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes
        $columns = array(
            array( 'db' => 'tax_group_id', 'dt' => 0 ),
            array( 'db' => 'tax_groups_desc',  'dt' => 1 ),
            array( 'db' => 'tax_id_groups',   'dt' => 2,'formatter' => function( $d, $row ) {
                 return $this->getTaxName($d);
            } ),

            array( 'db' => 'status',   'dt' => 3 ),
            array(
                'db'        => 'tax_group_id',
                'dt'        => 4,
                'formatter' => function( $d, $row ) {
                    return '<button type="button" id="btnview" class="btn btn-success btn-sm" title="View"><i class="fa fa-eye" aria-hidden="true"></i></button> &nbsp; 
                                    <button type="button" id="btnedit" class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button> &nbsp;
                                    <button type="button" id="btndelete" class="btn btn-danger btn-sm" title="Status Change"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
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

   echo json_encode(
            SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
        );
    }*/


    /*public function TaxGroupServerSide()
    {
 $table = 'tax_group';
        $primaryKey = 'tax_group_id';
        $columns = array(
            array( 'db' => '`tg`.`tax_group_id`', 'dt' => 0,'field' => 'tax_group_id'),

            array( 'db' => '`tg`.`tax_groups_desc`',  'dt' => 1,'field' => 'tax_groups_desc'  ),
            group_concat(array( 'db' => '`t`.`tax_name`',   'dt' =>2, 'field' => 'tax_name' )),
            array( 'db' => '`tg`.`status`',     'dt' => 3,'field' => 'status'  ),





            array(
                'db'        => '`tg`.`status`',
                'dt'        => 4,
                'field' => 'status',
                'formatter' => function( $d, $row ) {
                    return '<button type="button" id="btnview" class="btn btn-success btn-xs" title="View"><i class="fa fa-eye" aria-hidden="true"></i>
                            </button>&nbsp;<button type="button" id="btnedit" class="btn btn-primary btn-xs" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                            <button type="button" id="btndelete" class="btn btn-danger btn-xs" title="Status Change"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
                }
            )
        );


        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db'   => $this->db->database,
            'host' => $this->db->hostname
        );



        $joinQuery = "from tax_group tg join tax t on find_in_set(t.tax_id,tg.tax_id_groups)";
        $extraWhere = "";
        $groupBy = "tg.tax_group_id";
        $having = "";

        echo json_encode(
            SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $having )
        );

    }*/

    function TaxGroupServerSide()
    {
        $this->load->model("tax_model");
        $res=$this->tax_model->fnTaxGroupJson();
        print_r(json_encode($res));
        //echo $res;
    }


    public function LoadTax()
    {
        $this->load->model("tax_model");
        $ret=$this->tax_model->taxlist();
        return $ret;
    }

    public function getTaxName($id)
    {   $this->load->model("tax_model");
        return  $taxname=$this->tax_model->getTaxGroupNameById($id);
    }

}
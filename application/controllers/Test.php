<?php
/**
 * Created by PhpStorm.
 * User: Ravi
 * Date: 17-01-2018
 * Time: 11:46 AM
 */

class Test extends CI_Controller
{

    public  function index()
    {
        $this->load->model("missed_inv_no_model");
        $this->missed_inv_no_model->getMissedInvoiceNo();
    }
}
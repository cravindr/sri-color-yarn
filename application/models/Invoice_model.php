<?php
/**
 * Created by PhpStorm.
 * User: Attract-01
 * Date: 12/22/2017
 * Time: 12:47 PM
 */

class Invoice_model extends CI_Model
{
    public function GetCompanyDetails()
    {
       $qry = $this->db->get_where("company", array('comp_id' => '1'));
       return $qry->result();
    }

    public function GetCustomer()
    {
        $qry = $this->db->get("customer");
        return $qry->result();
    }

    public function GetPaymentOption()
    {
        $qry = $this->db->get_where("payment_option", array('status' => 'active'));
        return $qry->result();
    }

    public function GetInvoiceShippingAddressById($id)
    {
        $qry = $this->db->get_where("customer_branch", array('cus_id' => $id));
        return $qry->result();
    }

    public function GetCustomerById($id)
    {
        $qry = $this->db->get_where("customer", array('cus_id' => $id));
        return $qry->result();
    }

    public function GetGSTTax()
    {
        $qry = $this->db->get_where("tax_group", array('status' => 'active'));
        return $qry->result();
    }

    public function GetInvoiceTax($cus_state_code,$tax_group_id,$product_id)
    {
        $qry = $this->db->query("SELECT 
                                            tax.tax_id,
                                              tax.tax_name,
                                              tax.tax_value,
                                              tax.tax_zone_id,
                                              tax.tax_cdate,
                                              tax.status,
                                              tax_zone.zone_desc,
                                              tax_group.tax_groups_desc,
                                              tax_group.tax_id_groups,
                                              product.product_name,
                                              product.hsncode,
                                              product.category_id,
                                              product.uom,
                                              product.price,
                                              product.tax_group_id,
                                              product.reordered_level,
                                              product.discount_amount,
                                              product.discount_per,
                                              product.discount,
                                              product.status
                                        FROM
                                            tax
                                                JOIN
                                            tax_zone ON (tax.tax_zone_id = tax_zone.zone_id)
                                                LEFT JOIN
                                            tax_group ON (FIND_IN_SET(tax.tax_id, tax_group.tax_id_groups) > 0)
                                                JOIN
                                            product ON (product.tax_group_id = tax_group.tax_group_id)
                                        WHERE
                                            FIND_IN_SET('$cus_state_code', tax_zone.zone_codes) > 0
                                                AND tax_group.tax_group_id = '$tax_group_id' 
                                                AND product.product_id= '$product_id'");
        return $qry->result();
    }

    public function GenerateInvoice($data)
    {
        //print_r($data); exit;
        if($data['inv_no'] == '')
        {
            $inv_no = $this->InvoiceNumberGenerator();
        }
        else
        {
            $qry = $this->db->get_where("invoice_master", array('inv_no' => $data['inv_no']));

            if($qry->num_rows() == 1)
            {
                $this->session->set_userdata("invoice", "already_existed");
                redirect('invoice/newinvoice');
            }
            else
            {
                $inv_no = $data['inv_no'];
            }
        }


        $inv_addrs = $this->GetBillingAddress($data['inv_customer']);
        $bill_address = implode(",",$inv_addrs);

        if($data['ship_address'] == '')
        {
            $ship_addrs = $bill_address;
        }
        else
        {
            $ships_addrs = $this->GetShippingAddress($data['ship_address']);
            $ship_addrs = implode(",",$ships_addrs);
        }

        $invoicedata = array(
            'inv_no' => $inv_no,
            'cus_id' => $data['inv_customer'],
            'cus_ship_id' => $data['ship_address'],
            'rcm' => '',
            'transport_mode' => $data['trans_mode'],
            'vehicle_no' => $data['vehicle_no'],
            'date_of_supply' => $data['supply_date'],
            'inv_date' => $data['inv_date'],
            'place_of_supply' => $data['place_supply'],
            'inv_address' => $bill_address,
            'inv_shipping_address' => $ship_addrs,
            'total' => array_sum($data['total']),
            'cgst' => array_sum($data['cgstamt']),
            'sgst' => array_sum($data['sgstamt']),
            'igst' => array_sum($data['igstamt']),
            'gst' => array_sum($data['cgstamt']) + array_sum($data['sgstamt']) + array_sum($data['igstamt']),
            'total_tax' => array_sum($data['cgstamt']) + array_sum($data['sgstamt']) + array_sum($data['igstamt']),
            'net_amount' => $data['netamount'],
            'rcgst' => '',
            'rsgst' => '',
            'rigst' => '',
            'rgst' => '',
            'erf_no' => '',
            'bill_generator_name' => $data['prepared_by'],
            'auth_sign_name' => '',
            'auth_sign_designation' => '',
            'amount_in_words' => $this->getIndianCurrencyToWords(round($data['netamount'])),
            'payment_type' => $data['inv_payment_option'],
            'order_no' => $data['order_no']
        );

        //print_r($invoicedata); exit;
        $qry_invoice = $this->db->insert('invoice_master',$invoicedata);
        //print_r($qry_invoice); exit;

            if($qry_invoice == 1)
            {
                if($invoicedata['payment_type'] == 'credit')
                {
                    $data_credit = array(
                        'trans_date' => $invoicedata['inv_date'],
                        'cus_id' => $invoicedata['cus_id'],
                        'inv_id' => $this->db->insert_id(),
                        'inv_amount' => $invoicedata['net_amount'],
                        'trans_type' => 'credit',
                        'amount' => $invoicedata['net_amount']
                    );

                        $this->load->model('Payment_model', 'payment');
                        $result = $this->payment->Save($data_credit);

                            if ($result == 1)
                            {
                                $retv = new stdClass();
                                $retv->id = $this->db->insert_id();
                                $retv->invoice_id = $inv_no;
                                return $retv;
                            }
                }
                else
                {
                    $retv = new stdClass();
                    $retv->id = $this->db->insert_id();
                    $retv->invoice_id = $inv_no;
                    return $retv;
                }
            }
    }

    public function GetBillingAddress($id)
    {
        $qry = $this->db->get_where("customer", array('cus_id' => $id));
        $qry->result();

        foreach ($qry->result() as $v)
        {
            $ar = array($v->cus_address1,$v->cus_address2,$v->cus_place,$v->cus_city,$v->cus_state,$v->cus_country,$v->pin_code);
        }
        return $ar;
    }

    public function GetShippingAddress($id)
    {
        $qry = $this->db->get_where("customer_branch", array('shi_id' => $id));
        $qry->result();

        foreach ($qry->result() as $v)
        {
            $ar = array($v->shi_address1,$v->shi_address2,$v->shi_place,$v->shi_city,$v->shi_state,$v->shi_country,$v->pin_code);
        }
        return $ar;
    }

    public function InvoiceNumberGenerator()
    {
        $qry = $this->db->get("invoice_master");

            if($qry->num_rows()== 0)
            {
                $inv_first_val = 'INV';
                $inv_middle_val = date('Y');
                $num = '000000';
                $inv_last_val = str_pad($num + 1, 6, 0, STR_PAD_LEFT);
                return $inv_no = $inv_first_val.'-'.$inv_middle_val.'-'.$inv_last_val;
            }
            else
            {
                $qry = $this->db->query("SELECT max(substr(inv_no,10,6)) AS `invoice_no` FROM invoice_master");
                $result = $qry->result();
                $max_inv_no =  $result[0]->invoice_no;
                $num = $max_inv_no;

                $inv_first_val = 'INV';
                $inv_middle_val = date('Y');
                $inv_last_val = str_pad($num + 1, 6, 0, STR_PAD_LEFT);
                return $inv_no = $inv_first_val.'-'.$inv_middle_val.'-'.$inv_last_val;
            }

    }

    public function GetProductNameByMultiple($prod_id)
    {
       $qry = $this->db->query("SELECT product_name FROM product WHERE product_id = '$prod_id'");
        $res = $qry->result();
       return $res[0]->product_name;
    }

    public function getIndianCurrencyToWords($number)
    {
        $decimal = round($number - ($no = floor($number)), 2) * 100;
        $hundred = null;
        $digits_length = strlen($no);
        $i = 0;
        $str = array();
        $words = array(0 => '', 1 => 'one', 2 => 'two',
            3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
            7 => 'seven', 8 => 'eight', 9 => 'nine',
            10 => 'ten', 11 => 'eleven', 12 => 'twelve',
            13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
            16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
            19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
            40 => 'forty', 50 => 'fifty', 60 => 'sixty',
            70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
        $digits = array('', 'hundred','thousand','lakh', 'crore');
        while( $i < $digits_length ) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += $divider == 10 ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
            } else $str[] = null;
        }
        $Rupees = implode('', array_reverse($str));
        $paise = ($decimal) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
        return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise ;
    }

    public function InvoiceParametters($invoice_id)
    {
        $masters = $this->InvoiceMasterByInvoiceId($invoice_id);
        $master = json_decode(json_encode($masters[0]), True);

        $details = $this->InvoiceDetailsByInvoiceId($invoice_id);
        $customers = $this->GetCustomerById($master['cus_id']);

        if($master['cus_ship_id'] <> 0)
        {
            $customer_branchs = $this->GetCustomerBranchById($master['cus_ship_id']);
            $customer_branch = (array) $customer_branchs[0];
        }
        else
        {
            $customer_branch = 0;
        }


        $customer = (array) $customers[0];


        return $res = array(
            'master' => $master,
            'details' => $details,
            'customer' => $customer,
            'customer_branch' => $customer_branch
        );
    }

    public function InvoiceDetailsByInvoiceId($invoice_id)
    {
        $this->db->select('*');
        $this->db->where('inv_no', $invoice_id);
        $qry = $this->db->get("invoice_detail");

        foreach ($qry->result() as $k => $v)
        {
            if($v->dc_no == '')
            {
                $dc_date = '';
            }
            else
            {
                $dc_date = $this->GetDcdateWiseInvno($v->dc_no);
            }

            $res[] = array(
                'id' => $v->id,
                'inv_id' => $v->inv_id,
                'inv_no' => $v->inv_no,
                'dc_no' => $v->dc_no,
                'dc_date' => $dc_date,
                'prod_id' => $v->prod_id,
                'prod_desc' => $v->prod_desc,
                'hsn_code' => $v->hsn_code,
                'qty' => $v->qty,
                'uom' => $v->uom,
                'price' => $v->price,
                'total' => $v->total,
                'discount' => $v->discount,
                'taxable_value' => $v->taxable_value,
                'cgst_rate' => $v->cgst_rate,
                'cgst_amount' => $v->cgst_amount,
                'sgst_rate' => $v->sgst_rate,
                'sgst_amount' => $v->sgst_amount,
                'igst_rate' => $v->igst_rate,
                'igst_amount' => $v->igst_amount,
                'tax_detail' => $v->tax_detail,
                'bundle_count' => $v->bundle_count,
                'no_of_bundle' => $v->no_of_bundle,
                'hanking' => $v->hanking,
                'ref_no' => $v->ref_no
            );
        }

        return $res;
        //print_r($res); exit;
    }

    public function GetDcdateWiseInvno($inv_no)
    {
        $qry = $this->db->query("SELECT inv_date AS dc_date
                                        FROM 
                                        delivery_master
                                        WHERE inv_no = '$inv_no'");


       $res = $qry->result();

        return $res[0]->dc_date;
    }

    public function InvoiceMasterByInvoiceId($invoice_id)
    {
        $this->db->select('*');
        $this->db->where('inv_no', $invoice_id);
        $qry = $this->db->get("invoice_master");
        return $qry->result();
    }

    public function GetCustomerBranchById($id)
    {
        $qry = $this->db->get_where("customer_branch", array('shi_id' => $id));
        if($qry)
        {
            return $qry->result();
        }
        else
        {
            return '';
        }

    }

    public function ViewInvoice($inv_id)
    {
        $qry = $this->db->get_where('invoice_master', array('inv_id' => $inv_id));
        return $qry->result();
    }

    public function DeleteInvoice($inv_id)
    {
        $qry1 = $this->db->delete('invoice_detail', array('inv_id' => $inv_id));
        if($qry1 > 0)
        {
            $qry = $this->db->delete('invoice_master', array('inv_id' => $inv_id));
            return $qry;
        }

    }

    public function DeliveryChallanNumberGenerator()
    {
        $qry = $this->db->get("delivery_master");

        if($qry->num_rows()== 0)
        {
            $inv_first_val = 'DC';
            $inv_middle_val = date('Y');
            $num = '000000';
            $inv_last_val = str_pad($num + 1, 6, 0, STR_PAD_LEFT);
            return $inv_no = $inv_first_val.'-'.$inv_middle_val.'-'.$inv_last_val;
        }
        else
        {
            $qry = $this->db->query("SELECT max(substr(inv_no,10,6)) AS `invoice_no` FROM delivery_master");
            $result = $qry->result();
            $max_inv_no =  $result[0]->invoice_no;
            $num = $max_inv_no;

            $inv_first_val = 'DC';
            $inv_middle_val = date('Y');
            $inv_last_val = str_pad($num + 1, 6, 0, STR_PAD_LEFT);
            return $inv_no = $inv_first_val.'-'.$inv_middle_val.'-'.$inv_last_val;
        }

    }

    public function SaveDeliveryChallan($data)
    {
        $inv_addrs = $this->GetBillingAddress($data['cus_id']);
        $bill_address = implode(",",$inv_addrs);

        if($data['ship_address'] == '')
        {
            $ship_addrs = $bill_address;
        }
        else
        {
            $ships_addrs = $this->GetShippingAddress($data['ship_address']);
            $ship_addrs = implode(",",$ships_addrs);
        }

        $data1 = array(
            'inv_no' => $this->DeliveryChallanNumberGenerator(),
            'cus_id' => $data['cus_id'],
            'inv_date' => $data['date'],
            'total' => array_sum($data['amount']),
            'net_amount' => round($data['totalamount']),
            'inv_address' => $ship_addrs,
            'inv_shipping_address' => $ship_addrs,
            'bill_generator_name' => $data['prepared_by'],
            'amount_in_words' => $this->getIndianCurrencyToWords(round($data['totalamount'])),
            'order_no' => $data['order_no'],
            'ref_no' => $data['ref_no'],
            'transport_mode' => $data['transport_mode'],
            'vehicle_no' => $data['vehicle_no'],
            'date_of_supply' => $data['date_of_supply'],
            'place_of_supply' => $data['place_of_supply']
        );

        $qry = $this->db->insert("delivery_master", $data1);
        $inv_id = $this->db->insert_id();


            if($qry == 1)
            {
               
                for ($i=0;$i<count($data['prod_id']); $i++)
                {
                   
                    $data2 = array(
                        'inv_id' =>  $inv_id,
                        'inv_no' =>  $data1['inv_no'],
                        'prod_id' =>  $data['prod_id'][$i],
                        'prod_desc' =>  $prod_desc = $this->GetProductNameByMultiple($data['prod_id'][$i]),
                        'hsn_code' =>  $data['hsncode'][$i],
                        'qty' =>  $data['qty'][$i],
                        'uom' =>  $data['uom'][$i],
                        'price' =>  $data['price'][$i],
                        'bundle_count' =>  $data['bundle_count'][$i],
                        'no_of_bundle' =>  $data['no_of_bundle'][$i],
                        'hanking' =>  $data['hanking'][$i],
                        'ref_no' =>  $data['ref_no']
                    );

                   $qry1 = $this->db->insert("delivery_detail",$data2);
                }

               if($qry1 == 1)
               {
                   return $data2['inv_no'];
               }
               else
               {
                   return 0;
               }
            }
    }

    public function GetDataPrintDeliveryChallan($dc_no)
    {
        $qry = $this->db->query("SELECT
                                              dd.prod_desc,
                                              dd.hsn_code,
                                              dd.qty,
                                              dd.uom,
                                              dd.price,
                                              dd.bundle_count,
                                              dd.no_of_bundle,
                                              dd.hanking,
                                              dd.ref_no,
                                              cus.cus_name,
                                              cus.cus_id,
                                              dm.inv_no,
                                              dm.net_amount,
                                              dm.amount_in_words,
                                              dm.inv_address,
                                              dm.inv_shipping_address,
                                              dm.inv_date,
                                              dm.bill_generator_name,
                                              dm.cus_ship_id,
                                              dm.transport_mode,
                                              dm.vehicle_no,
                                              dm.date_of_supply,
                                              dm.place_of_supply,
                                              dm.order_no,
                                              cus.cus_state,
                                              cus.cus_state_code,
                                              cus.cus_gstin_no
                                            FROM
                                              delivery_master AS dm
                                              JOIN
                                              delivery_detail AS dd
                                                ON (dm.inv_no = dd.inv_no)
                                              JOIN customer AS cus
                                                  ON (cus.cus_id = dm.cus_id)
                                              WHERE dm.inv_no = '$dc_no'
                                            ");
        foreach ($qry->result() as $v)
        {
            $res[] = array(
                'prod_desc' => $v->prod_desc,
                'hsn_code' => $v->hsn_code,
                'qty' => $v->qty,
                'uom' => $v->uom,
                'price' => $v->price,
                'cus_name' => $v->cus_name,
                'cus_id' => $v->cus_id,
                'inv_no' => $v->inv_no,
                'net_amount' => $v->net_amount,
                'amount_in_words' => $v->amount_in_words,
                'inv_address' => $v->inv_address,
                'inv_shipping_address' => $v->inv_shipping_address,
                'inv_date' => $v->inv_date,
                'bill_generator_name' => $v->bill_generator_name,
                'cus_ship_id' => $v->cus_ship_id,
                'cus_state' => $v->cus_state,
                'cus_state_code' => $v->cus_state_code,
                'cus_gstin_no' => $v->cus_gstin_no,
                'transport_mode' => $v->transport_mode,
                'vehicle_no' => $v->vehicle_no,
                'date_of_supply' => $v->date_of_supply,
                'place_of_supply' => $v->place_of_supply,
                'order_no' => $v->order_no,
                'bundle_count' => $v->bundle_count,
                'no_of_bundle' => $v->no_of_bundle,
                'hanking' => $v->hanking,
                'ref_no' => $v->ref_no
            );

        }

        return $res;
    }

    public function DeleteDC($id)
    {
        $qry1 = $this->db->delete('delivery_detail', array('inv_id' => $id));
        if($qry1 > 0)
        {
            $qry = $this->db->delete('delivery_master', array('dc_id' => $id));
            return $qry;
        }

    }

    public function ViewDC($inv_id)
    {
        $qry = $this->db->get_where('delivery_master', array('dc_id' => $inv_id));
        return $qry->result();
    }

    public function DCInvoiceGetCustomerProduct($cusid)
    {
        $qry = $this->db->query("SELECT * FROM delivery_master WHERE cus_id = '$cusid' AND status = 'g'");
        return $qry->result();
    }

    public function GetInvoiceFromDc($dcnum)
    {
        //$qry = $this->db->query("SELECT * FROM delivery_detail WHERE inv_no IN ($dcnum)");
        $qry = $this->db->query("SELECT *
                                        FROM   delivery_detail 
                                               JOIN product 
                                                 ON ( product.product_id = delivery_detail.prod_id ) 
                                               JOIN tax_group 
                                                 ON ( tax_group.tax_group_id = product.tax_group_id ) 
                                        WHERE  inv_no IN ($dcnum)");
        return $qry->result();
    }

    public function GetTaxDetails($tax_group_id,$statecode)
    {
        $qry = $this->db->query("SELECT * 
                                FROM   tax 
                                       JOIN tax_group 
                                         ON ( Find_in_set(tax.tax_id, tax_group.tax_id_groups) ) 
                                       JOIN tax_zone 
                                         ON ( tax.tax_zone_id = tax_zone.zone_id ) 
                                WHERE  tax_group.tax_group_id = '$tax_group_id' 
                                       AND Find_in_set('$statecode', tax_zone.zone_codes)");
        return $qry->result();
    }
}
?>



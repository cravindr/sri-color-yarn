<?php
/**
 * Created by PhpStorm.
 * User: Ravi
 * Date: 29-12-2017
 * Time: 11:02
 */

class Invoicedetail_model extends CI_Model
{
	/**
	 * @param $productId
	 * @param $qty
	 * @param $statecode
	 * @param $inv_id
	 */
	public function InsertDC($dc_no, $productId, $qty, $rate, $statecode, $inv_id, $inv_no, $bc, $nob, $hank, $refno)
	{
		//echo "InsertDC($dc_no,$productId, $qty, $statecode, $inv_id,$inv_no)";
		$qry = "SELECT
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
              FIND_IN_SET('$statecode', tax_zone.zone_codes) > 0
              AND tax_group.tax_group_id = product.tax_group_id
              AND product.product_id= '$productId'";

		//print_r($qry); exit;

		$res = $this->db->query($qry);
		$rows = $res->result();
		foreach ($rows as $row) {
			$total = 0;
			$this->InvoiceAfterUpdateStatusDeliveryMaster($dc_no);

			$bundle_count = $bc;
			$no_of_bundle = $nob;
			$hanking = $hank;
			$ref_no = $refno;

			$prod_id = $productId;
			$dcno = $dc_no;
			$prod_desc = $row->product_name;
			$hsn_code = $row->hsncode;
			$qty = $qty;
			$uom = $row->uom;
			$price = $rate;
			$total = $price * $qty;
			$discount = $row->discount;
			if ($discount == 'per') {
				$discount_per = $row->discount_per;
				$discount = $total * $discount_per / 100;
			} else {
				$discount = $row->discount_amount * $qty;
			}
			$taxable_value = $total;
			$tax_name[] = $row->tax_name;
			$cgst_rate[] = $row->tax_value;

		}

		/*        print_r($tax_name);
                echo "<br>";
                print_r($cgst_rate);
                echo " Price: $price : qty:$qty <br>";
                print_r($row);*/

		$rets = $this->GetTax($tax_name, $cgst_rate, $total);
		/*      echo "<br> Res:";
               print_r($rets);*/
		$tax_total = 0;
		$tax_desc = "";
		$sgst = 0;
		$cgst = 0;
		$igst = 0;
		$sgst_rate = 0;
		$cgst_rate = 0;
		$igst_rate = 0;
		foreach ($rets as $ret) {
			/*    echo "<br>";
                   print_r($ret);
                echo "<br>";*/
			$tax_total = $tax_total + $ret["tax_amount"];
			if ($tax_desc == "") {
				$tax_desc = $ret["tax_name"] . ":" . $ret["tax_amount"];
			} else {
				$tax_desc = $tax_desc . ";" . $ret["tax_name"] . ":" . $ret["tax_amount"];
			}
			// echo "<br>".$ret["tax_name"];
			if (strcasecmp(substr($ret["tax_name"], 0, 4), "SGST") == 0) {
				$sgst = $this->CalculateTax($total, $ret["tax_rate"]);
				$sgst_rate = $ret["tax_rate"];

			} elseif (strcasecmp(substr($ret["tax_name"], 0, 4), "CGST") == 0) {
				$cgst = $this->CalculateTax($total, $ret["tax_rate"]);
				$cgst_rate = $ret["tax_rate"];
			} elseif (strcasecmp(substr($ret["tax_name"], 0, 4), "IGST") == 0) {
				$igst = $this->CalculateTax($total, $ret["tax_rate"]);
				$igst_rate = $ret["tax_rate"];
			}

		}
		//echo "<br>Total Tax: $tax_total and Desc :$tax_desc";
		//echo "<br> SGST:$sgst : CGST:$cgst  : IGST:$igst";
		// exit;


		$cgst_amount = $cgst;
		//$sgst_rate;
		$sgst_amount = $sgst;
		// $igst_rate;
		$igst_amount = $igst;
		$tax_detail = $tax_desc;


		$data = array(
			'inv_id' => $inv_id,
			'inv_no' => $inv_no,
			'dc_no' => $dcno,
			'prod_id' => $prod_id,
			'prod_desc' => $prod_desc,
			'hsn_code' => $hsn_code,
			'qty' => $qty,
			'uom' => $uom,
			'price' => $price,
			'total' => $total,
			'discount' => $discount,
			'taxable_value' => $taxable_value,
			'cgst_rate' => $cgst_rate,
			'cgst_amount' => $cgst_amount,
			'sgst_rate' => $sgst_rate,
			'sgst_amount' => $sgst_amount,
			'igst_rate' => $igst_rate,
			'igst_amount' => $igst_amount,
			'tax_detail' => $tax_detail,
			'bundle_count' => $bundle_count,
			'no_of_bundle' => $no_of_bundle,
			'hanking' => $hanking,
			'ref_no' => $ref_no
		);


//print_r($data); exit;

		return $qry = $this->db->insert("invoice_detail", $data);

	}

	public function Insert($productId, $qty, $rate, $statecode, $inv_id, $inv_no)
	{
		//print_r("Insert($productId, $qty, $statecode, $inv_id,$inv_no)"); exit;
		$qry = "SELECT
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
  FIND_IN_SET('$statecode', tax_zone.zone_codes) > 0
  AND tax_group.tax_group_id = product.tax_group_id
  AND product.product_id= '$productId'";


		$res = $this->db->query($qry);
		$rows = $res->result();
		foreach ($rows as $row) {
			$total = 0;


			$prod_id = $productId;
			$prod_desc = $row->product_name;
			$hsn_code = $row->hsncode;
			$qty = $qty;
			$uom = $row->uom;
			$price = $rate;
			$total = $price * $qty;
			$discount = $row->discount;
			if ($discount == 'per') {
				$discount_per = $row->discount_per;
				$discount = $total * $discount_per / 100;
			} else {
				$discount = $row->discount_amount * $qty;
			}
			$taxable_value = $total;
			$tax_name[] = $row->tax_name;
			$cgst_rate[] = $row->tax_value;

		}

		/*        print_r($tax_name);
                echo "<br>";
                print_r($cgst_rate);
                echo " Price: $price : qty:$qty <br>";
                print_r($row);*/

		$rets = $this->GetTax($tax_name, $cgst_rate, $total);
		/*      echo "<br> Res:";
               print_r($rets);*/
		$tax_total = 0;
		$tax_desc = "";
		$sgst = 0;
		$cgst = 0;
		$igst = 0;
		$sgst_rate = 0;
		$cgst_rate = 0;
		$igst_rate = 0;
		foreach ($rets as $ret) {
			/*    echo "<br>";
                   print_r($ret);
                echo "<br>";*/
			$tax_total = $tax_total + $ret["tax_amount"];
			if ($tax_desc == "") {
				$tax_desc = $ret["tax_name"] . ":" . $ret["tax_amount"];
			} else {
				$tax_desc = $tax_desc . ";" . $ret["tax_name"] . ":" . $ret["tax_amount"];
			}
			// echo "<br>".$ret["tax_name"];
			if (strcasecmp(substr($ret["tax_name"], 0, 4), "SGST") == 0) {
				$sgst = $this->CalculateTax($total, $ret["tax_rate"]);
				$sgst_rate = $ret["tax_rate"];

			} elseif (strcasecmp(substr($ret["tax_name"], 0, 4), "CGST") == 0) {
				$cgst = $this->CalculateTax($total, $ret["tax_rate"]);
				$cgst_rate = $ret["tax_rate"];
			} elseif (strcasecmp(substr($ret["tax_name"], 0, 4), "IGST") == 0) {
				$igst = $this->CalculateTax($total, $ret["tax_rate"]);
				$igst_rate = $ret["tax_rate"];
			}

		}
		//echo "<br>Total Tax: $tax_total and Desc :$tax_desc";
		//echo "<br> SGST:$sgst : CGST:$cgst  : IGST:$igst";
		// exit;


		$cgst_amount = $cgst;
		//$sgst_rate;
		$sgst_amount = $sgst;
		// $igst_rate;
		$igst_amount = $igst;
		$tax_detail = $tax_desc;


		$data = array(
			'inv_id' => $inv_id,
			'inv_no' => $inv_no,
			'dc_no' => '',
			'prod_id' => $prod_id,
			'prod_desc' => $prod_desc,
			'hsn_code' => $hsn_code,
			'qty' => $qty,
			'uom' => $uom,
			'price' => $price,
			'total' => $total,
			'discount' => $discount,
			'taxable_value' => $taxable_value,
			'cgst_rate' => $cgst_rate,
			'cgst_amount' => $cgst_amount,
			'sgst_rate' => $sgst_rate,
			'sgst_amount' => $sgst_amount,
			'igst_rate' => $igst_rate,
			'igst_amount' => $igst_amount,
			'tax_detail' => $tax_detail
		);

//print_r($data);

		return $qry = $this->db->insert("invoice_detail", $data);

	}

	public function GetTax($tax_name, $cgst_rate, $total)
	{
		// $ret=new stdClass();

		foreach ($tax_name as $key => $value) {
			//print "$key holds $value\n";
			//echo $tax_name[$key].":".$cgst_rate[$key]."<br>";

			$tax_n = $tax_name[$key];
			$tax_a = $cgst_rate[$key];
			$ret[] = array("tax_name" => $tax_n,
				"tax_rate" => $tax_a,
				"tax_amount" => $this->CalculateTax($total, $tax_a)
			);

		}

		return $ret;
	}

	public function CalculateTax($totalamount, $taxper)
	{
		return $totalamount * $taxper / 100;
	}

	public function InvoiceAfterUpdateStatusDeliveryMaster($invno)
	{
		$data = array(
			'status' => 'i'
		);

		$qry = $this->db->update('delivery_master', $data, "inv_no = '$invno'");

		return $qry;
	}

}

<?php
/**
 * Created by PhpStorm.
 * User: Attract-01
 * Date: 1/5/2018
 * Time: 12:59 PM
 */

require_once ('common/html_open.php');

require_once ('common/head_open.php');
require_once ('common/meta.php');
require_once ('common/link_css.php');
require_once ('delivery-challan/delivery-style/invoice_style.php');
require_once ('common/head_close.php');

require_once ('common/body_open.php');

require_once('delivery-challan/head/dc_company_top_details.php');
require_once('delivery-challan/body/dc_body_head_details.php');

require_once('delivery-challan/body/dc_body_product_category_open.php');

require_once('delivery-challan/body/dc_body_product_category_header.php');
require_once('delivery-challan/body/dc_body_product_category_body.php');
require_once('delivery-challan/body/dc_body_product_category_close.php');
require_once('delivery-challan/body/dc_body_amount_details.php');
require_once('delivery-challan/foot/dc_footer_details.php');

require_once ('common/link_js.php');
?>
<script>
    $(function () {
        window.print();
    });
</script>
<?php
require_once ('common/body_close.php');

require_once ('common/html_open.php');

?>
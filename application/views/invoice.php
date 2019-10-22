<?php

require_once ('common/html_open.php');

require_once ('common/head_open.php');
require_once ('common/meta.php');
require_once ('common/link_css.php');
require_once ('invoice/invoice-style/invoice_style.php');
require_once ('common/head_close.php');

require_once ('common/body_open.php');

require_once('invoice/head/invoice_company_top_details.php');
require_once('invoice/body/invoice_body_head_details.php');

require_once('invoice/body/invoice_body_product_category_open.php');

require_once('invoice/body/invoice_body_product_category_header.php');
require_once('invoice/body/invoice_body_product_category_body.php');
require_once('invoice/body/invoice_body_product_category_close.php');
require_once('invoice/body/invoice_body_amount_details.php');
require_once('invoice/foot/invoice_footer_details.php');

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
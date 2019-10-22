<?php
/**
 * Created by PhpStorm.
 * User: Attract-01
 * Date: 1/30/2018
 * Time: 5:09 PM
 */

require_once ('common/html_open.php');

require_once ('common/head_open.php');
require_once ('common/meta.php');
require_once ('common/link_css.php');
require_once ('dashboard/dashboard_common_css.php');
require_once ('plugins/bootstrap_select_css.php');
require_once ('plugins/bootstrap_fileinput_css.php');
require_once ('plugins/bootstrap_datetimepicker_css.php');
require_once ('common/head_close.php');

require_once ('common/body_open.php');

require_once ('dashboard/dashboard_main_container_open.php');
require_once ('dashboard/dashboard_left_side_content.php');
require_once ('dashboard/dashboard_top_navigation.php');

require_once ('dashboard/dashboard_main_content_open.php');
require_once ('purchase/purchase_form.php');
require_once ('dashboard/dashboard_main_content_close.php');

require_once ('dashboard/dashboard_main_container_close.php');

require_once ('common/link_js.php');
require_once ('dashboard/dashboard_common_js.php');

require_once ('plugins/bootstrap_fileinput_js.php');
require_once ('plugins/bootstrap_datetimepicker_js.php');
require_once('invoice/dc_with_invoice_js.php');
require_once ('plugins/bootstrap_select_js.php');
require_once ('common/body_close.php');

require_once ('product/modal_window_product.php');
require_once ('common/html_close.php');
?>
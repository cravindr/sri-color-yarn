<?php
/**
 * Created by PhpStorm.
 * User: Attract-01
 * Date: 1/30/2018
 * Time: 11:19 AM
 */

require_once ('common/html_open.php');

require_once ('common/head_open.php');
require_once ('common/meta.php');
require_once ('common/link_css.php');
require_once ('dashboard/dashboard_common_css.php');
require_once ('plugins/datatables_css.php');
require_once ('plugins/bootstrap_select_css.php');
require_once ('plugins/datatables_custom_css.php');
require_once ('common/head_close.php');

require_once ('common/body_open.php');

require_once ('dashboard/dashboard_main_container_open.php');
require_once ('dashboard/dashboard_left_side_content.php');
require_once ('dashboard/dashboard_top_navigation.php');

require_once ('dashboard/dashboard_main_content_open.php');
require_once('purchase/purchase_table_list.php');
require_once ('dashboard/dashboard_main_content_close.php');

require_once ('dashboard/dashboard_main_container_close.php');

require_once ('common/link_js.php');
require_once ('dashboard/dashboard_common_js.php');
require_once ('plugins/datatables_js.php');
require_once ('plugins/bootstrap_select_js.php');
require_once('purchase/purchase_list_js.php');
require_once ('common/body_close.php');

require_once ('purchase/purchase_model_forms.php');

require_once ('common/html_open.php');
?>